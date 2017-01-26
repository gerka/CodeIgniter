<?php
class Partners_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();

        }
        		public function get_partners($slug = FALSE)
	{		
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('Partners');
	                return $query->result_array();
	        }

	        if (is_array($slug)) {
	        	foreach ($slug as $key => $value) {
	        		if ($key == 0) {
	        			$this->db->where('id =', $value['ia']);
	        		}
	        		else{$this->db->or_where('id =', $value['id']);}
	        	}
	        	$query = $this->db->get('Partners');
	        	print($this->db->last_query());
	        	return $query->result_array();
	        }
	        $query = $this->db->get_where('Partners', array('id' => $slug));
	        return $query->row_array();
	}

	public function insert_partner($data=false){
		
	    if($this->db->insert('Partners', $data))
	    	{$json = json_encode(array('type' => 'success','message'=>'фильтр добавлен!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));}
	}
	public function set_partner($slug = FALSE)
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}
		$user = $this->ion_auth->user()->row();
	    $this->load->helper('url');
	    if ($slug === FALSE)
	        {
			    $json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не так свяжитесь с поддержкой :)','icon'=>'warning'));
			    return $json;

			}
		elseif (!empty($slug['id'])) {
			
			$this->db->where('id', $slug['id']);
			
			if($this->db->update('Partners', $slug)){
				
				$json = json_encode(array('type' => 'success','message'=>'Страница успешно изменена!','icon'=>'success'));}
				else{$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));}
				return $json;
		}
		else{
		$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));
				return $json;
			// if($this->db->insert('Page', $slug)){
			// 	$json = json_encode(array('type' => 'success','message'=>'Страница успешно добавлена!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не так свяжитесь с поддержкой :)','icon'=>'warning'));
				
			// }
			// return $json;

		}
	}

}
