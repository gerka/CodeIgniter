<?php
class News extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('News_model');
            $this->load->model('Tags_model');
            $this->load->helper('url_helper');

            
            $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
            $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css");
            $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
            $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
            $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
            $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
            $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js");
            

            $this->breadcrumb->add_crumb('Панель администратора', '/admin/');

                
        }

        public function index()
        {
                $data['news'] = $this->News_model->get_news();
                $data['title'] = 'Архив новостей';
                $this->load->view('templates/header', $data);
                $this->load->view('News/index', $data);
                $this->load->view('templates/footer', $data);
        }

        public function view($slug = NULL)
        {
                $data['news'] = $this->News_model->get_news($slug);


                if (empty($data['news']))
                {
                        show_404();
                }

                $data['title'] = $data['news']['title'];

                $this->load->view('templates/header', $data);
                $this->load->view('News/view', $data);
                $this->load->view('templates/footer');
        }
        public function loadNews($num_page)
        {   
                $lim = $this->input->post('limit');

                $news = $this->News_model->get_news(FALSE, false, true,$num_page,$lim,'alias,logo,title,date_create,h1,description');
                $json = array('status'=>false);
                if (empty($news))
                {echo  json_encode($json); }
                else{$news['status'] = 'OK';
                $json = $news;}
                echo json_encode($json);
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
                // 
                $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
                $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
                );
                $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
                );
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createNewsForm.js");
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
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
                $data['title'] = 'Создание новости';
                $this->breadcrumb->add_crumb('Создание новости', '/admin/news/create');
                $this->load->helper('form');
                $data['news_cat_filter'] = $this->News_model->get_cat_all();
                $data['tagsNews'] = $this->Tags_model->getAllTags();
                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/News/create', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function createNews()
        {
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок', 'required');
                $this->form_validation->set_rules('body', 'Основной текст', 'required');
                
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    echo ($this->News_model->set_news());
                    
                }   
            } 
        public function change($idNews)
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
                $data['NewsItem'] = $this->News_model->get_news($idNews);

        if (empty($data['NewsItem']))
        {
                show_404();
        }
                // set the flash data error message if there is one
                $this->data['page_level_plugin'][] = array(
                    'src' => asset_url()."global/scripts/datatable.js"
                    );
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/normalize.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.Metronic.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2.min.css");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/typeahead/handlebars.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
                $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"); 
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/select2/js/select2.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeNewsForm.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/addNewsTags.js");
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
                $data['title'] = 'Редактирование новости';
                $this->breadcrumb->add_crumb('Редактирование новости', '/admin/cards/change');
                $this->load->helper('form');
                $data['news_cat_filter'] = $this->News_model->get_cat_all();
                $data['tagsNews'] = $this->Tags_model->getAllTags();
                $data['tagsAddedNews'] = $this->Tags_model->getTagsNews($idNews);

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/News/change', $data);
                $this->load->view('admin/Tags/addTags', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function changeNews($idNews)
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
                

        if (empty($idNews))
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
                    'id_news'=> $idNews,
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'body' => $this->input->post('body'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'preview_text' => $this->input->post('preview_text'),
                    'h1' => $this->input->post('h1'),
                    'alias' => $this->input->post('alias'),
                    'date_create' => date('Y-m-d H:i:s'),
                    'id_cat' => $this->input->post('id_cat'),
                    'public' => $this->input->post('public'),
                    'archive' => $this->input->post('archive'),
                    'date_create' => date('Y-m-d H:i:s',strtotime($this->input->post('date_create'))),
                    'logo'=>$this->input->post('logo')
                );
                    echo ($this->News_model->set_news($data['post']));
                }   
            }  
        }
        
        public function change_cat($idNews)
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
                $data['NewsCatItem'] = $this->News_model->get_news_cat($idNews);

        if (empty($data['NewsCatItem']))
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeNewsCatForm.js");

                $data['title'] = 'Редактирование категории новости';
                $this->breadcrumb->add_crumb('Редактирование новости', '/admin/cards/change');
                $this->load->helper('form');
                

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/News/change_cat', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
        public function changeCatNews($idNews)
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
                

        if (empty($idNews))
        {
                show_404();
        }
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок', 'required');
               // $this->form_validation->set_rules('body', 'Основной текст', 'required');
                
                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $data['post'] = array(
                    'id_cat'=> $idNews,
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'body' => $this->input->post('body'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'preview_text' => $this->input->post('preview_text'),
                    'h1' => $this->input->post('h1'),
                    'alias' => $this->input->post('alias'),
                    'id_element'=>$this->input->post('id_element')
                );
                    echo ($this->News_model->set_cat_news($data['post']));
                }   
            }  
        }
        public function deleteNews($idNews)
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
                

        if (empty($idNews))
        {
                show_404();
        }
            else{
                   
                    echo ($this->News_model->delete_news($idNews));
                }   
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
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createCatNewsForm.js");
                $data['title'] = 'Создание категории новости';
                $data['cat_news'] = $this->News_model->get_news_cat();
                $this->breadcrumb->add_crumb('Создание категории новости', '/admin/news/create_cat');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/News/create_cat', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
        }
        }
