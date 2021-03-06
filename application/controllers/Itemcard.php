<?php
class ItemCard extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ItemCard_model');
    $this->load->model('Filter_model');
    $this->load->model('Staff_model');
    $this->load->model('Menu_model');
    $this->load->model('ImageControl_model');
    $this->load->model('Review_model');
    $this->load->helper('url_helper');


    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/date.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");

    $this->breadcrumb->add_crumb('Панель администратора', '/admin/');


  }

  public function index()
  {
    $data['cards_item'] = $this->ItemCard_model->get_cards();
    $data['title'] = 'Архив карточек товара';
    $this->load->view('templates/header', $data);
    $this->load->view('ItemCards/index', $data);
    $this->load->view('templates/footer');
  }

  public function show_images($idElement= false)
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

              if ($idElement !=false) {
  /* 
   * Paging
   */

  $data['images'] = $this->ImageControl_model->get_images_element($idElement); }

  if(!empty($data['images'])){
  $iTotalRecords = count($data['images']);

  $records = array();
  $records["data"] = array(); 


  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
    );
  foreach ($data['images'] as $key => $value) {
    // $image_type['logo'] = ($value['type']=='logo') ? 'checked' : '' ;
    // $image_type['base'] = ($value['type']=='base') ? 'checked' : '' ;
    // $image_type['small'] = ($value['type']=='small') ? 'checked' : '' ;
    $records["data"][] = array(
      '<img class="img-responsive imageControl image_preview" src="/'.$value['url'].'" alt="'.$value['alt'].'"> ',
      '/'.$value['url'],
      $value['alt'],
      $value['sort'],
      $value['id_user'],
      ' ',
      '<button type="button" data-del-item="'.$value["idImage"].'" onclick="" class="removeImage remove btn btn-sm btn-default btn-circle btn-editable" ><i class="fa fa-pencil" ></i> Delete</button>',
      );
  }
  
  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  // $records["draw"] = $sEcho;
  // $records["recordsTotal"] = $iTotalRecords;
  // $records["recordsFiltered"] = $iTotalRecords;
  
  
}
if (empty($records["data"])) {
    $records["data"][] = array(
      ' ',
      '  ',
      'Изображений не найдено в этой карточке товара',
      ' ',
      ' ',
      ' ',
      ' ',
      );
  }
echo json_encode($records);
}
}
public function show_cards($slug = false)
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
  $start = ($_REQUEST['start'] == '') ? false : $_REQUEST['start'] ;
    $length = ($_REQUEST['length'] == '') ? false : $_REQUEST['length'] ;
    $id = ($_REQUEST['id'] == '') ? false : $_REQUEST['id'] ;
    $h1 = ($_REQUEST['h1'] == '') ? false : $_REQUEST['h1'] ;
    
    $product_created_from = ($_REQUEST['product_created_from'] == '') ? false : $_REQUEST['product_created_from'] ;
    $product_created_to = false;
    //$product_created_to = ($_REQUEST['product_created_to'] == '') ? false : $_REQUEST['product_created_to '] ;

    $data['cards'] = $this->ItemCard_model->get_cards_Byfilter($id,$start,$length,$h1,$product_created_from,$product_created_to,false);}
