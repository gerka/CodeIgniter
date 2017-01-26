<?php
class Menu extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Menu_model');
                $this->load->model('Filter_model');
                $this->load->model('Element_model');
                $this->load->model('ItemCard_model');
                $this->load->helper('url_helper');
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/scripts/urlLit.js");
                
                
                 $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");

                $this->breadcrumb->add_crumb('Меню', '/admin/menu/show_menu');

                
        }

        public function index()
        {
                $data['cards_item'] = $this->ItemCard_model->get_cards();
                $data['title'] = 'Архив карточек товара';
                $this->load->view('templates/header', $data);
                $this->load->view('itemCards/index', $data);
                $this->load->view('templates/footer');
        }
        public function get_menu_have_filters($menu = false)
        {
                $data['menu']=$this->input->post('menu');
                $data['filters'] = $this->Menu_model->getFiltersByMenu($data['menu']);
                print json_encode($data['filters']);
                return;
        }
        public function get_menu_have_cards($menu = false)
        {
         //    if (!empty($this->input->get('node')))
         //        { print json_encode([0=>["info"=>[ "id" => "ajson1", "parent" => "#", "text" => "Simple root node" ]]]);
         // return;}
                $data['menu']=$this->input->post('menu');
                if(!$menu){$data['menu']=$menu;}
               // print json_encode( [ "id" => "item.id", "parent" => "item.parent", "text" => "item.text" , "icon" => "item.icon" ,'type'=>"item.type","data" => ["location"=>"item.location","sort"=>"item.sort","meta_keywords"=>"item.meta_keywords","description"=>"item.description","description"=>"item.description","alt"=>"item.alt"]]);
               // return;
                //$data['menu']=$menu;
                //print json_encode($data['menu']);
                $data['cards'] = $this->Menu_model->getCardsByMenu($data['menu']);

                print json_encode($data['cards']);
                return;
        }
        

        public function get_filters_have_menu($menu = false)
        {
                
                $data['filter_cats_menu'] = $this->Menu_model->getFiltersByMenu($menu,true);
                $data['filter_cats_no_menu'] = $this->Menu_model->getFiltersNoMenu($menu);

                // print_r($data['filter_cats_no_menu']);
                $filter_cats = $this->Filter_model->get_filter_cat();
                
                foreach ($data['filter_cats_no_menu'] as $key => $value) {
                    $data['filter_cats_no_menu'][$key]['filters'] = $this->Filter_model->getFiltersByIdCat($value['id_filter_cat']);
                    foreach ($filter_cats as $key2 => $value2) {
                    if ($value2['idfilter_cat'] == $data['filter_cats_no_menu'][$key]['id_filter_cat']) {
                        $data['filter_cats_no_menu'][$key]['nameCat'] = $value2['h1'];
                    }
                  }
                }
                foreach ($data['filter_cats_menu'] as $key => $value) {
                    $data['filter_cats_menu'][$key]['filters'] = $this->Filter_model->getFiltersByIdCat($value['id_filter_cat']);
                    foreach ($filter_cats as $key2 => $value2) {
                    if ($value2['idfilter_cat'] == $data['filter_cats_menu'][$key]['id_filter_cat']) {
                        $data['filter_cats_menu'][$key]['nameCat'] = $value2['h1'];
                    }
                  }
                }
                if (count($data['filter_cats_menu'])) {
                     $data['filter_cats_menu']['status'] = 'OK'; $data['filter_cats_menu']['no_menu'] = $data['filter_cats_no_menu'];
                }
                else {$data['filter_cats_menu']['status'] = $this->db->last_query(); $data['filter_cats_menu']['no_menu'] = $data['filter_cats_no_menu'];}
                
                print json_encode($data['filter_cats_menu']);
                return;
        }
        public function set_menu_have_filters($menu = false)
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
                $data['menu']=$this->input->post('menu');
                $data['filters'] = $this->input->post('filter_cat');
                $echo = $this->Menu_model->setFilters($data['menu'],$data['filters']);
                 echo($echo);
                 }
        }

        public function set_menu_have_cards($menu = false)
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
                $data['menu']=$this->input->post('menu');
                $data['cards'] = $this->input->post('cards');
                $echo = $this->Menu_model->setCards($data['menu'],$data['cards']);
                 echo($echo);
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
                
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-select/css/bootstrap-select.min.css");
                $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
                );
              $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
                );
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-select/js/bootstrap-select.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createMenuForm.js");
                $data['title'] = 'Создание пункта меню';
                $data['position_menu'] = $this->Menu_model->get_position_menu();
                $data['Menu'] = $this->Menu_model->get_menu();
                $this->breadcrumb->add_crumb('Создание пункта меню', '/admin/menu/create');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Menu/create', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function addFilter()
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/addFilterMenuForm.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/ui-tree.min.js");
                $data['title'] = 'Добавление категорий фильтрации в меню сайта';
                //$data['position_menu'] = $this->Menu_model->get_position_menu();
                $data['Menu'] = $this->Menu_model->get_menu();
                $data['FilterCat'] = $this->Filter_model->get_filter_cat();
                $this->breadcrumb->add_crumb('Добавление категорий фильтрации в меню', '/admin/menu/addFilter');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Menu/addFilter', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function create_position()
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
        public function createPositionMenu()
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
                    $echo = $this->Menu_model->set_position_menu();
                    echo($echo);
                }   
            }  
        public function createMenu()
        {
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('value', 'Заголовок', 'required');
                //$this->form_validation->set_rules('type', 'Тип', 'required');
                //$this->form_validation->set_rules('value', 'Значение', 'required');
                
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $echo = $this->Menu_model->set_menu();
                    echo($echo);
                   // redirect('/admin/cards/change', 'refresh');
                }   
            }  

        
        public function change($idMenu)
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
                $data['MenuItem'] = $this->Menu_model->get_menu($idMenu);
                $data['MenuItem']['InMenu'] = $this->Menu_model->get_position_menu($idMenu);

        if (empty($data['MenuItem']))
        {
                show_404();
        }
         $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
                
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-select/css/bootstrap-select.min.css");
                $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
                );
              $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
                );
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-select/js/bootstrap-select.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeMenuForm.js");
                $data['title'] = 'Редактирование пункта меню '.$idMenu;
                $data['position_menu'] = $this->Menu_model->get_position_menu();
                $data['Menu'] = $this->Menu_model->get_menu();
                $this->breadcrumb->add_crumb('Редактирование пункта меню', '/admin/menu/create');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Menu/change', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function change_position($idCard)
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
        public function changeMenu($idMenu)
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
                

        if (empty($idMenu))
        {
                show_404();
        }
               // // Обязательные формы для заполнения карточки товара
               //  $this->form_validation->set_rules('h1', 'Заголовок', 'required');
                //$this->form_validation->set_rules('body', 'Основной текст', 'required');
                
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
               // if ($this->form_validation->run() === FALSE)
               //  {
               //      echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
               //  }
                else{
                    $data['post'] = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'value' => $this->input->post('value'),
                    'parent' => $this->input->post('parent'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'body' => $this->input->post('body'),
                    'alias' => $this->input->post('alias'),
                    'sort'=>$this->input->post('sort'),
                    'id_menu'=>$this->input->post('id_menu'),
                    'public'=>$this->input->post('public'),
                    'logo'=>$this->input->post('logo'),

                );
                    echo ($this->Menu_model->set_menu($data['post']));
                }   
            }  
        }
        public function deleteMenu($id_menu=false)
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
                

        if (empty($id_menu))
        {
                show_404();
        }
            else{
                   
                    echo ($this->Menu_model->delete_menu($id_menu));
                }   
            }  
        }
        public function deleteMenu2($id_menu)
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
                

        if (empty($id_menu))
        {
                show_404();
        }
            else{
                   
                    echo ($this->Menu_model->delete_menu2($id_menu));
                }   
            }  
        }
        public function deleteFilterCat($id_menu)
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
                

        if (empty($id_menu))
        {
                show_404();
        }
            else{
                   
                    echo ($this->Filter_model->delete_filter_cat($idCards));
                }   
            }  
        }