public function show_cat($slug = false)
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

  $data['cat_news'] = $this->News_model->get_news_cat();
  $iTotalRecords = count($data['cat_news']);
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

foreach ($data['cat_news'] as $key => $value) {
        $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_cat'].'"/><span></span></label>',
      $value['id_cat'],
      $value['value'],
      $value['title'],
      $value['h1'],
      $value['alias'],
      '<a href="change_cat/'.$value["id_cat"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Edit</a>',
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
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showCatNewsForm.js");
                $data['title'] = 'Просмотр категорий новостей';
                $data['cat_news'] = $this->News_model->get_news_cat();
                $this->breadcrumb->add_crumb('Просмотр категорий новостей', '/admin/news/show_cat');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/News/show_cat', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
                }
        }
        }

public function show_news($slug = false)
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
    $product_created_from = ($_REQUEST['product_created_from'] == '') ? false : $_REQUEST['product_created_from'] ;
    $product_created_to = false;
    //$product_created_to = ($_REQUEST['product_created_to'] == '') ? false : $_REQUEST['product_created_to '] ;

    $data['news'] = $this->News_model->get_news_Byfilter($id,$h1,$product_created_from,$product_created_to);
}
else{ $data['news'] = $this->News_model->get_news(); }
  
  // $iTotalRecords = count($data['news']);
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

    $false = 'bg-red-soft bg-font-red-soft';
  $true = 'bg-blue-soft bg-font-blue-soft';

foreach ($data['news'] as $key => $value) {
    $idClass = ($value['public']) ? $true : $false ;
        $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_news'].'"/><span></span></label>',
      '<div class="'.$idClass.'">'.$value['id_news'].'</div>',
      
      $value['h1'],
      $value['date_create'],
      '<a href="change/'.$value["id_news"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><button data-del-item="'.$value["id_news"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initArchiveButton()"><i class="fa fa-pencil" ></i> В архив</button><a href=/'.$value["alias"].' target=_blank class="archive btn btn-sm btn-default btn-circle btn-editable" ><i class="fa fa-pencil" ></i> Просмотреть новость</a>',
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
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showNewsForm.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showTagsForm.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/addNewsTags.js");
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
                $data['title'] = 'Просмотр новостей';
                $data['news'] = $this->News_model->get_news();
                $this->breadcrumb->add_crumb('Просмотр новостей', '/admin/news/show_news');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                  $data['buttons']['action'][] = [
                        'title'=>'В архив',
                        'link'=>'/admin/news/show_archive',
                        'icon'=>'fa fa-archive',
                        'color'=>'blue-steel',
                        'hiddenMobile'=>true
                      ];
                      $data['buttons']['action'][] = [
                        'title'=>'Создать новость',
                        'link'=>'/admin/news/create',
                        'icon'=>'fa fa-plus',
                        'color'=>'blue-soft',
                        'hiddenMobile'=>true
                      ];
                $this->load->view('admin/News/show_news', $data);
                $this->load->view('admin/Tags/show_tags', $data);
                $this->load->view('admin/Tags/addTags', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
                }
        }
        }

