<?php
class Pablicus extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('ItemCard_model');
    $this->load->model('Staff_model');
    $this->load->model('Filter_model');
    $this->load->model('Menu_model');
    $this->load->model('News_model');
    $this->load->model('ImageControl_model');
    $this->load->model('Element_model');
    $this->load->model('Review_model');
    $this->load->model('Language_model');
    $this->load->helper('url_helper');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery-3.1.0.min.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery-2.0.2.min.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/bootstrap/js/bootstrap.min.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/jquery-ui/jquery-ui.min.js');
    $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/js/main.js');
    
    $this->data['page_level_plugin'][] =  array('src' => asset_url()."global/scripts/datatable.js");
    $this->data['page_level_plugin'][] = array('src' => asset_url()."global/plugins/typeahead/handlebars.min.js");
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.sticky.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/bootstrap-select.min.js');
    $this->data['page_level_script'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.bundle.min.js");
    $this->data['page_level_css'][] = array('src' => asset_url()."global/plugins/typeahead/typeahead.css");
    $this->data['page_level_script'][] =  array('src' => asset_url()."pages/scripts/search_form.js");
    $this->breadcrumb->add_crumb('Главная', '/admin/');
    $this->data['page_level_css'][] =  array('src' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/bootstrap/css/bootstrap.min.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/jquery-ui/jquery-ui.min.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/bootstrap-select.min.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/build.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/style.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/media.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/jquery.fancybox.css?v=2.1.5');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.css?v=1.0.5');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7');
          
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.stellar.min.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.placeholder.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.inputmask.bundle.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/js/jquery.mousewheel-3.0.6.pack.js');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/fancybox/jquery.fancybox.pack.js?v=2.1.5');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.js');
    $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-buttons.js?v=1.0.5');
    $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-media.js?v=1.0.6');
    $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7');
    $this->data['page_level_css'][] =  array('src' => asset_url().'global/plugins/intl-tel-input-master/build/css/intlTelInput.css');
    $this->data['page_level_plugin'][] =  array('src' => asset_url().'global/plugins/intl-tel-input-master/build/js/intlTelInput.js');
    //$this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/css/build.css');
    $this->data['page_level_css'][] =  array('src' => asset_url().'yoga_template/owl-carousel2/owl.carousel.css');
