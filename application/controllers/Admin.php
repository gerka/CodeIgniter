<?php
class Admin extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('ItemCard_model');
                $this->load->helper('url_helper');
                $this->data['page_level_script'][]= array('src' => '');
                $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
                $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/WorkOnSite.js");
        }

    public function index(){

    if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
            $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');
        }
        elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            // set the flash data error message if there is one
           // $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/WorkOnSite.js");
            $this->breadcrumb->clear();
            $this->breadcrumb->add_crumb('Административная панель', '/admin/');
            $this->load->helper('form');
            $data['title'] = 'Панель администратора';
            $this->load->view('templates/admin/include/head', $data);
            $this->load->view('templates/admin/include/header', $data);
            $this->load->view('templates/admin/include/breadcrumbs', $data);
            $this->load->view('templates/admin/include/sidebar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/admin/include/footer', $data);
            $this->load->view('templates/admin/include/javascript', $data);
        }
    }
    
        
        
    }