public function show_menu($slug = false)
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
  $data['menus'] = $this->Menu_model->get_menu();}
  $cats = $this->Menu_model->get_position_menu();
  $iTotalRecords = count($data['menus']);
  //$iDisplayLength = intval($_REQUEST['length']);
  //$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
  //$iDisplayStart = intval($_REQUEST['start']);
  //$sEcho = intval($_REQUEST['draw']);

  $records = array();
  $records["data"] = array(); 

  //$end = $iDisplayStart + $iDisplayLength;
  //$end = $end > $iTotalRecords ? $iTotalRecords : $end;

  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
  );

foreach ($data['menus'] as $key => $value) {

        $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_menu'].'"/><span></span>'.$value["id_menu"].'</label>',
      $value['value'],
      $value['alias'],
      $value['sort'],
      
      '<a href="change/'.$value["id_menu"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a><a href="javascript:;" data-del-item="'.$value["id_menu"].'" onclick="initArchiveButton()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>',
    );
  }

  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  //$records["draw"] = $sEcho;
  // $records["recordsTotal"] = $iTotalRecords;
  // $records["recordsFiltered"] = $iTotalRecords;
  
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showMenuForm.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/addCardMenuForm.js");
                
                
                $data['title'] = 'Просмотр меню';
                $data['menus'] = $this->Menu_model->get_menu();
                $data['Menu'] = $this->Menu_model->get_menu();

                $data['CardsCat'] = $this->ItemCard_model->get_cards(FALSE, false, false,TRUE);
                $this->breadcrumb->add_crumb('Просмотр пунктов меню', '/admin/filter/show_filters');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/Menu/show_menu', $data);
                $this->load->view('admin/Menu/addCards', $data);
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
  $iTotalRecords = count($data['filters']);
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

  $records["draw"] = $sEcho;
  $records["recordsTotal"] = $iTotalRecords;
  $records["recordsFiltered"] = $iTotalRecords;
  
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
                $response = count($this->Element_model->getCardsByFilter($request));
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