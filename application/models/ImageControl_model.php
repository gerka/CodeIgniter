<?php
class ImageControl_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

         public function get_gallery($idImage=false){
        	if ($idImage === FALSE)
	        {
	                $query = $this->db->get_where('Image',['dop_field'=>1]);
	                return $query->result_array();
	        }
	    }
         public function get_image_by_id($idImage=false){
        	if ($idImage === FALSE)
	        {
	                $query = $this->db->get('Image');
	                return $query->result_array();
	        }
	        $this->db->from('Image, Image_has_element');
	        $this->db->where('Image.idImage=Image_has_element.image');
	        $query = $this->db->get_where('', array('image' => $idImage));
	        
	        $this->db->last_query();
	        $retVal = ($query) ? $query->result_array() : '' ;
	        if ($retVal) {
	        	$retVal[0]['size'] = human_filesize(filesize($retVal[0]['url']));
	        }
	        return json_encode($retVal);
        }

        function changeProperty($data=false){
        	$error1 = json_encode(['type'=>'warning','message'=>'Данные свойств не были получены']);
        	$error2 = json_encode(['type'=>'warning','message'=>'Изображение не обновлено']);
        	$success_message = json_encode(['type'=>'success','message'=>'Изображение обновлено']);
        	if ($data==false) {
        		return $error1;
        	}
        	else{
        		if ($data['idImage']==0) {
        			return $error1;
        		}
        		$this->db->where('idImage', $data['idImage']);
        		unset($data['idImage']);
        		if($this->db->update('Image', $data)){
        			
        			return $success_message;
        		}
        		else{$error3 =json_encode(['type'=>'warning','message'=>$this->db->last_query()]);
        			return $error3;
        		}
        	}
        }

        function getAllMenuElements($slug = FALSE)
	{		
			
	        if ($slug === FALSE)
	        {
	        	$arrParent = [
	        	['id'=>'Page','text'=>'Страницы','parent'=>'#'],
	        	['id'=>'item_card','text'=>'Карточки','parent'=>'#'],
	        	['id'=>'filter','text'=>'Фильтры','parent'=>'#'],
	        	['id'=>'news','text'=>'Новости','parent'=>'#'],
	        	['id'=>'Staff','text'=>'Преподователи','parent'=>'#']
	        	];

	        	$query = $this->db->get('Page');
	        	$result = $query->result_array();
	        	foreach ($result as $key => $value) {
	        		$arrParent[]=['id'=>$value['id_element'],'text'=>$value['h1'],'parent'=>'Page'];
	        			        	}
	        	$query = $this->db->get('item_card');
	        	$result = $query->result_array();
	        	foreach ($result as $key => $value) {
	        		$arrParent[]=['id'=>$value['id_element'],'text'=>$value['h1'],'parent'=>'item_card'];
	        			        	}
	        	// $query = $this->db->get('filter');
	        	// $result = $query->result_array();
	        	// foreach ($result as $key => $value) {
	        	// 	$arrParent[]=['id'=>$value['id_element'],'text'=>$value['h1'],'parent'=>'filter'];
	        	// 		        	}
	        	$query = $this->db->get('news');
	        	$result = $query->result_array();
	        	foreach ($result as $key => $value) {
	        		$arrParent[]=['id'=>$value['id_element'],'text'=>$value['h1'],'parent'=>'news'];
	        			        	}
	        	$query = $this->db->get('Staff');
	        	$result = $query->result_array();
	        	foreach ($result as $key => $value) {
	        		$arrParent[]=['id'=>$value['id_element'],'text'=>$value['name'],'parent'=>'Staff'];
	        			        	}

	        //  	$query=$this->db->select('
									//  item_card.id_post,
									// ');
				$query=$this->db->from('Image,Image_has_element');
				//$query=$this->db->join('Image_has_element','Image_has_element.image=Image.idImage','left');
				$query=$this->db->where('Image_has_element.image=Image.idImage');
				$query=$this->db->order_by('sort');
				$query=$this->db->get();
				$result = $query->result_array();
				foreach ($result as $key => $value) {
	        		$arrParent[]=['id'=>$value['image'],'text'=>$value['idImage'].$value['alt'],'parent'=>$value['element'],'location'=>$value['url'],'icon'=>'fa fa-file','type'=>'file','id_user'=>$value['id_user'],'sort'=>$value['sort'],'meta_keywords'=>$value['meta_keywords'],'description'=>$value['description'],'alt'=>$value['alt']];
	        			        	}

	            return $arrParent;
	        }

	        if (is_array($slug)) {
	        	// $query = $this->db->order_by('sort','asc');
	        	// $query = $this->db->get('Menu');
	        	// $result = $query->result_array();
	        	// $queryParent = $this->db->get_where('Menu',array('parent=' => 0));
	        	$arrParent = [
	        	['name'=>'pages','title'=>'Страницы','parent'=>'#'],
	        	['name'=>'cards','title'=>'Карточки','parent'=>'#'],
	        	['name'=>'filters','title'=>'Фильтры','parent'=>'#'],
	        	['name'=>'news','title'=>'Новости','parent'=>'#'],
	        	['name'=>'staff','title'=>'Преподователи','parent'=>'#']
	        	];

	        	// foreach ($arrParent as $key => $value) {
	        	// 	foreach ($result as $key2 => $value2) {
	        	// 		if ($value['id_menu']==$value2['parent']) {
	        	// 			$arrParent[$key]['submenu'][]=$value2;
	        	// 		}
	        	// 	}
	        	// }

	        	return $arrParent;
	        	
	        }
	        $query = $this->db->get_where('Menu', array('id_menu' => $slug));

	        return $query->row_array();
	}

        public function get_images_card($idCard=false){
        	if ($idCard === FALSE)
	        {
	                $query = $this->db->get('Image');
	                return $query->result_array();
	        }
	        $this->db->from('Image, Image_has_item_card');
	        $this->db->where('Image.idImage=Image_has_item_card.Image_idImage');
	        $query = $this->db->get_where('', array('item_card_id_post' => $idCard));
	        $this->db->last_query();
	        $retVal = ($query) ? $query->result_array() : '' ;
	        return $retVal;
        }
        public function get_last_images($numPage=0,$maxRecords = 4){
        	// if ($idCard === FALSE)
	        // {
	        //         $query = $this->db->get('Image');
	        //         return $query->result_array();
	        // }
	        
	        $lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
	        
	        $this->db->order_by('idImage','desc');
	        $query = $this->db->get('Image', $maxRecords,$lim);
	        $this->db->last_query();
	        $retVal = ($query) ? $query->result_array() : '' ;

	        return $retVal;
        }
        public function get_images_element($idElement=false){
        	if ($idElement === FALSE)
	        {
	                $query = $this->db->get('Image');
	                return $query->result_array();
	        }
	        $this->db->from('Image, Image_has_element');
	        $this->db->where('Image.idImage=Image_has_element.image');
	        $this->db->where('Image_has_element.element',$idElement);

	        $query = $this->db->get();
	        $this->db->last_query();
	        $retVal = ($query) ? $query->result_array() : '' ;
	        return $retVal;
        }
        public function get_images_staff($idStaff=false){
        	if ($idStaff === FALSE)
	        {
	                $query = $this->db->get('Image');
	                return $query->result_array();
	        }
	        $this->db->from('Image, Image_has_staff');
	        $this->db->where('Image.idImage=Image_has_staff.image');
	        $query = $this->db->get_where('', array('staff' => $idStaff));
	        $this->db->last_query();
	        $retVal = ($query) ? $query->result_array() : '' ;
	        return $retVal;
        }

        function set_image_has_element($idElement= false, $idImage = false)
		{
			$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}

			if ($idElement===false) {
				return;
			}if ($idImage===false) {
				return;
			}
			$data = [
			'image'=>$idImage,
			'element'=>$idElement
			];
			if($this->db->insert('Image_has_element',$data)){
			return $this->db->insert_id();
		}
		else{return $this->db->last_query(); }
	}

		function set_image($data = false,$elementId = false){
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if (empty($data)) {
	    	$json = json_encode('{"status":0}');
		    } 
		    elseif (isset($data['idImage'])) 	     {
		    	if($this->db->update('Image', $data))
		    	{$json = json_encode('{"status":2}');}else{$json = json_encode('{"status":0}');}
		    }
		    else {
		    	if($this->db->insert('Image', $data))
		    	{

		    		$id = $this->db->insert_id();
		    		if ($elementId!=false) {
		    			if($this->db->insert('Image_has_element', ['image'=>$id,'element'=>$elementId,'gallery'=>1]))
		    			{$json = json_encode(["status"=> 1, "id"=>$id, "url"=>$data['url']]);}
		    			else{$json = json_encode(['status'=>0]);}
		    		}
		    		$json = json_encode(["status"=> 1, "id"=>$id, "url"=>$data['url']]);}
		    		else{$json = json_encode(['status'=>0]);}
		    }
	    	return $json;
		}
		function set_image_review($data = false,$elementId = false){
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if (empty($data)) {
	    	$json = json_encode('{"status":0}');
		    } 
		    elseif (isset($data['idImage'])) 	     {
		    	if($this->db->update('Image', $data))
		    	{$json = json_encode('{"status":2}');}else{$json = json_encode('{"status":0}');}
		    }
		    else {
		    	if($this->db->insert('Image', $data))
		    	{

		    		$id = $this->db->insert_id();
		    		if ($elementId!=false) {
		    			if($this->db->insert('Image_has_review', ['image'=>$id,'element'=>$elementId,'gallery'=>1]))
		    			{$json = ["status"=> 1, "id"=>$id, "url"=>$data['url']];}
		    			else{$json = json_encode(['status'=>0]);}
		    		}
		    		$json = ["status"=> 1, "id"=>$id, "url"=>$data['url']];}
		    		else{$json = json_encode(['status'=>0]);}
		    }
	    	return $json;
		}
		//  function set_image_has_staff($id_staff = false, $ar_image = false ,$name=false)
		// {
		// 	$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
		// 	if (!$this->ion_auth->is_admin())
		// 	{
		// 		$this->session->set_flashdata('message', 'You must be an admin to view this page');
		// 		redirect('auth/login');
		// 	}

		// 		$this->load->helper('url');
				
		// 		if (!is_array($ar_image) and $ar_image !== false) {
		// 				//$this->db->delete('Image_has_item_card', array('item_card_id_post' => $id_staff));
		// 				$data['staffHasimageInsert'] = array(
		// 					'staff' => $id_staff,
		// 					'image' => $ar_image
		// 					);
		// 				if($this->db->insert('Image_has_staff', $data['staffHasimageInsert'])){
		// 					$out = true;
		// 					$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
		// 						$out=false;
		// 						$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}
		// 							return $out;
		// 			}
				
						
		// 		if ($ar_image == false) {
		// 		$ar_image = (!empty($this->input->post('images'))) ? $this->input->post('images') : array(false) ;		
		// 		foreach ($ar_image as $value) {
		// 			if ($value==false) {
		// 				return;
		// 			}
		// 			$this->db->delete('Image_has_staff', array('staff' => $id_staff));
		// 			$data['staffHasimageInsert'] = array(
		// 				'staff' => $id_staff,
		// 				'image' => $value
		// 				);
		// 			if($this->db->insert('Image_has_staff', $data['staffHasimageInsert'])){
		// 				$out = true;
		// 				$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
		// 					$out=false;
		// 					$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}
		// 		}
		// 		}
		// 		else{if($this->db->insert('Image_has_staff', $ar_image)){
		// 			$out = true;
		// 			$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
		// 				$out=false;
		// 				$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}}
				
		// 	return $out;
		// }

		 function set_image_has_staff($id_staff = false, $ar_image = false ,$name=false)
		{
			$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}

				$this->load->helper('url');
				
				if (!is_array($ar_image) and $ar_image !== false) {
						//$this->db->delete('Image_has_item_card', array('item_card_id_post' => $id_staff));
						$data['staffHasimageInsert'] = array(
							'staff' => $id_staff,
							'image' => $ar_image
							);
						if($this->db->insert('Image_has_staff', $data['staffHasimageInsert'])){
							$out = true;
							$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
								$out=false;
								$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}
									return $out;
					}
				
						
				if ($ar_image == false) {
				$ar_image = (!empty($this->input->post('images'))) ? $this->input->post('images') : array(false) ;		
				foreach ($ar_image as $value) {
					if ($value==false) {
						return;
					}
					$this->db->delete('Image_has_staff', array('staff' => $id_staff));
					$data['staffHasimageInsert'] = array(
						'staff' => $id_staff,
						'image' => $value
						);
					if($this->db->insert('Image_has_staff', $data['staffHasimageInsert'])){
						$out = true;
						$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
							$out=false;
							$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}
				}
				}
				else{if($this->db->insert('Image_has_staff', $ar_image)){
					$out = true;
					$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
						$out=false;
						$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}}
				
			return $out;
		}
		public function delete_image_card($idImage=FALSE,$idElement = false)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idImage!=false) {
			
			$this->db->where('image', $idImage);
			$this->db->where('element', $idElement);

			//$this->db->update('item_card', array('archive' => 1, ))
			if ($this->db->delete('Image_has_element'))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'];
			}
			return $json;
		}
		else{
			return $json;
		}
	}
    }