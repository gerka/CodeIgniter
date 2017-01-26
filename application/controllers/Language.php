<?php
class Language extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Element_model');
    $this->load->model('Language_model');
	}

	public function getLanguageByElement($idElement = false, $languge = false)
	{
		if($languge != false){return print (json_encode($this->Language_model->getLanguage($idElement,$languge)));}

		else{
			$mass=$this->Element_model->getElement($idElement);
			$json[$idElement]=$mass;
		 	print (json_encode($json));
		  //	print (json_encode($this->Element_model->getItemsByElement(false,$idElement)));
		}
		return;
		
	}
	function setLanguageByElement($idElement = false, $language = false)
	{	
	    $fields =array();
	    foreach ($this->input->post() as $key => $value) {
	    	$fields[$key]=$value;
	    }
		return print($this->Language_model->setLanguage($idElement,$language,$fields));
	}
}


