<?php
class Review_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();

        }
        public function publicReview($idReview = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idReview = $this->input->post('id_review')) {
				# code...
			
			$this->db->where('id_review', $idReview);

			//$this->db->update('item_card', array('archive' => 1, ))
			
			if ($this->db->update('Review', array('public' => 1, )))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'];
			}
			return json_encode($json);
		}
		else{
			return ['status'=>'error1'];
		}
	}
        public function archiveReview($idReview = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idReview = $this->input->post('id_review')) {
				# code...
			
			$this->db->where('id_review', $idReview);
			$this->db->set('archive', 1);

			//$this->db->update('item_card', array('archive' => 1, ))
			if ($this->db->update('Review'))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'];
			}
			return json_encode($json);
		}
		else{
			return ['status'=>'error1'];
		}
	}

	public function unPublicReview($idReview = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idReview = $this->input->post('id_review')) {
				# code...
			
			$this->db->where('id_review', $idReview);

			//$this->db->update('item_card', array('archive' => 1, ))
			
			if ($this->db->update('Review', array('public' => 0, )))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'];
			}
			return json_encode($json);
		}
		else{
			return ['status'=>'error1'];
		}
	}
        public function unArchiveReview($idReview = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idReview = $this->input->post('id_review')) {
				# code...
			
			$this->db->where('id_review', $idReview);

			//$this->db->update('item_card', array('archive' => 1, ))
			if ($this->db->update('Review', array('archive' => 0, )))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'];
			}
			return json_encode($json);
		}
		else{
			return ['status'=>'error1'];
		}
	}
        public function get_reviews($slug = FALSE,$public = false,$archive = false, $count=false,$idReview = false)
	{

	        $columns = [0=>'id_review',1=>'date_create',2=>'h1',3=>'body',4=>'public',5=>'logo'];
	        $order =false;
	        $order = (!isset($_REQUEST['order'][0]['column'])) ? $order : $this->db->order_by($columns[$_REQUEST['order'][0]['column']],$_REQUEST['order'][0]['dir']) ;
	        //$public=true;
	        switch ($public) {
	        	case 'all':
	        		# code...
	        		break;
	        	case false:
	        		$query = $this->db->where('public', 0);
	        		break;
	        	case 'true':
	        		$query = $this->db->where('public', 1);
	        		break;
	        	
	        	default:
	        		$query = $this->db->where('public', 1);
	        		break;
	        }
	        switch ($archive) {
	        	
	        	case 'all':
	        		# code...
	        		break;
	        	case false:
	        		$query = $this->db->where('archive', 0);
	        		break;
	        	case true:
	        		$query = $this->db->where('archive' ,1);
	        		break;
	        	
	        	default:
	        		$query = $this->db->where('archive', 0);
	        		break;
	        }
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('Review');
	                if ($count == true) {
	                	return $this->db->count_all_results();
	                }
	                return $query->result_array();
	        }
	        if ($idReview !== FALSE) {$query = $this->db->get_where('Review', array('id_review' => $idReview));}
	        else{$query = $this->db->get_where('Review', array('id_post' => $slug));}
	        

	        return $query->result_array();
	        //return $this->db->last_query();
	}

        public function get_news_reviews($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('Review_news');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('Review_news', array('id_news' => $slug));
	        return $query->result_array();
	}
        public function set_review($idCard = FALSE,$data = false)
	{
		if ($data === false) {
			$json = ['status'=>'0'];
		} else {
	        if($this->db->insert('Review', $data))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'.$this->db->last_query()];
			}
			return json_encode($json);
		}
	        
	}

        public function update_review($idCard = FALSE,$data = false)
	{
		if ($data === false) {
			$json = ['status'=>'0'];
		} else {
			foreach ($data as $key => $value) {
				if($value!='' and $key!='id_review'){
				$this->db->set($key,$value);}
			}
			$this->db->where('id_review',$data['id_review']);
	        if($this->db->update('Review'))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'.$this->db->last_query()];
			}
			return json_encode($json);
		}
	        
	}
        public function set_news_review($idCard = FALSE,$data = false)
	{
		if ($data === false) {
			# code...
		} else {
	        if($this->db->insert('Review_news', $data))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'.$this->db->last_query()];
			}
			return json_encode($json);
		}
	        
	}

}