//    $this->data['page_level_css'][] =  array('src' => asset_url().'global/plugins/bootstrap-select/css/bootstrap-select.min.css');
//    $this->data['page_level_css'][] =  array('src' => asset_url().'global/plugins/bootstrap-select/js/bootstrap-select.min.js');
    $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/js/cookiePub.js');
  }

  public function view ($lang = false, $url = 'home')
  {

    $defaultLang = "ru";
    $data['menu'] = $this->Menu_model->get_menu(array(''));
    $menuElements =[];
    if($data['menu']!=false and $defaultLang!=$lang){
        foreach ($data['menu'] as $key => $value) {
            if ($value['id_element']) {
                $menuElements[]=$value['id_element'];
                if (isset($value['submenu'])) {
                    foreach ($value['submenu'] as $keySub => $valueSub) {
                        if ($valueSub['id_element']) {
                            $menuElements[]=$valueSub['id_element'];
                        }                    
                    }
                }
            }
        }
    
    $translate = $this->Language_model->getLanguage($menuElements, $lang);
        if($translate['status']!=false)
        {
                foreach ($data['menu'] as $key => $parent) {
                    foreach ($parent as $nameField => $value) {
                        if (!empty($translate[$parent['id_element']][$nameField])) {
                            
                            $data['menu'][$key][$nameField]=$translate[$parent['id_element']][$nameField];
                        }
                    }
                    if(!empty($data['menu'][$key]['submenu'])) {
                                foreach ($parent['submenu'] as $keySub => $submenu) {
                                    foreach ($submenu as $nameFieldSub => $valueSub) {
                                        if (!empty($translate[$submenu['id_element']][$nameFieldSub])) {
                                    $data['menu'][$key]['submenu'][$keySub][$nameFieldSub]=$translate[$submenu['id_element']][$nameFieldSub];
                                    }
                                }
                                }
                            }
                }
           
        }
    }
    //print_r($translate);
    $primeFilter = 
    [
    0=>$retVal = ($this->input->cookie('country', TRUE) and $this->input->cookie('country', TRUE)!= 'undefined') ? $this->input->cookie('country', TRUE) : '' ,
    1=>$retVal = ($this->input->cookie('region', TRUE) and $this->input->cookie('region', TRUE)!= 'undefined') ? $this->input->cookie('region', TRUE) : '' ,
    2=>$retVal = ($this->input->cookie('city', TRUE) and $this->input->cookie('city', TRUE)!= 'undefined') ? $this->input->cookie('city', TRUE) : '' ,
    ];
    
    $data['PrimeFilterFull'] = [];
    foreach ($primeFilter as $key => $value) {
        $data['PrimeFilterFull'][]['filter']=$value;
    }
    $data['PrimeFilterFull'] = $this->Filter_model->get_filters($data['PrimeFilterFull']);

    //print_r($data['PrimeFilterFull']);
    //берем все alias фильтров)
    $template_path = asset_url().'yoga_template/';
    //$filters = $this->Element_model->getFiltersAlias($primeFilter);
    $data['url'] = explode('/',uri_string());
    $countURL =count($data['url']);
    
    if($lang!='ru' and $lang!='eng'){ $url = $lang; $lang=$defaultLang;  }
    if($data['url'][0]==$lang){if($countURL>1){ $countURL = $countURL-1;} }
    if($lang == false){$lang=$defaultLang;}
    $data['lang'] = $lang;
    $data['element'] = $this->Element_model->getElementUrl($url);

    if($data['element']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($data['element']['id_element'], $lang);
        if($translate['status']!=false)
        {
            foreach ($translate[$data['element']['id_element']] as $key => $value) {
                $data['element'][$key] = $value;
            }
    }
        // print_r($translate);
         //print_r($data['element']);
    }
    $data['FilterCountry'] = $this->Filter_model->getFiltersByIdCat(93);
    
    $arrFilterCountry = [];
    foreach ($data['FilterCountry'] as $key => $value) {
        $arrFilterCountry[]=$value['id_element'];
    }
    if($data['FilterCountry']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($arrFilterCountry, $lang);
        if($translate['status']!=false)
        {
            foreach ($data['FilterCountry'] as $key => $parent) {
                    foreach ($parent as $nameField => $value) {
                        if (!empty($translate[$parent['id_element']][$nameField])) {
                            
                            $data['FilterCountry'][$key][$nameField]=$translate[$parent['id_element']][$nameField];
                        }
                    }
                    
                }
            }
        // print_r($translate);
         //print_r($data['element']);
    }
    $typeShow = '';
    $data['BaseUrl']='';
    $menuUrl  = ($data['url'][0]=='ru' or $data['url'][0]=='eng') ? 1 : 0 ;
   
 //print_r($menuUrl );
//print_r($data['element']);
    // if ($data['element']==false) {
    //   $typeShow = '';
    //   show_404();
    // }
    //print_r($data['url'][$countURL]);
    $retVal = (isset($data['url'][$countURL])) ? $data['url'][$countURL] : $data['url'][$countURL-1] ;
    $parent = $this->Menu_model->isParent($retVal,0);
       if($parent)
       {

        $arrElementMenu =$this->Menu_model->get_menu($parent); 
        $data['BaseUrl'][]=$arrElementMenu['alias'];
    }
    if ($countURL > 1) {
        //print($countURL);
        // для начала проверяем 1 элемент URL он должен быть коренным то есть parent=0 
        // для этого узнаем id_menu
       //print($data['url'][$menuUrl]);
        //Добавляем primeFilter если существует 
    $primeFilterInMenu = [];
    $countPrimeFilter=($menuUrl) ? count($primeFilter)+1 : count($primeFilter) ;
    foreach ($primeFilter  as $key => $value) {
        for ($i=1; $i < $countPrimeFilter; $i++) { 
            if(!empty($data['url'][$i])){
            if($value==$this->Filter_model->isFilter($data['url'][$i])){
               
                $primeFilterInMenu[]=$data['url'][$i];}
        }
    }
    }
    $menuUrl  = (!empty($primeFilterInMenu)) ? $menuUrl+count($primeFilterInMenu) : $menuUrl ;
        $parent = $this->Menu_model->isParent($data['url'][$menuUrl],0);

       if($parent)
       {
        $data['BaseUrl']='';
        $arrElementMenu =$this->Menu_model->get_menu($parent); 
        $data['BaseUrl'][]=$arrElementMenu['alias'];
        //Второй алиас может быть либо подменю  
        
        $secondMenu = $this->Menu_model->isParent($data['url'][$menuUrl],$parent);
print_r($data['url'] );
        if(!$secondMenu)
        {

            //либо фильтром в этом меню. Выберем все фильтры принадлежащие 1 меню.
            $filtersByMenu = $this->Filter_model->getFilterOnPageByMenu($parent);
                    if(!$filtersByMenu){show_404();}
            //print_r($filtersByMenu);
            $typeShow = 'menu';
        }
        else{
            $data['element'] = $this->Element_model->getElementUrl($data['url'][$menuUrl+1]);
            $arrElementMenu =$this->Menu_model->get_menu($secondMenu); 
            $data['BaseUrl'][]=$arrElementMenu['alias'];
            //если 2 алиас подменю,тогда следующий алиас должен быть точно фильтром
            $filtersByMenu = $this->Filter_model->getFilterOnPageByMenu($secondMenu);
            
            //если их нет, то 404 потому как запрос не верен.
            if(!$filtersByMenu){show_404();}

            if ($countURL>2) {
                for ($i=2; $i < $countURL; $i++) { 
                    $outBreak = 0;
                    
                    foreach ($filtersByMenu as $key => $value) {
                        foreach ($value['filters'] as $key2 => $value2) {
                            if($data['url'][$i]==$value2['alias']){
                                $outBreak = 1;
                                //print('Вышел');
                             break;}
                             
                        }
                         
                    }
                    if ($outBreak==0) {

                        show_404();
                    }
                }
            }

            $typeShow = 'menu';
        }

       }
            if ($data['url'][1]=="tag") {
                $typeShow = 'tag';
            }

    }
    else{
        if ($data['element']==false){ show_404(); }
        if (isset($data['element']['idPage'])) {$typeShow ='page';}//print('HEY');
        if (isset($data['element']['id_filter']))  {$typeShow ='filter';}
        if (isset($data['element']['idfilter_cat']))  {$typeShow ='filter_cat';}
        if (isset($data['element']['id_menu']))  {$typeShow ='menu';

         $parent = $this->Menu_model->isParent($data['url'][$countURL],0);
         // $data['element']['id_menu']=$secondMenu;
         //print('HEY');
         $filtersByMenu = $this->Filter_model->getFilterOnPageByMenu($parent);
         if ($url=='news') {
             $typeShow ='news' ;
                     }
        }
        if (isset($data['element']['id_post']))  {$typeShow ='card';}
        if (isset($data['element']['id_cat']))  {$typeShow ='news_cat';}
        if (isset($data['element']['id_news']))  {$typeShow ='news-item';}
        if (isset($data['element']['id_tag']))  {$typeShow ='tag';}
        if (isset($data['element']['id_staff']))  {$typeShow ='staff';}

        // if (isset($data['element']['news_cat']))  {$typeShow ='doc';}

    }
            
        
    
    
    $data['typeShow'] = $typeShow;

  // print($typeShow);
    switch ($typeShow) {
          case 'page':

                    $data['header_menu'] = $this->Filter_model->get_cats_header();
                    //print_r($data['header_menu']);
                    

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
                    
                    switch ($url) {
                    case 'home':
                    $data['header_search'] = 1;
                    $this->load->view('templates/yoga_template/header', $data);
                    $data['slider_top'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone'],false,false,true,false,$primeFilter);
                   $data['slider_mesta'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone','filter.h1'],239,false,true,false,$primeFilter);
                  $data['slider_merop'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone','filter.h1'],225,false,true,false,$primeFilter);

                  $this->load->view('pages/home', $data);
                        break;
                    case 'news':
                    
                      //   $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/loadNews.js');
                      //   $data['contentBlockClass'] = 'news-page';
                      //   $data['HeaderBaner'] = 1;
                      //  // $data['clearPage'] = 0;
                      //   //$data['filter'] = $this->Filter_model->getFilterOnPage(true);
                      //   $data['news']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description');

                      // $this->load->view('templates/campstogo/head', $data);
                      // //$this->load->view('templates/campstogo/header', $data);
                      // $data['breadCrumb'][] =['link'=>$data['element']['alias'],'text'=>$data['element']['h1']]; 
                      // $this->load->view('pages/news', $data);
                            break;
                            default:
                            $this->load->view('templates/yoga_template/header', $data);
                      $this->load->view('pages/clear', $data);
                      break;
                  }
                    $this->load->view('templates/yoga_template/footer', $data);
                    
            break;
          case 'filter':
            $data['header_menu'] = $this->Filter_model->get_cats_header();
            $data['filter'] = $this->Filter_model->getFilterOnPage();
            $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
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
            
            $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
            
            
            
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
            
            //print_r($data['url']);
            //$data['header_menu'] = $this->Filter_model->get_cats_header();
            //$data['url'] = explode('/',$url);
            //$data['filter'] = $this->Filter_model->getFilterOnPageByMenu($data['element']['id_menu']);
            $data['filter'] = $filtersByMenu;
            //print_r($data['filter']);
            $arrFilterSmart=[];
            if($data['filter']!=false and $defaultLang!=$lang){
                foreach ($data['filter'] as $key => $value) {
                    if ($value['id_element']) {
                        $arrFilterSmart[]=$value['id_element'];
                        if (isset($value['filters'])) {
                            foreach ($value['filters'] as $keySub => $valueSub) {
                                if ($valueSub['id_element']) {
                                    $arrFilterSmart[]=$valueSub['id_element'];
                                }                    
                            }
                        }
                    }
                }

            $translate = $this->Language_model->getLanguage($arrFilterSmart, $lang);
                if($translate['status']!=false)
                {
                        foreach ($data['filter'] as $key => $parent) {
                            foreach ($parent as $nameField => $value) {
                                if($nameField == 'cat' and !empty($translate[$parent['id_element']]['h1'])){$data['filter'][$key][$nameField]=$translate[$parent['id_element']]['h1'];}
                                if (!empty($translate[$parent['id_element']][$nameField])) {
                                    
                                    $data['filter'][$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                }
                            }
                            if(!empty($data['filter'][$key]['filters'])) {
                                        foreach ($parent['filters'] as $keySub => $filters) {
                                            foreach ($filters as $nameFieldSub => $valueSub) {
                                                if($nameFieldSub == 'filter' and !empty($translate[$filters['id_element']]['h1'])){
                                                    $data['filter'][$key]['filters'][$keySub][$nameFieldSub]=$translate[$filters['id_element']]['h1'];}
                                                if (!empty($translate[$filters['id_element']][$nameFieldSub])) {
                                            $data['filter'][$key]['filters'][$keySub][$nameFieldSub]=$translate[$filters['id_element']][$nameFieldSub];
                                            }
                                        }
                                        }
                                    }
                        }
                   
                }
            }
        //     $data['element'] = $this->Element_model->getElementUrl($data['url'][$countURL]);
        //     if($data['element']!=false and $defaultLang!=$lang){
        
        //         $translate = $this->Language_model->getLanguage($data['element']['id_element'], $lang);
        //         if($translate['status']!=false)
        //         {
        //             foreach ($translate[$data['element']['id_element']] as $key => $value) {
        //                 $data['element'][$key] = $value;
        //             }
        //     }
        // }
            // $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
            // $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
            //print_r($data['element']);
            if (isset($data['element']['id_menu']) and $countURL == count($data['BaseUrl'])) {
                // print($countURL);
                // print(count($data['BaseUrl']));
                    $data['pagination']['pageNum'] = $this->input->get('page');
                    if (!empty($data['pagination']['pageNum'])) {

                       $data['elements'] = $this->Element_model->getCardsByMenu($data['element']['id_menu'],$data['pagination']['pageNum'],12);

                       
                       $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12) ;
                            $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
                    }
                    else{

                       // print($data['element']['id_menu']);
                   $data['elements'] = $this->Element_model->getCardsByMenu($data['element']['id_menu']);
                   $arrFilterPageElements = [];
    foreach ($data['elements'] as $key => $value) {
        $arrFilterPageElements[]=$value['id_element'];
    }
    if($data['elements']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($arrFilterPageElements, $lang);
        if($translate['status']!=false)
        {
            

            foreach ($data['elements'] as $key => $parent) {
                //print_r($parent);
                    if(is_array($parent)){
                    foreach ($parent as $nameField => $value) {
                        if (!empty($translate[$parent['id_element']][$nameField]) ) {
                            
                            $data['elements'][$key][$nameField]=$translate[$parent['id_element']][$nameField];
                        }
                    }
                    }
                }
            }
        // print_r($translate);
         //print_r($data['element']);
    }
                  // print_r($data['element']);
                   $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                            $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
               }
            }
            else{

                    $data['pagination']['pageNum'] = intval($this->input->get('page'));
                    //print_r($this->Element_model->getFiltersIdByAlias($data['url']));
                    
                    $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
                    print_r($data['elements']);
                        if (!empty($data['pagination']['pageNum'])) {
                            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements'],$data['pagination']['pageNum'],12);
                            $arrFilterPageElements = [];
    foreach ($data['elements'] as $key => $value) {
        $arrFilterPageElements[]=$value['id_element'];
    }
    if($data['elements']!=false and $defaultLang!=$lang){
        $translate = $this->Language_model->getLanguage($arrFilterPageElements, $lang);
        if($translate['status']!=false)
        {
            foreach ($data['elements'] as $key => $parent) {
                    if(is_array($parent)){
                    foreach ($parent as $nameField => $value) {
                        if (!empty($translate[$parent['id_element']][$nameField]) ) {
                            $data['elements'][$key][$nameField]=$translate[$parent['id_element']][$nameField];
                        }
                    }
                    }
                }
            }
    }
                            $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                            $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
                        }
                        else{

                $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
                print_r($data['elements']);
                $arrFilterPageElements = [];
    foreach ($data['elements'] as $key => $value) {
        $arrFilterPageElements[]=$value['id_element'];
    }
    if($data['elements']!=false and $defaultLang!=$lang){
        $translate = $this->Language_model->getLanguage($arrFilterPageElements, $lang);
        if($translate['status']!=false)
        {
            foreach ($data['elements'] as $key => $parent) {
                    if(is_array($parent)){
                    foreach ($parent as $nameField => $value) {
                        if (!empty($translate[$parent['id_element']][$nameField]) ) {
                            
                            $data['elements'][$key][$nameField]=$translate[$parent['id_element']][$nameField];
                        }
                    }
                    }
                }
            }
    }
                $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
                
            }
        }
            
            
            
            
            
            $data['title'] = 'Страница фильтрации';
            
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/filterOnSite.js');
            $this->load->view('pages/filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'card':
            $data['url'] = explode('/',$url);
            $data['item']=$data['element'];
            $data['item']['gallery'] = $this->ImageControl_model->get_images_card($data['item']['id_post']);
            $arFiltersId = $this->Filter_model->getFiltersIdByIdCard($data['item']['id_post']);
            $data['item']['filters'] = $this->Filter_model->get_filter_all_idCard($data['item']['id_post']);
            $data['item']['slider_like'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone','item_card.h1'],false,false,true,false,$primeFilter);
            $data['item']['review'] = $this->Review_model->get_reviews($data['item']['id_post'],true);
            $data['item']['staff'] = $this->Staff_model->get_staff_all_page($data['item']['id_post']);
            $data['header_menu'] = $this->Filter_model->get_cats_header();
            
            
           
            $this->data['page_level_script'][] =  array('src' => asset_url().'yoga_template/js/card.js');
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/card', $data['item']);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'news':
            
            $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/loadNews.js');
            $data['contentBlockClass'] = 'news-page';
            $data['HeaderBaner'] = 1;
           // $data['clearPage'] = 0;  
            //$data['filter'] = $this->Filter_model->getFilterOnPage(true);
            //$data['News_cats'] = $this->News_model->get_news_cat();
            $data['news_new']=$this->News_model->get_news_all(FALSE, false, true,0,6,false);
            $NewsElements =[];
    if($data['news_new']!=false and $defaultLang!=$lang){
        foreach ($data['news_new'] as $key => $value) {
            if ($value['id_element']) {
                $NewsElements[]=$value['id_element'];
                if (isset($value['news'])) {
                    foreach ($value['news'] as $keyNews => $valueNews) {
                        if ($valueNews['id_element']) {
                            $NewsElements[]=$valueNews['id_element'];
                                        if (isset($valueNews['tags'])) {
                                            
                                foreach ($valueNews['tags'] as $keyNewsTag => $valueNewsTag) {
                                    if ($valueNewsTag['element']) {
                                        $NewsElements[]=$valueNewsTag['element'];
                                    }                    
                                }
                            }
                        }                    
                    }
                }
            }
        }
            $translate = $this->Language_model->getLanguage($NewsElements, $lang);
        if($translate['status']!=false)
        {
            foreach ($data['news_new'] as $key => $parent) {
                    foreach ($parent as $nameField => $value) {
                        if (!empty($translate[$parent['id_element']][$nameField])) {
                            
                            $data['news_new'][$key][$nameField]=$translate[$parent['id_element']][$nameField];
                        }
                    }
                    if(!empty($data['news_new'][$key]['news'])) {
                                foreach ($parent['news'] as $keyNews => $news) {
                                    foreach ($news as $nameFieldNews => $valueNews) {
                                        if (!empty($translate[$news['id_element']][$nameFieldNews])) {
                                    $data['news_new'][$key]['news'][$keyNews][$nameFieldNews]=$translate[$news['id_element']][$nameFieldNews];

                                    }
                                }
                                if(!empty($data['news_new'][$key]['news'][$keyNews]['tags'])) {
                                            foreach ($news['tags'] as $keyTags => $tags) {
                                                foreach ($tags as $nameFieldNewsTag => $valueNewsTag) {
                                                    if (!empty($translate[$tags['element']][$nameFieldNewsTag])) {
                                                $data['news_new'][$key]['news'][$keyTags][$nameFieldNewsTag]=$translate[$tags['element']][$nameFieldNewsTag];

                                                }
                                            }
                                            }
                                        }
                                }
                            }

                }
            
    }
}
           // $data['news']=$this->News_model->get_news();
           

            

            $data['item']=$this->Element_model->getElementUrl($url);
            if($data['item']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($data['item']['id_element'], $lang);
        if($translate['status']!=false)
        {
            foreach ($translate[$data['item']['id_element']] as $key => $value) {
                $data['item'][$key] = $value;
            }
    }
}
            $data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/news', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'tag':
            
            $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/loadNews.js');
            $data['contentBlockClass'] = 'news-page';
            $data['HeaderBaner'] = 1;
           // $data['clearPage'] = 0;  
            //$data['filter'] = $this->Filter_model->getFilterOnPage(true);
            $data['News_cats'] = $this->News_model->get_news_cat();
           // $data['news']=$this->News_model->get_news();
            $data['news_new']=$this->News_model->get_news_all(FALSE, false, true,0,6,false);
            $data['news_new_tag']=$this->News_model->get_news_by_tag($data['url'][2], false, true,0,6,false);
            $data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $data['item']=$this->Element_model->getElementUrl($url);
            if($data['item']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($data['item']['id_element'], $lang);
        if($translate['status']!=false)
        {
            foreach ($translate[$data['item']['id_element']] as $key => $value) {
                $data['item'][$key] = $value;
            }
    }
}
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/newsTags', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'news-item':
            $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/loadNews.js');
            $data['contentBlockClass'] = 'news-page';
            $data['HeaderBaner'] = 1;
           // $data['clearPage'] = 0;  
            //$data['filter'] = $this->Filter_model->getFilterOnPage(true);
            $data['News_cats'] = $this->News_model->get_news_cat();
            $data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $data['item']=$this->Element_model->getElementUrl($url);
            if($data['item']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($data['item']['id_element'], $lang);
        if($translate['status']!=false)
        {
            foreach ($translate[$data['item']['id_element']] as $key => $value) {
                $data['item'][$key] = $value;
            }
    }
}
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/item-news', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'staff':
            $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/loadNews.js');
            $data['contentBlockClass'] = 'news-page';
            $data['HeaderBaner'] = 1;
           // $data['clearPage'] = 0;  
            //$data['filter'] = $this->Filter_model->getFilterOnPage(true);
            $data['News_cats'] = $this->News_model->get_news_cat();
            $data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $data['item']=$this->Element_model->getElementUrl($url);
            if($data['item']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($data['item']['id_element'], $lang);
        if($translate['status']!=false)
        {
            foreach ($translate[$data['item']['id_element']] as $key => $value) {
                $data['item'][$key] = $value;
            }
    }
}
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/item-staff', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'news_cat':
          $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/loadNews.js');
            // $data['contentBlockClass'] = 'news-page';
           // $data['HeaderBaner'] = 1;
           // $data['clearPage'] = 0;  
            //$data['filter'] = $this->Filter_model->getFilterOnPage(true);
            $data['News_cats'] = $this->News_model->get_news_cat();
                       // $data['news']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $data['item']=$this->Element_model->getElementUrl($url);
            if($data['item']!=false and $defaultLang!=$lang){
        
        $translate = $this->Language_model->getLanguage($data['item']['id_element'], $lang);
        if($translate['status']!=false)
        {
            foreach ($translate[$data['item']['id_element']] as $key => $value) {
                $data['item'][$key] = $value;
            }
    }
}
            $data['news']=$this->Element_model->getCategoryNewsByIdCat($data['item']['id_cat']);
            $data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/news-cat', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          
          default:
          
            $this->load->view('pages/zaglushka');
            break;
        }    
    //     if ($url =='home') {
    //                 return;
    // }

  	if ($url === false or 'index.html') {
        
  	}
     // elseif (in_array($url,$filters)) {
      
     //  $filters = explode ('/',uri_string());
     //  $cards = $this->Element_model->getCardsByFilter($filters);
     //  $output = $this->Element_model->getItems($cards);

     // }
     else {
       
  		// set the flash data error message if there is one
                    $this->data['page_level_script'][]= array('src' => asset_url()."pages/scripts/createPageForm.js");
                    

                    //print(uri_string());
                    $data['element'] = $this->Element_model->getElementUrl(uri_string());
                    if($data['element']!=false and $defaultLang!=$lang){
                        $translate = $this->Language_model->getLanguage($data['element']['id_element'], $lang);
                        if($translate['status']!=false)
                        {
                            foreach ($translate[$data['element']['id_element']] as $key => $value) {
                                $data['element'][$key] = $value;
                            }
                    }
                }
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
      $data['pagination']['countPages']ation = [page=int,howMuch=int];
      
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


    }
  }

