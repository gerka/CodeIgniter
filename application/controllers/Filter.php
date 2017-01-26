<?php
class Filter extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Filter_model');
                $this->load->model('Element_model');
                $this->load->model('Language_model');
                $this->load->helper('url_helper');
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/scripts/urlLit.js");
                
                //$this->data['page_level_script'][] =  array('src' => asset_url()."pages/scripts/table-datatables-managed.js");

                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
                // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                // $this->data['page_level_plugin'][] =array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");

                $this->breadcrumb->add_crumb('Панель администратора', '/admin/');

                
        }

        public function index()
        {
                $data['cards_item'] = $this->ItemCard_model->get_cards();
                $data['title'] = 'Архив карточек товара';
                $this->load->view('templates/header', $data);
                $this->load->view('itemCards/index', $data);
                $this->load->view('templates/footer');
        }
        public function addParentFilter()
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
                
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jstree/dist/themes/default/style.min.css");
                
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-select/css/bootstrap-select.min.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
                $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
                );
              $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
                );
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-select/js/bootstrap-select.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
                
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jstree/dist/jstree.min.js"); 
                
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
                $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/addParentFilter.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/ui-tree.min.js");
                $data['title'] = 'Добавление родителя для фильтра';
                //$data['position_menu'] = $this->Menu_model->get_position_menu();
                $data['Menu'] = $this->Filter_model->get_filter_all(false,true);
                $data['FilterCat'] = $this->Filter_model->get_filter_all();
                $data['Cats'] = $this->Filter_model->get_filter_cat();
                $this->breadcrumb->add_crumb('Добавление родителя для фильтра', '/admin/filter/addFilterParent');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Filter/addFilterParent', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
public function importFilter()
          {
               // Обязательные формы для заполнения карточки товара
            $this->form_validation->set_rules('h1', 'Заголовок', 'required');
                // $this->form_validation->set_rules('body', 'Основной текст', 'required');
                // $this->form_validation->set_rules('description', 'Описание', 'required');
                // $this->form_validation->set_rules('link', 'Адрес сайта', 'required');
                // $this->form_validation->set_rules('logo', 'Логотип', 'required');
                // $this->form_validation->set_rules('meta_keywords', 'META теги', 'required');
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
            if ($this->form_validation->run() === FALSE)
            {
              echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));

            }
            else{
              echo $this->Filter_model->import_filter();
            }   
          }
