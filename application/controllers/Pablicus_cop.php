<?php
class Pablicus extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ItemCard_model');
    $this->load->model('Staff_model');
    $this->load->model('Filter_model');
    $this->load->model('Menu_model');
    $this->load->model('ImageControl_model');
    $this->load->model('Element_model');
    $this->load->model('Review_model');
    $this->load->helper('url_helper');

    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/typeahead/handlebars.min.js");
    //$this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.sticky.js');
    $this->data['page_level_script'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js");
    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
    $this->data['page_level_script'][] =  array('src' => asset_url()."pages/scripts/search_form.js");
    $this->breadcrumb->add_crumb('Главная', '/admin/');
  }

  public function view ($url = false)
  {

    $primeFilter = 'vozrast';
    //берем все alias фильтров
    $template_path = asset_url().'yoga_template/';
    $filters = $this->Element_model->getFiltersAlias($primeFilter);
    $data['url'] = explode('/',uri_string());
    $data['element'] = $this->Element_model->getElementUrl(uri_string());
    $typeShow = '';
    
    // if ($data['element']==false) {
    //   $typeShow = '';
    //   show_404();
    // }
    if (count($data['url']) > 1) {
        if ($data['element']==false){
        $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
        print_r($data['elements']);
            if (!empty($data['elements'])) {
                $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
                $typeShow = 'filter';
            }
            else{show_404();}
        }
        
      
    }

    if (isset($data['element']['idPage'])) {$typeShow ='page';}
    if (isset($data['element']['id_filter']))  {$typeShow ='filter';}
    if (isset($data['element']['idfilter_cat']))  {$typeShow ='filter_cat';}
    if (isset($data['element']['id_menu']))  {$typeShow ='menu';}
    if (isset($data['element']['id_post']))  {$typeShow ='card';}
    if (isset($data['element']['id_news']))  {$typeShow ='news';}
    if (isset($data['element']['news_cat']))  {$typeShow ='news_cat';}
    if (isset($data['element']['news_cat']))  {$typeShow ='doc';}
    $data['typeShow'] = $typeShow;
   print($typeShow);
    switch ($typeShow) {
          case 'page':

                    $data['header_menu'] = $this->Filter_model->get_cats_header();
                    //print_r($data['header_menu']);
                    $data['menu'] =$this->Menu_model->get_menu(array(''));

                    $data['h1'] = (!empty($data['element']['h1'])) ? $data['element']['h1'] : '' ;
                    $data['title'] =  (!empty($data['element']['h1'])) ? $data['element']['h1'] : '' ;
                    $data['keywords'] = (!empty($data['element']['meta_keywords'])) ? $data['element']['meta_keywords']:'';
                    $data['description'] = (!empty($data['element']['description'])) ? $data['element']['description']:'';
                    $data['body'] = (!empty($data['element']['body'])) ? $data['element']['body']:'';

                    $plugins = explode ( '
' , $data['element']['plugin']);
                    foreach ($plugins as $key => $value) {
                      $this->data['page_level_plugin'][] =  array('src' => $template_path.$value);
                    }
                    $scripts = explode ( '
' , $data['element']['js']);
                    foreach ($scripts as $key => $value) {
                      $this->data['page_level_script'][] =  array('src' => $template_path.$value);
                    }
                    $css = explode ( '
' , $data['element']['css']);
                    foreach ($css as $key => $value) {
                      $this->data['page_level_css'][] =  array('src' => $template_path.$value);
                    }
                    //print_r($data['page_level_plugin']);
                    $this->breadcrumb->add_crumb('Главная', '/');
                    $this->load->view('templates/yoga_template/head', $data);
                    // $this->load->view('templates/yoga_template/header', $data);
                    if ($url == 'home.php') {
                        $data['header_search'] = 1;
                        $this->load->view('templates/yoga_template/header', $data);
                      $data['slider_top'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date','item_card.alias','item_card.telephone'],false,false,true);
                      $data['slider_mesta'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date','item_card.alias','item_card.telephone','filter.h1'],40,false,true);
                      $data['slider_merop'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date','item_card.alias','item_card.telephone','filter.h1'],41,false,true);

                      $this->load->view('pages/home', $data);
                    }
                    else{
                        $this->load->view('templates/yoga_template/header', $data);
                      $this->load->view('pages/clear', $data);
                    }
                    $this->load->view('templates/yoga_template/footer', $data);
                    
            break;
          case 'filter':
            $data['header_menu'] = $this->Filter_model->get_cats_header();
            $data['filter'] = $this->Filter_model->getFilterOnPage();
            $data['menu'] =$this->Menu_model->get_menu(array(''));
            $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);

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
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.js');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7');
            $data['title'] = 'Страница фильтрации';
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            // if (empty($data['elements'])) {
            //             show_404();
            //         }
            break;
          case 'filter_cat':

            $data['header_menu'] = $this->Filter_model->get_cats_header();
            $data['url'] = explode('/',$url);
            $data['filter'] = $this->Filter_model->getFilterOnPage();
            $data['menu'] =$this->Menu_model->get_menu(array(''));
            $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
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
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.js');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7');
            $data['title'] = 'Страница фильтрации';
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            // if (empty($data['elements'])) {
            //             show_404();
            //         }
            break;
          case 'menu':
            $data['header_menu'] = $this->Filter_model->get_cats_header();
            $data['url'] = explode('/',$url);
            $data['filter'] = $this->Filter_model->getFilterOnPageByMenu($data['element']['id_menu']);
            
            $data['menu'] =$this->Menu_model->get_menu(array(''));
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
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.js');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7');
            $data['title'] = 'Страница фильтрации';
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'card':
            $data['url'] = explode('/',$url);
            $data['item']=$this->Element_model->getElementUrl($data['url'][0]);
            $data['item']['gallery'] = $this->ImageControl_model->get_images_card($data['item']['id_post']);
            $arFiltersId = $this->Filter_model->getFiltersIdByIdCard($data['item']['id_post']);
            $data['item']['filters'] = $this->Filter_model->get_filter_all_idCard($data['item']['id_post']);
            $data['item']['slider_like'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date','item_card.alias','item_card.telephone','item_card.h1'],false,false,true);
            $data['item']['review'] = $this->Review_model->get_reviews($data['item']['id_post'],true);
            $data['item']['staff'] = $this->Staff_model->get_staff_all_page($data['item']['id_post']);
            $data['header_menu'] = $this->Filter_model->get_cats_header();
            $this->data['page_level_css'][] =  array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/bootstrap/css/bootstrap.min.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/jquery-ui/jquery-ui.min.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/build.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/style.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/media.css');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/jquery.fancybox.css?v=2.1.5');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7');
            $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.css');
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
            $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.js');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7');
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/js/card.js');
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/card', $data['item']);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'news':
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/news', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'news_cat':
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/news_filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          
          default:
            print($url);
           // print_r($data['element']);
            $this->load->view('pages/zaglushka');
            break;
        }    
        if ($url =='home.php') {
                    return;
    }

  	if ($url === false or 'index.html') {
  		              //$this->load->view('templates/header');
                    //$this->load->view('pages/zaglushka');
                    //$this->load->view('templates/footer');
  	}
     elseif (in_array($url,$filters)) {
      
      $filters = explode ('/',uri_string());
     // print_r($filters);
      $cards = $this->Element_model->getCardsByFilter($filters);
      $output = $this->Element_model->getItems($cards);
      //print_r($output);
      //print_r($this->$data['elements']);
      // $this->load->view('templates/header', $data);
      // $this->load->view('pages/home', $data);
      // $this->load->view('templates/footer', $data);

     }
     else {
       
  		// set the flash data error message if there is one
                    $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createPageForm.js");
                    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");

                    //print(uri_string());
                    $data['element'] = $this->Element_model->getElementUrl(uri_string());

                    $data['title'] =  $data['element']['h1'];
                    $this->breadcrumb->add_crumb('Создание страницы', '/admin/Pages/create');
                    
                    
                    $this->load->view('templates/header', $data);
                    $this->load->view('pages/home', $data);
                    $this->load->view('templates/footer', $data);
  	}
  	}
    public function show_items($what = false)
    {
      /*
      $sort = asc;
      $sortField = field;
      $pagination = [page=int,howMuch=int];
      
       */
      $sort = (isset($_POST['sort'])) ? $_POST['sort'] : false ;
      $sortfield = (isset($_POST['sortfield'])) ? $_POST['sortfield'] : false ;

      //$fields = (isset($_POST['fields'])) ? $_POST['fields'] : false ;
      $pagination = (isset($_POST['pagination'])) ? $_POST['pagination'] : false ;
      //$howMuch = (isset($_POST['howMuch'])) ? $_POST['howMuch'] : false ;
      $sortField=explode(' ',$sortField);
      $sort=explode(' ',$sort);
      $sortField=$sortField[0];
      $sort=$sort[0];

      // switch ($what) {
      //   case 'card':
      //     //$result = $this->ItemCard_model->get
      //     break;
        
      //   default:
      //     # code...
      //     break;
      

    }
  }

