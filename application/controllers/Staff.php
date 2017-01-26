<?php
class Staff extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ItemCard_model');
    $this->load->model('Staff_model');
    $this->load->model('Filter_model');
    $this->load->model('ImageControl_model');
    $this->load->helper('url_helper');    
    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
    $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
    $this->breadcrumb->add_crumb('Панель администратора', '/admin/');
  }
  public function changeStaff($idStaff)
        {
            if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
                redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
                return show_error('You must be an administrator to view this page.');
            }
            else
            {
                

        if (empty($idStaff))
        {
                show_404();
        }
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('name', 'Имя преподователя', 'required');
                //$this->form_validation->set_rules('body', 'Основной текст', 'required');
                
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{

                    $data['post'] = array(
                    'id_staff'=> $idStaff,
                    'name' => $this->input->post('name'),
                    'description'=>$this->input->post('description'),
                    'alias' => $this->input->post('alias'),
                    'sort'=>$this->input->post('sort'),
                    'logo'=>$this->input->post('logo'),
                    'etc'=>$this->input->post('etc'),
                    'email' =>$this->input->post('email'),
                    'telephone' =>$this->input->post('telephone'),
                    'site' =>$this->input->post('site')

                );
                    echo ($this->Staff_model->set_staff($data['post']));
                   
                }   
            }  
        }
