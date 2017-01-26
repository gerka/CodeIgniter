<?php
class Language_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function setLanguage($idElement = false,$language = false,$fields = false)
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}
		if ($idElement !== FALSE)
	        {
	        	

		foreach ($fields as $key => $value) {
			if($key!='alias'){
			if (!is_int($value) and !is_array($value)) 
			{
			$data['langInsert'] = 
			[
			'value' => $value,
			'id_element' => $idElement,
			'language' => $language,
			'nameField' => $key
			];
			$status = $this->getLanguage($idElement, $language,$key);

			if ($status['status']!=false) {
				if ($this->db->replace('Language', $data['langInsert'])) {
					$json = json_encode(array('status'=>'success','type' => 'success','message'=>'Язык '.$language.' обновлен','icon'=>'heart'));
				}
				else{$json = json_encode(array('status'=>'error','type' => 'warning','message'=>'Язык '.$this->db->last_query().' не обновлен','icon'=>'heart'));}
	    		//return $json;
			}
			else{
			$this->db->insert('Language', $data['langInsert']);
			$json = json_encode(array('status'=>'success','type' => 'success','message'=>'Язык '.$language.' установлен','icon'=>'heart'));
	    //return $json;
			}
		}
	}
}
	    
	}
		//$json = json_encode(array('type' => 'warning','message'=>'Язык '.$language.' не установлен','icon'=>'heart-beat'));
	    return $json;
	}

	public function getLanguage($idElement = false, $language = false,$field = false)
	{
		if ($field!=false) {
			
			if(is_array($field)){
				foreach ($field as $key => $value) {
					$this->db->or_where('nameField',$value);
				}
			}
			else{
				$this->db->where('nameField',$field);
			}

		}	

		$this->db->where('language',$language);
		if(is_array($idElement)){
			foreach ($idElement as $key => $value) {
				if ($key==0) {
					$this->db->where('id_element',$value);
				}
				else{
				$this->db->or_where('id_element',$value);}
			}
		}
		else{
		$this->db->where('id_element',$idElement);}
		$query = $this->db->get('Language');
		$result = $query->result_array();
		$return = [];
		if(!empty($result)){
			foreach ($result as $key => $value) {
				foreach ($value as $key2 => $value2) {
					if($key2 == 'nameField'){ $key3 = $value2;}
					if ($key2 == 'value') { $value3 = $value2;}
					if($key2 == 'id_element'){$element =$value2; }		
				}
				$return[$element][$key3]=$value3;
			}
			$return['status'] = true;
			return $return;
		}else{return array('message'=>'язык '.$language.' не заполнен','status'=>false);}

		


	}
}