public function getRelationFilter($idParentFilter = false,$lang = false)
          {
               // Обязательные формы для заполнения карточки товара
           if ($idParentFilter!==false) {
            $relationFilter = $this->Filter_model->getRelationFilter($idParentFilter);
             
              if ($lang!=false and $lang!='ru') {
                              $arrrelationFilter = [];
                foreach ($relationFilter as $key => $value) {
                    $arrrelationFilter[]=$value['id_element'];
                }
                if($relationFilter!=false){
                    
                    $translate = $this->Language_model->getLanguage($arrrelationFilter, $lang);
                    if($translate['status']!=false)
                    {
                        foreach ($relationFilter as $key => $parent) {
                                foreach ($parent as $nameField => $value) {
                                    if (!empty($translate[$parent['id_element']][$nameField])) {
                                        
                                        $relationFilter[$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                    }
                                }
                                
                            }
                        }
                    
                }
              }
               echo json_encode($relationFilter);
           }

           else{echo json_encode(array('type'=>'warning'));}
              
              
          }
          public function uploadImagesFilter()
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
//ширина и высота в пикселях

              if (isset($_FILES))
              {
    // A list of permitted file extensions
                $allowed = array('png', 'jpg', 'gif','zip');
                if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){

                 $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                 if(!in_array(strtolower($extension), $allowed)){
                   echo '{"status":"error"}';
                   exit;
                 }
                 if(move_uploaded_file($_FILES['file']['tmp_name'],'uploads/'.$_FILES['file']['name'])){
                   $tmp='uploads/'.$_FILES['file']['name'];
     $new = 'images/'.$_FILES['file']['name']; //adapt path to your needs;
     if(copy($tmp,$new)){
       echo 'uploads/'.$_FILES['file']['name'];
       echo '{"status":"success"}';
     }
     exit;
   }
 }
 echo '{"status":"'.print_r($_FILES).'"}';
 exit;
}
}
}
        public function view($slug = NULL)
        {
                $data['filter_item'] = $this->Filter_model->get_filters($slug);
                if (empty($data['cards_item']))
                {
                        show_404();
                }

                $data['title'] = $data['cards_item']['title'];
                $this->load->view('templates/header', $data);
                $this->load->view('itemCards/view', $data);
                $this->load->view('templates/footer');
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createFilterForm.js");
                $data['title'] = 'Создание фильтра';
                $data['cat_filter'] = $this->Filter_model->get_filter_cat();
                $this->breadcrumb->add_crumb('Создание фильтра', '/admin/filter/create');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Filter/create', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function create_cat()
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
                unset($this->data['page_level_script']);
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createCatFilterForm.js");
                $data['title'] = 'Создание категории фильтра';
                $data['cat_filter'] = $this->Filter_model->get_filter_cat();
                $this->breadcrumb->add_crumb('Создание фильтра', '/admin/filter/create_cat');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Filter/create_cat', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function createCatFilter()
        {
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок категории', 'required');
                //$this->form_validation->set_rules('type', 'Тип', 'required');
                //$this->form_validation->set_rules('value', 'Текст категории', 'required');
                //$this->form_validation->set_rules('meta_keywords', 'Не выбрана категория фильтра', 'required');
                
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $echo = $this->Filter_model->set_cat_filter();
                    echo($echo);
                }   
            }  
        public function createFilter()
        {
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок', 'required');
                //$this->form_validation->set_rules('type', 'Тип', 'required');
                //$this->form_validation->set_rules('value', 'Значение', 'required');
                
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $echo = $this->Filter_model->set_filter();
                    echo($echo);
                   // redirect('/admin/cards/change', 'refresh');
                }   
            }  

        
        public function change($idCard)
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
                $data['filterItem'] = $this->Filter_model->get_filters($idCard);

        if (empty($data['filterItem']))
        {
                show_404();
        }
        $data['cards_cat_filter'] = $this->Filter_model->get_filter_cat();
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeFilterForm.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
                $data['title'] = 'Редактирование фильтра';
                $this->breadcrumb->add_crumb('Редактирование фильтра', '/admin/filter/show_filters/');
                $this->load->helper('form');
                

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Filter/change', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function change_cat($idCard)
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
                $data['filterItem'] = $this->Filter_model->get_filter_cat($idCard);

        if (empty($data['filterItem']))
        {
                show_404();
        }
        $data['cards_cat_filter'] = $this->Filter_model->get_filter_cat();
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeFilterCatForm.js");

                $data['title'] = 'Редактирование категории фильтра';
                $this->breadcrumb->add_crumb('Редактирование категории фильтра', '/admin/filter/change_cat');
                $this->load->helper('form');
                

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Filter/change_cat', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }

        public function changeFiltersCat($idCard)
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
                

        if (empty($idCard))
        {
                show_404();
        }
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок', 'required');
                //$this->form_validation->set_rules('body', 'Основной текст', 'required');
                
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $data['post'] = array(
                    'idfilter_cat'=> $idCard,
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'h1' => $this->input->post('h1'),
                    'body' => $this->input->post('body'),
                    'preview_text' => $this->input->post('preview_text'),
                    'alias' => $this->input->post('alias'),
                    'sort'=>$this->input->post('sort'),
                    'home' =>$this->input->post('home'),
                    'type' =>$this->input->post('type'),
                );
                    echo ($this->Filter_model->set_cat_filter($data['post']));
                }   
            }  
        }
        public function changeFilters($idCard)
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
                

        if (empty($idCard))
        {
                show_404();
        }
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок', 'required');
                //$this->form_validation->set_rules('body', 'Основной текст', 'required');
                
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $data['post'] = array(
                    'id_filter'=> $idCard,
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'value' => $this->input->post('value'),
                    'id_cat_filter' => $this->input->post('filter_cat_idfilter_cat'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'h1' => $this->input->post('h1'),
                    'body' => $this->input->post('body'),
                    'preview_text' => $this->input->post('preview_text'),
                    'alias' => $this->input->post('alias'),
                    'sort'=>$this->input->post('sort'),
                    'icon'=>$this->input->post('icon'),
                    'logo'=>$this->input->post('logo')
                );
                    echo ($this->Filter_model->set_filter($data['post']));
                }   
            }  
        }
        public function deleteFilter($idCards)
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
                

        if (empty($idCards))
        {
                show_404();
        }
            else{
                   
                    echo ($this->Filter_model->delete_filter($idCards));
                }   
            }  
        }
        public function deleteFilter2($idCards)
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
                

        if (empty($idCards))
        {
                show_404();
        }
            else{
                   
                    echo ($this->Filter_model->delete_filter2($idCards));
                }   
            }  
        }
        public function deleteFilterCat($idCards)
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
                

        if (empty($idCards))
        {
                show_404();
        }
            else{
                   
                    echo ($this->Filter_model->delete_filter_cat($idCards));
                }   
            }  
        }