public function createCatNews()
        {
               // Обязательные формы для заполнения карточки товара
                $this->form_validation->set_rules('h1', 'Заголовок категории', 'required');
                //$this->form_validation->set_rules('value', 'Значение категории', 'required');
                //$this->form_validation->set_rules('value', 'Текст категории', 'required');
                //$this->form_validation->set_rules('meta_keywords', 'Не выбрана категория фильтра', 'required');
                
               if ($this->form_validation->run() === FALSE)
                {
                    echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
                }
                else{
                    $data =[
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'body' => $this->input->post('body'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'preview_text' => $this->input->post('preview_text'),
                    'h1' => $this->input->post('h1'),
                    'alias' => $this->input->post('alias'),
                    'value' => $this->input->post('value')

                    ];
                    $echo = $this->News_model->set_cat_news($data);
                    echo($echo);
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
                

                $response = $this->News_model->find_news($request);
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
public function bloodhound_cat($request=False)
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
              $request = (isset($_GET['q'])) ? $_GET['q'] : '' ;
              
              if ($request!='') {
                // $request=mb_convert_encoding ($request, "UTF-8", mb_detect_encoding($request));
                

                $response = $this->News_model->find_cats($request);
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
 public function show_archive($slug = false)
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
    $product_created_from = ($_REQUEST['product_created_from'] == '') ? false : $_REQUEST['product_created_from'] ;
    $product_created_to = false;
    //$product_created_to = ($_REQUEST['product_created_to'] == '') ? false : $_REQUEST['product_created_to '] ;

    $data['news'] = $this->News_model->get_news_Byfilter($id,$h1,$product_created_from,$product_created_to);
}
else{ $data['news'] = $this->News_model->get_news(false,true); }
  
  $iTotalRecords = count($data['news']);
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
  foreach ($data['news'] as $key => $value) {
    $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_news'].'"/><span></span></label>',
      $value['id_news'],
      $value['h1'],
      $value['date_create'],
      '<a href="change/'.$value["id_news"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><button data-del-item="'.$value["id_news"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initDeleteButton()"><i class="fa fa-pencil" ></i> DELETE</button><button data-del-item="'.$value["id_news"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initArchiveButton()"><i class="fa fa-pencil" ></i> Восстановить</button>',
      );
  }

  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  // $records["draw"] = $sEcho;
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
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
  $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showArchiveNewsForm.js");
  $data['title'] = 'Просмотр архива новостей';
  $data['news'] = $this->News_model->get_news();
  $this->breadcrumb->add_crumb($data['title'], '/admin/news/show_news');
  $this->load->helper('form');
  $this->load->view('templates/admin/include/head', $data);
  $this->load->view('templates/admin/include/header', $data);
  $this->load->view('templates/admin/include/breadcrumbs', $data);
  $this->load->view('templates/admin/include/sidebar', $data);
   $data['buttons']['action'][] = [
                        'title'=>'В список новостей',
                        'link'=>'/admin/news/show_news',
                        'icon'=>'fa fa-archive',
                        'color'=>'blue-steel',
                        'hiddenMobile'=>true
                      ];
                      $data['buttons']['action'][] = [
                        'title'=>'Создать новость',
                        'link'=>'/admin/news/create',
                        'icon'=>'fa fa-plus',
                        'color'=>'blue-soft',
                        'hiddenMobile'=>true
                      ];

  $this->load->view('admin/News/show_news', $data);
  $this->load->view('templates/admin/include/footer', $data);
  $this->load->view('templates/admin/include/javascript');
}
}
}
public function replaceNews($idCards = false)
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
                      if (empty($this->input->post('id')))
                      {
                        
                          return json_encode( ['status'=>'error1']);
                        
                      }
                      else{
                        
                          echo ($this->News_model->replace_News($idCards));
                        
                      }   
                    }  
                  }

        }