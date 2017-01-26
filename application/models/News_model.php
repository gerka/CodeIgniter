<?php
class News_model extends CI_Model {

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

public function find_news($request = FALSE)
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
			$this->db->from('news');
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
public function find_cats($request = FALSE)
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

			$this->db->select('h1,preview_text');
			$this->db->from('news_cat');
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

		public function get_news($slug = FALSE, $archive = false, $dateCreate=false,$numPage=0,$maxRecords=12, $select=false)
	{
		$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
	        if ($slug)
	        {$query = $this->db->where('id_news', $slug );
	         $query = $this->db->get('news');
	                return $query->row_array();}
	        else{}
	        if($archive){$query = $this->db->where('archive', 1 );}
	        	else{$query = $this->db->where('archive',0 );}
	        if($dateCreate){$query = $this->db->where('date_create<',date('Y-m-d G:i:s'));}
	        	else{}
	        if($select){$query = $this->db->select($select);}
	        else{$query = $this->db->select('*');}
	        $query = $this->db->order_by("date_create", "desc");
	        $query = $this->db->get('news',$maxRecords,$lim);
	        return $query->result_array();
	}

		public function get_news_all($slug = FALSE, $archive = false, $dateCreate=false,$numPage=0,$maxRecords=12, $select=false)
	{
			$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
	        if ($slug)
	        {$query = $this->db->where('id_news', $slug );
	         $query = $this->db->get('news');
	                return $query->row_array();}
	        //else{}
	        if($archive){$query = $this->db->where('archive', 1 );}
	        	else{$query = $this->db->where('archive',0 ); $query = $this->db->where('public',1 ); }
	        if($dateCreate){$query = $this->db->where('date_create<',date('Y-m-d G:i:s'));}
	        	//else{}
	        if($select){$query = $this->db->select($select);}
	        else{$query = $this->db->select('*');}
	        $query = $this->db->order_by("date_create", "desc");
	        
	        $query = $this->db->get('news',$maxRecords,$lim);

	        $news = $query->result_array();
	        //return $news;
	        $query = $this->db->get('news_cat');
	        $catNews = $query->result_array();
	        $query = $this->db->get('tags');
			$tags = $query->result_array();
	        $query = $this->db->get('news_has_tags');
			$NhT = $query->result_array();
			$result = [];
			foreach ($catNews as $keyCat => $valueCat) {
				$result[$keyCat] = $valueCat;
				foreach ($news as $keyNews => $valueNews) {
					 if ($valueNews['id_cat'] == $valueCat['id_cat']) {
						
						$result[$keyCat]['news'][$keyNews] = $valueNews;
						foreach ($NhT as $keyNhT => $valueNhT) {
							if ($valueNews['id_news'] == $valueNhT['news']){
								$result[$keyCat]['news'][$keyNews]['tags'][$keyNhT] = '';
								foreach ($tags as $keyTags => $valueTags) {
							
							if ($valueNhT['tag'] == $valueTags['id_tag']) {
						$result[$keyCat]['news'][$keyNews]['tags'][$keyNhT] = $valueTags;
															}
														}
													}
												}
						
					}
					
				}
				if(empty($result[$keyCat]['news'])){unset($result[$keyCat]);}
			}
	        return $result;
	}
	public function get_news_by_tag($slug = FALSE, $archive = false, $dateCreate=false,$numPage=0,$maxRecords=12, $select=false)
	{
			$lim = ($numPage*$maxRecords==0) ? 0 : $numPage*$maxRecords ;
	        if ($slug)
	        {
	        	$query = $this->db->where('alias',$slug );
	        	$query = $this->db->get('tags');
				$tag = $query->result_array();
	        	$query=$this->db->join('news_has_tags','news_has_tags.news=news.id_news','left');
	        	$query=$this->db->where('tag',$tag[0]['id_tag']);

	    		}
	        if($archive){$query = $this->db->where('archive', 1 );}
	        	else{$query = $this->db->where('archive',0 );}


	        if($dateCreate){$query = $this->db->where('date_create<',date('Y-m-d G:i:s'));}
	        	else{}
	        if($select){$query = $this->db->select($select);}
	        else{$query = $this->db->select('*');}
	        $query = $this->db->order_by("date_create", "desc");
	        
	        $query = $this->db->get('news',$maxRecords,$lim);
	        $news = $query->result_array();

	        // $query = $this->db->get('news_cat');
	        // $catNews = $query->result_array();
	        $query = $this->db->get('tags');
			$tags = $query->result_array();

	        $query = $this->db->get('news_has_tags');
			$NhT = $query->result_array();
			$result = [];
			
			$result = $tag[0];
			$result['news'] = $news;
			$result['tags'] = $tags;
	        return $result;
	}

