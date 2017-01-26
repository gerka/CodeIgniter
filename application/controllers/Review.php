<?php
class Review extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Review_model');
    $this->load->helper('url_helper');
    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
    $this->breadcrumb->add_crumb('Панель администратора', '/admin/');
  }
  public function change($idReview)
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
              $data['Review'] = $this->Review_model->get_reviews($idReview,'all','all',false,$idReview);
             // print_r($data['Review']);
              if (empty($data['Review']))
              {
                show_404();
              }
                //$data['proverka'] = $this->Filter_model->getFiltersIdByidReview($idCard);
                // set the flash data error message if there is one
                // $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/normalize.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.Metronic.css");
                // $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
                // $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css");
              //   $this->data['page_level_plugin'][] = array(
              //   'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
              //   );
              // $this->data['page_level_plugin'][] = array(
              //   'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
              //   );
              // $this->data['page_level_plugin'][] = array(
              //   'src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"
              //   );
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
              // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js");
              // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
              // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
              // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
              // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
              // $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2.min.css");
              // $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css");
              // $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2-bootstrap.min.css");
              // $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/daterangepicker.css");
              // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/select2/js/select2.min.js");
              
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
              // $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeReviewForm.js");
              
              // $this->data['page_level_plugin'][]= array('src' =>"http://maps.googleapis.com/maps/api/js?key=AIzaSyD34f8N3If5za0tpksojOM6MbZ5j9fRyrM");
              //$this->data['page_level_plugin'][]= array('src' =>"http://maps.googleapis.com/maps/api/js?key=AIzaSyATrswEqCRkKdUUo_0Zxt4CnGnSEoYuSoU&sensor=false");
              // $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/mapGenerator.js");
              // $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/loadLastImages.js");
              // $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/imageControlSave.js");

              $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");

              // $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/moment.min.js");
              // $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/daterangepicker.js");
              $data['title'] = 'Редактирование отзыва';
              $this->breadcrumb->add_crumb('Редактирование отзыва', '/admin/cards/change');
              $this->load->helper('form');
              // $data['menuCard'] = $this->ItemCard_model->get_menu_cards($idCard);
              // $data['lastImages'] = $this->ImageControl_model->get_last_images();
              // $data['countReview'] = count($this->Review_model->get_reviews($idCard,'all',false,true));

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
              $this->load->view('templates/admin/include/head', $data);
              $this->load->view('templates/admin/include/header', $data);
              $this->load->view('templates/admin/include/breadcrumbs', $data);
              $this->load->view('templates/admin/include/sidebar', $data);
              $this->load->view('admin/Review/change', $data);
              $this->load->view('templates/admin/include/footer', $data);
              $this->load->view('templates/admin/include/javascript');
            }
          }

 function changeReview($idReview = false)
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
              
              if (empty($idReview))
              {
                show_404();
              }
               // Обязательные формы для заполнения карточки товара
              //$this->form_validation->set_rules('title', 'Заголовок', 'required');
              $this->form_validation->set_rules('body', 'Название компании', 'required');

                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
              if ($this->form_validation->run() === FALSE)
              {
                echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
              }
              else{
                $data['post'] = array(
                  'id_review'=> $idReview,
                  'h1' => $this->input->post('h1'),
                  'body' => $this->input->post('body'),
                  'public' => $this->input->post('public'),
                  'archive' => $this->input->post('archive'),
                  'e-mail' => $this->input->post('email'),
                  'rating' => $this->input->post('rating'),
                  'telephone' => $this->input->post('telephone'),
                  'logo'=>$this->input->post('logo_review')
                  //'url' => $this->input->post('url')
                  );
                $old = $this->Review_model->get_reviews($data['post']['id_review'],'all','all',false,$idReview);
               // print($old[0]['public']);
                //print($data['post']['public']);
                echo ($this->Review_model->update_review($idReview,$data['post']));
                if($old[0]['public']!=$data['post']['public']){
                  $this->email->clear();
                  $this->email->from('namaste@globe.yoga', 'globe.yoga');
                  $this->email->to($old[0]['e-mail']);
                  $this->email->subject('Change Status Review');
                  $message = 'Thank for your interst!'."\n";
                  if($data['post']['public'] ==1 )
                  {
                    $message = $message.'Your review on Globe.Yoga is public'."\n";
                    $message = $message.'Your review:'."\n";
                    $message = $message.$old[0]['body']."\n";
                    $this->email->message($message);
                    $email=$this->email->send();
                    if(!$email){print_r($this->email->print_debugger());}
                    
                  }

                


                  return;
                  
                  
                }
              }   
            }   
            }  
          
 function archiveReview($idReview = false)
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
              if (empty($this->input->post('id_review')))
              {
                
                  echo json_encode( ['status'=>'error1']);
                  return;
                
              }
              else{
                  echo ($this->Review_model->archiveReview($idReview));
                  return;
              }   
            }  
          }
 function publicReview($idReview = false)
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
              if (empty($this->input->post('id_review')))
              {
                
                  return json_encode( ['status'=>'error1']);
                
              }
              else{
                  echo ($this->Review_model->publicReview($idReview));
              }   
            }  
          }
 function unArchiveReview($idReview = false)
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
              if (empty($this->input->post('id_review')))
              {
                
                  return json_encode( ['status'=>'error1']);
                
              }
              else{
                  echo ($this->Review_model->unArchiveReview($idReview));
              }   
            }  
          }
 function unPublicReview($idReview = false)
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
              if (empty($this->input->post('id_review')))
              {
                
                  return json_encode( ['status'=>'error1']);
                
              }
              else{
                  echo ($this->Review_model->unPublicReview($idReview));
              }   
            }  
          }
          public function approve(){
            $this->data['page_level_plugin'][] = array(
    'src' => asset_url()."global/scripts/datatable.js"
    );
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
  $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/approveReviewForm.js");
  $data['title'] = 'Просмотр отзывов';
  $this->breadcrumb->add_crumb('Просмотр отзывов', '/admin/review/approve');
  $this->load->helper('form');
  $this->load->view('templates/admin/include/head', $data);
  $this->load->view('templates/admin/include/header', $data);
  $this->load->view('templates/admin/include/breadcrumbs', $data);
  $this->load->view('templates/admin/include/sidebar', $data);
  $this->load->view('admin/Review/approve', $data);
  $this->load->view('templates/admin/include/footer', $data);
  $this->load->view('templates/admin/include/javascript',$data);

          }
  public function show_review($idCard=false){
    if ($idCard === false) {
      if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'filter')
{   
    $id = ($_REQUEST['product_review_no'] == '') ? false : $_REQUEST['product_review_no'] ;
   
    $h1 = ($_REQUEST['h1'] == '') ? false : $_REQUEST['h1'] ;
    $body = ($_REQUEST['body'] == '') ? false : $_REQUEST['body'] ;
    $product_review_date_from = ($_REQUEST['product_review_date_from'] == '') ? false : $_REQUEST['product_review_date_from'] ;
    $product_created_to = false;
    //$product_created_to = ($_REQUEST['product_created_to'] == '') ? false : $_REQUEST['product_created_to '] ;

    //$data['reviews'] = $this->Review_model->get_reviews_Byfilter($id,$h1,$product_review_date_from,$product_created_to,false);
}
else{ $data['reviews'] = $this->Review_model->get_reviews(false,'all',false); }
  
  $iTotalRecords = count($data['reviews']);
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
  foreach ($data['reviews'] as $key => $value) {
    if ($value['public'] == 0) {$button = 'danger'; $pub='Не опубликовано';} else {$button = 'success';$pub='Опубликовано';}
    
    $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_review'].'"/><span></span></label>'.$value['id_post'],
      $value['date_create'],
      $value['h1'],
      $value['body'],
      '<button class="btn btn-sm btn-'.$button.' filter-cancel" data-public="'.$value["public"].'" data-item="'.$value["id_review"].'" onclick="initPublicReviewButton()"> '.$pub.'</button>',
     // $value['id_post'],
      
      // '<img src="/images/'.$value['logo'].'"style="max-width: 120px;" alt="">',
      
      '<a href="/admin/review/change/'.$value["id_review"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><button data-item="'.$value["id_review"].'" data-archive="'.$value["archive"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initArchiveReviewButton()"><i class="fa fa-pencil" ></i> В архив</button>',
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
    
    } 
    else {
      if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'filter')
{   
    $id = ($_REQUEST['product_review_no'] == '') ? false : $_REQUEST['product_review_no'] ;
   
    $h1 = ($_REQUEST['h1'] == '') ? false : $_REQUEST['h1'] ;
    $body = ($_REQUEST['body'] == '') ? false : $_REQUEST['body'] ;
    $product_review_date_from = ($_REQUEST['product_review_date_from'] == '') ? false : $_REQUEST['product_review_date_from'] ;
    $product_created_to = false;
    //$product_created_to = ($_REQUEST['product_created_to'] == '') ? false : $_REQUEST['product_created_to '] ;

    //$data['reviews'] = $this->Review_model->get_reviews_Byfilter($id,$h1,$product_review_date_from,$product_created_to,false);
}
else{ $data['reviews'] = $this->Review_model->get_reviews($idCard,'all',false); }
  
  $iTotalRecords = count($data['reviews']);
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
  foreach ($data['reviews'] as $key => $value) {
    if ($value['public'] == 0) {$button = 'danger'; $pub='Не опубликовано';} else {$button = 'success';$pub='Опубликовано';}
    
    $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_review'].'"/><span></span></label>',
      $value['date_create'],
      $value['h1'],
      $value['body'],
      '<button class="btn btn-sm btn-'.$button.' filter-cancel" data-public="'.$value["public"].'" data-item="'.$value["id_review"].'" onclick="initPublicReviewButton()"> '.$pub.'</button>',
     // $value['id_post'],
      
      // '<img src="/images/'.$value['logo'].'"style="max-width: 120px;" alt="">',
      
      '<a href="/admin/review/change/'.$value["id_review"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><button data-item="'.$value["id_post"].'" data-archive="'.$value["archive"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initArchiveReviewButton()"><i class="fa fa-pencil" ></i> В архив</button>',
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
  public function show_news_review($idCard=false){
  	if ($idCard === false) {
  		# code...
  		show_404();
  	} else {
  		if (isset($_REQUEST['action']) and $_REQUEST['action'] == 'filter')
{   
    $id = ($_REQUEST['product_review_no'] == '') ? false : $_REQUEST['product_review_no'] ;
   
    $h1 = ($_REQUEST['h1'] == '') ? false : $_REQUEST['h1'] ;
    $body = ($_REQUEST['body'] == '') ? false : $_REQUEST['body'] ;
    $product_review_date_from = ($_REQUEST['product_review_date_from'] == '') ? false : $_REQUEST['product_review_date_from'] ;
    $product_created_to = false;
    //$product_created_to = ($_REQUEST['product_created_to'] == '') ? false : $_REQUEST['product_created_to '] ;

    //$data['reviews'] = $this->Review_model->get_reviews_Byfilter($id,$h1,$product_review_date_from,$product_created_to,false);
}
else{ $data['reviews'] = $this->Review_model->get_news_reviews($idCard); }
  
  $iTotalRecords = count($data['reviews']);
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
  foreach ($data['reviews'] as $key => $value) {
  	if ($value['public'] == 0) {$button = 'danger'; $pub='Не опубликовано';} else {$button = 'success';$pub='Опубликовано';}
  	
    $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_review'].'"/><span></span></label>',
      $value['date_create'],
      $value['h1'],
      $value['body'],
      '<button class="btn btn-sm btn-'.$button.' filter-cancel" data-item="'.$value["id_news"].'" onclick="initPublicReviewButton()"> '.$pub.'</button>',
     // $value['id_post'],
      
      // '<img src="/images/'.$value['logo'].'"style="max-width: 120px;" alt="">',
      
      '<a href="/admin/review/change/'.$value["id_review"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><button data-del-item="'.$value["id_news"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initArchiveReviewButton()"><i class="fa fa-pencil" ></i> В архив</button>',
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
  public function createReview($idCard, $select = false)
          {
               // Обязательные формы для заполнения карточки товара
            $this->form_validation->set_rules('h1_review', 'Заголовок', 'required');
            $this->form_validation->set_rules('body_review', 'Основной текст', 'required');
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
              $e_mail = (!empty($this->input->post('e-mail'))) ? $this->input->post('e-mail') : '' ;
              $telephone = (!empty($this->input->post('telephone'))) ? $this->input->post('telephone') : '' ;
              $rating = (!empty($this->input->post('rating_review'))) ? $this->input->post('rating_review') : '' ;
              $archive = (!empty($this->input->post('archive_review'))) ? $this->input->post('archive_review') : 0 ;
              $logo = (!empty($this->input->post('logo_review'))) ? $this->input->post('logo_review') : 0 ;
              $data['review'] = [
              'id_post' => $this->input->post('id_post_review'),
              'body' => strip_tags($this->input->post('body_review'), '<br><br/>'),
                'h1' => strip_tags($this->input->post('h1_review')),
                'rating' => $rating,
                'archive'=> $archive,
                'e-mail'=> $e_mail,
                'telephone'=>$telephone,
                'logo' => $logo,
                'public'=> 0
              ];
            	$data['review_news'] = [
            	'id_news' => $this->input->post('id_post_review'),
            	'body' => strip_tags($this->input->post('body_review')),
                'h1' => strip_tags($this->input->post('h1_review')),
                'rating' => $rating,
                'archive'=> $archive,
                'e-mail'=> $e_mail,
                'telephone'=>$telephone,
                'logo' => $logo,
                'public'=> 0
            	];
              switch ($select) {
                case false:
                  echo $this->Review_model->set_review($idCard,$data['review']);
                  break;
                case 'news':
                  echo $this->Review_model->set_news_review($idCard,$data['review_news']);
                  break;
                // case '':
                //   # code...
                //   break;
                
                // default:
                //   # code...
                //   break;
              }
              
            }   
          }
}