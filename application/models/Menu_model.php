<?php
class Menu_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
function getSliderMenu($idMenu=false,$maxRecords=6,$type = 'cat' ){
	$result = [];
	$allLink = '';
	$numPage = 0;

	$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
	if($idMenu!==false){

		$query = $this->db->from('Menu');
		$query = $this->db->where('id_menu',$idMenu);
		$query = $this->db->get();
		$res=$query->row_array();
		$allLink = $res['alias'];

		//$menuTitle = $res['value'];
		if($res['parent'] == 0 )
		{
			$query = $this->db->where('parent',$idMenu);
		$query = $this->db->get('Menu');
		$res = $query->result_array();

		$query = $this->db->where('Menu_has_cards.id_menu',$idMenu);
		foreach ($res as $key => $value) {
			$query = $this->db->or_where('Menu_has_cards.id_menu',$value['id_menu']);
		}
			}
	else{
		$query = $this->db->where('Menu_has_cards.id_menu',$idMenu);}
		if(!empty($_SESSION['PrimeFilter']['country']) and $_SESSION['PrimeFilter']['country']!=0)
		{	$country = $_SESSION['PrimeFilter']['country'];
			$joinStatement = 'card_has_filter.item=item_card.id_post and card_has_filter.filter = '.$country;
			if(!empty($_SESSION['PrimeFilter']['region']) and $_SESSION['PrimeFilter']['region']!=0)
		{	$region = $_SESSION['PrimeFilter']['region'];
			$joinStatement =$joinStatement.'and card_has_filter.filter = '.$region;
			if(!empty($_SESSION['PrimeFilter']['city']) and $_SESSION['PrimeFilter']['city']!=0)
				{	$city = $_SESSION['PrimeFilter']['city'];
				$joinStatement =$joinStatement.'and card_has_filter.filter = '.$city;
			}
			}
			$query = $this->db->join('card_has_filter',$joinStatement,'right');
			//$query = $this->db->where_in('item')('card_has_filter',$joinStatement,'left');
			// print($joinStatement);
			 //print('<br>');
		}
		
		switch ($type) {
			case 'cat':
				$this->db->join('Menu_has_cards','Menu_has_cards.id_cards=item_card.id_post and item_card.home = 1','left');
				break;
			
			case 'top':
				$this->db->join('Menu_has_cards','Menu_has_cards.id_cards=item_card.id_post and item_card.slider = 1','left');
				break;
		}
		
		//$this->db->where('card_has_filter.item ='.$idCard);
		
		$query = $this->db->order_by('item_card.date_create','desc');
		if(!empty($country)){
			$query = $this->db->where('filter',$country);
		}
		if(!empty($region)){
			$query = $this->db->where('filter',$region);
		}
		if(!empty($city)){
			$query = $this->db->where('filter',$city);
		}
		
		$query = $this->db->get('item_card',$maxRecords,$lim);
		if (!empty($query)){$result = $query->result_array();}
		else{$result = [];}
		if(!empty($result))
		{$result[0]['menuLink'] = $allLink;}

			 // print($this->db->last_query());
			 //  print('<br>');
			
			
	}

	return $result;
}
    function aliasCheck($alias=false){
    	if ($alias == false) {
    		return false;
    	}
    	$query=$this->db->get_where('URL_table',array('URL'=>$alias));
    	if($query->result())
    	{
    		return false;
    	}
    	else {return true;}
    }    
    function deleteElementMenu($id_menu=false){
    	if ($id_menu == false) {
    		return false;
    	}
    	$query=$this->db->get_where('Menu',array('id_menu'=>$id_menu));
    	$row = $query->row();

		if (isset($row))
		{
		        $id_element = $row->id_element;
		        $this->db->get_where('Elements',array('id_element'=>$id_element));
		    	$row2 = $query->row();
				if (isset($row2))
				{
				        $id_url = $row->id_url;
				        $this->db->delete('URL_table', array('idURL_table' => $id_url));
				}
		        
		        if ($this->db->delete('Elements', array('id_element' => $id_element ))) {
		        	return true;
		        }
		        else {return false;}
		}
    	else {return false;}
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
	function setPositionMenu($id_menu = false,$position = false)
	{
		if ($position === false) {
			return 0;
		}
		$query = $this->db->delete('Menu_have_position', array('id_menu' => $id_menu ) );
		foreach ($position as $key => $value) {
			$query = $this->db->insert('Menu_have_position', array('id_menu' => $id_menu,'id_position'=>$value) );
		}
		
		return $id_menu;

	}
        public function delete_menu($slug = FALSE)
	{
	        
	        if ($slug === FALSE)
	        {
	                
	                return 'фильтр не выбран';
	        }
	        if ($query = $this->db->delete('Menu', array('id_menu' => $slug ) ) )
	    	{$json = json_encode(array('type' => 'success','message'=>'Пункт меню удален!','icon'=>'success','status'=>'OK'));}
	    else{	
	    	$query = $this->db->get_where('menu_have_filter_cat', array('id_menu' => $slug ));
	    	$count_filters = $query->num_rows();
	    	$query = $this->db->get_where('Menu_has_cards', array('id_menu' => $slug ));
	    	$count_cards = $query->num_rows();
	    	$query = $this->db->get_where('Menu_have_position', array('id_menu' => $slug ));
	    	$count_positions = $query->num_rows();
	    	$message = ($count_filters) ? 'Данное меню используется с '.$count_filters.' фильтрами.' : '';
	    	$message = ($count_cards) ? $message.'Данное меню используется с '.$count_cards.' карточками. ': $message;
	    	$message = ($count_positions) ? $message.'Данное меню используется с '.$count_positions.' меню. ': $message;
	    	$message = $message.' Вы уверены, что хотите удалить пункт меню? <a href="javascript:;" data-del-item="'.$slug.'" onclick="initArchiveButton2()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>';
	    	$json = json_encode(array('type' => 'warning','message'=>$message,'icon'=>'warning','status'=>'error_message'));}
	    return $json;
	
	}
	public function delete_menu2($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	                
	                return 'фильтр не выбран';
	        }
	        if ($this->db->delete('menu_have_filter_cat', array('id_menu' => $slug )))
	    	{
	    		$this->db->delete('Menu_has_cards', array('id_menu' => $slug ));
				$this->db->delete('Menu_have_position', array('id_menu' => $slug ));
				$this->deleteElementMenu($slug);
	    		 if ($query = $this->db->delete('Menu', array('id_menu' => $slug ) ) ){
	    		$json = json_encode(array('type' => 'success','message'=>'Пункт меню удален!'.$this->db->last_query(),'icon'=>'success','status'=>'OK'));}
	    else{$json = json_encode(array('type' => 'warning','message'=>'Пункт меню не удален ','icon'=>'warning','status'=>'error_message'));}
	    return $json;
	}
}
        public function delete_position_menu($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	                
	                return 'фильтр не выбран';
	        }
	        if ($query = $this->db->delete('filter_cat', array('idfilter_cat' => $slug ) ) )
	    	{$json = json_encode(array('type' => 'success','message'=>'Категория фильтра удалена!','icon'=>'success'));}
	    else{$json = json_encode(array('type' => 'warning','message'=>'Категория не удалена, скорее всего она используется в других фильтрах :(','icon'=>'warning','status'=>'error_message'));}
	    return $json;
	}