else{ $data['cards'] = $this->ItemCard_model->get_cards(false,false,false,true); 
}
  //print($data['cards']) ;
  $iTotalRecords = count($data['cards']);
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

  foreach ($data['cards'] as $key => $value) {
    $idClass = ($value['public']) ? $true : $false ;
    $records["data"][] = array(
      // '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_post'].'"/><span></span></label>',
      '<div class="'.$idClass.'">'.$value['id_post'].'</div>',
      $value['h1'],
      // '<img src="/images/'.$value['logo'].'"style="max-width: 120px;" alt="">',
      $value['value'],
      $value['date_create'],
      '<a href="change/'.$value["id_post"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><button data-del-item="'.$value["id_post"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initArchiveButton()"><i class="fa fa-pencil" ></i> В архив</button><a href=/'.$value["alias"].' target=_blank class="archive btn btn-sm btn-default btn-circle btn-editable" ><i class="fa fa-pencil" ></i> Посмотреть карточку</a>',
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
  $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showCardsForm.js");
  $data['title'] = 'Просмотр карточек';
  $data['cards'] = $this->ItemCard_model->get_cards();
  $this->breadcrumb->add_crumb('Просмотр карточек', '/admin/cards/show_cards');
  $this->load->helper('form');
  $this->load->view('templates/admin/include/head', $data);
  $this->load->view('templates/admin/include/header', $data);
  $this->load->view('templates/admin/include/breadcrumbs', $data);
  $this->load->view('templates/admin/include/sidebar', $data);
  $data['buttons']['action'][] = [
    'title'=>'В архив',
    'link'=>'/admin/cards/show_archive',
    'icon'=>'fa fa-archive',
    'color'=>'blue-steel',
    'hiddenMobile'=>true
  ];
  $data['buttons']['action'][] = [
    'title'=>'Создать карточку',
    'link'=>'/admin/cards/create',
    'icon'=>'fa fa-plus',
    'color'=>'blue-soft',
    'hiddenMobile'=>true
  ];
  $this->load->view('admin/ItemCards/show_cards', $data);
  $this->load->view('templates/admin/include/footer', $data);
  $this->load->view('templates/admin/include/javascript',$data);
}
}
}
public function set_image_has_item_card($idCard=false,$idImage=false)
{
  $out = $this->ItemCard_model->set_image_has_item_card($idCard,$idImage);
  if ($out == false) {
    echo '{"status":"0"}';
  }
  else{
    echo '{"status":"1"}';
  }
  return $out;
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

    $data['cards'] = $this->ItemCard_model->get_cards_Byfilter($id,$h1,$product_created_from,$product_created_to);
}
else{ $data['cards'] = $this->ItemCard_model->get_cards(FALSE,true,false,true); }
  
  $iTotalRecords = count($data['cards']);
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
  foreach ($data['cards'] as $key => $value) {
    $records["data"][] = array(
      // '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_post'].'"/><span></span></label>',
      $value['id_post'],
      $value['h1'],
      // '<img src="/images/'.$value['logo'].'"style="max-width: 50px; max-height: 50px;" alt="">',
      $value['value'],
      $value['date_create'],
      '<a href="change/'.$value["id_post"].'" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i>Edit</a><button data-del-item="'.$value["id_post"].'" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initArchiveButton()"><i class="fa fa-pencil" ></i> Восстановить</button><button data-del-item="'.$value["id_post"].'" data-toggle="modal" href="#smallDel" class="archive btn btn-sm btn-default btn-circle btn-editable" onclick="initDelButton()"><i class="fa fa-pencil" ></i> Удалить навсегда</button>',
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
    $this->data['page_level_plugin'][] = array(
    'src' => asset_url()."global/scripts/datatable.js"
    );
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
  $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
  $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showArchiveForm.js");
  $data['title'] = 'Просмотр архива карточек';
  $data['cards'] = $this->ItemCard_model->get_cards();
  $this->breadcrumb->add_crumb($data['title'], '/admin/cards/show_cards');
  $this->load->helper('form');
  $this->load->view('templates/admin/include/head', $data);
  $this->load->view('templates/admin/include/header', $data);
  $this->load->view('templates/admin/include/breadcrumbs', $data);
  $this->load->view('templates/admin/include/sidebar', $data);
  $data['buttons']['action'][] = [
    'title'=>'В не архив',
    'link'=>'/admin/cards/show_cards',
    'icon'=>'fa fa-safari',
    'color'=>'green-sharp'
  ];
    $data['buttons']['action'][] = [
    'title'=>'Создать карточку',
    'link'=>'/admin/cards/create',
    'icon'=>'fa fa-plus',
    'color'=>'blue-soft',
    'hiddenMobile'=>true
  ];
  $this->load->view('admin/ItemCards/show_cards', $data);
  $this->load->view('templates/admin/include/footer', $data);
  $this->load->view('templates/admin/include/javascript');
}
}
}


