<?php
class Element_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
public function valid($field = false,$data = false,$otvet = array('state' => 'false'))
{
	if ($field === false or $data === false) {
		$otvet = array('state' => 'true');
		return $otvet;
	}
	else{

	// $this->db->get_where('URL_table',$data[0]);

	if ($this->db->get_where('URL_table',$data[0])->num_rows()!=0) {
		$otvet = array('state' => 'true');
		return $otvet;
	}

	return $otvet;}
}
function getItemsByElement($what = false, $elementId = false , $sort = false, $distinct = false,$archive=false,$primeFilter = false, $notIncl = false,$lim = false,$maxRecords=8,$numPage=0)
{


	

	if ($distinct !=false) {
		$this->db->distinct('item_card.id_post');
	}
		if ($what!=false and is_array($what)) {
			foreach ($what as $value) {
				$this->db->select($value);
			}
		}
		
		$this->db->from('item_card');
		$this->db->join('card_has_filter','card_has_filter.item=item_card.id_post','left');
		$this->db->join('Menu_has_cards','Menu_has_cards.id_cards=item_card.id_post','left');
		$this->db->join('Menu','Menu_has_cards.id_menu=Menu.id_menu','left');
		$this->db->join('filter',' card_has_filter.filter=filter.id_filter','left');
		$this->db->join('filter_cat',' filter_cat.idfilter_cat = filter.id_cat_filter','left');
		
		if($archive==false){
			$this->db->where('item_card.archive =0');
			$this->db->where('item_card.public =1');
		}
		if($notIncl!=false and is_array($notIncl)){
			foreach ($notIncl as $key => $value) {
				$this->db->where('item_card.id_element <>'.$value);
			}
			
		}
		
		if ($elementId!=false) {
			$this->db->join('Elements','Elements.id_element = filter.id_element or Elements.id_element = filter_cat.id_element or Elements.id_element = Menu.id_element or Elements.id_element = item_card.id_element','left');
			
			if(!is_array($elementId)){
				$this->db->where('Elements.id_element ='.$elementId);

			}
			
			else{
				foreach ($elementId as $key => $value) {	
					$this->db->or_where('Elements.id_element',$value);
				}
			}
		}
		if ($primeFilter!=false and is_array($primeFilter)) {
			$cardsId = $this->getCardsByIdFilter($primeFilter);
				foreach ($primeFilter as $key => $value) {



					if (!empty($value) and is_numeric($value)) {

						

						$this->db->where('card_has_filter.filter',$value);
					}
					
				}
			}

			
		if ($lim !=false) {
			$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
			$this->db->limit($maxRecords,$lim);
			//print('HEY');
			//$this->db->order_by($sort);
					}
		if ($sort !=false) {
			$this->db->order_by($sort);
					}
		if ($distinct !=false) {
			$this->db->group_by('item_card.id_post');
		}
		if ($query1 = $this->db->get()) {
			$result = $query1->result_array();
			//$result = $this->db->last_query();
			return $result;
					}
					else{return $this->db->last_query();}
}
function getCategoryByIdCat($idCat = false){
$result = [];
	        		
	                $this->db->select('filter_cat.h1 as cat,idfilter_cat as id,alias,sort,id_element, preview_text, meta_keywords,type');
	                $this->db->order_by('filter_cat.sort  asc');
	                if ($idCat==true) {
	                	$this->db->where('idfilter_cat',$idCat);
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
	function getCategoryNewsByIdCat($idCat = false){
$result = [];
	        		
	                $this->db->select('news_cat.h1 as cat,id_cat as id,alias,id_element, preview_text, meta_keywords');
	                //$this->db->order_by('news_cat.sort  asc');
	                if ($idCat==true) {
	                	$this->db->where('id_cat',$idCat);
	                }
	                $query1 = $this->db->get('news_cat');
					$query1_res = $query1->result_array();
					foreach ($query1_res as $key => $value) {
						$result[$value['id']] = $value;
						}
	                $this->db->select('news.h1 as news,id_cat as id_cat_news,alias,id_element, preview_text, meta_keywords,logo,description,date_create,title');
	                $this->db->order_by('news.date_create asc');
					$this->db->from('news');
					$query2 = $this->db->get();
					$query2_res = $query2->result_array();
					foreach ($query2_res as $key => $value) {
						if(!empty($result[$value['id_cat_news']])){
						$result[$value['id_cat_news']]['news'][] = $value;}
						}

	        		return $result;
	}
	function getElement($idElement = false){

		
		$tables = [
		'filter f'=>'f.id_element = e.id_element',
		'Page p'=>'p.id_element = e.id_element',
		'item_card i'=>'i.id_element = e.id_element',
		'news n'=>'n.id_element = e.id_element',
		'news_cat nc'=>'nc.id_element = e.id_element',
		'filter_cat fc'=>'fc.id_element = e.id_element',
		'Menu m'=>'m.id_element = e.id_element',
		'tags t'=>'t.element = e.id_element',
		'Staff s'=>'s.id_element = e.id_element',
		];
		$this->db->select('*');
		$result =[];
		foreach ($tables as $table=>$onCondition) {
			$this->db->join($table, $onCondition ,'left');
			$this->db->from('Elements e');
			$this->db->where('e.id_element', $idElement);
			$query = $this->db->get();
			$res=$query->row_array();
			if (isset($res['h1'])) {
				if ($res['h1']!=null) {
				$result=$res;
			}
		}
			if (isset($res['value'])) {
				if ($res['value']!=null) {
				$result=$res;
			}
			}
			if (isset($res['value'])) {
				if ($res['value']!=null) {
				$result=$res;
			}
			}
			
		}
		if(empty($result)){$result = $this->db->last_query();}
		return $result;



	}
	function getElementUrl($url){
		
		$query = $this->db->select('id_element');
		if ($url == 'all') {
			$result['id_filter'] = 'all';
			return $result;
		}else{
		$query = $this->db->get_where('Elements, URL_table', 'URL_table.URL = "'.$url.'" and Elements.id_url = URL_table.idURL_table');
	}
		$elementId = $query->row_array();
		$elementId = $elementId['id_element'];
		$tables = [
		'filter f'=>'f.id_element = e.id_element',
		'Page p'=>'p.id_element = e.id_element',
		'item_card i'=>'i.id_element = e.id_element',
		'news n'=>'n.id_element = e.id_element',
		'news_cat nc'=>'nc.id_element = e.id_element',
		'filter_cat fc'=>'fc.id_element = e.id_element',
		'Menu m'=>'m.id_element = e.id_element',
		'tags t'=>'t.element = e.id_element',
		'Staff s'=>'s.id_element = e.id_element',
		];

		$query = $this->db->select('*');
		$result =[];
		// print($url);
		// print('<br>');
		// print($elementId);
		// print('<br>');
		// print(gettype($elementId));
		// print('<br>');
		foreach ($tables as $table=>$onCondition) {
			
			$query = $this->db->join($table, $onCondition ,'left');
			$query = $this->db->from('Elements e');
			$query = $this->db->where('e.id_element', $elementId);
			$query = $this->db->get();
			$res=$query->row_array();
			if (isset($res['h1'])) {
				if ($res['h1']!=null) {
				$result=$res;
			}
		}
			if (isset($res['value'])) {
				if ($res['value']!=null) {
				$result=$res;
			}
			}
			if (isset($res['name'])) {
				if ($res['name']!=null) {
				$result=$res;
			}
			}
			
		}
		if(empty($result)){$result = $this->db->last_query();}
		//print($this->db->last_query());
		return $result;
	}
	function countAllCards($menu = false){
		if ($menu == false) {
			return false;
		}
		 $this->db->select('*');
		 $this->db->from('item_card');
		 $this->db->join('Menu_has_cards','item_card.id_post=Menu_has_cards.id_cards','left');
		 $this->db->where('Menu_has_cards.id_menu ='.$menu);
		 return $this->db->count_all_results();
	}
	public function getCardsByMenu($menu=false,$numPage=0,$maxRecords=12)
	{
		$country = $_SESSION['PrimeFilter']['country'];
		$region = $_SESSION['PrimeFilter']['region'];
		$city = $_SESSION['PrimeFilter']['city'];

		if ($menu === FALSE)

		{
			
			return 'Ничего не найдено';
		}
		$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
		 

					$queryMenu = $this->db->select('id_menu,parent');
					$queryMenu = $this->db->get_where('Menu',array('id_menu' => $menu));
					$resultMenu = $queryMenu->result_array();
					if($resultMenu[0]['parent']!=0){
					$result = [];
					$query =$this->db->select('*');
		 			// $query =$this->db->from('item_card');
		 			$query =$this->db->join('Menu_has_cards','item_card.id_post=Menu_has_cards.id_cards and item_card.archive=0 and item_card.public=1','left');
	        		$query =$this->db->where('Menu_has_cards.id_menu',$menu);
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
													}
	        	}
	        		else{
	        		$queryMenu = $this->db->select('id_menu');
					$queryMenu = $this->db->get_where('Menu',array('parent' => $menu));
					$resultMenu = $queryMenu->result_array();
					$query =$this->db->select('*');
		 			
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
						
					}

		 			$query =$this->db->join('Menu_has_cards','item_card.id_post=Menu_has_cards.id_cards and item_card.archive=0 and item_card.public=1','left');
		 			$query =$this->db->where('Menu_has_cards.id_menu',$menu);

					foreach ($resultMenu as $key => $value) {
						 $query =$this->db->or_where('Menu_has_cards.id_menu',$value['id_menu']);
					}
					
	        		}
		 

		 // $query = $this->db->where('public',1);
		 // $query = $this->db->where('archive',0);

		
		 $query = $this->db->limit($maxRecords,$lim);
		 //$this->db->order_by('sort  ASC');
		$query = $this->db->get('item_card');
		$res=[];
		
		$res = ($query->result_array()) ? $query->result_array() : ''; 
		//$res['query'] = $this->db->last_query();
		
		$countRecords = $this->countAllCards($menu);

		$res['countRecords']=$countRecords;

		return $res;
	}
	function getCardsByIdFilter($filters = FALSE)
	{
		if ($filters === FALSE and !is_array($filters))
		{
			
			return 'Ничего не найдено';
		}
		foreach ($filters as $key => $value) {
			if ($key == 0 and ($value == 'all' or $value=='All' or $value=='ALL')) {
				$this->db->select('id_post');
		$this->db->from('item_card');
		$this->db->where('archive',0);
		$this->db->where('public',1);
		$query = $this->db->get();
				if (empty($query))
				{return false;}
		$return = $query->result_array();
		$result = [];
		foreach ($return as $key => $value) {
			foreach ($value as $key2 => $item) {
				$result[] = $item;
			}
		}
		
		return $result;
			}
		}
		
		$from = '(SELECT item ';
		$where ='';
		// $idFilters = $this->getFiltersIdByAlias($filters);

		foreach ($filters as $key => $idfilter) {
			if(!empty($idfilter['id_filter'])){
			$from = $from.", SUM(CASE filter WHEN ".$idfilter['id_filter']." THEN 1 ELSE 0 END) as '".$idfilter['id_filter']."' ";

			if ($key == 0) {
				$where = $where." svod.`".$idfilter['id_filter']."` = 1";
			} else {
				$where = $where." and svod.`".$idfilter['id_filter']."` = 1";
			}
			}
			
		}
		$from = $from.'FROM card_has_filter 
		GROUP BY item) AS svod';
		$this->db->select('svod.item');
		$this->db->where($where);
		$query = $this->db->get($from);
		
		
		//$query->row();
				if (empty($query))
				{return false;}
		$return = $query->result_array();
		$result = [];
		foreach ($return as $key => $value) {
			foreach ($value as $key2 => $item) {
				$result[] = $item;
			}
		}
		
		return $result;
	}
	function getCardsByFilter($filters = FALSE)
	{
		if ($filters === FALSE)
		{
			
			return 'Ничего не найдено';
		}
		foreach ($filters as $key => $value) {
			if ($key == 0 and ($value == 'all' or $value=='All' or $value=='ALL')) {
				$this->db->select('id_post');
		$this->db->from('item_card');
		$this->db->where('archive',0);
		$this->db->where('public',1);
		$query = $this->db->get();
				if (empty($query))
				{return false;}
		$return = $query->result_array();
		$result = [];
		foreach ($return as $key => $value) {
			foreach ($value as $key2 => $item) {
				$result[] = $item;
			}
		}
		
		return $result;
			}
		}
		
		$from = '(SELECT item ';
		$where ='';
		$idFilters = $this->getFiltersIdByAlias($filters);

		foreach ($idFilters as $key => $idfilter) {
			
			$from = $from.", SUM(CASE filter WHEN ".$idfilter['id_filter']." THEN 1 ELSE 0 END) as '".$idfilter['id_filter']."' ";
			if ($key == 0) {
				$where = $where." svod.`".$idfilter['id_filter']."` = 1";
			} else {
				$where = $where." and svod.`".$idfilter['id_filter']."` = 1";
			}
			
			
		}
		$from = $from.'FROM card_has_filter GROUP BY item) AS svod';
		$this->db->select('svod.item');
		$this->db->where($where);
		$this->db->join('item_card','item_card.id_post=svod.item','left');
		$query = $this->db->get($from);
		
		
		//$query->row();
				if (empty($query))
				{return false;}
		$return = $query->result_array();
		$result = [];
		foreach ($return as $key => $value) {
			foreach ($value as $key2 => $item) {
				$result[] = $item;
			}
		}
		//$result = $this->db->last_query();
		return $result;
	}
	function getCardsByCatFilter($cat = FALSE)
	{
		if ($filters === FALSE)
		{
			
			return 'Ничего не найдено';
		}

		 $this->db->select('*');
		 $this->db->from('filter');
		 $this->db->join('card_has_filter','filter.id_filter=card_has_filter.filter','left');
		 $this->db->join('filter_cat','filter.id_cat_filter=filter_cat.idfilter_cat','left');
		 $this->db->where('card_has_filter.item ='.$idCard);
		 //$this->db->order_by('filter_cat.h1  ASC');
		$query1 = $this->db->get();
		return $result;
	}
	public function getFiltersIdByAlias($alias)
	{

		$this->db->select('filter.id_filter');
		$where ='';
		foreach ($alias as $key => $value) {
			if ($key == 0) {
				$where = $where.'filter.alias ='." '".$value."'";
			}
			else{
			$where = $where.' or '.'filter.alias ='." '".$value."'";
			}
		}
		$this->db->where($where);

		$query = $this->db->get('filter');

		$res = $query->result_array();
		
		return $res;
	}
	function getFiltersAlias($alias){
		
		$this->db->select('filter.alias');
		$query = $this->db->get_where('filter, filter_cat', 'filter_cat.alias = "'.$alias.'" and filter.id_cat_filter = filter_cat.idfilter_cat');

		$result =[];
		if ($res = $query->result_array()) {
			foreach ($res as $key=>$alias) {
			
			if ($alias!=null) {
				$result[]=$alias;
			}
		}
		}
		
		
		return $result;
	}
	function getItems($items = false)
	{
		if($items == false)
		{
			show_404();
		}
		$result=[];

		$where ='';
		
		foreach ($items as $key => $value) {
			if ($key == 0) {
				$where = $where.'item_card.id_post ='." '".$value."' and item_card.archive = 0";
			}
			else{
			$where = $where.' or '.'item_card.id_post ='." '".$value;
			}
		}
		$this->db->where($where);
		$query = $this->db->get('item_card');
		$result = $query->result_array();
		return $result;
	}
	function countAllCardsFilter($items = false){
		if ($items == false) {
			return false;
		}
		 $this->db->select('id_post,id_user,title,description,date_create,meta_keywords,logo,link,preview_text,h1,alias,id_element,public,archive,map');
		 $this->db->from('item_card');
		$where ='';
		//$this->db->select($where);
		foreach ($items as $key => $value) {
			if ($key == 0) {
				$where = $where.'item_card.id_post ='." '".$value."' and item_card.archive = 0";
			}
			else{
			$where = $where.' or '.'item_card.id_post ='." '".$value."' and item_card.archive = 0";
			}
		}
		$this->db->where($where);
		//$this->db->get('item_card');
		 return $this->db->count_all_results();
	}
	function AddIconsFilters($elements = false){
		if ($elements==false) {
			return false;
		}
		foreach ($elements as $key => $value) {
			if (!empty($value['id_element'])) {
				$this->db->select('*');
				$this->db->from('filter');
				$this->db->join('card_has_filter', 'card_has_filter.filter = filter.id_filter','left');
				$this->db->where('card_has_filter.item='.$value['id_post']);
				$this->db->where('filter.id_cat_filter=40');
				if ($query = $this->db->get()) {
					$result = $query->result_array();
				}
				else{$result = $this->db->last_query();}
				$elements[$key]['filters']=$result;
			}
		}
		return $elements;
	}