public function show_images($idStaff = false)
  {
 
    if (!$this->ion_auth->logged_in())
    {
                // redirect them to the login page
      redirect('auth/login', 'refresh');
      $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
              return show_error('You must be an administrator to view this page.');
            }
            else
            {

              if ($idStaff !=false) {
  /* 
   * Paging
   */

  $data['images'] = $this->ImageControl_model->get_images_staff($idStaff); }

  if(!empty($data['images'])){
  $iTotalRecords = count($data['images']);
  $iDisplayLength = intval($_REQUEST['length']);
  $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  $iDisplayStart = intval($_REQUEST['start']);
  $sEcho = intval($_REQUEST['draw']);
  $records = array();
  $records["data"] = array(); 

  $end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;

  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
    );
  foreach ($data['images'] as $key => $value) {
    $image_type['logo'] = ($value['type']=='logo') ? 'checked' : '' ;
    $image_type['base'] = ($value['type']=='base') ? 'checked' : '' ;
    $image_type['small'] = ($value['type']=='small') ? 'checked' : '' ;
    $records["data"][] = array(
      '<a href="/'.$value['url'].'" class="fancybox-button" data-rel="fancybox-button">
                                                                        <img class="img-responsive" src="/'.$value['url'].'" alt="'.$value['alt'].'"> </a>',
      '<input type="text" class="form-control" name="images['.$value['idImage'].']["alt"]" value="'.$value['alt'].'"> ',
      '<input type="text" class="form-control" name="images['.$value['idImage'].']["sort"]" value="1">',
      '<label><input type="radio" name="images['.$value['idImage'].'][image_type]" '.$image_type['base'].' value="base"> </label>',
      '<label><input type="radio" name="images['.$value['idImage'].'][image_type]" '.$image_type['small'].' value="small"> </label>',
      '<label><input type="radio" name="images['.$value['idImage'].'][image_type]" '.$image_type['logo'].' value="logo"> </label>',
      '<button type="button" data-del-item="'.$value["idImage"].'" class="remove btn btn-sm btn-default btn-circle btn-editable" onclick="initRemoveButton()"><i class="fa fa-pencil" ></i> Delete</button>',
      );
  }

  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  $records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
} 
}
}
public function set_image_has_staff($idStaff=false,$idImage=false)
{
  $out = $this->ImageControl_model->set_image_has_staff($idStaff,$idImage);
  if ($out == false) {
    echo '{"status":"0"}';
  }
  else{
    echo '{"status":"1"}';
  }
  return $out;
}
 public function change($idStaff)
        {
        if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
                redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
                return show_error('You must be an administrator to view this page.');
            }
            else
            {
                $data['staffItem'] = $this->Staff_model->get_staffs($idStaff);

        if (empty($data['staffItem']))
        {
                show_404();
        }
        
                // set the flash data error message if there is one
                $this->data['page_level_plugin'][] = array(
                    'src' => asset_url()."global/scripts/datatable.js"
                    );
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeStaffForm.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."global/scripts/urlLit.js");
                $data['title'] = 'Редактирование преподавателя '.$data['staffItem']['name'];
                $this->breadcrumb->add_crumb('Редактирование преподователя', '/admin/staff/change');
                $this->load->helper('form');
                $data['cards_select'] = $this->Staff_model->get_staff_idStaff($idStaff);

                $data['filterCountry'] = $this->Staff_model->get_filter_staff_idStaff_idCatFilter($idStaff,93);
                $data['filterRegion'] = $this->Staff_model->get_filter_staff_idStaff_idCatFilter($idStaff,180);
                $data['filterCity'] = $this->Staff_model->get_filter_staff_idStaff_idCatFilter($idStaff,94);
                

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Staff_model->get_filters();
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Staff/change', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
  public function create()
        {
        if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
                redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
                return show_error('You must be an administrator to view this page.');
            }
            else
            {
                // set the flash data error message if there is one
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
                $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
                );
              $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
                );
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createStaffForm.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."global/scripts/urlLit.js");
                $data['cards_select'] = $this->Staff_model->get_staff_idStaff();
                $data['title'] = 'Создание преподавателя';
                $this->breadcrumb->add_crumb('Создание фильтра', '/admin/staff/create');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Staff/create', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }

   public function bloodhound_name($request=False)
          {
            if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
              redirect('auth/login', 'refresh');
              $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
              return show_error('You must be an administrator to view this page.');
            }
            else
            {
              $request = (isset($_GET['name'])) ? $_GET['name'] : '' ;
              
              if ($request!='') {
                // $request=mb_convert_encoding ($request, "UTF-8", mb_detect_encoding($request));
                

                $response = $this->Staff_model->find_staffs($request);
                echo $response;
                return $response;
              }
              else{
                $response = ['value'=>'Не вышло'];
                echo json_encode($response);
                return $response;
              }
            }
          }
           public function createStaff()
        {
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('name', 'ФИО', 'required');
                //$this->form_validation->set_rules('type', 'Тип', 'required');
                //$this->form_validation->set_rules('value', 'Значение', 'required');
                
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $echo = $this->Staff_model->set_staff();
                    echo($echo);
                   
                }   
            }  
            public function show_staff($slug = false)
        {
        if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
                redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
                return show_error('You must be an administrator to view this page.');
            }
            else
            {
                if ($slug !=false) {
  /* 
   * Paging
   */

  //var_dump($_POST["selected"]);

  $data['staff'] = $this->Staff_model->get_staffs();
  $iTotalRecords = count($data['staff']);
  // $iDisplayLength = intval($_REQUEST['length']);
  //$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  //$iDisplayStart = intval($_REQUEST['start']);
  //$sEcho = intval($_REQUEST['draw']);

  $records = array();
  $records["data"] = array(); 

  // $end = $iDisplayStart + $iDisplayLength;
  // $end = $end > $iTotalRecords ? $iTotalRecords : $end;

  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
  );

foreach ($data['staff'] as $key => $value) {
        $records["data"][] = array(
      //'<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_staff'].'"/><span></span></label>',
      //'<img style="width:50px;height:auto;" src="/images/'.$value['logo'].'" data-id="'.$value['id_staff'].'"/>',
      $value['id_staff'],
      $value['name'],
      $value['description'],
      $value['sort'],
      '<a href="change/'.$value["id_staff"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a><a href="javascript:;" onclick="initArchiveButton()" data-del-item="'.$value["id_staff"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a><a target="_blank" href="/'.$value["alias"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Просмотр</a>',
    );
  }

  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  //$records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
                } else {
                    # code...
                
                
                // set the flash data error message if there is one
                // unset($this->data['page_level_script']);
                // unset($this->data['page_level_plugin']);
                $this->data['page_level_plugin'][] = array(
                    'src' => asset_url()."global/scripts/datatable.js"
                    );
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showStaffForm.js");
                $data['title'] = 'Просмотр преподавателей';
                $this->breadcrumb->add_crumb('Просмотр преподавателей', '/admin/filter/show_filters');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Staff/show_staff', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
                }
        }
        }

        function set_staff_has_card($id_card=false){
          if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
                redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
                return show_error('You must be an administrator to view this page.');
            }
            else
            {
              $data = $this->input->post('staff');
              if($result = $this->Staff_model->set_staf_has_card($id_card,$data)){return $result;}
            }
        }

        public function deleteStaff($idStaff)
        {
            if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
                redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
                return show_error('You must be an administrator to view this page.');
            }
            else
            {
                

        if (empty($idStaff))
        {
                show_404();
        }
            else{
                   
                    echo ($this->Staff_model->delete_staff($idStaff));
                }   
            }  
        }
}