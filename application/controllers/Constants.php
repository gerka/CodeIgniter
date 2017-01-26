<?php
class Constants extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('Tags_model');
                $this->load->helper('url_helper');
                $this->load->library('email');
        }

public function show()
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
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/codemirror/lib/codemirror.css");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/codemirror/theme/monokai.css");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/lib/codemirror.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootbox/bootbox.min.js");
              
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/mode/javascript/javascript.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/addon/edit/matchbrackets.js");
              $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showConstants.js");
              $constants = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/constans.json");
              //$constants = json_decode($constants,true);
              $data['lang'] = ["ru","eng"];
              $data['constants'] = $constants;
              $data['title'] = 'Просмотр констант';
              $this->breadcrumb->add_crumb($data['title'], '/admin/cards/create');
              $this->load->view('templates/admin/include/head', $data);
              $this->load->view('templates/admin/include/header', $data);
              $this->load->view('templates/admin/include/breadcrumbs', $data);
              $this->load->view('templates/admin/include/sidebar', $data);
              $this->load->view('admin/Constants/show', $data);
              $this->load->view('templates/admin/include/footer', $data);
              $this->load->view('templates/admin/include/javascript', $data);
                // return;
        }
        }
    

        public function getByTag($idTag = false)
        {

        }


        function Save(){
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
              $data = $this->input->post('constants');
              $filename = $_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/constans.json";
              //print($filename);
              print(file_put_contents($filename, $data, LOCK_EX));
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
    }