public function show_filters($slug = false)
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
  $start = (!isset($_REQUEST['start'])) ? false : $_REQUEST['start'] ;
    $length = (!isset($_REQUEST['length'])) ? false : $_REQUEST['length'] ;
    $id = (!isset($_REQUEST['id'])) ? false : $_REQUEST['id'] ;
    $h1 = (!isset($_REQUEST['h1'])) ? false : $_REQUEST['h1'] ;
    $title = (!isset($_REQUEST['title'])) ? false : $_REQUEST['title'] ;
    $data['filters'] = $this->Filter_model->get_filter_Byfilter($id,$start,$length,$h1,false,false,false);
}
else{
  $data['filters'] = $this->Filter_model->get_filters();}
  $cats = $this->Filter_model->get_filter_cat();
  $iTotalRecords = count($data['filters']);
  // $iDisplayLength = intval($_REQUEST['length']);
  // $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  // $iDisplayStart = intval($_REQUEST['start']);
  // $sEcho = intval($_REQUEST['draw']);

  $records = array();
  $records["data"] = array(); 

  // $end = $iDisplayStart + $iDisplayLength;
  // $end = $end > $iTotalRecords ? $iTotalRecords : $end;

  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
  );
if ($slug == 1) {
    $iDisplayLength = intval($_REQUEST['length']);
  $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  $iDisplayStart = intval($_REQUEST['start']);
  $sEcho = intval($_REQUEST['draw']);
$end = $iDisplayStart + $iDisplayLength;
  $end = $end > $iTotalRecords ? $iTotalRecords : $end;
foreach ($data['filters'] as $key => $value) {
    foreach ($cats as $key1 => $value1) {if($value1['idfilter_cat']==$value['id_cat_filter']) $retVal = $value1['h1']; }
        $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_filter'].'"/><span></span></label>',
      $value['id_filter'],
      $value['value'],
      $value['title'],
      $retVal,
      '<a href="change/'.$value["id_filter"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a><a href="javascript:;" data-del-item="'.$value["id_filter"].'" onclick="initArchiveButton()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>',
    );
  }
}
else{
  foreach ($data['filters'] as $key => $value) {
    foreach ($cats as $key1 => $value1) {if($value1['idfilter_cat']==$value['id_cat_filter']) $retVal = $value1['h1']; }
        $records["data"][] = array(
      $value['id_filter'],
      $value['value'],
      $value['title'],
      $retVal,
      '<a href="change/'.$value["id_filter"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a>',
      '<a href="javascript:;" data-del-item="'.$value["id_filter"].'" onclick="initArchiveButton()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>',
    );
  }
}
  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }
