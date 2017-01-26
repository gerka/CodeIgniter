<?php
class Filter_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }

        function deleteElementFilter($id_filter=false,$filter_cat=false){
    	if ($id_filter == false) {
    		return false;
    	}
    	if ($filter_cat!=false) {
    		$query=$this->db->get_where('filter_cat',array('idfilter_cat'=>$id_filter));
    	}
    	else{$query=$this->db->get_where('filter',array('id_filter'=>$id_filter));}
    	
    	$row = $query->row();

		if (isset($row))
		{
		        $id_element = $row->id_element;
		        $query=$this->db->get_where('Elements',array('id_element'=>$id_element));
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

public function isFilter($URL = false)
{
	if ($URL === false) {
		return false;
	}
	else{
		if (is_array($URL)) {
			foreach ($URL as $key => $value) {
				if ($this->db->get_where('filter',array('alias'=>$value))->num_rows()==0) {
		return false;
			}

	}
		}
		else{

			$query = $this->db->get_where('filter',array('alias'=>$URL));
				$row = $query->result_array();
				if(isset($row[0]['id_filter'])){
			return $row[0]['id_filter'];}
			else {return false;}
		}
	return true;}
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

	public function import_filter($dat = FALSE)
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
			$slug = url_title($this->input->post('title'), 'dash', TRUE);

			    $data['filterInsert'] = array(
		                'title' => $this->input->post('title'),
		                'description' => $this->input->post('description'),
		                'value' => $this->input->post('value'),
		                'id_cat_filter' => $this->input->post('id_cat'),
		                'meta_keywords' => $this->input->post('meta_keywords'),
		                'h1' => $this->input->post('h1'),
		                //'body' => $this->input->post('body'),
		                'preview_text' => $this->input->post('preview_text'),
		                'alias' => $this->input->post('alias'),
		                //'sort'=>$this->input->post('sort'),
		                //'logo'=>$this->input->post('logo'),
		                //'icon'=>$this->input->post('icon')
			    );
			//проверка не обновляем ли мы карточку
				$query = $this->db->select('id_element,id_filter');
				$query = $this->db->get_where('filter', array('h1' => $data['filterInsert']['h1']));
				if($row = $query->row()){
				$IDELEMENT=$row->id_element;
				
				$this->db->where('h1', $data['filterInsert']['h1']);
				if($this->db->update('filter', $data['filterInsert']))
					{
			    		$this->setUrl($data['filterInsert']['alias'],true, $IDELEMENT);
						$json = json_encode(array('type' => 'success','message'=>'Карточка Обновлена!','icon'=>'success'));
				
				}else{
					$json = json_encode(array('type' => 'warning','message'=>'Видимо такая карточка уже существует 1 ','icon'=>'warning'));
				}
				die($json);}

				else{
			
			$idElement = $this->setUrl($data['filterInsert']['alias']);
			if ($idElement) {
				$data['filterInsert']['id_element'] = $idElement;
			}
			else  { die(json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует 2','icon'=>'warning')));}
			
			if($this->db->insert('filter', $data['filterInsert']))
			{
				$id_last=$this->db->insert_id();
				$json = json_encode(array('type' => 'success','message'=>'Карточка Добавлена!','icon'=>'success','id_element'=>$idElement,'id_card'=>$id_last));
				//$filterArr = $this->validFilterArr($this->input->post('filters'));
				if (!empty($this->input->post('menu'))) {
					$MenuInsert = ['id_cards'=>$id_last,'id_menu'=>$this->input->post('menu')];
					$query=$this->db->delete('Menu_has_cards',['id_cards'=>$id_last]);
					$query=$this->db->insert('Menu_has_cards',$MenuInsert);
				}
				//$Menu = $this->input->post('menu');
				// if ($this->set_card_has_filter($data['filterInsert']['title'],$filterArr,'title')) {

				// 	$json = json_encode(array('type' => 'success','message'=>'Карточка Добавлена!','id_element'=>$idElement,'icon'=>'success','id_card'=>$id_last));  	}

				// 	else{
				// 		$json = json_encode(array('type' => 'warning','message'=>'Карточка Обновлена а категории нет! '.$this->input->post('filters'),'icon'=>'success','id_element'=>$idElement,'id_card'=>$id_last));
				// 	}
				}else{
					$id_last=$this->db->insert_id();
					$json = json_encode(array('type' => 'warning','message'=>'В карточке присутствуют недопустимые поля','icon'=>'warning','id_element'=>$idElement,'id_card'=>$id_last,'last'=>$this->db->last_query()));
				}
				return $json;
			}
			}

	    

		}
        public function delete_filter($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	                
	                return 'фильтр не выбран';
	        }
	        if ($query = $this->db->delete('filter', array('id_filter' => $slug ) ) )
	    	{	$this->deleteElementFilter($slug);
	    		$json = json_encode(array('type' => 'success','message'=>'Фильтр удален!','icon'=>'success','status'=>'OK'));}
	    else{	
	    	$query = $this->db->get_where('card_has_filter', array('filter' => $slug ));	
	    	$count_cards = $query->num_rows();
	    	$query = $this->db->get_where('staff_has_filters', array('filter_staff' => $slug ));
	    	$count_staff = $query->num_rows();
	    	$message = ($count_staff) ? 'А также удалит '.$count_staff.' в карточках преподователей' : '' ;
	    	$json = json_encode(array('type' => 'warning','message'=>'Данный фильтр используется в карточках товара. Удаление фильтра приведёт к удалению его значений во всех '.$count_cards.' «карточках товаров»
	    		'.$message.'. Вы уверены, что хотите удалить? <a href="javascript:;" data-del-item="'.$slug.'" onclick="initArchiveButton2()" class="btn btn-sm btn-default btn-circle btn-editable"><i class="fa fa-pencil"></i> Delete</a>','icon'=>'warning','status'=>'error_message'));}
	    return $json;
	}
        public function delete_filter2($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
                return 'фильтр не выбран';
	        }
	        if ($this->db->delete('card_has_filter', array('filter' => $slug )) && $this->db->delete('staff_has_filters', array('filter_staff' => $slug )))
	    	{
	    		 if ($query = $this->db->delete('filter', array('id_filter' => $slug ) ) ){

	    		 	$this->deleteElementFilter($slug);
	    		$json = json_encode(array('type' => 'success','message'=>'Фильтр удален!','icon'=>'success','status'=>'OK'));}
	    else{$json = json_encode(array('type' => 'warning','message'=>'Фильтр не удален скорее всего он используется в карточке:( ','icon'=>'warning','status'=>'error_message'));}
	    return $json;
	}
}

	
        public function delete_filter_cat($slug = FALSE)
	
	{
	        if ($slug === FALSE)
	        {
	                
	                return 'фильтр не выбран';
	        }
	        if ($query = $this->db->delete('filter_cat', array('idfilter_cat' => $slug ) ) )
	    	{
	    		$this->deleteElementFilter($slug,'filter_cat');
	    		$json = json_encode(array('type' => 'success','message'=>'Категория фильтра удалена!','icon'=>'success'));}
	    else{$json = json_encode(array('type' => 'warning','message'=>'Категория не удалена, скорее всего она используется в других фильтрах :(','icon'=>'warning','status'=>'error_message'));}
	    return $json;
	}

		public function get_filters($slug = FALSE)
	{		
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('filter');
	                return $query->result_array();
	        }

	        if (is_array($slug) ) {
	        	if(empty($slug)){return;}
	        	foreach ($slug as $key => $value) {
	        		if ($key == 0) {
	        			$this->db->where('id_filter =', $value['filter']);
	        		}
	        		else{$this->db->or_where('id_filter =', $value['filter']);}
	        	}
	        	$query = $this->db->get('filter');
	        	//print($this->db->last_query());
	        	return $query->result_array();
	        }
	        $query = $this->db->get_where('filter', array('id_filter' => $slug));
	        return $query->row_array();
	}
		public function get_filter_cat($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	        		$this->db->order_by('filter_cat.sort  asc');
	                $query = $this->db->get('filter_cat');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('filter_cat', array('idfilter_cat' => $slug));
	        return $query->row_array();
	}
		public function get_filters_by_parent($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	        		$this->db->where('filter_cat.sort  asc');
	                $query = $this->db->get('filter');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('filter', array('parent' => $slug[0]));
	        return $query->result_array();
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

	public function get_filter_all($idCard = false,$slug = false)
	{ $result = [];
	        	if ($idCard == false) {
	                $this->db->select('filter.title as filter,filter_cat.title as cat,id_filter,id_cat_filter');
					$this->db->from('filter, filter_cat');
					$this->db->where('filter.id_cat_filter=filter_cat.idfilter_cat');
					$this->db->order_by('filter_cat.title  ASC');
					$query1 = $this->db->get();
					foreach ($query1->result_array() as $key => $value) {
						if ($slug!=false) {
							$result[] = $value;
						}
						else{$result[$value['cat']][] = $value;}
						
						}
	                } 
	                else 
	                {
	        		 $this->db->select('filter.h1 as filter,filter_cat.h1 as cat,id_filter,id_cat_filter');
					$this->db->from('filter, filter_cat');
					$this->db->where('filter.id_cat_filter=filter_cat.idfilter_cat');
					$this->db->order_by('filter_cat.h1  ASC');
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
	                $this->db->select('filter.title as filter,filter_cat.title as cat,id_filter,id_cat_filter,filter.icon as icon,filter.alias as alias');
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
	         		 $this->db->select('filter.h1 , filter_cat.h1 as cat,id_filter, id_cat_filter , filter_cat.id_element, card_has_filter.item,card_has_filter.filter,filter.icon as icon,filter.alias as alias');
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

public function getFilterOnPage($onMenu=false)
	{ 				
					$result = [];
	        		
	                $this->db->select('filter_cat.h1 as cat,idfilter_cat as id,alias,sort,id_element, preview_text, meta_keywords,type');
	                $this->db->order_by('filter_cat.sort  asc');
	                if ($onMenu==true) {
	                	$this->db->where('home',1);
	                }
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
public function getFilterOnPageByMenuRecursive($id_menu=false)
	{ 				

					$queryMenu = $this->db->select('id_menu,parent');
					$queryMenu = $this->db->get_where('Menu',array('id_menu' => $id_menu));
					$resultMenu = $queryMenu->result_array();
					if($resultMenu[0]['parent']!=0){
					$result = [];
	        		$queryListFilter = $this->db->select('id_filter_cat');
	        		$queryListFilter = $this->db->get_where('menu_have_filter_cat',array('id_menu'=>$id_menu));
	        		$resultListFilter = $queryListFilter->result_array();}
	        		else{
	        		$queryMenu = $this->db->select('id_menu');
					$queryMenu = $this->db->get_where('Menu',array('parent' => $id_menu));
					$resultMenu = $queryMenu->result_array();
					$queryListFilter = $this->db->select('id_filter_cat');
					foreach ($resultMenu as $key => $value) {
						$queryListFilter = $this->db->or_where('id_menu',$value['id_menu']);
					}
					$queryListFilter = $this->db->get('menu_have_filter_cat');
					$resultListFilter = $queryListFilter->result_array();
	        		}
	        		//$resultFilter = [];
	        		
	                $query1 = $this->db->select('filter_cat.h1 as cat,idfilter_cat as id,alias,sort,id_element, preview_text, meta_keywords,type');
	          //       foreach ($resultListFilter as $key => $value) {
	        		// 	$this->db->where('filter_cat.idfilter_cat',$value['id_filter_cat']); 
	        		// }
	                $query1 = $this->db->order_by('filter_cat.sort  asc');
	                foreach ($resultListFilter as $key => $value) {
	                	
	        			$query1 = $this->db->or_where('filter_cat.idfilter_cat',$value['id_filter_cat']); 
	        		}
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

public function getFilterOnPageByMenu($id_menu=false)
	{ 				

					
					$result = [];
	        		$queryListFilter = $this->db->select('id_filter_cat');
	        		$queryListFilter = $this->db->get_where('menu_have_filter_cat',array('id_menu'=>$id_menu));
	        		$resultListFilter = $queryListFilter->result_array();
	        		if(empty($resultListFilter)){return false;}
	                $query1 = $this->db->select('filter_cat.h1 as cat,idfilter_cat as id,alias,sort,id_element, preview_text, meta_keywords,type');
	          
	                $query1 = $this->db->order_by('filter_cat.sort  asc');
	                foreach ($resultListFilter as $key => $value) {
	                	
	        			$query1 = $this->db->or_where('filter_cat.idfilter_cat',$value['id_filter_cat']); 
	        		}
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

		function addFilterToCard($arrayCard = false,$arrFiltersCat = false){
			$newArr = [];
			if(!empty($arrFiltersCat) and $arrFiltersCat!=false){
			$filtersCat = $this->getFiltersByIdCat($arrFiltersCat);
			}
			if(count($arrayCard)>1){
				foreach ($arrayCard as $key => $value) {
					$newArr[$key] = $value;
					if(!empty($value['id_post'])){
						$filters = $this->getFiltersIdByIdCard($value['id_post']);
						//print_r()
						if(!empty($filtersCat) and $arrFiltersCat!=false){
							
							$filtersNew = [];
							// $temp = [];
							// foreach ($filters as $key => $value) {
							// 	$temp[]['filter'] =$value['filter']; 
							// }
							 //print_r($filtersCat);
							foreach ($filtersCat as $key2 => $value2) {
								if(in_array_r($value2['id_filter'],$filters,'filter'))
								{$filtersNew[]['filter'] = $value2['id_filter'];}
							}
							//print_r($filtersNew);
							$filters = $filtersNew;

						}
						
						$filtersNew=$this->get_filters($filters);
						// print_r($filtersNew);
						// return;
						//print_r($filters);
						$newArr[$key]['filters'] = $filtersNew;
					}

				}
				//print_r($filters);
				return $newArr;
			}
			return $newArr;
		}

		function getFiltersIdByIdCard($idCard){
			$this->db->select('filter');
			$query = $this->db->get_where('card_has_filter', array('item' => $idCard));
	        $return = $query->result_array();
	        return $return;
		}
		function getFiltersByIdCat($idCat){
			$query = $this->db->order_by('h1', 'asc');
			$query = $this->db->get_where('filter', array('id_cat_filter' => $idCat));
			

	        $return = $query->result_array();
	        return $return;
		}

		public function set_filter($dat=false)
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
                'id_cat_filter' => $this->input->post('id_cat'),
                'meta_keywords' => $this->input->post('meta_keywords'),
                'h1' => $this->input->post('h1'),
                'body' => $this->input->post('body'),
                'preview_text' => $this->input->post('preview_text'),
                'alias' => $this->input->post('alias'),
                'sort'=>$this->input->post('sort'),
                'logo'=>$this->input->post('logo'),
                'icon'=>$this->input->post('icon')
	    );
	    $idElem = $this->setUrl($data['alias']);
			if ($idElem) {
				$data['id_element'] = $idElem;
			}
			else  {return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));}

	    
	    if($this->db->insert('filter', $data))
	    	{
	    		$id_last=$this->db->insert_id();
	    		$json = json_encode(array('type' => 'success','message'=>'фильтр добавлен!','icon'=>'success'));}
	    		else{$json = json_encode(array('type' => 'warning','message'=>$this->db->last_query(),'icon'=>'warning'));}
	}
	else{
				$id_last=$this->db->insert_id();
		
				$query = $this->db->select('id_element');
				$query = $this->db->get_where('filter', array('id_filter' => $dat['id_filter']));
				$row = $query->row();
				$IDELEMENT=$row->id_element;
				if ($IDELEMENT == 0) {
					$dat['id_element']=$this->setUrl($dat['alias'],true, $IDELEMENT);
					if ($dat['id_element']) {
						return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));
					}
					$IDELEMENT=$dat['id_element'];
				}
				
		$this->db->where('id_filter', $dat['id_filter']);

		    if($this->db->update('filter', $dat))
	    	{
	    		$this->setUrl($dat['alias'],true, $IDELEMENT);
	    		
	    		
	    		$json = json_encode(array('type' => 'success','message'=>'фильтр обновлен!','icon'=>'success'));
	}else{
	    		$json = json_encode(array('type' => 'warning','message'=>'Видимо что-то пошло не по плану','icon'=>'warning'));
	    		}
	}
	    return $json;
	}

	public function import_filter_relations($data=false)
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}
		$json = json_encode(array('type' => 'warning','message'=>'Входные параметры нарушены','icon'=>'warning'));
		if (is_array($data)){
			$queryParent = $this->db->select('id_filter, '.$data['compareField']);
			$queryParent = $this->db->where('value',$data['parentCat']);
			$queryParent = $this->db->get('filter');
			$returnParent = $queryParent->row_array();
			$queryChild = $this->db->select('id_filter,'.$data['compareField']);
			$queryChild = $this->db->where('value',$data['childCat']);
			$queryChild = $this->db->get('filter');
			$returnChild = $queryChild->row_array();

				$this->db->set('parent', $returnParent['id_filter']);
				$this->db->where('id_filter', $returnChild['id_filter']);
				if($this->db->update('filter')){
					$json = json_encode(array('type' => 'success','message'=>'Связь Добавлена!','icon'=>'success'));
				}
				else{
				$json = json_encode(array('type' => 'warning','message'=>'Связь не добавлена','icon'=>'warning','query'=>$this->db->last_query()));
				}
			
		}

		return $json;
	}
	public function getRelationFilter($idParentFilter){
			$query = $this->db->get_where('filter', array('parent' => $idParentFilter));
	        $return = $query->result_array();
	        return $return;
	}

	public function setParentFilters($parent=false,$filters=false)
	{
		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}
		if (is_array($filters)){
			foreach ($filters as $key => $value) {
				$this->db->set('parent', $parent[0]);
				$this->db->where('id_filter', $value);
				$this->db->update('filter');
			}
			return $this->db->last_query();
		}
		
	}

		public function set_cat_filter($dat=false)
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
}
