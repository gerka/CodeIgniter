<?php
class Tags_model extends CI_Model {

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
public function set_tags_has_news($id_news,$ar_tags)
		{
			$json = json_encode(array('type' => 'warning','message'=>'категории не добавлены!','icon'=>'warning'));
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			$user = $this->ion_auth->user()->row();
			$this->load->helper('url');
				if (is_array($ar_tags)) {
				if ($ar_tags != '') {
							$this->db->delete('news_has_tags', array('news' => $id_news));		
				foreach ($ar_tags as $key=>$value) {
					if ($value!=0) {
						$data['newsHasTags'] = array(
						'news' => $id_news,
						'tag' => $key
						);
					$this->db->insert('news_has_tags', $data['newsHasTags']);
					}
					
				}
			}
		}
		if(is_array($id_news)){
			if ($id_news != '') {
							$this->db->delete('news_has_tags', array('news' => $ar_tags));		
				foreach ($id_news as $key) {
					if ($key!=0) {
						$data['newsHasTags'] = array(
						'news' => $key,
						'tag' => $ar_tags
						);
					if($this->db->insert('news_has_tags', $data['newsHasTags'])){
					$json = json_encode(array('type' => 'success','message'=>'Преподователь добавлен карточке','icon'=>'success'));}
					
					}
					
				}
			}
		}

				
			
			
			return $json;
		}
       public function getAllTags($q = false){
       	if ($q!=false) 
       	{
			$query = $this->db->select('value');
			$query = $this->db->like('value', $q);
			$query = $this->db->get('tags');
			return $query->result_array();
       	}
       	else{
       		$query = $this->db->select('*');
       		//$query = $this->db->join('news_has_tags', 'position_menu.id_position = Menu_have_position.id_position');

			$query = $this->db->get('tags');
			return $query->result_array();
       	}
       }
       public function getTagsNews($idNews = false){
       	if ($idNews!=false) 
       	{
			$query = $this->db->select('*');
			$query = $this->db->where('news', $idNews);
			$query = $this->db->get('news_has_tags');
			return $query->result_array();
       	}
       	else{
       		return false;
       	}
       }
       public function find_tag($h1 = false){
       	if ($h1!=false) 
       	{
			$query = $this->db->select('*');
			$query = $this->db->where('value', $h1);
			$query = $this->db->get('tags');
			return $query->result_array();
       	}
       	else{
       		return false;
       	}
       }
       public function addTag($h1 = false){
       	if ($h1!=false) 
       	{
       		$data=[
       		'value'=>$h1,
       		'alias'=>$this->input->post('alias')
       		];
       		if ($data['alias']=="") {
       			return array('type' => 'warning','message'=>'не заполнен URL','icon'=>'warning','url'=>'Url уже существует');
       		}
       		$idElement = $this->setUrl($data['alias']);
			if ($idElement) {
				$data['element'] = $idElement;
			}
			else  {return array('type' => 'warning','message'=>'Видимо карточка c таким URL уже существует','icon'=>'warning','url'=>'Url уже существует');}
			if($this->db->insert('tags', $data))
			{$res = $this->db->insert_id();}
			else{$res = false;}
			return $res;       	
		}
       	else{
       		return false;
       	}
       }
       public function updateTag($idTag = false,$h1 = false){
       	if ($h1!=false) 
       	{
       		$data=[
       		'value'=>$h1
       		];
       		$this->db->where('id_tag',$idTag);
			if($this->db->update('tags', $data))
			{$res = true;}
			else{$res = false;}
			return $res;       	
		}
       	else{
       		return false;
       	}
       }
       		public function delete_tag($idTag = FALSE)
		{
			
			if (!$this->ion_auth->is_admin())
			{
				$this->session->set_flashdata('message', 'You must be an admin to view this page');
				redirect('auth/login');
			}
			if ($idTag != false) {
				# code...
			$this->db->select('element, id_tag, alias');
			$this->db->from('tags');
			$this->db->where('id_tag', $idTag);
			$query = $this->db->get();
			foreach ($query->result() as $row)
{
        $idElement = $row->element;
        $alias = $row->alias;
}
			
$data['delete'] = '' ;

			$this->db->delete('news_has_tags', array('tag' => $idTag));
			
			$this->db->delete('tags', array('id_tag' => $idTag));
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


}