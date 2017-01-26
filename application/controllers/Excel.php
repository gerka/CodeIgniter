<?php
class Excel extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('ItemCard_model');
		    $this->load->model('Staff_model');
		    $this->load->model('Filter_model');
		    $this->load->model('Menu_model');
		    $this->load->model('ImageControl_model');
		    $this->load->model('Element_model');
		    $this->load->model('Review_model');
            $this->load->helper('url_helper');
            $this->load->library('Excell');
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
			$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
			$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2.min.css");
			$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/icheck/skins/all.css");
			$this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
			$this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
			$this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
			$this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/select2/js/select2.full.min.js");
			$this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/icheck/icheck.min.js");


			$this->breadcrumb->add_crumb('Панель администратора', '/admin/');
        }
  public function index()
  {
    //$data['cards_item'] = $this->ItemCard_model->get_cards();
    //$data['title'] = 'Архив карточек товара';
    $this->load->view('templates/header', $data);
    $this->load->view('ItemCards/index', $data);
    $this->load->view('templates/footer');
  }

  public function AddRelationFilter()
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
          
              $data = [
              'childCat'=>$this->input->post('childCat'),
                'parentCat'=>$this->input->post('parentCat'),
                'idParentCat'=>$this->input->post('idParentCat'),
                'idChildCat'=>$this->input->post('idChildCat'),
                'compareField'=>$this->input->post('compareField')
              ];
              echo $this->Filter_model->import_filter_relations($data);
              
        }
  }

  public function importCard()
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
        	//var_dump($_FILES['file']['tmp_name']);
          if (empty($_FILES['file']['tmp_name']))
          {
            $data['status'] = 1;
            echo (json_encode($data));
          }
          else{

          	$file = $_FILES['file']['tmp_name'];
          	//read file from path
          	
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			 
			//get only the Cell Collection
			$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
			 
			//extract to a PHP readable array format
			foreach ($cell_collection as $cell) {
			    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
			    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
			    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
			 
			    //header will/should be in row 1 only. of course this can be modified to suit your need.
			    if ($row == 1) {
			        $header[$row][$column] = $data_value;
			    } else {
			        $arr_data[$row][$column] = $data_value;
			    }
			}
			 
			//send the data in an array format
			$data['header'] = $header;
			$data['values'] = $arr_data;
			$data['status'] = 1;


            echo (json_encode($data));
          }   
        }  
      }
  
  public function import($slug = false)
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
			    //$data['cards_item'] = $this->ItemCard_model->get_cards();
			    $data['FilterCat'] = $this->Filter_model->get_filter_cat();
          $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
          $this->data['page_level_script'][] = array('src' => asset_url()."global/scripts/urlLit.js");
        	$this->data['page_level_script'][] = array('src' => asset_url()."global/plugins/jquery.json.min.js");
          
			    $this->breadcrumb->add_crumb('Импорт карточек', '/admin/excel/import');
			    $data['title'] = 'Excel';
			    $this->load->view('templates/admin/include/head', $data);
			    $this->load->view('templates/admin/include/header', $data);
			    $this->load->view('templates/admin/include/breadcrumbs', $data);
			    $this->load->view('templates/admin/include/sidebar', $data);
          switch ($slug) {
            case 'filters':
            $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/importExcelForm.js");
            $data['title'] = 'Импорт фильтров';
             $this->load->view('admin/Excel/importFilters', $data);
              break;
            case 'filtersRelations':
            $data['title'] = 'Импорт связей фильтров';
            $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/importExcelRelationsForm.js");
             $this->load->view('admin/Excel/importFiltersRelations', $data);
              break;
            
            default:
            $data['title'] = 'Импорт карточек';
            $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/importExcelForm.js");
              $this->load->view('admin/Excel/import', $data);
              break;
          }
			    
			    $this->load->view('templates/admin/include/footer', $data);
			    $this->load->view('templates/admin/include/javascript');
			}
  }
}