if ($slug == 1) {
   $records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
}
  
  
  echo json_encode($records);
                } else {
                    # code...
                
                
                // set the flash data error message if there is one
                unset($this->data['page_level_script']);
                unset($this->data['page_level_plugin']);
                $this->data['page_level_plugin'][] = array(
                    'src' => asset_url()."global/scripts/datatable.js"
                    );
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showFilterForm.js");
                $data['title'] = 'Просмотр фильтров';
                $data['filters'] = $this->Filter_model->get_filters();
                $this->breadcrumb->add_crumb('Просмотр фильтров', '/admin/filter/show_filters');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Filter/show_filters', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
                }
        }
        }
        public function show_cat_filters($slug = false)
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
  $start = (!isset($_REQUEST['start'])) ? false : $_REQUEST['start'] ;
    $length = (!isset($_REQUEST['length'])) ? false : $_REQUEST['length'] ;
    $id = (!isset($_REQUEST['id'])) ? false : $_REQUEST['id'] ;
    $h1 = (!isset($_REQUEST['h1'])) ? false : $_REQUEST['h1'] ;
    $title = (!isset($_REQUEST['title'])) ? false : $_REQUEST['title'] ;
    $data['filters'] = $this->Filter_model->get_filter_cat_Byfilter($id,$start,$length,$h1,false,false,false);
}
else{
  $data['filters'] = $this->Filter_model->get_filter_cat();}
  // $iTotalRecords = count($data['filters']);
  // $iDisplayLength = intval($_REQUEST['length']);
  // $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  // $iDisplayStart = intval($_REQUEST['start']);
  // $sEcho = intval($_REQUEST['draw']);

  $records = array();
  $records["data"] = array(); 

  // $end = $iDisplayStart + $iDisplayLength;
  // $end = $end > $iTotalRecords ? $iTotalRecords : $end;

  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
  );


foreach ($data['filters'] as $key => $value) {
        $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['idfilter_cat'].'"/><span></span></label>',
      $value['idfilter_cat'],
      $value['h1'],
      '<a href="change_cat/'.$value["idfilter_cat"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a><a href="javascript:;" data-del-item="'.$value["idfilter_cat"].'" onclick="initArchiveButton()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>',
    );
  }

  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  // $records["draw"] = $sEcho;
  // $records["recordsTotal"] = $iTotalRecords;
  // $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
                } else {
                    # code...
                
                
                // set the flash data error message if there is one
                unset($this->data['page_level_script']);
                unset($this->data['page_level_plugin']);
                $this->data['page_level_plugin'][] = array(
                    'src' => asset_url()."global/scripts/datatable.js"
                    );
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showFilterCatForm.js");
                $data['title'] = 'Просмотр фильтров';
                $data['filters'] = $this->Filter_model->get_filters();
                $this->breadcrumb->add_crumb('Просмотр категорий фильтров', '/admin/filter/show_filters');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Filter/show_cat_filters', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
                }
        }
        }
   public function bloodhound_h1($request=False)
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
              $request = (isset($_GET['h1'])) ? $_GET['h1'] : '' ;
              
              if ($request!='') {
                // $request=mb_convert_encoding ($request, "UTF-8", mb_detect_encoding($request));
                

                $response = $this->Filter_model->find_filters($request);
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
          public function countCards($request=False)
          {
              if ($request!=false) {
                // $request=mb_convert_encoding ($request, "UTF-8", mb_detect_encoding($request));
                if (isset($_POST['url_string'])) {
                    $request = explode('/',$_POST['url_string']);
                    //print_r($request);
                }
                
               $response = $this->Element_model->getCardsByFilter($request);

                if (is_array($response)) {
                    $response = count($response);
                }
                else{$response = 0;}
                //$response = $this->Element_model->getCardsByFilter($request);
                echo json_encode($response);
                return ;
              }
              else{
                $response = ['value'=>'Не вышло'];
                echo json_encode($response);
                return $response;
              }
          }

          public function set_filters_by_parent($parent = false)
        {       if (!$this->ion_auth->logged_in())
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
                $data['parent']=$this->input->post('parent');
                $data['filters'] = $this->input->post('filters');
                $echo = $this->Filter_model->setParentFilters($data['parent'],$data['filters']);
                echo($echo);
                 }
        }
          public function get_filters_by_parent($request=False)
          {
              if ($request!=false) {
                // $request=mb_convert_encoding ($request, "UTF-8", mb_detect_encoding($request));
                if (isset($_POST['parent'])) {

                    $response = $this->Filter_model->get_filters_by_parent($_POST['parent']);

                   // $request = explode('/',$_POST['url_string']);
                    //print_r($request);
                }
                //$response = count($this->Element_model->getCardsByFilter($request));
                echo json_encode($response);
                return ;
              }
              else{
                $response = ['value'=>'Не вышло'];
                echo json_encode($response);
                return $response;
              }
          }
        }