public function view($slug = NULL)
{
  $data['cards_item'] = $this->ItemCard_model->get_cards($slug);


  if (empty($data['cards_item']))
  {
    show_404();
  }

  $data['title'] = $data['cards_item']['title'];

  $this->load->view('templates/header', $data);
  $this->load->view('ItemCards/view', $data);
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
              $data['menu'] = $this->Menu_model->get_menu();
                // set the flash data error message if there is one
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css");
                $this->data['page_level_plugin'][] = array(
                                'src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"
                                );
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/daterangepicker.css");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js");
                $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
                $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/moment.min.js");
                $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/daterangepicker.js");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/normalize.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.Metronic.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2.min.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2-bootstrap.min.css");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js");
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
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createItemCardForm.js");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/form-wizard.js");
              $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
              $this->data['page_level_plugin'][]= array('src' =>"http://maps.googleapis.com/maps/api/js?key=AIzaSyD34f8N3If5za0tpksojOM6MbZ5j9fRyrM");
              //$this->data['page_level_plugin'][]= array('src' =>"http://maps.googleapis.com/maps/api/js?key=AIzaSyATrswEqCRkKdUUo_0Zxt4CnGnSEoYuSoU&sensor=false");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/mapGenerator.js");
              //$data['cards_cat_filter'] = $this->Filter_model->get_filter_all();
              // $data['cards_cat_no_filter'] = $this->Filter_model->get_filter_all();
              $data['staffCard'] = $this->Staff_model->get_staff_all();
              $data['title'] = 'Создание карточки';
              $this->breadcrumb->add_crumb('Создание карточки', '/admin/cards/create');
              $this->load->helper('form');
              
              $data['filters'] = $this->Filter_model->get_filters();
              $this->load->view('templates/admin/include/head', $data);
              $this->load->view('templates/admin/include/header', $data);
              $this->load->view('templates/admin/include/breadcrumbs', $data);
              $this->load->view('templates/admin/include/sidebar', $data);
              $this->load->view('admin/ItemCards/createWizard', $data);
              $this->load->view('templates/admin/include/footer', $data);
              $this->load->view('templates/admin/include/javascript');
            }
          }
          public function createCard()
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
              echo $this->ItemCard_model->set_card();
            }   
          }
          public function importCard()
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
              echo $this->ItemCard_model->import_card();
            }   
          }
          public function uploadImagesCard()
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

 

public function uploadImagesCard2($imgPath=false)
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
// if (!empty($this->input->post('pathFile'))) {
//   $imgPath = $this->input->post('pathFile');
//   }
if ($imgPath == false) {
  # code...


              if (isset($_FILES))
              {
    // A list of permitted file extensions
                $allowed = array('png', 'jpg', 'gif','zip');
                if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){

                 $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                 if(!in_array(strtolower($extension), $allowed)){
                   echo '{"status":"error_1"}';
                   exit;
                 }
                 if(move_uploaded_file($_FILES['logo']['tmp_name'],'uploads/'.$_FILES['logo']['name'])){
                   $tmp='uploads/'.$_FILES['logo']['name'];
     $new = 'images/'.$_FILES['logo']['name']; //adapt path to your needs;
     if(copy($tmp,$new)){
       //echo 'uploads/'.$_FILES['logo']['name'];
       echo '{"status":"success"}';
       
     }
     exit;
   }
 }
 else{echo '{"status":"Нет массива"}';}
 //echo '{"status":"error_2"}';
 exit;
}

}

