<?php
class ItemCard_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function find_cards($request = FALSE)
		{
			if ($request === FALSE)
			{
				$json=json_encode(array('value' =>'Введите что-нибудь'));
				return $json;
			}
			

			
			//$request = mb_convert_encoding($request, "UTF-8");
			//echo "$request";

			$this->db->select('h1,alias');
			$this->db->from('item_card');
			$this->db->like('h1', $request);
			
			if ($query = $this->db->get())
			{
				$ar = [];
				foreach ($query->result() as $row)
				{
					$retVal = ($row->h1!='') ? $row->h1 : $row->title ;
					$retVal2 = ($row->alias!='') ? $row->alias : '' ;
					$ar[] = array('value' => $retVal,'url'=>$retVal2);
				}
				$json = json_encode($ar);

			}else{
				$fail = array('value' => 'неудача' );
				$json = json_encode($fail);
			}

			return $json;
		}

	public function get_cards($slug = FALSE, $archive = TRUE, $count=false,$addMenu = true)
	{
	// 	if ($archive === TRUE) {
		
	// 	if ($slug === FALSE)
	// 	{
	// 		$query = $this->db->get_where('item_card',['archive'=>1]);
	// 		return $query->result_array();
	// 	}
	// 	$return = [];

	// 	$query = $this->db->get_where('item_card', array('id_post' => $slug));
	// }
	// else{
		if ($slug === FALSE)
		{	
			
			if ($addMenu != false) {
				$query=$this->db->select('
									item_card.id_post,
									item_card.public,
									Menu_has_cards.id_cards,
									item_card.h1,
									item_card.date_create,
									item_card.alias,
									Menu_has_cards.id_menu,
									Menu.id_menu,
									Menu.value,
									Menu.parent,
									Menu.alias');
				//$query=$this->db->from('item_card');
				$query=$this->db->join('Menu','Menu.id_menu=Menu_has_cards.id_menu','left');
				//$query=$this->db->join('Menu_has_cards','Menu_has_cards.id_menu=Menu.id_menu','left');
				//$query=$this->db->join('item_card','item_card.id_post=Menu_has_cards.id_cards','left');
				$query=$this->db->where('Menu_has_cards.id_cards=item_card.id_post');
				$query=$this->db->where('Menu_has_cards.id_menu=Menu.id_menu');
				$query = ($archive) ? $this->db->where('item_card.archive',1) : $this->db->where('item_card.archive',0);
				$query=$this->db->group_by('item_card.id_post');
				$query=$this->db->get('item_card,Menu_has_cards');
				//$result = $this->db->last_query();
				$result = $query->result_array();
				
				if(empty($result)){$result=[];}
				//return $result;
			}
			$query = ($archive) ? $this->db->get_where('item_card',['item_card.archive'=>1]) : $this->db->get_where('item_card',['item_card.archive'=>0]) ;
			//$query = $this->db->get_where('item_card',['item_card.archive'=>0]);
			$res = $query->result_array();
			foreach ($res as $key => $value) {
				$res[$key]['value'] = 'No menu';
							}
			if ($count==true) {
				$result = $query->result_array();
			return count($result);
			}
			foreach ($result as $key => $value) {
				//$res[] = $value;
				foreach ($res as $key => $valueRes) {
					if($value['id_post']==$valueRes['id_post']){$res[$key] = $value;}
				}
			}
			return $res;
		}
		$return = [];
		if (is_array($slug)) {
			if ($archive == false) {
				$query = $this->db->where('archive',0);
			}
			else{$query = $this->db->where('archive',1);}
			foreach ($slug as $key => $value) {
				$query = $this->db->or_where('id_post',$value);
			}
			$query = $this->db->get('item_card');
		}

		$query = $this->db->get_where('item_card', array('id_post' => $slug));
	
		
		return $query->row_array();
	}
	public function get_menu_cards($slug = FALSE)
	{
		
		
		if ($slug != FALSE)
		{
			$query = $this->db->get_where('Menu_has_cards',['id_cards'=>$slug]);
			return $query->row_array();
		}
		else return;
		}
	
	public function get_cards_Byfilter($id = false,$start=false,$length=false,$h1 = false,$product_created_from = false,$product_created_to = false,$archive = true,$orderCard = false)
	{
			$order = '';
			$like = '';
	        $where = '';
	        $columns = [0=>'id_post',1=>'id_post',2=>'h1',3=>'logo',4=>'date_create'];
	        $order = (!isset($_REQUEST['order'][0]['column'])) ? $order : $this->db->order_by($columns[$_REQUEST['order'][0]['column']],$_REQUEST['order'][0]['dir']) ;
	        $like = ($id===false) ? $like : $this->db->like('id_post',$id) ;
	        $like = ($h1===false) ? $like : $this->db->like('h1',$h1) ;
	        // $start= ($start===false) ? $like : $this->db->like('start',$start) ;
	        // $length= ($length===false) ? $like : $this->db->like('length',$length) ;
	        $product_created_from = ($product_created_from === false) ? false : $product_created_from=$product_created_from.' 00:00:00' ;
	        $product_created_to = ($product_created_to === false) ? false : $product_created_to=$product_created_to.' 00:00:00' ;

	        $where = ($product_created_from === false) ? $where : $this->db->where('date_create >',$product_created_from) ;
	        $where = ($product_created_to === false) ? $where : $this->db->where('date_create <',$product_created_to) ;
	        if ($archive == true) {
	        $query = $this->db->get('item_card');
	        } else {
			$query = $this->db->get_where('item_card ',['archive'=>0],$start,$length);
		}
			if ($orderCard!=false) {

				foreach ($orderCard as $key => $value) {
					$this->db->order_by($key,$value);
				}
			}
	        return $query->result_array();
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


	public function set_card($dat = FALSE)
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}
		if ($dat === FALSE)
		{

			$user = $this->ion_auth->user()->row();
			$this->load->helper('url');
			$home =(!empty($this->input->post('home'))) ? $this->input->post('home') : 0;
			$data['cardInsert'] = array(
				'id_user' => $user->id,
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'body' => $this->input->post('body'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'logo' => $this->input->post('logo'),
				'alias' => $this->input->post('alias'),
				'link' => $this->input->post('link'),
				'h1' => $this->input->post('h1'),
				'preview_text' => $this->input->post('preview_text'),
				'public' => $this->input->post('public'),
	        	'archive' => $this->input->post('archive'),
	        	'map'=> $this->input->post('map'),
                'telephone'=> $this->input->post('phone'),
                'adress'=> $this->input->post('adress'),
                'contact_name'=> $this->input->post('contact_name'),
                'schedule'=> $this->input->post('schedule'),
                'event'=>$this->input->post('event'),
                'company_name'=>$this->input->post('company_name'),
                'e_mail'=>$this->input->post('e_mail'),
                'home'=>$home,
				);
			$idElement = $this->setUrl($data['cardInsert']['alias']);
			if ($idElement) {
				$data['cardInsert']['id_element'] = $idElement;
			}
			else  {

				return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));}
			// $json = json_encode(array('type' => 'success','message'=>$idElement,'icon'=>'success'));
			// return $json;
			
			if($this->db->insert('item_card', $data['cardInsert']))
			{
				$id_last=$this->db->insert_id();
				$json = json_encode(array('type' => 'success','message'=>'Карточка Обновлена!','icon'=>'success','id_element'=>$idElement,'id_card'=>$id_last));
				if ($this->set_card_has_filter($data['cardInsert']['title'],$this->input->post('filters'),'title')) {

					$json = json_encode(array('type' => 'success','message'=>'Карточка Обновлена и категории тоже!','id_element'=>$idElement,'icon'=>'success','id_card'=>$id_last));  	}

					else{
						$json = json_encode(array('type' => 'warning','message'=>'Карточка Обновлена а категории нет! '.$this->input->post('filters'),'icon'=>'success','id_element'=>$idElement,'id_card'=>$id_last));
					}
				}else{
					//$this->clearURL($idElement);
					$id_last=$this->db->insert_id();
					$json = json_encode(array('type' => 'warning','message'=>'Видимо такая карточка уже существует ','icon'=>'warning','id_element'=>$idElement,'id_card'=>$id_last,'last'=>$this->db->last_query()));
				}
				return $json;
			}
			else{
				$query = $this->db->select('id_element');
				$query = $this->db->get_where('item_card', array('id_post' => $dat['post']['id_post']));
				$row = $query->row();
				$IDELEMENT=$row->id_element;
				if ($IDELEMENT == 0) {
					$dat['post']['id_element']=$this->setUrl($dat['post']['alias'],true, $IDELEMENT);
					if ($dat['post']['id_element']) {
						return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));
					}
					$IDELEMENT=$dat['post']['id_element'];
				}

				$this->db->where('id_post', $dat['post']['id_post']);
				if($this->db->update('item_card', $dat['post']))
					{
			    		if(!$this->setUrl($dat['post']['alias'],true, $IDELEMENT)){
			    		return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));}
						$json = json_encode(array('type' => 'success','message'=>'Карточка Обновлена!','icon'=>'success'));
				if ($this->set_card_has_filter($dat['post']['id_post'],$dat['filters'])) {
					$json = json_encode(array('type' => 'success','message'=>'Карточка Обновлена и категории тоже!','icon'=>'success','id_element'=>$IDELEMENT));  	}
					else{$json = json_encode(array('type' => 'warning','message'=>'Карточка Обновлена а категории нет! '.json_encode($dat['filters']),'icon'=>'success'));}
				}else{
					$json = json_encode(array('type' => 'warning','message'=>'Видимо такая карточка уже существует','icon'=>'warning'));
				}
				return $json;
			}

	    // $data['cardHasFilterInsert'] = array(
	    // 	'filter' => $this->input->post('filter'), 
	    // 	);
	    // $this->db->insert('card_has_filter', $data['cardInsert']);

		}
		public function import_card($dat = FALSE)
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}
		if ($dat === FALSE)
		{

			$user = $this->ion_auth->user()->row();
			$this->load->helper('url');
			$home =(!empty($this->input->post('home'))) ? $this->input->post('home') : 0;
			$data['cardInsert'] = array(
				'id_user' => $user->id,
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'body' => $this->input->post('body'),
				'meta_keywords' => $this->input->post('meta_keywords'),
				'logo' => $this->input->post('logo'),
				'alias' => $this->input->post('alias'),
				'link' => $this->input->post('link'),
				'h1' => $this->input->post('h1'),
				'preview_text' => $this->input->post('preview_text'),
				'public' => $this->input->post('public'),
	        	'archive' => $this->input->post('archive'),
	        	'map'=> $this->input->post('map'),
                'telephone'=> $this->input->post('phone'),
                'adress'=> $this->input->post('adress'),
                'contact_name'=> $this->input->post('contact_name'),
                'home'=> $home,
				);
			//проверка не обновляем ли мы карточку
				$query = $this->db->select('id_element,id_post');
				$query = $this->db->get_where('item_card', array('h1' => $data['cardInsert']['h1']));
				if($row = $query->row()){
				$IDELEMENT=$row->id_element;
				
				$this->db->where('h1', $data['cardInsert']['h1']);
				if($this->db->update('item_card', $data['cardInsert']))
					{
			    		$this->setUrl($data['cardInsert']['alias'],true, $IDELEMENT);
						$json = json_encode(array('type' => 'success','message'=>'Карточка Обновлена!','icon'=>'success'));
				if ($this->set_card_has_filter($row->id_post,$this->validFilterArr($this->input->post('filters')),'id_post')) {
					$json = json_encode(array('type' => 'success','message'=>'Карточка Обновлена и категории тоже!','icon'=>'success','id_element' => $IDELEMENT));  	}
					else{$json = json_encode(array('type' => 'warning','message'=>'Карточка Обновлена а категории нет! '.json_encode($this->input->post('filters')),'icon'=>'success'));}
				}else{
					$json = json_encode(array('type' => 'warning','message'=>'Видимо такая карточка уже существует','icon'=>'warning'));
				}
				die($json);}

				else{
			// $filterArr = $this->validFilterArr($this->input->post('filters'));
			// $json = json_encode(array('type' => 'warning','message'=>$filterArr,'icon'=>'warning'));
			//  return print($json);
			//
			$idElement = $this->setUrl($data['cardInsert']['alias']);
			if ($idElement) {
				$data['cardInsert']['id_element'] = $idElement;
			}
			else  { die(json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning')));}
			// $json = json_encode(array('type' => 'success','message'=>$idElement,'icon'=>'success'));
			// return $json;
			
			if($this->db->insert('item_card', $data['cardInsert']))
			{
				$id_last=$this->db->insert_id();
				$json = json_encode(array('type' => 'success','message'=>'Карточка Добавлена!','icon'=>'success','id_element'=>$idElement,'id_card'=>$id_last));
				$filterArr = $this->validFilterArr($this->input->post('filters'));
				if (!empty($this->input->post('menu'))) {
					$MenuInsert = ['id_cards'=>$id_last,'id_menu'=>$this->input->post('menu')];
					$query=$this->db->delete('Menu_has_cards',['id_cards'=>$id_last]);
					$query=$this->db->insert('Menu_has_cards',$MenuInsert);
				}
				$Menu = $this->input->post('menu');
				if ($this->set_card_has_filter($data['cardInsert']['title'],$filterArr,'title')) {

					$json = json_encode(array('type' => 'success','message'=>'Карточка Добавлена!','id_element'=>$idElement,'icon'=>'success','id_card'=>$id_last));  	}

					else{
						$json = json_encode(array('type' => 'warning','message'=>'Карточка Обновлена а категории нет! '.$this->input->post('filters'),'icon'=>'success','id_element'=>$idElement,'id_card'=>$id_last));
					}
				}else{
					$id_last=$this->db->insert_id();
					$json = json_encode(array('type' => 'warning','message'=>'В карточке присутствуют недопустимые поля','icon'=>'warning','id_element'=>$idElement,'id_card'=>$id_last,'last'=>$this->db->last_query()));
				}
				return $json;
			}
			}

	    // $data['cardHasFilterInsert'] = array(
	    // 	'filter' => $this->input->post('filter'), 
	    // 	);
	    // $this->db->insert('card_has_filter', $data['cardInsert']);

		}
		 function set_image_has_item_card($id_card = false, $ar_image = false ,$name=false)
		{
			$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}

				$this->load->helper('url');
				
				if (!is_array($ar_image) and $ar_image !== false) {
						//$this->db->delete('Image_has_item_card', array('item_card_id_post' => $id_card));
						$data['cardHasimageInsert'] = array(
							'item_card_id_post' => $id_card,
							'Image_idImage' => $ar_image
							);
						if($this->db->insert('Image_has_item_card', $data['cardHasimageInsert'])){
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
					$this->db->delete('Image_has_item_card', array('item_card_id_post' => $id_card));
					$data['cardHasimageInsert'] = array(
						'item_card_id_post' => $id_card,
						'Image_idImage' => $value
						);
					if($this->db->insert('Image_has_item_card', $data['cardHasimageInsert'])){
						$out = true;
						$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
							$out=false;
							$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}
				}
				}
				else{if($this->db->insert('Image_has_item_card', $ar_image)){
					$out = true;
					$json = json_encode(array('type' => 'success','message'=>'Изображения добавлены!','icon'=>'success'));}else{
						$out=false;
						$json = json_encode(array('type' => 'warning','message'=>'Изображения не добавлены в галерею!','icon'=>'success'));}}
				
			return $out;
		}
		public function validFilterArr($ar_filter=false)
		{	

			$newArr = [];
			$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($ar_filter==false) {
				return false;
			}
			$user = $this->ion_auth->user()->row();
			$this->load->helper('url');
			$query = $this->db->select('h1,idfilter_cat');
			$query = $this->db->get('filter_cat');
			$filterCats = $query->result_array();
			foreach ($ar_filter as $key => $value) {

				$pieces = explode(";", $value['filters'][0]);
				foreach ($filterCats as $keyCat => $valueCat) {
					if ($valueCat['h1'] == $value['nameCat']) {
						foreach ($pieces as $key2 => $wordToFind) {
							$wordToFind = trim ($wordToFind);
							if ($wordToFind==1) {
								$wordToFind='Да';
							}
							if ($wordToFind===0) {
								$wordToFind='Нет';
							}
							$query = $this->db->select('h1,id_filter');
							$query = $this->db->like('h1', $wordToFind);
							$query = $this->db->where('id_cat_filter', $valueCat['idfilter_cat']);
							$query = $this->db->get('filter');

							$temp = ($query->result_array()) ? $query->result_array() : false ;
							if (!$temp) {
								continue;
							}
							$newArr[] = $temp[0]['id_filter'];
						}
					}
				}
				
			}
	    
			return $newArr;
		}
		public function set_card_has_filter($id_card,$ar_filter,$name=false)
		{
			$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			$user = $this->ion_auth->user()->row();
			$this->load->helper('url');

	    // $slug = url_title($this->input->post('title'), 'dash', TRUE);
			if($name!=false){
				$query = $this->db->get_where('item_card', array($name=>$id_card));
				foreach ($query->result() as $row)
				{
					$this->db->delete('card_has_filter', array('item' => $row->id_post));
				}
				if ($ar_filter != '') {
					# code...
				
				foreach ($ar_filter as $value) {
					$data['cardHasFilterInsert'] = array(
						'item' => $row->id_post,
						'filter' => $value
						);
					$this->db->insert('card_has_filter', $data['cardHasFilterInsert']);
				}

				$json = json_encode(array('type' => 'success','message'=>'категории добавлены!','icon'=>'success'));
			}
			}
			else{
				$query = $this->db->get_where('item_card', array('id_post'=>$id_card));
				$this->db->delete('card_has_filter', array('item' => $id_card));

				if ($ar_filter != '') {
									
				foreach ($ar_filter as $value) {
					$data['cardHasFilterInsert'] = array(
						'item' => $id_card,
						'filter' => $value
						);
					$this->db->insert('card_has_filter', $data['cardHasFilterInsert']);
				}

				$json = json_encode(array('type' => 'success','message'=>'категории добавлены!','icon'=>'success'));
			}
			}
			return $json;
		}

		public function delete_cards($idCards = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idCards != false) {
				# code...
			$this->db->select('id_element, id_post, alias');
			$this->db->from('item_card');
			$this->db->where('id_post', $idCards);
			$query = $this->db->get();
			foreach ($query->result() as $row)
{
        $idElement = $row->id_element;
        $alias = $row->alias;
}
			
$data['delete'] = '' ;

			$this->db->delete('card_has_filter', array('item' => $idCards));
			$this->db->delete('staff_has_card', array('id_card' => $idCards));
			$this->db->delete('Menu_has_cards', array('id_cards' => $idCards));
			$this->db->delete('Review', array('id_post' => $idCards));
			$this->db->delete('item_card', array('id_post' => $idCards));
			
			$data['delete'][] = $this->db->last_query();
			$this->db->delete('Elements', array('id_element' => $idElement));
			$this->db->delete('URL_table', array('URL' => $alias));
			//$this->db->update('item_card', array('archive' => 1, ))
			if ($this->db->delete('URL_table', array('URL' => $alias)))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = $data['delete'];//['status'=>'error3'];
			}
			return json_encode($json);
		}
		else{
			return ['status'=>'error1'];
		}
	}
public function archiveCards($idCards = false){
	
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			
			if($idCards==false){$json = ['status'=>'error3'];return json_encode($json);}
			
			$this->db->where('id_post', $idCards);
			$this->db->set('archive' , 1 );
			$this->db->set('public' , 0 );
			//$this->db->update('item_card', array('archive' => 1f, ))
			if ($this->db->update('item_card'))
			{
				$json = ['status'=>'OK'];
			}else{
				$json = ['status'=>'error3'];
			}
			return json_encode($json);
		


}
public function replace_cards($idCards = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idCards = $this->input->post('id')) {
				# code...
			
			$this->db->where('id_post', $idCards);

			//$this->db->update('item_card', array('archive' => 1f, ))
			if ($this->db->update('item_card', array('archive' => 0, )))
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




	}