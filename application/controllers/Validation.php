<?php
class Validation extends CI_Controller {

        public function __construct()
        {
        		parent::__construct();
        		$this->load->model('Element_model');
                $this->load->helper('url_helper');

        }

      public  function valid($field = false)
        {
        	if ($this->input->post('value')) {
        		$validWhat = array($field => $this->input->post('value'));
        	 } 
        	 else{
        	 	$validWhat= '';
        	 }
			$data['valid'][]=$validWhat;

        	$json = $this->Element_model->valid($field,$data['valid']);
        	return print(json_encode($json));

        }
}