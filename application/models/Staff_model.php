<?php
class Staff_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }


function setUrl($url = false,$change = false, $idElement=false)
	{
		if ($url === false) {
			return 0;
		}
		if ($change != false ) {
			if ($idElement === false) {
				if($this->db->insert('URL_table',["URL"=>$url])){
				$idUrl = $this->db->insert_id();
				$this->db->insert('Elements', ["id_url"=>$idUrl]);
				$idElement = $this->db->insert_id();
				return $idElement;}
				else {return false;}
			}
			$query = $this->db->select('id_url');
			$query = $this->db->from('Elements');
			$query = $this->db->where('id_element',$idElement);
			$query= $this->db->get();
			$row = $query->row();
			$idUrl=$row->id_url;
			$this->db->set('URL', $url);
			$this->db->where('idURL_table', $idUrl);
			if ($this->db->update('URL_table')) {
				return $idElement;
			}
		  	else{return false;}
		  	return;
		}
		if($this->db->insert('URL_table',["URL"=>$url])){
		$idUrl = $this->db->insert_id();
		$this->db->insert('Elements', ["id_url"=>$idUrl]);
		$idElement = $this->db->insert_id();
		return $idElement;}
		else {return false;}

	}
        public function delete_staff($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	                
	                return 'фильтр не выбран';
	        }
	        if ($query = $this->db->delete('Staff', array('id_staff' => $slug ) ) )
	    	{$json = json_encode(array('type' => 'success','message'=>'Человек удален!','icon'=>'success', 'status'=>'OK'));}
	    else{$json = json_encode(array('type' => 'warning','message'=>'Человек не удален скорее всего он используется в карточке:(','icon'=>'warning','status'=>'error1'));}
	    return $json;
	}
       

		public function get_staffs($slug = FALSE)
	{		
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('Staff');
	                return $query->result_array();
	        }
	        if (is_array($slug)) {
	        	foreach ($slug as $key => $value) {
	        		if ($key == 0) {
	        			$this->db->where('id_staff =', $value['staff']);
	        		}
	        		else{$this->db->or_where('id_staff =', $value['staff']);}
	        	}
	        	$query = $this->db->get('Staff');
	        	print($this->db->last_query());
	        	return $query->result_array();
	        }
	        $query = $this->db->get_where('Staff', array('id_staff' => $slug));
	        return $query->row_array();
	}
		
		public function set_staf_has_card($id_card,$ar_staff)
		{
			$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			$user = $this->ion_auth->user()->row();
			$this->load->helper('url');
				if (is_array($ar_staff)) {
				if ($ar_staff != '') {
							$this->db->delete('staff_has_card', array('id_card' => $id_card));		
				foreach ($ar_staff as $key=>$value) {
					if ($value!=0) {
						$data['staffHasCardInsert'] = array(
						'id_card' => $id_card,
						'id_staff' => $key
						);
					$this->db->insert('staff_has_card', $data['staffHasCardInsert']);
					}
					
				}
			}
		}
		if(is_array($id_card)){
			if ($id_card != '') {
							$this->db->delete('staff_has_card', array('id_staff' => $ar_staff));		
				foreach ($id_card as $key) {
					if ($key!=0) {
						$data['staffHasCardInsert'] = array(
						'id_card' => $key,
						'id_staff' => $ar_staff
						);
					if($this->db->insert('staff_has_card', $data['staffHasCardInsert'])){
					$json = json_encode(array('type' => 'success','message'=>'Преподователь добавлен карточке','icon'=>'success'));}
					
					}
					
				}
			}
		}

				
			
			
			return $json;
		}
		public function set_staf_has_filters($id_filter,$ar_staff)
		{
			$json = json_encode(array('type' => 'warning','message'=>'Фильтры не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			$user = $this->ion_auth->user()->row();
			$this->load->helper('url');
				if (is_array($ar_staff)) {
				if ($ar_staff != '') {
							$this->db->delete('staff_has_filters', array('filter_staff' => $id_filter));		
				foreach ($ar_staff as $key=>$value) {
					if ($value!=0) {
						$data['staffHasFiltersInsert'] = array(
						'filter_staff' => $id_filter,
						'staff_id' => $key
						);
					$this->db->insert('staff_has_filters', $data['staffHasFiltersInsert']);
					}
					
				}
			}
		}
		if(is_array($id_filter)){
			if ($id_filter != '') {
							$this->db->delete('staff_has_filters', array('staff_id' => $ar_staff));		
				foreach ($id_filter as $key) {
					if ($key!=0) {
						$data['staffHasFiltersInsert'] = array(
						'filter_staff' => $key,
						'staff_id' => $ar_staff
						);
					if($this->db->insert('staff_has_filters', $data['staffHasFiltersInsert'])){
					$json = json_encode(array('type' => 'success','message'=>'Преподователь добавлен фильтрам','icon'=>'success'));}
					
					}
					
				}
			}
		}

				
			
			
			return $json;
		}

	public function get_staff_all($idCard = false)
	{ $result = [];
	        	if ($idCard == false) {
	                $this->db->select('Staff.name,id_staff');
					$this->db->from('Staff');
					$this->db->order_by('name  ASC');
					$query1 = $this->db->get();
					$result = $query1->result_array();
	                } 
	                else 
	                {
	        		 $this->db->select('Staff.name ,id_staff,description,logo');
					$this->db->from('Staff');
					$this->db->order_by('name  ASC');
					$query1 = $this->db->get();
					$id_staffs = $this->getStaffIdByIdCard($idCard); 
					if(!empty($id_staffs)){
					foreach ($query1->result_array() as $key => $value) {
						if ( in_array_r($value['id_staff'], $id_staffs,"id_staff")) {
							$value['value']=1;}
						$result[] = $value;}
					}
					else{$result=$query1->result_array();}
	        		}

	        		return $result;
	        
	}
	public function get_staff_idStaff($idStaff = false)
	{ $result = [];
	        	if ($idStaff== false) {
	    //             $this->db->select('Staff.name as staff,id_staff');
					// $this->db->from('Staff');
					// $this->db->order_by('staff  ASC');
					// $query1 = $this->db->get();
					// $result = $query1->result_array();
					$this->db->select('item_card.h1 as card,id_post,description,logo');
					$this->db->from('item_card');
					$this->db->order_by('card  ASC');
					$query1 = $this->db->get();
					$result=$query1->result_array();
	                } 
	                else 
	                {
	        		 $this->db->select('item_card.h1 as card,id_post,description,logo');
					$this->db->from('item_card');
					$this->db->order_by('card  ASC');
					$query1 = $this->db->get();
					$id_staffs = $this->getCardIdByIdStaff($idStaff); 
					if(!empty($id_staffs)){
					foreach ($query1->result_array() as $key => $value) {
						if ( in_array_r($value['id_post'], $id_staffs,"id_card")) {
							$value['value']=1;}
						$result[] = $value;}
					}
					else{$result=$query1->result_array();}
	        		}

	        		return $result;
	        
	}
	public function get_filter_staff_idStaff_idCatFilter($idStaff = false,$idFilterCat = false)
	{ $result = [];
	        	if ($idStaff== false && $idFilterCat ==false) {
	        		return;
	                } 
	                else 
	                {
	                $filters =$this->getFiltersByIdCat($idFilterCat);
	                
					$id_staffs = $this->getFilterIdByIdStaff($idStaff); 
					if(!empty($id_staffs)){
					foreach ($filters as $key => $value) {
						if ( in_array_r($value['id_filter'], $id_staffs,"filter")) {
							$value['value_select']=1;}
						$result[] = $value;}
					}
					else{$result=$filters;}
	        		}

	        		return $result;
	        
	}
			function getFiltersByIdCat($idCat){
			$query = $this->db->order_by('h1', 'asc');
			$query = $this->db->get_where('filter', array('id_cat_filter' => $idCat));
			

	        $return = $query->result_array();
	        return $return;
		}
	public function get_staff_all_page($idCard = false)
	{ $result = [];
	        	if ($idCard == false) {
	                $this->db->select('Staff.name ,id_staff,Staff.id_element');
					$this->db->from('Staff');
					$this->db->order_by('name  ASC');
					$query1 = $this->db->get();
					$result = $query1->result_array();
	                } 
	                else 
	                {
	        		 $this->db->select('Staff.name ,staff_has_card.id_staff,description,logo,archive,alias,Staff.id_element');
					$this->db->from('Staff,staff_has_card');
					$this->db->where('staff_has_card.id_staff=Staff.id_staff');
					$this->db->where('staff_has_card.id_card',$idCard);
					$this->db->order_by('name  ASC');
					$query1 = $this->db->get();
					$result=$query1->result_array();
	        		}

	        		return $result;
	        
	}
	

		function getStaffIdByIdCard($idCard){
			$this->db->select('id_staff');
			$query = $this->db->get_where('staff_has_card', array('id_card' => $idCard));
	        $return = $query->result_array();
	        return $return;
		}

		function getCardIdByIdStaff($idStaff){
			$this->db->select('id_card');
			$query = $this->db->get_where('staff_has_card', array('id_staff' => $idStaff));
	        $return = $query->result_array();
	        return $return;
		}

		function getFilterIdByIdStaff($idStaff){
			$this->db->select('filter_staff as filter');
			$query = $this->db->get_where('staff_has_filters', array('staff_id' => $idStaff));
	        $return = $query->result_array();
	        return $return;
		}

		public function set_staff($dat=false)
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}

		$user = $this->ion_auth->user()->row();
	    $this->load->helper('url');
	    if ($dat===false) {
	    $slug = url_title($this->input->post('title'), 'dash', TRUE);
	    $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'alias' => $this->input->post('alias'),
                'sort'=>$this->input->post('sort'),
                'logo'=>$this->input->post('logo'),
                'etc'=>$this->input->post('etc'),
                'email' =>$this->input->post('email'),
	            'telephone' =>$this->input->post('telephone'),
	            'site' =>$this->input->post('site')

	    );
	    $idElem = $this->setUrl($data['alias']);
	    if ($idElem) {
				$data['id_element'] = $idElem;
			}
			else  {

				return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));}

	    
	    if($this->db->insert('Staff', $data))
	    	{$id_staff = $this->db->insert_id();
	    		if (!empty($this->input->post('cards'))) {
	    		$this->set_staf_has_card($this->input->post('cards'),$id_staff);
	    		}
	    		if(!empty($this->input->post('filters'))){
	    			$filters = $this->input->post('filters');
	    		$this->Staff_model->set_staf_has_filters($filters,$id_staff);}

	    		$json = json_encode(array('type' => 'success','message'=>'Преподователь добавлен!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));}
	}
	else{
				$query = $this->db->select('id_element');
				$query = $this->db->get_where('Staff', array('id_staff' => $dat['id_staff']));
				$row = $query->row();
				$IDELEMENT=$row->id_element;

				if ($IDELEMENT == 0) {
					$dat['id_element']=$this->setUrl($dat['alias'],true, $IDELEMENT);
					return json_encode(array('type' => 'warning','message'=>$dat['id_element']));
					if ($dat['id_element']) {
						return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url'));
					}
					$IDELEMENT=$dat['id_element'];
				}
		
		$this->db->where('id_staff', $dat['id_staff']);
		    if($this->db->update('Staff', $dat))
	    	{	if(!$this->setUrl($dat['alias'],true, $IDELEMENT)){
			    		return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));}
	    		if (!empty($this->input->post('cards'))) {
	    		$this->set_staf_has_card($this->input->post('cards'),$dat['id_staff']);
	    		}
	    		if(!empty($this->input->post('filters'))){
	    			$filters = $this->input->post('filters');
	    		$this->Staff_model->set_staf_has_filters($filters,$dat['id_staff']);
	    	}

	    		$json = json_encode(array('type' => 'success','message'=>'Преподователь обновлен!','icon'=>'success'));
	}else{
	    		$json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не по плану','icon'=>'warning'));
	    		}
	}
	    return $json;
	}
	
	public function find_staffs($request = FALSE)
		{
			if ($request === FALSE)
			{
				$json=json_encode(array('value' =>'Введите что-нибудь'));
				return $json;
			}
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}

			$this->db->select('name');
			$this->db->from('Staff');
			$this->db->like('name', $request);
			
			if ($query = $this->db->get())
			{
				$ar = [];
				foreach ($query->result() as $row)
				{
					$retVal = ($row->name!='') ? $row->name : '' ;
					$ar[] = array('value' => $retVal);
				}
				$json = json_encode($ar);

			}else{
				$fail = array('value' => 'неудача' );
				$json = json_encode($fail);
			}

			return $json;
		}
		
    }