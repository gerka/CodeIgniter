<?php
class Email extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('ItemCard_model');
                $this->load->model('Filter_model');
                $this->load->model('Partners_model');
                $this->load->model('Menu_model');
                $this->load->helper('url_helper');
                $this->load->library('email');
                $this->data['page_level_css'][] =  array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/bootstrap/css/bootstrap.min.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/jquery-ui/jquery-ui.min.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/build.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/style.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/media.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/jquery.fancybox.css?v=2.1.5');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/js/main.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery-3.1.0.min.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery-2.0.2.min.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/bootstrap/js/bootstrap.min.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/jquery-ui/jquery-ui.min.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.sticky.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.stellar.min.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.placeholder.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.inputmask.bundle.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.mousewheel-3.0.6.pack.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/fancybox/jquery.fancybox.pack.js?v=2.1.5');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'global/plugins/jquery.blockui.min.js');
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.js');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7');
            

        }

     //    function EmailContacts($slug = false, $message=false,$email = false){
     //    	$AdminMail = '3628249@gmail.com';
     //    	if($email==false){ 
     //    		//$email='namaste@globe.yoga';
     //    		$email='gerka23@gmail.com'; 
     //    	}
     //    		switch ($slug) {
     //    			case 'Subscribe':
     //    			$this->email->from('globe.yoga@yandex.ru', 'Info');
					// $this->email->to($email,$AdminMail);
					// // $this->email->cc('another@another-example.com');
					// // $this->email->bcc('them@their-example.com');
					// $this->email->subject('Question from globe.yoga');
					// if ($message==false){
					// 	$message = $this->input->post($message)
					// }
					// $this->email->message($message);
					// $email=$this->email->send();
     //    				break;
     //    			case 'Add':
     //    			$this->email->from('info@campstogo.com', 'Info');
					// $this->email->to($email,$AdminMail);
					// // $this->email->cc('another@another-example.com');
					// // $this->email->bcc('them@their-example.com');
					// $this->email->subject('Add Request from CampsToGo.com');
					// if ($message==false){
					// 	$message = 'Нет Данных';
					// }
					// $this->email->message($message);
					// $email=$this->email->send();
     //    				break;

     //    			case 'Edit':
     //    			$this->email->from('info@campstogo.com', 'Info');
					// $this->email->to($email,$AdminMail);
					// // $this->email->cc('another@another-example.com');
					// // $this->email->bcc('them@their-example.com');
					// $this->email->subject('Edit Request from CampsToGo.com');
					// if ($message==false){
					// 	$message = 'Нет Данных';
					// }
					// $this->email->message($message);
					// $email=$this->email->send();
     //    				break;
        			
     //    			default:
     //    				# code...
     //    				break;
     //    		}
     //    	}
     	
        function EmailToAdmin($slug = false, $message=false,$email = false){
        	$AdminMail = '3628249@gmail.com';
        	$this->email->clear();
        	if($email==false){ 
        		$email='namaste@globe.yoga';
        		//$email='gerka23@gmail.com'; 
        	}
        		switch ($slug) {
        			case 'Contact':
        			$this->email->from($email, 'Reply form Globe.Yoga');
					$this->email->to($email,$AdminMail);
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('Contact from globe.yoga');
					if ($message==false){
						$message = 'нет данных';
					}
					$this->email->message($message);
					$email=$this->email->send();
        				break;
        			case 'Partner':
        			$this->email->from($email, 'Reply form Globe.Yoga');
					$this->email->to($email,$AdminMail);
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('New Partner on globe.yoga');
					if ($message==false){
						$message = 'нет данных';
					}
					$this->email->message($message);
					$email=$this->email->send();
        				break;
        			case 'Add':
        			$this->email->from('info@campstogo.com', 'Info');
					$this->email->to($email,$AdminMail);
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('Add Request from CampsToGo.com');
					if ($message==false){
						$message = 'Нет Данных';
					}
					$this->email->message($message);
					$email=$this->email->send();
        				break;

        			case 'Edit':
        			$this->email->from('info@campstogo.com', 'Info News');
					$this->email->to($email,$AdminMail);
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('Edit Request from CampsToGo.com');
					if ($message==false){
						$message = 'Нет Данных';
					}
					$this->email->message($message);
					$email=$this->email->send();
        				break;
        			
        			default:
        				# code...
        				break;
        		}
        	}
       
        public function Contact(){
        	$data['header_menu'] = $this->Filter_model->get_cats_header();
            $data['menu'] = $this->Menu_model->get_menu(array(''));
		$result['state']='false';
        	if(!empty($this->input->post('email')))
        		{
        			$this->email->clear();
        			$this->email->from('namaste@globe.yoga', 'Info News');
					$this->email->to($this->input->post('email'));
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('Question from Globe.Yoga');
					//$this->email->message('Thank for your interst!');
					$message = 'Thank for your interst!'."\n";
					$message = $message.'from:'.$this->input->post('email')."\n";
					$message = $message.'Name:'.$this->input->post('name')."\n";
					$message = $message.'Telephone: '.$this->input->post('phone')."\n";
					$message = $message.'Message: '.$this->input->post('message');
					$this->email->message($message);
					$email=$this->email->send();
					$this->email->clear();
					$this->EmailToAdmin('Contact',$message);
					
					if (!$email) {
						 $result['state']='false';
						// echo json_encode($result);
					}
					else{$result['state']='true'.$email;}
        		}
        		 
        		//$data['body']=json_encode($result);
        		$data['h1']='Сообщение отправлено';
        			$this->load->view('templates/yoga_template/head', $data);
		            $this->load->view('templates/yoga_template/header', $data);
		            $this->load->view('pages/clear', $data);
		            $this->load->view('templates/yoga_template/footer', $data);
					
				
        }
        public function Partners($lang = 'ru'){

        	// $data['header_menu'] = $this->Filter_model->get_cats_header();
         //    $data['menu'] = $this->Menu_model->get_menu(array(''));
		$result['state']='false';
		$data['lang'] = $lang;
        	if(!empty($this->input->post('email')))
        		{
        			
        			$dataPartners = [
        			'name'=>$this->input->post('name'),
        			'url'=>$this->input->post('site'),
        			'company'=>$this->input->post('company'),
        			'email'=>$this->input->post('email'),
        			'id_menu'=>$this->input->post('menu'),
        			'phone'=>$this->input->post('phone'),
        			];
        			$needle =[];
        			$replace = [];
        			$message = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/EmailTpl/Partners.json");
        			$message = json_decode($message,true);
        			foreach($dataPartners as $key5=>$value5) {
        				$needle[] ="#$key5#";
        				$replace[] = $value5;
        			}
        			$haystack =$message['Partners'][$lang];
        			$res = str_replace($needle, $replace, $haystack);
        			$message['Partners'][$lang] = $res;
        			
        			$this->email->clear();
        			
        			$this->email->from('namaste@globe.yoga', 'globe.yoga');
					$this->email->to($this->input->post('email'));
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject($message['Partners'][$lang]['subject']);
					//$this->email->message('Thank for your interst!');
					$mes ='';
					foreach ($message['Partners'][$lang] as $key => $value) {
						if($key != 'out' and $key != 'subject' and $key != 'false'){
							$mes = $mes.$value;
						}
					}
					$this->email->message($mes);
					$email=$this->email->send();
					$this->email->clear();
					$this->EmailToAdmin('Contact',$mes);
					//print($email);
					//print_r($dataPartners);
					if (!$email) {
						 $result['state']='false';

						$data['h1']=$message['Partners'][$lang]['false'];
					}
					else{$data['h1']=$message['Partners'][$lang]['out'];
						$this->Partners_model->insert_partner($dataPartners);}
        		}

        		//$data['body']=json_encode($result);
        		//$data['h1']=$message['Partners'][$lang]['out'];
        		$this->renderView($data);
        			
					
				
        }
        public function Subscribe(){
		$result['state']='false';
        	if(!empty($this->input->post('email')))
        		{

        			$this->email->from('info@campstogo.com', 'Info ');
					$this->email->to($this->input->post('email'));
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('Subscribe from CampsToGo.com');
					$this->email->message('Congratulation!');
					$message = '';
					$message = $message.'Thank for your interst!'."\n";
					$message = $message.'Your request is'."\n";
					$message = $message.'from'.$data['email']."\n";

					$email=$this->email->send();
					$this->EmailToAdmin('Subscribe',$message);
					if (!$email) {
						 $result['state']='false';
						// echo json_encode($result);
					}
					else{$result['state']='true';}
        		}
        			
					print(json_encode($result));
				
        }
        public function AddCamp(){
        	
        	$result['state']='false';

        	if(!empty($this->input->post('ContactAdd')))
        		{
        	$data = [
        		'CampNameAdd' => ($this->input->post('CampNameAdd')) ? $this->input->post('CampNameAdd') : '',          
                'UrlAdd' =>($this->input->post('UrlAdd')) ? $this->input->post('UrlAdd') : '',         
                'NameAdd' =>($this->input->post('NameAdd')) ? $this->input->post('NameAdd') : '',          
                'ContactAdd' =>($this->input->post('ContactAdd')) ? $this->input->post('ContactAdd') : '',          
                'CommentAdd' =>($this->input->post('CommentAdd')) ? $this->input->post('CommentAdd') : ''   
        	];
        	
        			$this->email->from('info@campstogo.com', 'Info');
					$this->email->to($data['ContactAdd']);
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('Add camp to CampsToGo.com');
					$message = '';
					$message = $message.'Thank for your interst!'."\n";
					$message = $message.'Your request is'."\n";
					$message = $message.'Camp Name'.$data['CampNameAdd']."\n";
					$message = $message.'URL '.$data['UrlAdd']."\n";
					$message = $message.'Message from  '.$data['NameAdd']."\n";
					$message = $message.'Contact is  '.$data['ContactAdd']."\n";
					$message = $message.'Your Message:  '.$data['CommentAdd']."\n";
					$this->email->message($message);

					$email=$this->email->send();
					$this->EmailToAdmin('Add',$message);
					if (!$email) {
						 $result['state']='false';
						// echo json_encode($result);
					}
					else{$result['state']='true';}
        		}
        		
				print(json_encode($result));
        }
        public function EditCamp(){
			$result['state']='false';
        	if(!empty($this->input->post('ContactEdit')))
        		{
        	$data = [
        		'CampNameEdit' => ($this->input->post('CampNameEdit')) ? $this->input->post('CampNameEdit') : '',          
                'UrlEdit' =>($this->input->post('UrlEdit')) ? $this->input->post('UrlEdit') : '',         
                'NameEdit' =>($this->input->post('NameEdit')) ? $this->input->post('NameEdit') : '',          
                'ContactEdit' =>($this->input->post('ContactEdit')) ? $this->input->post('ContactEdit') : '',          
                'CommentEdit' =>($this->input->post('CommentEdit')) ? $this->input->post('CommentEdit') : ''   
        	];

        			$this->email->from('info@campstogo.com', 'Info');
					$this->email->to($data['ContactEdit']);
					// $this->email->cc('another@another-example.com');
					// $this->email->bcc('them@their-example.com');
					$this->email->subject('Edit camp to CampsToGo.com');
					$message = '';
					$message = $message.'Thank for your interst!'."\n";
					$message = $message.'Your request is'."\n";
					$message = $message.'Camp Name'.$data['CampNameEdit']."\n";
					$message = $message.'URL '.$data['UrlEdit']."\n";
					$message = $message.'Message from  '.$data['NameEdit']."\n";
					$message = $message.'Contact is  '.$data['ContactEdit']."\n";
					$message = $message.'Your Message:  '.$data['CommentEdit']."\n";
					$this->email->message($message);
					$email=$this->email->send();
					$this->EmailToAdmin('Edit',$message);
					if (!$email) {
						 $result['state']='false';
						// echo json_encode($result);
					}
					else{$result['state']='true';}
        		}
        		//$result['state']='true';
				print(json_encode($result));
        }

        public function show($template = false)
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
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/codemirror/lib/codemirror.css");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/codemirror/theme/monokai.css");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/lib/codemirror.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootbox/bootbox.min.js");
              
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/mode/javascript/javascript.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/addon/edit/matchbrackets.js");
              // $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showConstants.js");
                $dir    = $_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/EmailTpl";
                $data['lang'] = ["ru","eng"];

                if ($template == false){
				$Tpls = scandir($dir);
				foreach($Tpls as $key=>$val){
					
					if(strlen($val)>2)
					{
						$val = substr($val,0,-5);
						$data['email_tpl'][]=$val;}
				}
              //$email_tpl = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/email_tpl.json");
              //$constants = json_decode($constants,true);
              

              //$data['email_tpl'] = $Tpls;
              //json_decode($email_tpl,true);
              
              $data['title'] = 'Просмотр шаблонов';
              $this->breadcrumb->add_crumb($data['title'], '/admin/email/show_admin');
              $this->load->view('templates/admin/include/head', $data);
              $this->load->view('templates/admin/include/header', $data);
              $this->load->view('templates/admin/include/breadcrumbs', $data);
              $this->load->view('templates/admin/include/sidebar', $data);
              $this->load->view('admin/Constants/show_tpl_emails', $data);
              $this->load->view('templates/admin/include/footer', $data);
              $this->load->view('templates/admin/include/javascript', $data);
                }
                else
                {
                	
        	$data['title'] = 'Просмотр шаблона '.$template;
        	$email_tpl = file_get_contents($dir.'/'.$template.".json");
        	$data['templateEdit'] = $template;
        	$data['email_tpl'] = json_decode($email_tpl);

        	$this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/EditTplEmail.js");
            $this->breadcrumb->add_crumb($data['title'], '/admin/email/show_admin/'.$template);
              $this->load->view('templates/admin/include/head', $data);
              $this->load->view('templates/admin/include/header', $data);
              $this->load->view('templates/admin/include/breadcrumbs', $data);
              $this->load->view('templates/admin/include/sidebar', $data);
              if($data['email_tpl'] == false){
              	print "<h4>В шаблоне ошибка в формате данных JSON</h4>";
	        	}
	        	else{$this->load->view('admin/Constants/show_tpl_email', $data);}
              
              $this->load->view('templates/admin/include/footer', $data);
              $this->load->view('templates/admin/include/javascript', $data);
                }
        }
        }
    

        public function save_Email_TPL($template = false)
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
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/codemirror/lib/codemirror.css");
              $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/codemirror/theme/monokai.css");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/lib/codemirror.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootstrap-selectsplitter/bootstrap-selectsplitter.min.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/bootbox/bootbox.min.js");
              
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/mode/javascript/javascript.js");
              $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/plugins/codemirror/addon/edit/matchbrackets.js");
              // $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/showConstants.js");
                $dir    = $_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/EmailTpl";
                $data['lang'] = ["ru","eng"];

                if ($template != false and !empty($this->input->post('data'))){
				$Tpls = scandir($dir);
				foreach($Tpls as $key=>$val){
					
					if(strlen($val)>2)
					{
						$val = substr($val,0,-5);
						$data['email_tpl'][]=$val;
						if ($val == $template) {
							$file = $dir.'/'.$template.'.json';
							$current = $this->input->post('data');
							if(file_put_contents($file, $current)){
								print(json_encode(['status'=>'success']));
								return;
							}
						}
					}
				}
              //$email_tpl = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/email_tpl.json");
              //$constants = json_decode($constants,true);
              

              //$data['email_tpl'] = $Tpls;
              //json_decode($email_tpl,true);
              
              
        }
        }
    
}
function renderView ($data){
			$constants = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/constans.json");
		    $constants = json_decode($constants,true);
		    $data['constants'] = $constants;
		    		$this->load->view('templates/yoga_template/head', $data);
		            $this->load->view('templates/yoga_template/header', $data);
		            $this->load->view('pages/email', $data);
		            $this->load->view('templates/yoga_template/footer', $data);
    }
}