public function getCardsByMenu($menu = FALSE,$all = false)
	{		
	        if ($menu === FALSE)
	        {
	        	return false;
	        }
	        
	        if (is_array($menu)) {
	        	foreach ($menu as $key => $value) {
	        		if ($key == 0) {
	        			$this->db->where('id_menu =', $value);
	        		}
	        		else{$this->db->or_where('id_menu =', $value);}
	        	}
	        	$query = $this->db->get('Menu_has_cards');

	        	//print($this->db->last_query());
	        	return $query->result_array();
	        }
	        $query = $this->db->get_where('Menu_has_cards', array('id_cards' => $menu));
	        return $query->row_array();
	}
	
	 function get_menu($slug = FALSE, $public = true)
	{		
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('Menu');
	                return $query->result_array();
	        }

	        if (is_array($slug)) {
	        	$query = $this->db->get('Menu_have_position');
	        	$posRes = $query->result_array();
	        	$query = $this->db->order_by('sort','asc');
	        	if($public==true){$query =$this->db->where('public',1);}
	        		else{$query = $this->db->where('public',0);}

	        	//$query =$this->db->join('Menu_have_position', 'Menu_have_position.id_menu = Menu.id_menu ');
	        	$query = $this->db->get('Menu');

	        	$result = $query->result_array();
	        	$queryParent = $this->db->order_by('sort','asc');
	        	if(!empty($slug[0])){foreach ($slug as $key => $value) {
	        		
	        		$queryParent = $this->db->where('id_menu',$value);
	        	}}
	        	if($public==true){$queryParent =$this->db->where('public',1);}
	        		else{$queryParent = $this->db->where('public',0);}
	        	//$queryParent =	$this->db->join('Menu_have_position', 'Menu_have_position.id_menu = Menu.id_menu ');
	        	$queryParent = $this->db->get_where('Menu',array('parent=' => 0));
	        	$arrParent = $queryParent->result_array();
	        	
	        		
		        	foreach ($arrParent as $key => $value) {
		        		foreach ($posRes as $keyPos => $valuePos) {
		        			if( $valuePos['id_menu'] == $value['id_menu']){$arrParent[$key]['position'][]=$valuePos['id_position'];}
			        		foreach ($result as $key2 => $value2) {
			        			
			        			if ($value['id_menu']==$value2['parent']) {
			        				$arrParent[$key]['submenu'][$key2]=$value2;
			        			}
			        			
			        		}
		        		}
				}	
	        	return $arrParent;
	        	
	        }
	        $query = $this->db->order_by('sort  asc');
	        $query = $this->db->get_where('Menu', array('id_menu' => $slug));

	        return $query->row_array();
	}
		public function getFiltersByMenu($menu = FALSE,$inheritance = false)
	{		
	        if ($menu === FALSE)
	        {
	        	return false;
	        }



	        if (is_array($menu)) {
	        	foreach ($menu as $key => $value) {
	        		if ($key == 0) {
	        			$this->db->where('id_menu =', $value);
	        		}
	        		else{$this->db->or_where('id_menu =', $value);}
	        	}
	        	$query = $this->db->get('menu_have_filter_cat');

	        	
	        	return $query->result_array();
	        }
	        if ($inheritance !=false) {
	        	$query = $this->db->get_where('Menu',array('id_menu' => $menu ));
	        	$row = $query->result_array();
	        	$query = $this->db->get_where('Menu',array('parent' => $row[0]['parent'] ));
	        	$row = $query->result_array();
	        	$query = $this->db->where('id_menu',0);
	        	$query = $this->db->or_where('id_menu',$menu);
	        	foreach ($row as $key => $value) {
	        		$query = $this->db->or_where('id_menu',$value['id_menu']);
	        	}
	        }
	        else{$query =$this->db->where('id_menu',$menu); }
	        $query = $this->db->get('menu_have_filter_cat');
	        return $query->result_array();
	}
		public function getFiltersNoMenu($menu = FALSE)
	{		
	        if ($menu === FALSE)
	        {
	        	return false;
	        }

	        if (is_array($menu)) {
	        	foreach ($menu as $key => $value) {
	        		if ($key == 0) {
	        			$this->db->where('id_menu <>', $value);
	        		}
	        		else{$this->db->or_where('id_menu <>', $value);}
	        	}
	        	$query = $this->db->get('menu_have_filter_cat');

	        	//print($this->db->last_query());
	        	return $query->result_array();
	        }
	        
	       	$filterMass = $this->getFiltersByMenu($menu);
	       	$query = $this->db->distinct();
	        $query = $this->db->group_by('id_filter_cat');
	       	foreach ($filterMass as $key => $value) {
	       		 if ($key == 0) {
	        			$this->db->where('id_filter_cat <>', $value['id_filter_cat']);
	        		}
	        		else{$this->db->where('id_filter_cat <>', $value['id_filter_cat']);}
	       	}
	        $query = $this->db->get_where('menu_have_filter_cat', array('menu_have_filter_cat.id_menu <>' => $menu));
	        return $query->result_array();
	}
		public function setFilters($menu = FALSE,$filters = false)
	{		if ($menu === false) {
			return 0;
		}
		foreach ($menu as $key => $value) {
			$query = $this->db->delete('menu_have_filter_cat', array('id_menu' => $value ) );
		}
		if($filters == false){return json_encode(array('type' => 'warning','message'=>'В меню не осталось категорий','icon'=>'fa fa-heart'));}
		foreach ($menu as $key => $value) {
			foreach ($filters as $key2 => $value2) {
			$query = $this->db->insert('menu_have_filter_cat', array('id_menu' => $value,'id_filter_cat'=>$value2) );
		}
		}
		$json = json_encode(array('type' => 'success','message'=>'Категории фильтров присвоены меню','icon'=>'fa fa-heart'));
		return $json;
	}
		public function setCards($menu = FALSE,$cards = FALSE)
	{		
		if ($menu === false) {
			return 0;
		}
		foreach ($cards as $key => $value) {
			$query = $this->db->delete('Menu_has_cards', array('id_cards' => $value ) );
		}
		if($cards === false){return json_encode(array('type' => 'warning','message'=>'В меню не осталось карточек','icon'=>'fa fa-heart'));}
		foreach ($menu as $key => $value) {
			foreach ($cards as $key2 => $value2) {
			if ($this->db->insert('Menu_has_cards', array('id_menu' => $value,'id_cards'=>$value2) )) {
				$json = json_encode(array('type' => 'success','message'=>'Карточки присвоены меню','icon'=>'fa fa-heart'));
			}
			else{$json = json_encode(array('type' => 'warning','message'=>'Карточки не присвоены меню','icon'=>'fa fa-heartbeat'));}
		}
		}
		//$json = json_encode(array('type' => 'success','message'=>'Карточки присвоены меню','icon'=>'fa fa-heart'));
		return $json;
	}
		public function get_position_menu($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	        		$this->db->order_by('position_menu.position  asc');
	                $query = $this->db->get('position_menu');
	                return $query->result_array();
	        }

	        
	        $this->db->select('*');
