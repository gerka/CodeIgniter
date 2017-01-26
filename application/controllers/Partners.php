<?php
class Partners extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Partners_model');
                $this->load->model('Menu_model');
                $this->load->helper('url_helper');
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
			    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
			    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
			    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/date.js");
			    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
			    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
               
        }
        public function getPartners(){
        	if ($this->input->post('pub')!=1) {
        		redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');
        	}
        	$data = $this->Partners_model->get_partners();
        	print(json_encode($data));
        	return ;
        }
        public function change($idPartner = false)
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
            	$this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
				$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2.min.css");
				$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2-bootstrap.min.css");
				$this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/select2/js/select2.min.js");
				$this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changePartnersForm.js");
            	$data['title']= 'Просмотр партнера '.$idPartner;
            	$this->breadcrumb->add_crumb($data['title'], '/admin/prtners/change/'.$idPartner);
            	$data['PartnerItem'] = $this->Partners_model->get_partners($idPartner);
            	$data['menu'] = $this->Menu_model->get_menu();
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Partners/change', $data);
               // $this->load->view('admin/Menu/addCards', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
            }
        }
        public function changePartners($idPartner = false)
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


              if (empty($idPartner))
              {
                show_404();
              }
               // Обязательные формы для заполнения карточки товара
              //$this->form_validation->set_rules('title', 'Заголовок', 'required');
              $this->form_validation->set_rules('company', 'Название компании', 'required');

                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
              if ($this->form_validation->run() === FALSE)
              {
                echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
              }
              else{
                $data['post'] = array(
                  'id'=> $idPartner,
                  'name' => $this->input->post('name'),
                  'company' => $this->input->post('company'),
                  'phone' => $this->input->post('phone'),
                  'approve' => $this->input->post('approve'),
                  'email' => $this->input->post('email'),
                  'id_menu' => $this->input->post('id_menu'),
                  'image' => $this->input->post('image'),
                  'url' => $this->input->post('url')
                  );
                $old = $this->Partners_model->get_partners($data['post']['id']);
                echo ($this->Partners_model->set_partner($data['post']));
                

                

                if($old['approve']!=$data['post']['approve']){
                	$this->email->from('globe.yoga@yandex.ru', 'Info Partnership');
                	$this->email->to($this->input->post($data['post']['email']));
                	$this->email->subject('Change Status');
                	$message = 'Thank for your interst!'."\n";
                	if($data['post']['approve'] !=1 )
                	{
                		$message = $message.'Sorry, now, you are not our partner'."\n";
                	}
                	else
                	{
                		$message = $message.'Now, you are our partner'."\n";
                	}
                	
                	$this->email->message($message);
					$email=$this->email->send();
                }
              }   
            }  
          }
        public function show_partners($slug=false)
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

  $data['rows'] = $this->Partners_model->get_partners();
  $iTotalRecords = count($data['rows']);


  $records = array();
  $records["data"] = array(); 


  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
  );

foreach ($data['rows'] as $key => $value) {
if ($value['approve'] == 0) {$button = 'danger'; $pub='Не опубликовано';} else {$button = 'success';$pub='Опубликовано';}
        $records["data"][] = array(
      // '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_menu'].'"/><span></span>'.$value["id_menu"].'</label>',
      $value['name'],
      $value['company'],
      $value['phone'],
      '<button class="btn btn-sm btn-'.$button.' filter-cancel" data-public="'.$value["approve"].'" data-item="'.$value["id"].'" onclick="initPublicReviewButton()"> '.$pub.'</button>',
      '<a href="change/'.$value["id"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a><a href="javascript:;" data-del-item="'.$value["id"].'" onclick="initArchiveButton()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>',
    );
  }
  
  echo json_encode($records);
                } else {
                    # code...
                
                
                // set the flash data error message if there is one
                unset($this->data['page_level_script']);
                unset($this->data['page_level_plugin']);
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jstree/dist/themes/default/style.min.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
                $this->data['page_level_plugin'][] = array(
                    'src' => asset_url()."global/scripts/datatable.js"
                    );
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
                $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jstree/dist/jstree.min.js"); 
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showPartnersForm.js");
                
                
                
                $data['title'] = 'Просмотр партнеров';
                // $data['rows'] = $this->Menu_model->get_menu();
                // $data['Menu'] = $this->Menu_model->get_menu();

                // $data['CardsCat'] = $this->ItemCard_model->get_cards();
                $this->breadcrumb->add_crumb('Просмотр партнеров', '/admin/prtners/show_partners');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Partners/show_partners', $data);
               // $this->load->view('admin/Menu/addCards', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
                }
        }
        }
}
?>