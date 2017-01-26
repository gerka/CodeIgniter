<?php
class Page_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();

        }

	function setUrl($url = false,$change = false, $old=false)
	{
		if ($url === false) {
			return 0;
		}
		if ($change != false ) {
			if ($old == false) {
				return 0;
			}
			$this->db->set('URL', $url);
			$this->db->where('URL', $old);
			$this->db->update('URL_table');
		  return;
		}
		$this->db->insert('URL_table',["URL"=>$url]);
		$idUrl = $this->db->insert_id();
		$this->db->insert('Elements', ["id_url"=>$idUrl]);
		$idElement = $this->db->insert_id();
		return $idElement;

	}


		public function get_pages($slug = FALSE)
		{	if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('Page');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('Page', array('idPage' => $slug));
	        return $query->row_array();
	}
		function get_pages_Byfilter($id = false,$h1 = false,$url = false)
	{
	        $like = '';
	        $where = '';

	        $like = ($id===false) ? $like : $this->db->like('id_news',$id);
	        $like = ($h1===false) ? $like : $this->db->like('h1',$h1);
	        $url = ($url===false) ? $like : $this->db->like('url',$url);
	        $query = $this->db->get('Page');
	        //echo $this->db->last_query();
	        return $query->result_array();
	}

		public function set_page($slug = FALSE)
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
		elseif (!empty($slug['idPage'])) {
			$query = $this->db->select('alias');
			$query = $this->db->get_where('Page', array('idPage' => $slug['idPage']));
			$row = $query->row();
			$oldUrl=$row->alias;
			$this->db->where('idPage', $slug['idPage']);
			
			if($this->db->update('Page', $slug)){
				if ($oldUrl!=$slug['alias']) {
	    		$this->setUrl($slug['alias'],true, $oldUrl);
	    		}

				$json = json_encode(array('type' => 'success','message'=>'Страница успешно изменена!','icon'=>'success'));}
				else{$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));}
				return $json;
		}
		else{

			if($this->db->insert('Page', $slug)){
				$json = json_encode(array('type' => 'success','message'=>'Страница успешно добавлена!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не так свяжитесь с поддержкой :)','icon'=>'warning'));
				
			}
			return $json;

		}
	}

		public function delete_page($slug = FALSE)
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
	        	$json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не так (не передан идентификатор страницы) свяжитесь с поддержкой :)','icon'=>'warning'));
			    return $json;
		}
		else{
			
			
			if($this->db->delete('Page', array('idPage' => $slug)))
			{
				$json = json_encode(array('type' => 'success','message'=>'Страница успешно удалена!','icon'=>'success'));}
				
				else{
					$json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не так свяжитесь с поддержкой :)','icon'=>'warning'));
				return $json;
			}

		}
	}

}