		function get_news_Byfilter($id = false,$h1 = false,$product_created_from = false,$product_created_to = false)
	{
	        $like = '';
	        $where = '';

	        $like = ($id===false) ? $like : $this->db->like('id_news',$id) ;
	        $like = ($h1===false) ? $like : $this->db->like('h1',$h1) ;
	        $product_created_from = ($product_created_from === false) ? false : $product_created_from=$product_created_from.' 00:00:00' ;
	        $product_created_to = ($product_created_to === false) ? false : $product_created_to=$product_created_to.' 00:00:00' ;

	        $where = ($product_created_from === false) ? $where : $this->db->where('date_create >',$product_created_from) ;
	        $where = ($product_created_to === false) ? $where : $this->db->where('date_create <',$product_created_to) ;

	        $query = $this->db->get('news');
	        //echo $this->db->last_query();
	        return $query->result_array();
	}
		public function get_news_cat($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	                $query = $this->db->get('news_cat');
	                return $query->result_array();
	        }

	        $query = $this->db->get_where('news_cat', array('id_cat' => $slug));
	        return $query->row_array();
	}
function deleteElementNews($id_news=false){
    	if ($id_news == false) {
    		return false;
    	}
    	$query=$this->db->get_where('news',array('id_news'=>$id_news));
    	$row = $query->row();

		if (isset($row))
		{
		        $id_element = $row->id_element;
		        $query = $this->db->get_where('Elements',array('id_element'=>$id_element));
		    	$row2 = $query->row();
				if (!empty($row2))
				{
				        $id_url = $row2->id_url;
				        $this->db->delete('URL_table', array('idURL_table' => $id_url));
				}
		        
		        if ($this->db->delete('Elements', array('id_element' => $id_element ))) {
		        	return true;
		        }
		        else {return false;}
		}
    	else {return false;}
    }    
		public function delete_news($slug = FALSE)
	{
	        if ($slug === FALSE)
	        {
	                
	                return 'Новость не выбрана';
	        }
	        $this->deleteElementNews($slug);
	        if ($query = $this->db->delete('news', array('id_news' => $slug)))
	    	{$json = json_encode(array('type' => 'success','message'=>'Новость удалена!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>'Новость не удалена :(','icon'=>'warning'));}
	    return $json;
	}

		public function set_news($dat = FALSE)
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

	    //$slug = url_title($this->input->post('title'), 'dash', TRUE);

	    $data['newsInsert'] = array(
	        'title' => $this->input->post('title'),
	        'description' => $this->input->post('description'),
	        'body' => $this->input->post('body'),
	        'meta_keywords' => $this->input->post('meta_keywords'),
	        'preview_text' => $this->input->post('preview_text'),
	        'h1' => $this->input->post('h1'),
	        'alias' => $this->input->post('alias'),
	        'logo' => $this->input->post('logo'),
	        'public' => $this->input->post('public'),
	        'archive' => $this->input->post('archive'),
	        'id_cat' => $this->input->post('id_cat'),
	        'date_create' => date('Y-m-d H:i:s',strtotime($this->input->post('date_create')))
	    );
	    $idElement = $this->setUrl($data['newsInsert']['alias']);
	    if ($idElement) {
				$data['newsInsert']['id_element'] = $idElement;
			}
			else  {return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));}
			$data['newsInsert']['id_element'] = $idElement;
	    if($this->db->insert('news', $data['newsInsert']))
	    	{
	    		if (!empty($this->input->post('tags'))) {
	    			$this->Tags_model->set_tags_has_news($this->db->insert_id(),$this->input->post('tags'));
	    		}
	    		
	    		$json = json_encode(array('type' => 'success','message'=>'Новость добавлена!','icon'=>'success'));
	    		if ($this->set_news_has_cat($data['newsInsert']['title'],$this->input->post('news_cats'),'title')) {

					$json = json_encode(array('type' => 'success','message'=>'Новость создана и категории тоже!','icon'=>'success'));  	}

	}else{$json = json_encode(array('type' => 'warning','message'=>'Проверьте все ли поля заполнены.','icon'=>'warning'));}
	    return $json;
	}
	else{
				$query = $this->db->select('id_element');
				$query = $this->db->get_where('news', array('id_news' => $dat['id_news']));
				$row = $query->row();
				$IDELEMENT=$row->id_element;
				if ($IDELEMENT == 0) {

					$IDELEMENT = $this->setUrl($dat['alias'],true, $IDELEMENT);
					$dat['id_element'] = $IDELEMENT;

					if ($dat['id_element']) {
						return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));
					}
					$IDELEMENT=$dat['id_element'];
									}


		$this->db->where('id_news', $dat['id_news']);
		    if($this->db->update('news', $dat))
	    	{
	    		$this->setUrl($dat['alias'],true, $IDELEMENT);
	    		
	    		$json = json_encode(array('type' => 'success','message'=>'Новость Обновлена!','icon'=>'success','dat'=>$dat));
	    		


	}else{
	    		$json = json_encode(array('type' => 'warning','message'=>'Видимо такая новость уже существует_2','icon'=>'warning'));
	    		}
	    return $json;
	}
}
		public function set_cat_news($data = false)
	{

		if (!$this->ion_auth->is_admin())
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth/login');
		}
		$user = $this->ion_auth->user()->row();
	    $this->load->helper('url');

	    $slug = url_title($this->input->post('title'), 'dash', TRUE);

	    if (empty($data)) {
	    	$json = json_encode(array('type' => 'warning','message'=>'Видимо такая категория уже существует','icon'=>'warning'));
	    } 
	    elseif (isset($data['id_cat'])) 	     {
	    	
	    	$query = $this->db->select('id_element');
				$query = $this->db->get_where('news_cat', array('id_cat' => $data['id_cat']));
				$row = $query->row();
				$IDELEMENT=$row->id_element;
				if ($IDELEMENT == 0) {
					$data['id_element'] = $this->setUrl($data['alias'],true, $IDELEMENT);
					if ($data['id_element']) {
						return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));
					}
					$IDELEMENT=$data['id_element'];
									}
		$this->db->where('id_cat', $data['id_cat']);
	    	if($this->db->update('news_cat', $data))
	    	{
	    		if(!$this->setUrl($data['alias'],true, $IDELEMENT)){
	    			return json_encode(array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует'));
	    		}
	    		$json = json_encode(array('type' => 'success','message'=>'Категория новостей обновлена!','icon'=>'herat'));}else{$json = json_encode(array('type' => 'warning','message'=>'Что-то пошло не так','icon'=>'heartbeat'));}
	    }
	    else {

	    	$idElement = $this->setUrl($data['alias']);

			if ($idElement) {
				$data['id_element'] = $idElement;
			}
			
	    	if($this->db->insert('news_cat', $data))
	    	{$json = json_encode(array('type' => 'success','message'=>'Категория новостей добавлена!','icon'=>'success'));}else{$json = json_encode(array('type' => 'warning','message'=>'Видимо такая категория уже существует','icon'=>'warning'));}
	    }
	    
	    
	    return $json;
	}

	public function set_news_has_cat($id_card,$ar_filter,$name=false)
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
				$query = $this->db->get_where('news', array($name=>$id_card));
				foreach ($query->result() as $row)
				{
					$this->db->delete('news_has_cat', array('id_news' => $row->id_news));
				}
				if ($ar_filter != '') {
					# code...
				
				foreach ($ar_filter as $value) {
					$data['newsHasCatInsert'] = array(
						'id_news' => $row->id_news,
						'id_cat' => $value
						);
					$this->db->insert('news_has_cat', $data['newsHasCatInsert']);
				}

				$json = json_encode(array('type' => 'success','message'=>'категории добавлены!','icon'=>'success'));
			}
			}
			else{
				$query = $this->db->get_where('news', array('id_news'=>$id_card));
				$this->db->delete('news_has_cat', array('id_news' => $id_card));

				foreach ($ar_filter as $value) {
					$data['newsHasCatInsert'] = array(
						'id_news' => $id_card,
						'id_cat' => $value
						);
					$this->db->insert('news_has_cat', $data['newsHasCatInsert']);
				}
				$json = json_encode(array('type' => 'success','message'=>'категории изменены!','icon'=>'success'));
			}
			return $json;
		}

	public function get_cat_all($idNews = false)
	{	$result =[];
	        	if ($idNews == false) {
	                $this->db->select('news_cat.title as cat,id_cat as id');
					$this->db->from('news_cat');
					$this->db->order_by('news_cat.title  ASC');
					$query1 = $this->db->get();
					foreach ($query1->result_array() as $key => $value) {
						$result[$value['cat']][] = $value;
						}
	                } 
	                else 
	                {
	        		 $this->db->select('filter.title as filter,filter_cat.title as cat,id_filter,id_cat_filter');
					$this->db->from('filter, filter_cat');
					$this->db->where('filter.id_cat_filter=filter_cat.idfilter_cat');
					$this->db->order_by('filter_cat.title  ASC');
					$query1 = $this->db->get();
					$id_cat = $this->getFiltersIdByIdCard($idNews); 
					foreach ($query1->result_array() as $key => $value) {
						if ( in_array_r($value['id_filter'], $id_filters,"filter")) {
							$value['value']=1;
						}
						$result[$value['cat']][] = $value;
												}
	        		}

	        		return $result;
	        
	}

public function replace_news($idCards = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idCards = $this->input->post('id')) {
			$query = $this->db->where('id_news', $idCards);
			$query = $this->db->get('news');
			$res = $query->result_array();
			if($res[0]['archive']==1){$archive = 0;}
			else{$archive = 1; $this->db->set('public', 0);}
			$this->db->where('id_news', $idCards);
			$this->db->set('archive', $archive);

			//$this->db->update('item_card', array('archive' => 1f, ))
			if ($this->db->update('news'))
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