function getItemsNewsPage($items = false,$numPage=0,$maxRecords=12)
	{
		if($items == false)
		{
			return;
		}
		$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
		$result=[];
		$this->db->select('*');
		$where ='';
		//$this->db->select($where);
		foreach ($items as $key => $value) {
			if ($key == 0) {
				$where = $where.'news.id_news ='." '".$value."' and news.archive = 0";
			}
			else{
			$where = $where.' or '.'news.id_news ='." '".$value."' and news.archive = 0";
			}
		}
		$this->db->where($where);
		$query = $this->db->get('news',$maxRecords,$lim);
		$result = $query->result_array();
		
		$countRecords = $this->countAllCardsFilter($items);
		$result['countRecords'] = $countRecords;
		return $result;
	}


	function getItemsFilterPage($items = false,$numPage=0,$maxRecords=12)
	{
		if($items == false)
		{
			return;
		}
		$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
		$result=[];
		$this->db->select('*');
		$where ='';
		//$this->db->select($where);
		foreach ($items as $key => $value) {
			if ($key == 0) {
				$where = $where.'item_card.id_post ='." '".$value."' and item_card.archive = 0";
			}
			else{
			$where = $where.' or '.'item_card.id_post ='." '".$value."' and item_card.archive = 0";
			}
		}
		$this->db->where($where);
		$query = $this->db->get('item_card',$maxRecords,$lim);
		$result = $query->result_array();
		
		$countRecords = $this->countAllCardsFilter($items);
		$result['countRecords'] = $countRecords;
		return $result;
	}
}