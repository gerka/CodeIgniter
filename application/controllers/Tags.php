<?php
class Tags extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Tags_model');
                $this->load->model('Language_model');
                $this->load->helper('url_helper');
                $this->load->library('email');
        }

public function show_tags($slug = false)
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
  $data['tags'] = $this->Tags_model->getAllTags();}
  //$cats = $this->Tags_model->get_position_menu();
  $iTotalRecords = count($data['tags']);


  $records = array();
  $records["data"] = array(); 


  $status_list = array(
    array("default" => "Publushed"),
    array("default" => "Not Published"),
    array("default" => "Deleted")
  );

foreach ($data['tags'] as $key => $value) {
        $engTag=$this->Language_model->getLanguage($value['element'],'eng','value');
        //print_r($engTag);
        $records["data"][] = array(
      '<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline"><input name="id[]" type="checkbox" class="checkboxes" value="'.$value['id_tag'].'"/><span></span>'.$value["id_tag"].'</label>',
      '<a href="javascript:;"  class="value_edit" data-type="text" data-name="value" data-pk="'.$value['id_tag'].'" data-url="/admin/tags/changeTag/'.$value['element'].'" data-title="'.$value["value"].'">'.$value['value'].'</a>',
      $value['alias'],
      $value['element'],
      '<a href="javascript:;"  class="value_eng_edit" data-type="text" data-name="value" data-pk="'.$value['element'].'" data-url="/admin/tags/lang/setLanguageByElement/'.$value['element'].'/eng" data-title="'.$value['value'].'">'.$retVal = ($engTag['status'] !=false) ? $engTag[$value['element']]['value'].'</a>' : ''.'</a>',
      //'<a href="#" class="value_edit" data-type="text" data-name="eng" data-pk="'.$value['element'].'" data-url="" data-title="'.$value['value'].'">'.($engTag['value']) ? $engTag['value'] : '' .'</a>',
      '<a href="javascript:;" data-del-item="'.$value["id_tag"].'" onclick="initArchiveButtonTags()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>',
    );
  }
  //print_r($engTag);
  if (isset($_REQUEST["customActionType"]) && $_REQUEST["customActionType"] == "group_action") {
    $records["customActionStatus"] = "OK"; // pass custom message(useful for getting status of group actions)
    $records["customActionMessage"] = "Group action successfully has been completed. Well done!"; // pass custom message(useful for getting status of group actions)
  }

  //$records["draw"] = $sEcho;
  // $records["recordsTotal"] = $iTotalRecords;
  // $records["recordsFiltered"] = $iTotalRecords;
  
  echo json_encode($records);
                } else {
                    $this->data['page_level_plugin'][] = array(
                    'src' => asset_url()."global/scripts/datatable.js"
                    );

                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/datatables.min.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
                $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
                // X-editable
                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/select2/css/select2.css");
                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css");
                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css");
                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.css");
                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css");
                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css");

                    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-editable/inputs-ext/address/address.css");
                 
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/select2/js/select2.min.js");
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js");
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js");
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js");
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js");
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.min.js");
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-editable/inputs-ext/address/address.js");
                      $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js");
                      // X-editable
               
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showTagsForm.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/addNewsTags.js");
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/urlLit.js");
                $data['title'] = 'Просмотр тегов';
                //$data['news'] = $this->News_model->get_news();
                $this->breadcrumb->add_crumb('Просмотр новостей', '/admin/news/show_news');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                  // $data['buttons']['action'][] = [
                  //       'title'=>'В архив',
                  //       'link'=>'/admin/news/show_archive',
                  //       'icon'=>'fa fa-archive',
                  //       'color'=>'blue-steel',
                  //       'hiddenMobile'=>true
                  //     ];
                  //     $data['buttons']['action'][] = [
                  //       'title'=>'Создать новость',
                  //       'link'=>'/admin/news/create',
                  //       'icon'=>'fa fa-plus',
                  //       'color'=>'blue-soft',
                  //       'hiddenMobile'=>true
                  //     ];
                
                $this->load->view('admin/Tags/show_tags', $data);
                $this->load->view('admin/Tags/addTags', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
                return false;
        }
        }
    }

        public function getByTag($idTag = false)
        {

        }

 function bloodhound_h1_tag()
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
                $h1 = ($this->input->post('h1')) ? $this->input->post('h1') : false ;
                if ($h1) {
                    $response = $this->Tags_model->find_tag($h1);
                    $json = ['valid'=>$response];
                    echo json_encode($json);
                }
              else{
              $json = ['valid'=>false];
                    echo json_encode($json);
                    $response = false;
                    }
              return $response;
              
              }
              
            
          }

        function addTag(){
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
            $erorr = [];
              $data = $this->input->post('h1');

              if($res = $this->Tags_model->addTag($data))
              {     
                    
                    if(!empty($res['type']))
                    {$erorr['type'] = $res['type'];}
                    else{$erorr['type'] = "success";}
                    $erorr['query'] = $res;
                    if(!empty($res['message']))
                    {$erorr['message'] = $res['message'];}
                    $result=true;
                                      
                echo json_encode($erorr);
                return $result;
                
            }
            else
            {
                $erorr['type'] = "warning";
                    $result=false;
                echo json_encode($erorr);
                return $result;}
            }
        }
        function set_tags_has_news($id_news=false,$idTag = false){
          if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
                redirect('auth/login', 'refresh');
                $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');
                return;      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
                return show_error('You must be an administrator to view this page.');
            }
            elseif($idTag){
                if($result = $this->Tags_model->set_tags_has_news($id_news,[$idTag])){return $result;}
            }
            else
            {
              $data = $this->input->post('tags');
              if($result = $this->Tags_model->set_tags_has_news($id_news,$data)){return $result;}
            }
        }
        public function getJson($q = false){
        	$result = [];
        	$q = $_GET['q'];
			// $q = iconv("cp1251","UTF-8",$q);
			
        	$result = $this->Tags_model->getAllTags($q);
        	echo json_encode($result);
        }
        public function deleteTag($idTag = false)
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
                $idTag = $this->input->post('id');
                  echo ($this->Tags_model->delete_tag($idTag));
                
              }   
            }  
          }
          function setLanguageByElement($idElement = false, $language = false)
    {   
        $fields =array();
        $fields[$this->input->post('name')] = $this->input->post('value');
        return print($this->Language_model->setLanguage($idElement,$language,$fields));
    }
          function changeTag($idElement = false)
    { $json = json_encode(['status'=>'error']);
        if ($idElement!=false) {
        if ($this->Tags_model->updateTag($this->input->post('pk'),$this->input->post('value'))) {
            $json = json_encode(['status'=>'success']);
        }
        return $json;
    } 
    return $json;
    }
    }