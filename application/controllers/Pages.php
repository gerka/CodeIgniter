<?php
class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Page_model');
        $this->load->helper('url_helper');
        $this->load->model('Element_model');

        $this->breadcrumb->add_crumb('Панель администратора', '/admin/');
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
                    $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createPageForm.js");

                    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
                    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");


                    $this->data['page_level_plugin'][] = array(
                        'src' => asset_url()."global/scripts/datatable.js"
                        );
                    $this->data['page_level_plugin'][] = array(
                        'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
                        );
                    $this->data['page_level_plugin'][] = array(
                        'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
                        );
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");

                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");

                    $data['title'] = 'Создание статичной страницы';
                    $this->breadcrumb->add_crumb('Создание страницы', '/admin/Pages/create');
                    $this->load->helper('form');
                    $this->load->view('templates/admin/include/head', $data);
                    $this->load->view('templates/admin/include/header', $data);
                    $this->load->view('templates/admin/include/breadcrumbs', $data);
                    $this->load->view('templates/admin/include/sidebar', $data);
                    $this->load->view('admin/Pages/create', $data);
                    $this->load->view('templates/admin/include/footer', $data);
                    $this->load->view('templates/admin/include/javascript');
                }
            }
            public function createPage()
            {
             // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок', 'required');
               
                if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    
                    $url = $this->input->post('alias');
                    $idElement = $this->Page_model->setUrl($url);

                    $data['post'] = array(
                    'title' => $this->input->post('title'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'description' => $this->input->post('meta_description'),
                    'h1' => $this->input->post('h1'),
                    'body' => $this->input->post('body'),
                    'alias' => $this->input->post('alias'),
                    'preview_text' => $this->input->post('preview_text'),
                    'public' => $this->input->post('public'),
                    'archive' => $this->input->post('archive'),
                    'js' => $this->input->post('js'),
                    'css' => $this->input->post('css'),
                    'plugin' => $this->input->post('plugin'),
                    
                );
                    $data['post']['id_element'] = $idElement;
                    $echo = $this->Page_model->set_page($data['post']);
                    echo ($echo);

                }  
            }

            public function view($page = 'home')
            {
              if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
              {
                // Whoops, we don't have a page for that!
                show_404();
            }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
    public function show_pages($slug = false)
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
   if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'filter')
{   
    $id = ($_REQUEST['id'] == '') ? false : $_REQUEST['id'] ;
    $h1 = ($_REQUEST['h1'] == '') ? false : $_REQUEST['h1'] ;
    $url = ($_REQUEST['alias'] == '') ? false : $_REQUEST['alias'] ;
    

    $data['pages'] = $this->Page_model->get_pages_Byfilter($id,$h1,$url);
}
else{ $data['pages'] = $this->Page_model->get_pages(); }

  
  $iTotalRecords = count($data['pages']);
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

  foreach ($data['pages'] as $key => $value) {
    $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['idPage'].'"/><span></span></label>',
      $value['idPage'],
      $value['h1'],
      $value['alias'],
      '<a href="change/'.$value["idPage"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><a href="delete/'.$value["idPage"].'" data-del-item="'.$value["idPage"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a><br><a href=/'.$value["alias"].' target=_blank class="archive btn btn-sm btn-default btn-circle btn-editable" ><i class="fa fa-pencil" ></i> Просмотреть страницу</a>',
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
} else {

    unset($this->data['page_level_script']);
    unset($this->data['page_level_plugin']);
    $this->data['page_level_plugin'][] = array(
        'src' => asset_url()."global/scripts/datatable.js"
        );
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
    $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showPagesForm.js");
    $data['title'] = 'Просмотр страниц';
    $data['pages'] = $this->Page_model->get_pages();
    $this->breadcrumb->add_crumb('Просмотр страниц', '/admin/pages/show_pages');
    $this->load->helper('form');
    $this->load->view('templates/admin/include/head', $data);
    $this->load->view('templates/admin/include/header', $data);
    $this->load->view('templates/admin/include/breadcrumbs', $data);
    $this->load->view('templates/admin/include/sidebar', $data);
    $this->load->view('admin/Pages/show_pages', $data);
    $this->load->view('templates/admin/include/footer', $data);
    $this->load->view('templates/admin/include/javascript');
}
}
}
public function change($idPage)
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
                $data['PageItem'] = $this->Page_model->get_pages($idPage);

                if (empty($data['PageItem']))
                {
                    show_404();
                }
                // set the flash data error message if there is one
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changePageForm.js");

                $data['title'] = 'Редактирование страницы';
                $this->breadcrumb->add_crumb('Редактирование страницы', '/admin/cards/change');
                $this->load->helper('form');
                

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Pages/change', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
            }
        }
        public function changePage($idPage)
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
                

        if (empty($idPage))
        {
                show_404();
        }
               // Обязательные формы для заполнения карточки товара
                
                $this->form_validation->set_rules('body', 'Основной текст', 'required');
                
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $data['post'] = array(
                    'idPage'=> $idPage,
                    'title' => $this->input->post('title'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'description' => $this->input->post('meta_description'),
                    'h1' => $this->input->post('h1'),
                    'body' => $this->input->post('body'),
                    'alias' => $this->input->post('alias'),
                    'preview_text' => $this->input->post('preview_text'),
                    'public' => $this->input->post('public'),
                    'archive' => $this->input->post('archive'),
                    'js' => $this->input->post('js'),
                    'css' => $this->input->post('css'),
                    //'id_element'=>$this->input->post('id_element'),
                    'plugin' => $this->input->post('plugin')
                );
                    
                    echo ($this->Page_model->set_page($data['post']));
                }   
            }  
        }
        public function deletePage($idPage)
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
                

        if (empty($idPage))
        {
                show_404();
        }
            else{
                    echo ($this->Page_model->delete_page($idPage));
                }   
            }  
        }

    }


    ?>