else
{
  if (isset($_FILES))
              {

               //$data = file_get_contents($_REQUEST['imgData']);
    // A list of permitted file extensions
                $allowed = array('png', 'jpg', 'gif','zip');
                if (!isset($_FILES['logo'])) {
                  echo '{"status":"error_Files_notisset"}';
                                  }
                if(isset($_FILES['logo'])){
                  //print_r($_FILES['logo']);
                 $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                 //echo '{"status":"'.$extension.'"}';
                 if(!in_array(strtolower($extension), $allowed)){
                   echo '{"status":"error_1"}';
                   exit;
                 }
                 $minHeight = 390;
                 $minWidth = 255;
                 $sizePic = getimagesize($_FILES['logo']['tmp_name']);

                 if($sizePic[0]<$minWidth or $sizePic[1]<$minHeight){die( json_encode('{"status":"File too small for this site"}'));}
                 if(move_uploaded_file($_FILES['logo']['tmp_name'],'uploads/'.$_FILES['logo']['name'])){
                   $tmp='uploads/'.$_FILES['logo']['name'];
                   $imgFull=$imgPath.'.'.$extension;
     $new = 'images/'.$imgFull; //adapt path to your needs;
     if(copy($tmp,$new)){
      $data = [
        'url' => $new
        ];
      $jsonOut = $this->ImageControl_model->set_image($data);
       //echo 'uploads/'.$_FILES['logo']['name'];
        
      $out1 = create_preview_image($new,'images/thumb/285X460/'.$imgFull,285,460);
      $out1 = create_preview_image($new,'images/thumb/720X446/'.$imgFull,720,446);
      $out1 = create_preview_image($new,'images/thumb/355X446/'.$imgFull,355,446);
      $out1 = create_preview_image($new,'images/thumb/745X460/'.$imgFull,745,460);
      $out1 = create_preview_image($new,'images/thumb/180X240/'.$imgFull,180,240);
      $out1 = create_preview_image($new,'images/thumb/390X255/'.$imgFull,390,255);
      $out2 = create_preview_image($new,'images/thumb/480X259/'.$imgFull,480,259);
      $out3 = create_preview_image($new,'images/thumb/90X90/'.$imgFull,90,90);
      $out4 = create_preview_image($new,'images/thumb/90X60/'.$imgFull,90,60);
       print(json_encode('{"status":"success"}'));
     }
     exit;
   }
 }
  else{echo '{"status":"Нет массива"}';}
 echo '{"status":"'.json_encode($_REQUEST).'"}';
 exit;
}
}
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
              $data['CardsItem'] = $this->ItemCard_model->get_cards($idCard);

              if (empty($data['CardsItem']))
              {
                show_404();
              }
              $data['cards_cat_filter'] = $this->Filter_model->get_filter_all($idCard);
              $data['menu'] = $this->Menu_model->get_menu();
              $data['staffCard'] = $this->Staff_model->get_staff_all($idCard);
              //$data['proverka'] = $this->Filter_model->getFiltersIdByIdCard($idCard);
                // set the flash data error message if there is one
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/normalize.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/css/ion.rangeSlider.Metronic.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/css/multi-select.css");
                $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css");
                $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/handlebars.min.js"
                );
              $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js"
                );
              $this->data['page_level_plugin'][] = array(
                'src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"
                );
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"); 
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/fancybox/source/jquery.fancybox.pack.js");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2.min.css");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2-bootstrap.min.css");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/daterangepicker.css");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/select2/js/select2.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/plupload/js/plupload.full.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-summernote/summernote.min.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jquery-multi-select/js/jquery.multi-select.js");
              $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/changeCardsForm.js");
              
              $this->data['page_level_plugin'][]= array('src' =>"http://maps.googleapis.com/maps/api/js?key=AIzaSyD34f8N3If5za0tpksojOM6MbZ5j9fRyrM");
              //$this->data['page_level_plugin'][]= array('src' =>"http://maps.googleapis.com/maps/api/js?key=AIzaSyATrswEqCRkKdUUo_0Zxt4CnGnSEoYuSoU&sensor=false");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/mapGenerator.js");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/loadLastImages.js");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/imageControlSave.js");
              $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/quicksearch/jquery.quicksearch.js");
              $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/moment.min.js");
              $this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/bootstrap-daterangepicker/daterangepicker.js");
              $data['title'] = 'Редактирование карточки';
              $this->breadcrumb->add_crumb('Редактирование карточки', '/admin/cards/change');
              $this->load->helper('form');
              $data['menuCard'] = $this->ItemCard_model->get_menu_cards($idCard);
              $data['lastImages'] = $this->ImageControl_model->get_last_images();
              $data['countReview'] = count($this->Review_model->get_reviews($idCard,'all',false,true));

                //$data['title'] = 'Панель администратора';
               // $data['filters'] = $this->Filter_model->get_filters();
              $this->load->view('templates/admin/include/head', $data);
              $this->load->view('templates/admin/include/header', $data);
              $this->load->view('templates/admin/include/breadcrumbs', $data);
              $this->load->view('templates/admin/include/sidebar', $data);
              $this->load->view('admin/ItemCards/change', $data);
              $this->load->view('templates/admin/include/footer', $data);
              $this->load->view('templates/admin/include/javascript');
            }
          }
          public function changeCards($idCard)
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
              //$this->form_validation->set_rules('title', 'Заголовок', 'required');
              $this->form_validation->set_rules('h1', 'Заголовок', 'required');

                //$this->form_validation->set_rules('filters[]', 'Не указан фильтр', 'required');
              if ($this->form_validation->run() === FALSE)
              {
                echo json_encode(array('type' => 'warning','message'=>validation_errors(),'icon'=>'warning'));
              }
              else{
                $home =(!empty($this->input->post('home'))) ? $this->input->post('home') : 0;
                $data['post'] = array(
                  'id_post'=> $idCard,
                  'title' => $this->input->post('title'),
                  'description' => $this->input->post('description'),
                  'body' => $this->input->post('body'),
                  'meta_keywords' => $this->input->post('meta_keywords'),
                  'preview_text' => $this->input->post('preview_text'),
                  'h1' => $this->input->post('h1'),
                  'alias' => $this->input->post('alias'),
                  'date_create' => date('Y-m-d H:i:s'),
                  'public' => $this->input->post('public'),
                  'archive' => $this->input->post('archive'),
                  'logo' => $this->input->post('logo'),
                  'map'=> $this->input->post('map'),
                  'telephone'=> $this->input->post('phone'),
                  'adress'=> $this->input->post('adress'),
                  'e_mail'=> $this->input->post('e_mail'),
                  'contact_name'=> $this->input->post('contact_name'),
                  'company_name'=> $this->input->post('company_name'),
                  'link'=>$this->input->post('link'),
                  'schedule'=> $this->input->post('schedule'),
                  'event'=>$this->input->post('event'),
                  'slider'=>$this->input->post('slider'),
                  'home'=>$home,

                  );
                $data['filters'] = $this->input->post('filters');
                echo ($this->ItemCard_model->set_card($data));
              }   
            }  
          }
          public function deleteCards($idCards = false)
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
                $idCards = $this->input->post('id');
                  echo ($this->ItemCard_model->delete_cards($idCards));
                
              }   
            }  
          }
          public function archiveCards($idCards = false)
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
                $idCards = $this->input->post('id');
                  echo ($this->ItemCard_model->archiveCards($idCards));
                
              }   
            }  
          }
        public function replaceCards($idCards = false)
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
                        
                          echo ($this->ItemCard_model->replace_cards($idCards));
                        
                      }   
                    }  
                  }

          public function bloodhound_h1($request=False)
          {
            
              $request = (isset($_GET['h1'])) ? $_GET['h1'] : '' ;
              
              if ($request!='') {
                // $request=mb_convert_encoding ($request, "UTF-8", mb_detect_encoding($request));
                

                $response = $this->ItemCard_model->find_cards($request);
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