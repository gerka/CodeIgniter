<?php
	class ImageControl extends CI_Controller {

	        public function __construct()
	        {
	        	parent::__construct();
	        	$this->load->model('ImageControl_model');
	        	$this->load->model('Element_model');
	        	$this->load->helper('utility_helper');
	        	$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css");
			    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/css/bootstrap-modal.css");
			    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap/js/bootstrap.min.js");
			    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js");
			    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/date.js");
			    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/bootstrap-modal/js/bootstrap-modal.js");
			    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
	        	$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jstree/dist/themes/default/style.min.css");
				$this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/jstree/dist/jstree.min.js"); 
				
	        	// $this->load->helper('utility_helper');
	        }

	        public function getPropertyFile($idImage = false){
	        if (!$this->ion_auth->logged_in())
            {	 // redirect them to the login page
              redirect('auth/login', 'refresh');
              $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
              return show_error('You must be an administrator to view this page.');
            }
            else
            {
            	if ($idImage == false)
	            { if (!empty($this->input->post('url'))) {
	              	# code...
	              }
	              $data = [
	              	'url'=>$this->input->post('url')
	              ];
	              $data['url']=$data['url'];
	              $fileProp['size'] = human_filesize(filesize($data['url']));
	              $return = json_encode($fileProp);
	              return print($return);
                  
              }
              else{
              	$data['responese'] = $this->ImageControl_model->get_image_by_id($idImage);
              	return print($data['responese']);
              }
            }
        }
	        public function changeProperty($idImage = false){
	        if (!$this->ion_auth->logged_in())
            {	 // redirect them to the login page
              redirect('auth/login', 'refresh');
              $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
              return show_error('You must be an administrator to view this page.');
            }
            else
            {
            	if ($idImage == false)
              {
                  return json_encode( ['status'=>'error1']);
              }
              $data = [
              	'idImage'=>$idImage,
              	'url'=>$this->input->post('source'),
              	'alt'=>$this->input->post('alt'),
                'sort'=>$this->input->post('sort'),
                'meta_keywords'=>$this->input->post('meta_keywords'),
                'description'=>$this->input->post('description'),
                'dop_field'=>$this->input->post('dop_field')
              ];
     //          'width'=>$this->input->post('width'),
     //          'height'=>$this->input->post('height'),
			  // 'quality'=>$this->input->post('quality')
              $return = $this->ImageControl_model->changeProperty($data);
              return print($return);
            }

	        }
	        public function set_image_has_element($idElement=false,$idImage=false)
{
		if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
              redirect('auth/login', 'refresh');
              $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
              return show_error('You must be an administrator to view this page.');
            }
            else
            {
  $out = $this->ImageControl_model->set_image_has_element($idElement,$idImage);
  if ($out == false) {
    echo '{"status":"0"}';
  }
  else{
    echo '{"status":"1"}';
  }
  return $out;
}
}
	      	public function show_control(){
	      		if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
              redirect('auth/login', 'refresh');
              $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
              return show_error('You must be an administrator to view this page.');
            }
            else
            {
            	//$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/jcrop/css/jquery.Jcrop.min.css");
            	
            	$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/FZ-Dtree/css/fz-dtree.css");
            	$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/FZ-Dtree/css/fz.theme.css");
            	$this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/FZ-Dtree/css/icons.css");

            	$this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/FZ-Dtree/js/fz-dtree.min.js");
            	
            	$this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/jcrop/js/jquery.color.js");
            	//$this->data['page_level_plugin'][]= array('src' => asset_url()."global/plugins/jcrop/js/jquery.Jcrop.min.js");
            	
            	
            	$this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showImageControl.js");
            	//$this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/ui-tree.min.js");
            	$data['title'] = 'Управление Media данными';     
            	$data['Menu'] = $this->ImageControl_model->getAllMenuElements();   
            	//print_r($data['Menu'])           ; 
                $this->breadcrumb->add_crumb('Управление Media данными', '/admin/image/show_control');
                $this->load->helper('form');
                $this->load->view('templates/admin/include/head', $data);
                $this->load->view('templates/admin/include/header', $data);
                $this->load->view('templates/admin/include/breadcrumbs', $data);
                $this->load->view('templates/admin/include/sidebar', $data);
                $this->load->view('admin/ImageControl/show_control', $data);
                $this->load->view('templates/admin/include/footer', $data);
                $this->load->view('templates/admin/include/javascript');
            }
            return;
	      	}
          public function deleteImageCard($idElement = false,$idImage = false)
          {
            if (!$this->ion_auth->logged_in())
            {
                // redirect them to the login page
              redirect('auth/login', 'refresh');
              $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
            {
                // redirect them to the home page because they must be an administrator to view this
              return show_error('You must be an administrator to view this page.');
            }
            else
            {
              if ($idElement === false or $idImage === false) {
                                	return;
                                }                 
             echo json_encode($this->ImageControl_model->delete_image_card($idImage,$idElement));
                  return;
                
              }   
            }  
          public function getElementImage($id=false){
          	if ($id == false) {
	        		return show_404();
	        	}
	        	$Result = $this->Element_model->getElement($id);
	        	echo(json_encode($Result));
	        	return $Result;
          }
	        public function getImages($id=false, $what = 'card'){
	        	if ($id == false) {
	        		return show_404();
	        	}
	        	switch ($what) {
	        		case 'card':
	        			$arImage = $this->ImageControl_model->get_images_card($id);
	        			break;
	        		
	        		default:
	        			$arImage = $this->ImageControl_model->get_images_card($id);
	        			break;
	        	}
	        	return $arImage;
	        }
	        public function loadLastImages($num=0, $maxlength = 4)
	        {
	        	
	        	$return = $this->ImageControl_model->get_last_images($num,$maxlength);

	        	echo json_encode($return);
	        	return;
	        }
// 	public function create_preview_image($source = false, $dest = false,$iHeightCenter = 150,$iWidthCenter = 150){
// 		if ($source === false) {
// 			return "No, no, no";
// 		} else 

// 		{

// 	$jpeg_quality = 90;

// 	$source = './demos/demo_files/image5.jpg';

// 	$img_r = imagecreatefromjpeg($source);
// 	$size = getimagesize($source);
//     $iMarginTop = round((($size[0] - $iHeightCenter) / 2));
//     $iMarginLeft = round((($size[1] - $iWidthCenter) / 2));
    
// 	$dst_r = ImageCreateTrueColor( $iWidthCenter, $iHeightCenter );

// 	imagecopyresampled($dst_r,$img_r,0,0,intval($iMarginTop),intval($iMarginLeft), $targ_w,$targ_h, intval($iWidthCenter),intval($iHeightCenter));
// 	imagejpeg($dst_r,$dest,$jpeg_quality);

// 	exit;
// }
// 		}

public function saveImage(){
	//$data = file_get_contents($_REQUEST['imgData']);
    //file_put_contents('image.jpg', $data);
    if (!$this->ion_auth->logged_in())
	  {
	                // redirect them to the login page
	    redirect('auth/login', 'refresh');
	    $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
	            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
	            {
	                // redirect them to the home page because they must be an administrator to view this
	              return show_error('You must be an administrator to view this page.');
	            }
	            else
	            {
	if (empty($this->input->post('url'))) {
		
	}
    $data = ['img'=>$this->input->post('imgData'),'url'=>$this->input->post('url')];
    $data['explode'] = explode("/", $data['url']);
	$data['count'] = count($data['explode']);
	$data['nameFile'] = $data['explode'][$data['count']-1];
	$data['filePath'] = $_SERVER['DOCUMENT_ROOT'].'/';
	//return print(json_encode(array('type' => 'success','message'=>$data,'icon'=>'success')));
    //file_force_contents($data['url'],$data['img']);
    for ($i=3; $i < $data['count']; $i++) { 
    	
    	$data['filePath'] = $data['filePath'].$data['explode'][$i].'/';

    }
    $data['filePath'] = substr($data['filePath'], 0, -1);

    if (!copy($data['filePath'], $data['filePath'].'_copy')) {
    return print(json_encode(array('type' => 'warning','message'=>"не удалось скопировать $file...\n",'icon'=>'success')));
    
}	

   	if (unlink($data['filePath'])) {
   		if(file_put_contents($data['filePath'], file_get_contents($data['img']))){
				$out1 = create_preview_image($data['img'],'images/thumb/745X460/'.$data['nameFile'],745,460);
				$out1 = create_preview_image($data['img'],'images/thumb/390X255/'.$data['nameFile'],390,255);
			    $out2 = create_preview_image($data['img'],'images/thumb/480X259/'.$data['nameFile'],480,259);
			    $out3 = create_preview_image($data['img'],'images/thumb/90X90/'.$data['nameFile'],90,90);
			    $out4 = create_preview_image($data['img'],'images/thumb/90X60/'.$data['nameFile'],90,60);   
			    return print(json_encode(array('type' => 'success','message'=>$data['url'],'icon'=>'success')));	
   		}
   		//unlink($data['url'])
   	}
	
}

}
		public function uploadImages($item=false,$path=false)
	{

	  if (!$this->ion_auth->logged_in())
	  {
	                // redirect them to the login page
	    redirect('auth/login', 'refresh');
	    $this->session->set_flashdata('login','Вы не зарегистрированы или не смогли войти попробуйте еще раз :)');      }
	            elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
	            {
	                // redirect them to the home page because they must be an administrator to view this
	              return show_error('You must be an administrator to view this page.');
	            }
	            else
	            {

	if ($item == false) {
	              if (isset($_FILES))
	              {
	    // A list of permitted file extensions
	                $allowed = array('png', 'jpg', 'gif','zip');
	                if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0){

	                 $extension = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
	                 if(!in_array(strtolower($extension), $allowed)){
	                   echo '{"status":"error_1"}';
	                   exit;
	                 }
	                 if(move_uploaded_file($_FILES['logo']['tmp_name'],'uploads/'.$_FILES['logo']['name'])){
	                   $tmp='uploads/'.$_FILES['logo']['name'];

	     $new = 'images/'.$_FILES['logo']['name']; //adapt path to your needs;
	     if(copy($tmp,$new)){
	       echo 'uploads/'.$_FILES['logo']['name'];
	       echo '{"status":"success"}';
	     }
	     exit;
	   }
	 }
	 echo '{"status":"error_2"}';
	 exit;
	}
	}

	elseif($item == 'card')
	{
		if (empty($_FILES) || $_FILES["file"]["error"]) {
		  die('{"status": 0}');
		}
		else{
	    // A list of permitted file extensions
	    			
					$fileName = $_FILES["file"]["name"];	
	                $allowed = array('png', 'jpg', 'gif','zip');
	                $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	                 if(!in_array(strtolower($extension), $allowed)){
	                   echo '{"status":"error_1"}';
	                   die('{"status": 0}');
	                 }
	                 if(move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/$fileName")){
	                   $tmp='uploads/'.$fileName;
	                   $path = ($path == false) ? '' : $path ;

	     $newName = uniqid().'.'.$extension; //adapt path to your needs;
	     $new = 'images/'.$item.'/'.$newName;  //adapt path to your needs;

	     if(copy($tmp,$new)){
	     	$data = [
	     	'url' => $new
	     	];
	     	$out4 = create_preview_image($new,'images/thumb/745X460/'.$newName,90,60);
	     	$out4 = create_preview_image($new,'images/thumb/90X60/'.$newName,90,60);
	     	$out1 = create_preview_image($new,'images/thumb/390X255/'.$newName,390,255);
		    $out2 = create_preview_image($new,'images/thumb/480X259/'.$newName,480,259);
		    $out3 = create_preview_image($new,'images/thumb/90X90/'.$newName,90,90);
		    if (!empty($this->input->post('Element'))) {
		    	$jsonOut = $this->ImageControl_model->set_image($data,$this->input->post('Element'));
		    }
	     	$jsonOut = $this->ImageControl_model->set_image($data);
	     	

			die(json_encode($jsonOut));
	     }
	     die('{"status": 0}');
	   }
	 die('{"status": 0}');
	}
	}
	elseif($item == 'review')
	{
		if (empty($_FILES) || $_FILES["file"]["error"]) {
		  die('{"status": 0}');
		}
		else{
	    // A list of permitted file extensions
	    			
					$fileName = $_FILES["file"]["name"];	
	                $allowed = array('png', 'jpg', 'gif','zip');
	                $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	                 if(!in_array(strtolower($extension), $allowed)){
	                   echo '{"status":"error_1"}';
	                   die('{"status": 0}');
	                 }
	                 if(move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/$fileName")){
	                   $tmp='uploads/'.$fileName;
	                   $path = ($path == false) ? '' : $path ;

	     $newName = uniqid().'.'.$extension; //adapt path to your needs;
	     $new = 'images/'.$item.'/'.$newName;  //adapt path to your needs;

	     if(copy($tmp,$new)){
	     	$data = [
	     	'url' => $new
	     	];
		    $out3 = create_preview_image($new,'images/thumb/90X90/'.$newName,90,90);
		    
		    if (!empty($this->input->post('id_review'))) {
		    	$jsonOut = $this->ImageControl_model->set_image_review($data,$this->input->post('id_review'));
		    }

	     	$jsonOut = $this->ImageControl_model->set_image($data);
	     	

			die(json_encode($jsonOut));
	     }
	     die('{"status": 0}');
	   }
	 die('{"status": 0}');
	}
	}
	elseif($item == 'staff')
	{
		if (empty($_FILES) || $_FILES["file"]["error"]) {
		  die('{"status": 0}');
		}
		else{
	    // A list of permitted file extensions
	    			
					$fileName = $_FILES["file"]["name"];	
	                $allowed = array('png', 'jpg', 'gif','zip');
	                 $extension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
	                 if(!in_array(strtolower($extension), $allowed)){
	                   echo '{"status":"error_1"}';
	                   die('{"status": 0}');
	                 }
	                 if(move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/$fileName")){
	                   $tmp='uploads/'.$fileName;
	                   $path = ($path == false) ? '' : $path ;

	     $newName = uniqid().'.'.$extension; //adapt path to your needs;
	     $new = 'images/'.$item.'/'.$newName; //adapt path to your needs;

	     if(copy($tmp,$new)){
	     	$data = [
	     	'url' => $new
	     	];
	     	$out4 = create_preview_image($new,'images/thumb/90X60/'.$newName,90,60);
	     	$jsonOut = $this->ImageControl_model->set_image($data);
	     	//$jsonOut = json_encode($jsonOut);

			die($jsonOut);
	     }
	     die('{"status": 0}');
	   }
	 die('{"status": 0}');
	}
	}
	}
	}  

}

?>