$this->db->from('Menu_have_position');
$this->db->join('position_menu', 'position_menu.id_position = Menu_have_position.id_position');
$this->db->where('id_menu',$slug);
$query = $this->db->get();

if ($query->result_array()) {
	return $query->result_array();
}
	        return $this->db->last_query();
	}
public function get_filter_cat_Byfilter($id = false,$start=false,$length=false,$h1 = false,$product_created_from = false,$product_created_to = false,$archive = true)
	{
	       	$like = '';
	        $where = '';
	        $columns = [0=>'idfilter_cat',1=>'idfilter_cat',2=>'h1'];
	        $order = (!isset($_REQUEST['order'][0]['column'])) ? $order : $this->db->order_by($columns[$_REQUEST['order'][0]['column']],$_REQUEST['order'][0]['dir']) ;
	        $like = ($id===false) ? $like : $this->db->like('idfilter_cat',$id) ;
	        $like = ($h1===false) ? $like : $this->db->like('h1',$h1) ;
	        $like = ($h1===false) ? $like : $this->db->like('h1',$h1) ;
			
	        // $start= ($start===false) ? $like : $this->db->like('start',$start) ;
	        // $length= ($length===false) ? $like : $this->db->like('length',$length) ;
	        // $product_created_from = ($product_created_from === false) ? false : $product_created_from=$product_created_from.' 00:00:00' ;
	        // $product_created_to = ($product_created_to === false) ? false : $product_created_to=$product_created_to.' 00:00:00' ;

	        // $where = ($product_created_from === false) ? $where : $this->db->where('date_create >',$product_created_from) ;
	        // $where = ($product_created_to === false) ? $where : $this->db->where('date_create <',$product_created_to) ;
	        if ($archive == true) {
	        $query = $this->db->get('filter_cat');
	        } else {
			$query = $this->db->get_where('filter_cat');
		}
	        return $query->result_array();
	}
public function get_filter_Byfilter($id = false,$start=false,$length=false,$h1 = false,$product_created_from = false,$product_created_to = false,$archive = true)
	{		$title = (!empty($_POST['title'])) ? $_POST['title'] : false ;
	       	$like = '';
	        $where = '';
	        $columns = [0=>'id_filter',1=>'id_filter',2=>'h1',3=>'title',4=>'id_cat_filter'];
	        $order = (!isset($_REQUEST['order'][0]['column'])) ? $order : $this->db->order_by($columns[$_REQUEST['order'][0]['column']],$_REQUEST['order'][0]['dir']) ;
	        $like = ($id===false) ? $like : $this->db->like('id_filter',$id) ;
	        $like = ($h1===false) ? $like : $this->db->like('h1',$h1) ;
	        $like = ($title===false) ? $like : $this->db->like('title',$h1) ;
			
	        // $start= ($start===false) ? $like : $this->db->like('start',$start) ;
	        // $length= ($length===false) ? $like : $this->db->like('length',$length) ;
	        // $product_created_from = ($product_created_from === false) ? false : $product_created_from=$product_created_from.' 00:00:00' ;
	        // $product_created_to = ($product_created_to === false) ? false : $product_created_to=$product_created_to.' 00:00:00' ;

	        // $where = ($product_created_from === false) ? $where : $this->db->where('date_create >',$product_created_from) ;
	        // $where = ($product_created_to === false) ? $where : $this->db->where('date_create <',$product_created_to) ;
	        if ($archive == true) {
	        $query = $this->db->get('filter');
	        } else {
			$query = $this->db->get_where('filter');
		}
	        return $query->result_array();
	}

	public function get_menu_all($idCard = false)
	{ $result = [];
	        	if ($idCard == false) {
	                $this->db->select('filter.title as filter,filter_cat.title as cat,id_filter,id_cat_filter');
					$this->db->from('filter, filter_cat');
					$this->db->where('filter.id_cat_filter=filter_cat.idfilter_cat');
					$this->db->order_by('filter_cat.sort  ASC');
					$query1 = $this->db->get();
					foreach ($query1->result_array() as $key => $value) {
						$result[$value['cat']][] = $value;
						}
	                } 
	                else 
	                {
	        		 $this->db->select('filter.h1 as filter,filter_cat.h1 as cat,id_filter,id_cat_filter');
					$this->db->from('filter, filter_cat');
					$this->db->where('filter.id_cat_filter=filter_cat.idfilter_cat');
					$this->db->order_by('filter_cat.sort  ASC');
					$query1 = $this->db->get();
					$id_filters = $this->getFiltersIdByIdCard($idCard); 
					foreach ($query1->result_array() as $key => $value) {
						if ( in_array_r($value['id_filter'], $id_filters,"filter")) {
							$value['value']=1;
						}

						$result[$value['cat']][] = $value;
												}
	        		}

	        		return $result;
	        
	}
	public function get_filter_all_idCard($idCard = false)
	{ $result = [];
	        	if ($idCard == false) {
	                $this->db->select('filter.title as filter,filter_cat.title as cat,id_filter,id_cat_filter');
					$this->db->from('filter, filter_cat');
					$this->db->where('filter.id_cat_filter=filter_cat.idfilter_cat');
					$this->db->order_by('filter_cat.title  ASC');
					$query1 = $this->db->get();
					foreach ($query1->result_array() as $key => $value) {
						$result[$value['cat']][] = $value;
						}
	                } 
	                else 
	                {
	         		 $this->db->select('filter.h1 , filter_cat.h1 as cat,id_filter, id_cat_filter , filter_cat.id_element, card_has_filter.item,card_has_filter.filter');
					 $this->db->from('filter');
					 $this->db->join('card_has_filter','filter.id_filter=card_has_filter.filter','left');
					 $this->db->join('filter_cat','filter.id_cat_filter=filter_cat.idfilter_cat','left');
					 $this->db->where('card_has_filter.item ='.$idCard);
					 //$this->db->order_by('filter_cat.h1  ASC');
					$query1 = $this->db->get();
					foreach ($query1->result_array() as $key => $value) {
						$result[$value['cat']][] = $value;
												}
	        		}

	        		return $result;
	        
	}
public function get_cats_header()
	{ $result = [];
	        		
	                $this->db->select('filter_cat.h1 as cat,idfilter_cat as id,alias,sort,id_element, preview_text, meta_keywords');
	                $this->db->order_by('filter_cat.sort  asc');
	                $query1 = $this->db->get_where('filter_cat',array('home' => 1));
					$query1_res = $query1->result_array();
					foreach ($query1_res as $key => $value) {
						$result[$value['id']] = $value;
						}
	                $this->db->select('filter.h1 as filter,id_cat_filter as id_cat,alias,sort,id_element, preview_text, meta_keywords,logo,description');
	                $this->db->order_by('filter.sort  asc');
					$this->db->from('filter');
					$query2 = $this->db->get();
					$query2_res = $query2->result_array();
					foreach ($query2_res as $key => $value) {
						if(!empty($result[$value['id_cat']])){
						$result[$value['id_cat']]['filters'][] = $value;}
						}

	        		return $result;
	        
	}

public function getFilterOnPage()
	{ $result = [];
	        		
	                $this->db->select('filter_cat.h1 as cat,idfilter_cat as id,alias,sort,id_element, preview_text, meta_keywords,type');
	                $this->db->order_by('filter_cat.sort  asc');
	                $query1 = $this->db->get('filter_cat');
					$query1_res = $query1->result_array();
					foreach ($query1_res as $key => $value) {
						$result[$value['id']] = $value;
						}
	                $this->db->select('filter.h1 as filter,id_cat_filter as id_cat,alias,sort,id_element, preview_text, meta_keywords,logo,description');
	                $this->db->order_by('filter.sort  asc');
					$this->db->from('filter');
					$query2 = $this->db->get();
					$query2_res = $query2->result_array();
					foreach ($query2_res as $key => $value) {
						if(!empty($result[$value['id_cat']])){
						$result[$value['id_cat']]['filters'][] = $value;}
						}

	        		return $result;
	        
	}



		function getFiltersIdByIdCard($idCard){
			$this->db->select('filter');
			$query = $this->db->get_where('card_has_filter', array('item' => $idCard));
	        $return = $query->result_array();
	        return $return;
		}

		public function set_menu($dat=false)
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
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'value' => $this->input->post('value'),
                'parent' => $this->input->post('parent'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'body' => $this->input->post('body'),
                'alias' => $this->input->post('alias'),
                'sort'=>$this->input->post('sort'),
                'public'=>$this->input->post('public'),
                'logo'=>$this->input->post('logo'),
                	    );
	    if (!$this->aliasCheck($data['alias'])) {
	    	return json_encode(array('type' => 'warning','message'=>'Такой URL уже существует','icon'=>'warning'));
	    }
	    $positionPost = $this->input->post('position');
	    $idElem = $this->setUrl($data['alias']);
	    $data['id_element'] = $idElem;
	    if($this->db->insert('Menu', $data))
	    	{	$this->setPositionMenu($this->db->insert_id(),$positionPost);

	    		$json = json_encode(array('type' => 'success','message'=>'Пункт меню создан!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));}
	}
	else{
		
		
			$query = $this->db->select('alias,id_element');
			$query = $this->db->get_where('Menu', array('id_menu' => $dat['id_menu']));
			$row = $query->row();
			$oldUrl=$row->alias;
			$idELEMENT=$row->id_element;
			$this->db->where('id_menu', $dat['id_menu']);
		    if($this->db->update('Menu', $dat))
	    	{
	    		if ($oldUrl!=$dat['alias']) {
				$this->setUrl($dat['alias'],true, $idELEMENT);
	    		}
	    		$json = json_encode(array('type' => 'success','message'=>'Пункт меню обновлен!'.$idELEMENT.'','icon'=>'success'));
	}else{
	    		$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));
	    		}
	}
	    return $json;
	}
	

		public function set_position_menu($dat=false)
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
	        		'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'meta_keywords' => $this->input->post('meta_keywords'),
                    'h1' => $this->input->post('h1'),
                    'body' => $this->input->post('body'),
                    'preview_text' => $this->input->post('preview_text'),
                    'alias' => $this->input->post('alias'),
                    'home' => $this->input->post('home'),
                    'type'=>$this->input->post('type')
	    );
	    $idElem = $this->setUrl($data['alias']);
	    $data['id_element'] = $idElem;
	    if($this->db->insert('filter_cat', $data))
	    	{$json = json_encode(array('type' => 'success','message'=>'Категория фильтра добавлена!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>'Видимо такая карточка уже существует','icon'=>'warning'));}
	}
	else{
		$this->db->where('idfilter_cat', $dat['idfilter_cat']);
		    if($this->db->update('filter_cat', $dat))
	    	{$json = json_encode(array('type' => 'success','message'=>'Категория фильтра обновлен!','icon'=>'success'));
	}else{
	    		$json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не по плану','icon'=>'warning'));
	    		}
	}
	    return $json;
	}
	public function find_filters($request = FALSE)
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

			
			//$request = mb_convert_encoding($request, "UTF-8");
			//echo "$request";

			$this->db->select('h1');
			$this->db->from('filter');
			$this->db->like('h1', $request);
			
			if ($query = $this->db->get())
			{
				$ar = [];
				foreach ($query->result() as $row)
				{
					$retVal = ($row->h1!='') ? $row->h1 : $row->title ;
					$ar[] = array('value' => $retVal);
				}
				$json = json_encode($ar);

			}else{
				$fail = array('value' => 'неудача' );
				$json = json_encode($fail);
			}

			return $json;
		}
		function isParent($alias=false,$parent=false){
			// функция проверяет меню по признаку соответствия URL и parent 
			// Нужна для определения коренного меню
			$this->db->select('*');
			$this->db->where('alias', $alias);
			if($query = $this->db->get_where('Menu',array('parent'=>$parent)))
			{
				foreach ($query->result() as $row)
					{
					        return $row->id_menu;
					}
			}
				else{
				return false;
			}
			
			
		}
		function getMenuByAlias($alias=false){
			// функция проверяет меню по признаку соответствия URL и parent 
			// Нужна для определения коренного меню
			$this->db->select('*');
			$this->db->where('alias', $alias);
			if($query = $this->db->get('Menu'))
			{
				$result = $query->result_array();
					if(!empty($result[0])){
					        return $result[0];}
					        else{return false;}
					
			}
				else{
				return false;
			}
			
			
		}
}
