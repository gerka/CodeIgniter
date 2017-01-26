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
    $this->data['page_level_scripting'][] =['value' => ''];
  }
  public function getRelationFilter($idParentFilter = false,$lang = false)
          {
               // Обязательные формы для заполнения карточки товара
           if ($idParentFilter!==false) {
            $relationFilter = $this->Filter_model->getRelationFilter($idParentFilter);
             
              if ($lang!=false and $lang!='ru') {
                              $arrrelationFilter = [];
                foreach ($relationFilter as $key => $value) {
                    $arrrelationFilter[]=$value['id_element'];
                }
                if($relationFilter!=false){
                    
                    $translate = $this->Language_model->getLanguage($arrrelationFilter, $lang);
                    if($translate['status']!=false)
                    {
                        foreach ($relationFilter as $key => $parent) {
                                foreach ($parent as $nameField => $value) {
                                    if (!empty($translate[$parent['id_element']][$nameField])) {
                                        
                                        $relationFilter[$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                    }
                                }
                                
                            }
                        }
                    
                }
              }
               return($relationFilter);
           }

           else{return(array('type'=>'warning'));}
              
              
          }
  public function view ($lang = false, $url = 'home')
  {
    $constants = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/assets/yoga_template/constans.json");
    $constants = json_decode($constants,true);
    $data['constants'] = $constants;
    $template_path = asset_url().'yoga_template/';
    $defaultLang = "ru";
    $langs = ["ru","eng"];

    if(!in_array($lang, $langs)){ $url = $lang; $lang=$defaultLang;  }
    $data['lang'] = $lang;
    $data['url'] = explode('/',uri_string());
    $countRealURL = count($data['url']);
    $countURL = $countRealURL;
    if($data['url'][0]==$lang){if($countURL>0){ $countURL = $countURL-1;} }

    //смотрим и запускаем сессию
    $this->session;
    if (isset($_SESSION['PrimeFilter']['country']) and $_SESSION['PrimeFilter']['country']!=0 ) {
        $PrimeFilter = $_SESSION['PrimeFilter'];
       $data['regionAppend'] = $this->getRelationFilter($_SESSION['PrimeFilter']['country'],$lang);
       if (isset($_SESSION['PrimeFilter']['region']) and $_SESSION['PrimeFilter']['region']!=0 ) { $data['cityAppend'] = $this->getRelationFilter($_SESSION['PrimeFilter']['region'],$lang);}
      // if(!empty($data['regionAppend'])){print_r($data['regionAppend']);}
        //print_r($PrimeFilter);
    } else {
        $newdata = ['PrimeFilter'=>['city'=>0,'region'=>0,'country'=>0 ],'lang'=>$lang];
        $this->session->set_userdata($newdata);    

        }
    //unset($_SESSION['PrimeFilter']);
    
    // старый Prime заменяем 
    
$primeFilter = 
    [
    0=>$retVal = ($this->input->cookie('country', TRUE) and $this->input->cookie('country', TRUE)!= 'undefined') ? $this->input->cookie('country', TRUE) : '' ,
    1=>$retVal = ($this->input->cookie('region', TRUE) and $this->input->cookie('region', TRUE)!= 'undefined') ? $this->input->cookie('region', TRUE) : '' ,
    2=>$retVal = ($this->input->cookie('city', TRUE) and $this->input->cookie('city', TRUE)!= 'undefined') ? $this->input->cookie('city', TRUE) : '' ,
    ];
    $NumUrlElement = $countRealURL - $countURL;
    $data['PrimeFilterFull'] = [];
    foreach ($primeFilter as $key => $value) {
        if($value!=''){
        $data['PrimeFilterFull'][]['filter']=$value;}
    }

    $data['PrimeFilterFull'] = $this->Filter_model->get_filters($data['PrimeFilterFull']);
    if(!empty($data['PrimeFilterFull'])){
    foreach ($data['PrimeFilterFull'] as $key => $value) {
        $key = 0;
        if(!empty($data['url'][$NumUrlElement+$key])){
        if(in_array_r($data['url'][$NumUrlElement+$key],$data['PrimeFilterFull'],'alias')){ $countURL = $countURL-1;}else{
            $tempElement = $this->Element_model->getElementUrl($data['url'][$NumUrlElement+$key]);
            if (!is_array($tempElement)) {
               show_404();
            }
            else{
                
                if(!empty($tempElement['id_filter'])){$countURL = $countURL-1;}
                }
        }

    }
        $key++;
    }
}
//print($NumUrlElement);
$NumUrlElement = $countRealURL - $countURL; //id url из data['url'][ id url ], с которого начинается счет. (пропуская язык или primeFilter)
//print($NumUrlElement);
    $data['menu'] = $this->Menu_model->get_menu(array('')); 
    $data['menu'] = $this->TranslateElements('menu',$data['menu'],$defaultLang,$lang); //функция перевода меню
    if(!empty($data['url'][$NumUrlElement]))
        {
            $urlElement = $data['url'][$NumUrlElement];
            $urlLastElement = $data['url'][$countRealURL - 1];
        }
    else{

        show_404();
        $urlElement = 'home';
        $urlLastElement = $urlElement;
        $url = $urlElement;
    }
    //$urlElement = $data['url'][$NumUrlElement]; //Url элемента с которого начинается счет
    
     // print($NumUrlElement);
     // print('<br>');
     // print($urlElement);
     // print('<br>');
     // print($url);
     // print($urlLastElement);
     // 
     $lastElement = $this->Element_model->getElementUrl($urlLastElement);

//print_r($lastElement);
    $data['element'] = $this->Element_model->getElementUrl($urlElement);


    $data['element'] = $this->TranslateElements('element',$data['element'],$defaultLang,$lang);
    
    $data['FilterCountry'] = $this->Filter_model->getFiltersByIdCat(93);
    $data['FilterCountry'] = $this->TranslateElements('filterCat',$data['FilterCountry'],$defaultLang,$lang);
   // print_r($data['FilterCountry']);
    $typeShow = '';
    $data['BaseUrl']=[];
    //$data['BaseUrl'][]=$lang;
    //Проверяем меню
    if (isset($lastElement['idPage'])) {$typeShow ='page';}//print('HEY');
    if (isset($lastElement['id_news']))  {$typeShow ='news-item';}
    if (isset($lastElement['id_staff']))  {$typeShow ='staff';}
    if (isset($lastElement['id_post']))  {$typeShow ='card';}

if($typeShow == ""){
    if (!empty($data['element']['id_menu'])) {
        

    $parent = $this->Menu_model->isParent($urlElement,0);
       if($parent and $urlElement!='news')
       {
        $arrElementMenu =$this->Menu_model->get_menu($parent); 
        $data['BaseUrl'][]=$arrElementMenu['alias'];
        //Второй алиас может быть либо подменю  
        if(!empty($data['url'][$NumUrlElement+1])){
        $secondMenu = $this->Menu_model->isParent($data['url'][$NumUrlElement+1],$parent);

        if(!$secondMenu)
        {
            //либо фильтром в этом меню. Выберем все фильтры принадлежащие 1 меню.
            $filtersByMenu = $this->Filter_model->getFilterOnPageByMenu($parent);

            if(empty($filtersByMenu)){ 

show_404();}
            foreach ($filtersByMenu as $key => $value) {
                $out = 0;
                if(!empty($value['filters'])){

                    if(in_array_r($data['url'][$NumUrlElement+1],$value['filters'],'alias')){ $out = 1; break;}
                }
                }
                if (!$out and $urlLastElement!='all' ) {

                    show_404();
                }
                else{
                    $typeShow = 'filter';
                }
                
        }
        else{
            // $data['element'] = $this->Element_model->getElementUrl($data['url'][$menuUrl+1]);
            $arrElementMenu =$this->Menu_model->get_menu($secondMenu); 
            $data['BaseUrl'][]=$arrElementMenu['alias'];
            //если 2 алиас подменю,тогда следующий алиас должен быть точно фильтром
            //print($secondMenu);
            $filtersByMenu = $this->Filter_model->getFilterOnPageByMenu($secondMenu);
            //print($secondMenu); 
            // print_r($filtersByMenu);
            //если их нет, то 404 потому как запрос не верен.
            // if(!$filtersByMenu){
            //     print('HEY2'); 
            //     show_404();}  

            if(!empty($data['url'][$NumUrlElement+2])){
                for ($i=$NumUrlElement+2; $i < $countRealURL; $i++) { 
                    
                        foreach ($filtersByMenu as $key => $value) {
                    $out = 0;
                    if(!empty($value['filters'])){

                        if(in_array_r($data['url'][$i],$value['filters'],'alias')){ $out = 1;
                             break;}
                    }
                    }
                }
                if (!$out) {
                    show_404();
                }
                else{
                    
                    $typeShow = 'filter';

                }
         }   
         else{$typeShow = 'menu';}
        }

}
else{
    if($urlLastElement == 'news'){$typeShow = 'news'; }
    else{
   $typeShow = 'menu'; }
   $filtersByMenu = $this->Filter_model->getFilterOnPageByMenu($parent);
}
       }
       if(!empty($data['url'][$NumUrlElement+1])){
            if ($data['url'][$NumUrlElement+1]=="tag") {
                $typeShow = 'tag';
            }
        }
        if($urlLastElement=='news'){$typeShow ='news' ;}

    }
    else{
        if ($data['element']==false){show_404(); }
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
         }  
         else{
            $data['element']=$lastElement;
            $data['element'] = $this->TranslateElements('element',$data['element'],$defaultLang,$lang);} 
        
   // print_r($lastElement);
    
    $data['typeShow'] = $typeShow;
    $data['lastFilter'] = $lastElement['alias'];

    switch ($typeShow) {
          case 'page':

                    //$data['header_menu'] = $this->Filter_model->get_cats_header();
                                       

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
                    $this->data['page_level_scripting'][]= ['value'=>'var Menu = '.json_encode($data['menu']).'; console.log(Menu);'];
                    
                    switch ($urlLastElement) {
                    case 'home':
                    $data['header_search'] = 1;
                   // print_r($data['menu']);
                    $this->load->view('templates/yoga_template/header', $data);
// $temp = [];
                    // foreach ($primeFilter as $key => $value) {
                    //     if(is_numeric($value) and $value!='')
                    //     $temp[]['id_filter']=$value;
                    // }
                   // print_r($this->Element_model->getCardsByIdFilter($temp));
                    $top = 0;
                    $mesta = 60;
                    $merop = 46;                    
                    $trip = 49;
                    $knowledge = 55; 
                    $mamam = 43;
                    $kids = 40;
                    //print_r($constants);
                    //print_r($this->Menu_model->getSliderMenu(60));
                   // $data['slider_top'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone'],false,false,true,false);
                    $data['slider_top'] = $this->Menu_model->getSliderMenu($top,10,'top');
                     if(!empty($data['slider_top'])){
                    $data['slider_top'] = $this->TranslateElements('elements',$data['slider_top'],$defaultLang,$lang);
                }
                   //$data['slider_mesta'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.title','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone'],$mesta,false,true,false);
                  $data['slider_mesta'] =  $this->Menu_model->getSliderMenu($mesta);
                  if(!empty($data['slider_mesta'])){
                  $tmp = $this->Menu_model->get_menu($mesta);
                  $tmp = $this->TranslateElements('element',$tmp,$defaultLang,$lang);
                  $data['slider_mesta'][0]['menuTitle'] =$tmp['value'];
                  
                  $data['slider_mesta'] = $this->TranslateElements('elements',$data['slider_mesta'],$defaultLang,$lang);
                    }
                  //print_r($data['slider_mesta']);
                  // print($data['slider_mesta']);
                //  $data['slider_merop'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone'],$merop,false,true,false);
                  $data['slider_merop'] = $this->Menu_model->getSliderMenu($merop);
                   if(!empty($data['slider_merop'])){
                  $data['slider_merop'] = $this->TranslateElements('elements',$data['slider_merop'],$defaultLang,$lang);
                  $tmp = $this->Menu_model->get_menu($merop);
                  $tmp = $this->TranslateElements('element',$tmp,$defaultLang,$lang);
                  $data['slider_merop'][0]['menuTitle'] =$tmp['value'];
                  }
                  //$data['slider_trip'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone'],$trip,false,true,false);
                  $data['slider_trip'] = $this->Menu_model->getSliderMenu($trip);
                  if(!empty($data['slider_trip'])){
                  //print_r($data['slider_trip']);
                 $data['slider_trip'] = $this->Filter_model->addFilterToCard($data['slider_trip'],93);

                 //print_r($data['slider_trip'][0]);
                  $data['slider_trip'] = $this->TranslateElements('elements',$data['slider_trip'],$defaultLang,$lang);

                  $tmp = $this->Menu_model->get_menu($trip);
                  $tmp = $this->TranslateElements('element',$tmp,$defaultLang,$lang);
                  $data['slider_trip'][0]['menuTitle'] =$tmp['value'];
                  //print_r($data['slider_trip']);
              }
                  //$data['slider_knowledge'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone'],$knowledge,false,true,false);
                  $data['slider_knowledge'] = $this->Menu_model->getSliderMenu($knowledge);
                  if(!empty($data['slider_knowledge'])){
                  $data['slider_knowledge'] = $this->TranslateElements('elements',$data['slider_knowledge'],$defaultLang,$lang);
                  $tmp = $this->Menu_model->get_menu($knowledge);
                  $tmp = $this->TranslateElements('element',$tmp,$defaultLang,$lang);
                  $data['slider_knowledge'][0]['menuTitle'] =$tmp['value'];
              }
                  $tmp = $this->Menu_model->get_menu([0=>$mamam]);
                  $tmp = $this->TranslateElements('menu',$tmp,$defaultLang,$lang);
                  $data['slider_moms'] =$tmp;
                  $tmp = $this->Menu_model->get_menu([0=>$kids]);
                  $tmp = $this->TranslateElements('menu',$tmp,$defaultLang,$lang);
                  $data['slider_kids'] =$tmp;
                  $data['gallery_bottom'] = $this->ImageControl_model->get_gallery();
                  //print_r($data['slider_trip']);


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

            
            //$data['header_menu'] = $this->Filter_model->get_cats_header();
            
           $tempCheck = (!empty($data['url'][$NumUrlElement+1])) ? $this->Menu_model->getMenuByAlias($data['url'][$NumUrlElement+1]) : false ;
            if(!empty($tempCheck)){
                //print_r($tempCheck);
                $parent = $tempCheck['id_menu'];
            }
            else{
            $parent = $this->Menu_model->isParent($urlElement,0);}

            $data['filter'] = $this->Filter_model->getFilterOnPageByMenu($parent);
            $data['filter'] = $this->TranslateElements('SmartFilter',$data['filter'],$defaultLang,$lang);
            $data['keywords'] = '';

            foreach ($data['url'] as $key => $value) {
                $tempElement = $this->Element_model->getElementUrl($value);
                if(is_array($tempElement)){
                    $data['keywords'] = $data['keywords'].' - '.$tempElement['title'];
                }
            }
            //$data['keywords'] = ($data['element']['meta_keywords']) ? $data['element']['meta_keywords'] : '' ;

            //$data['description'] = ($data['element']['description']) ? $data['element']['description'] : '' ;
            $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
            if (!empty($data['pagination']['pageNum'])) {
                            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements'],$data['pagination']['pageNum'],12);
                            $data['elements'] = $this->TranslateElements('elements',$data['elements'],$defaultLang,$lang);
                            $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                            $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
                        }
                        else{
                            $data['elements'] = $this->TranslateElements('elements',$data['elements'],$defaultLang,$lang);
                     $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
            }

            $data['title'] = ($data['element']['title']) ? $data['element']['title'] : '';
            $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/filterOnSite.js');
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            // if (empty($data['elements'])) {
            //             show_404();
            //         }
            break;

          case 'filter_cat':

            //$data['header_menu'] = $this->Filter_model->get_cats_header();
            $data['url'] = explode('/',$url);
            $data['filter'] = $this->Filter_model->getFilterOnPage();
            
            $data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
            $data['keywords'] = (!empty($data['element']['meta_keywords'])) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = (!empty($data['element']['description'])) ? $data['element']['description'] : '' ;
            $data['title'] = (!empty($data['element']['title'])) ? $data['element']['title'] : '';
            
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            // if (empty($data['elements'])) {
            //             show_404();
            //         }
            break;
          case 'menu':
          
           $tempCheck = (!empty($data['url'][$NumUrlElement+1])) ? $this->Menu_model->getMenuByAlias($data['url'][$NumUrlElement+1]) : false ;
            if(!empty($tempCheck)){
                //print_r($tempCheck);
                $parent = $tempCheck['id_menu'];
            }
            else{
            $parent = $this->Menu_model->isParent($urlElement,0);}
            $filtersByMenu = $this->Filter_model->getFilterOnPageByMenu($parent);
            
            $data['filter'] = $filtersByMenu;

            $data['filter'] = $this->TranslateElements('SmartFilter',$data['filter'],$defaultLang,$lang);

            if (isset($data['element']['id_menu']) and empty($data['url'][$NumUrlElement+1])) {
                //print('hey');
                //1 меню
                // print($countURL);
           //     print_r($countURL);
                // print(count($data['BaseUrl']));
                    $data['pagination']['pageNum'] = $this->input->get('page');
                    if (!empty($data['pagination']['pageNum'])) {

                   $data['elements'] = $this->Element_model->getCardsByMenu($data['element']['id_menu'],$data['pagination']['pageNum'],12);

                       
                       $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12) ;
                            $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
                    }
                    else{
//print_r($countURL);
                       // print($data['element']['id_menu']);
                   $data['elements'] = $this->Element_model->getCardsByMenu($data['element']['id_menu']);
                   

                   
                  // print_r($data['element']);
                   $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                            $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
               }
            }
            else{
                //Подменю
//print_r($countURL);
                    $data['pagination']['pageNum'] = intval($this->input->get('page'));
                    //print_r($this->Element_model->getFiltersIdByAlias($data['url']));
                    if(!empty($data['url'][$NumUrlElement+2]))
                    {$data['elements'] = $this->Element_model->getCardsByFilter($data['url']);
                    $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements']);
                    $data['elements'] = $this->TranslateElements('elements',$data['elements'],$defaultLang,$lang);
            }
                else{
                   // print($data['url'][$NumUrlElement+1]);
                   
                    $temp = $this->Element_model->getElementUrl($data['url'][$NumUrlElement+1]);
                    
                    $data['elements'] = $this->Element_model->getCardsByMenu($temp['id_menu']);
                    $data['elements'] = $this->TranslateElements('elements',$data['elements'],$defaultLang,$lang);
                    //print_r($data['elements']);
                }
                    
                    //print_r($data['elements']);
                        if (!empty($data['pagination']['pageNum'])) {
                            $data['elements'] = $this->Element_model->getItemsFilterPage($data['elements'],$data['pagination']['pageNum'],12);
                            $data['elements'] = $this->TranslateElements('elements',$data['elements'],$defaultLang,$lang);
                            
                            $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                            $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
                        }
                        else{

                

                
                $data['pagination']['countPages'] = ($data['elements']['countRecords']/12<1) ? 0 : ceil($data['elements']['countRecords']/12);
                $data['pagination']['on']=($data['pagination']['countPages']>1) ? 1 : 0 ;
                
            }
        }
            
            
            
            
            
            $data['keywords'] = (!empty($data['element']['meta_keywords'])) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = (!empty($data['element']['description'])) ? $data['element']['description'] : '' ;
            $data['title'] = (!empty($data['element']['title'])) ? $data['element']['title'] : '';
            $data['body'] = (!empty($data['element']['body'])) ? $data['element']['body'] : '';
            //$data['title'] = 'Страница фильтрации';
            
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->data['page_level_script'][] =  array('src' => asset_url().'pages/scripts/filterOnSite.js');
            $this->load->view('pages/filter', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'card':

            $data['url'] = explode('/',$url);
            $data['item']=$data['element'];
           // print_r($data['item']);
            $data['item']['gallery'] = $this->ImageControl_model->get_images_element($data['item']['id_element']);

            $arFiltersId = $this->Filter_model->getFiltersIdByIdCard($data['item']['id_post']);
            $data['item']['filters'] = $this->Filter_model->get_filter_all_idCard($data['item']['id_post']);
            
            $data['item']['slider_like'] = $this->Element_model->getItemsByElement(['item_card.id_post','item_card.logo','item_card.h1','item_card.preview_text','item_card.adress','item_card.date_create','item_card.alias','item_card.telephone','item_card.h1'],false,false,true,false,false,[0=>$data['element']['id_element']],true);

            $data['item']['review'] = $this->Review_model->get_reviews($data['item']['id_post'],'true');
            $data['item']['stars'] = $this->countStars($data['item']['review']);

            //print_r($data['item']['review']);
            //print_r($data['item']['staff']);
            $data['item']['staff'] = $this->Staff_model->get_staff_all_page($data['item']['id_post']);
            
            $data['item']['staff'] = $this->TranslateElements('elements',$data['item']['staff'],$defaultLang,$lang);
            //$data['header_menu'] = $this->Filter_model->get_cats_header();
           // print_r($data['item']['staff']);
            $data['buttonBackUrl'] = '/';
            $ur = explode('/',uri_string());
            
            for ($i=0; $i <$countRealURL-1 ; $i++) { 
                $data['buttonBackUrl'] = $data['buttonBackUrl'].$ur[$i].'/';
            }
            
           
            $data['keywords'] = ($data['element']['meta_keywords']) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = ($data['element']['description']) ? $data['element']['description'] : '' ;
            $data['title'] = ($data['element']['title']) ? $data['element']['title'] : '';
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
            
            $data['news_new'] = $this->TranslateElements('news',$data['news_new'],$defaultLang,$lang);
           // $data['news']=$this->News_model->get_news();
           

            

            $data['keywords'] = ($data['element']['meta_keywords']) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = ($data['element']['description']) ? $data['element']['description'] : '' ;
            $data['title'] = ($data['element']['title']) ? $data['element']['title'] : '';
            $data['item']=$this->Element_model->getElementUrl($url);
            $data['item'] = $this->TranslateElements('element',$data['item'],$defaultLang,$lang);
            //$data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $this->load->view('templates/yoga_template/head', $data);
            $this->load->view('templates/yoga_template/header', $data);
            $this->load->view('pages/news', $data);
            $this->load->view('templates/yoga_template/footer', $data);
            break;
          case 'tag':
            
            $data['keywords'] = ($data['element']['meta_keywords']) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = ($data['element']['description']) ? $data['element']['description'] : '' ;
            $data['title'] = ($data['element']['title']) ? $data['element']['title'] : '';

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
            $data['item'] = $this->TranslateElements('element',$data['item'],$defaultLang,$lang);
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
           // $data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');
            $data['item']=$this->Element_model->getElementUrl($url);
            $data['item'] = $this->TranslateElements('element',$data['item'],$defaultLang,$lang);

            $data['keywords'] = (!empty($data['element']['meta_keywords'])) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = (!empty($data['element']['description'])) ? $data['element']['description'] : '' ;
            $data['title'] = (!empty($data['element']['title'])) ? $data['element']['title'] : '';

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

            $data['item'] = $this->TranslateElements('element',$data['item'],$defaultLang,$lang);
            $filtersTemp = $this->Staff_model->getFilterIdByIdStaff($data['item']['id_staff']);
            
            if(!empty($filtersTemp)){
                $data['item']['filters'] =$this->Filter_model->get_filters($filtersTemp);
              $data['item']['filters'] = $this->TranslateElements('filterCat',$data['item']['filters'],$defaultLang,$lang);
            foreach ($data['item']['filters'] as $key => $value) {
               $arrTemp =  $this->Filter_model->get_filter_cat($value['id_cat_filter']);
               //$arrTemp = [$key=>$arrTemp];
               $data['item']['filters'][$key]['cat']=$arrTemp;
               $data['item']['filters'][$key]['cat'] = $this->TranslateElements('element',$data['item']['filters'][$key]['cat'],$defaultLang,$lang);
            }
            }
            
           
            $data['keywords'] = (!empty($data['element']['meta_keywords'])) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = (!empty($data['element']['description'])) ? $data['element']['description'] : '' ;
            $data['title'] = (!empty($data['element']['title'])) ? $data['element']['title'] : '';

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
            $data['item'] = $this->TranslateElements('element',$data['item'],$defaultLang,$lang);
            $data['news']=$this->Element_model->getCategoryNewsByIdCat($data['item']['id_cat']);
            //$data['otherNews']=$this->News_model->get_news(FALSE, false, true,0,6,'alias,logo,title,date_create,h1,description,preview_text');

            $data['keywords'] = (!empty($data['element']['meta_keywords'])) ? $data['element']['meta_keywords'] : '' ;
            $data['description'] = (!empty($data['element']['description'])) ? $data['element']['description'] : '' ;
            $data['title'] = ($data['element']['title']) ? $data['element']['title'] : '';
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
                    $data['element'] = $this->TranslateElements('element',$data['element'],$defaultLang,$lang);
                    $data['title'] =  $data['element']['h1'];
                    
                    $data['keywords'] = (!empty($data['element']['meta_keywords'])) ? $data['element']['meta_keywords'] : '' ;
                    $data['description'] = (!empty($data['element']['description'])) ? $data['element']['description'] : '' ;
                    $data['title'] = (!empty($data['element']['title'])) ? $data['element']['title'] : '';
                    
                    
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
    public function countStars($array=false)
    {
        $stars = 0;
        $rating = 0;
        $countReview= 0;
        foreach ($array as $key => $value) {
            $countReview++;
            $rating=$value['rating']+$rating;
            
        }
        if ($countReview != 0) {
            $stars = $rating/$countReview;
        }
        else {$stars = 1; }
        return $stars;
         
    }
    public function setSessionJS()
    {
        $result = json_encode(['status'=>'fail']);
        if(!empty($this->input->post('data')) and $this->input->post('data')=='Y')
        {
            $pointData = json_decode($this->input->post('point'));
            //$switch = $pointData->name;
            
                switch ($pointData->name) {
                    case 'lang':
                        $this->session->set_userdata($pointData->name,$pointData->value);
                        $result = json_encode(['status'=>'success','dataUpdates'=>[$pointData->name=>$this->session->lang]]);
                        echo $result;
                        return $result;
                        break;
                    case 'city':

                        //$this->session->set_userdata($pointData->name,$pointData->value);
                        
                        $_SESSION['PrimeFilter']['city'] = $pointData->value;
                        $result = json_encode(['status'=>'success','dataUpdates'=>[$pointData->name=>$this->session->city]]);
                        echo $result;
                        return $result;
                        break;
                    case 'region':
                        //$this->session->set_userdata($pointData->name,$pointData->value);
                        $_SESSION['PrimeFilter']['region'] = $pointData->value;
                        unset(
                                $_SESSION['city']
                        );
                        $result = json_encode(['status'=>'success','dataUpdates'=>[$pointData->name=>$this->session->region]]);
                        echo $result;
                        return $result;
                        break;
                    case 'country':
                        $_SESSION['PrimeFilter']['country'] = $pointData->value;
                        unset(
                                $_SESSION['region'],
                                $_SESSION['city']
                        );
                        $result = json_encode(['status'=>'success','dataUpdates'=>[$pointData->name=>$this->session->country]]);
                        echo $result;
                        return $result;
                        break;
                    
                    default:
                        //$this->session->set_userdata($pointData->name,$pointData->value);
                        $result = json_encode(['status'=>'fail','dataNoUpdates'=>$pointData]);
                        echo $result;
                        return $result;
                        break;
                }

                
            
            return;
        }
        else{
            echo $result;
            return $result;}
    }
    public function getSessionJS($nameSessVar)
    {
        $result = json_encode(['status'=>'fail']);
        if(!empty($this->input->post('data')) and $this->input->post('data')=='N')
        {
            switch ($nameSessVar) {
                case 'city':
                    $result = json_encode(['status'=>'success','data'=>$this->session->PrimeFilter[$nameSessVar]]);
                    break;
                case 'region':
                    $result = json_encode(['status'=>'success','data'=>$this->session->PrimeFilter[$nameSessVar]]);

                    break;
                case 'country':
                    $result = json_encode(['status'=>'success','data'=>$this->session->PrimeFilter[$nameSessVar]]);
                    break;
                case 'lang':
                    $result = json_encode(['status'=>'success','data'=>$this->session->$nameSessVar]);
                    break;
                
                default:
                   $result = json_encode(['status'=>'fail']);
                    break;
            }
            echo $result;
            return $result;
        }
        else{
            echo $result;
            return $result;}
    }
    public function TranslateElements($what = false,$array=false,$defaultLang=false,$lang=false)
    {
        if ($array!=false and $what!=false and $defaultLang != false and $lang != false ) {
            # code...
        
        switch ($what) {
            case 'menu':
            $menuElements = [];
                            if($array!=false and $defaultLang!=$lang){
                    foreach ($array as $key => $value) {
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
                            foreach ($array as $key => $parent) {
                                foreach ($parent as $nameField => $value) {
                                    if (!empty($translate[$parent['id_element']][$nameField])) {
                                        
                                        $array[$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                    }
                                }
                                if(!empty($array[$key]['submenu'])) {
                                            foreach ($parent['submenu'] as $keySub => $submenu) {
                                                foreach ($submenu as $nameFieldSub => $valueSub) {
                                                    if (!empty($translate[$submenu['id_element']][$nameFieldSub])) {
                                                $array[$key]['submenu'][$keySub][$nameFieldSub]=$translate[$submenu['id_element']][$nameFieldSub];
                                                }
                                            }
                                            }
                                        }
                            }
                       
                    }
                }

                break;
            
            case 'element':


                    if($array!=false and $defaultLang!=$lang){
                        
                        $translate = $this->Language_model->getLanguage($array['id_element'], $lang);
                        if($translate['status']!=false)
                        {
                            foreach ($translate[$array['id_element']] as $key => $value) {
                                $array[$key] = $value;
                            }
                    }

                    }
                break;            
            case 'filterCat':
               $arrFilterCountry = [];
                foreach ($array as $key => $value) {
                    $arrFilterCountry[]=$value['id_element'];
                }
                if($array!=false and $defaultLang!=$lang){
                    
                    $translate = $this->Language_model->getLanguage($arrFilterCountry, $lang);
                    if($translate['status']!=false)
                    {
                        foreach ($array as $key => $parent) {
                                foreach ($parent as $nameField => $value) {
                                    if (!empty($translate[$parent['id_element']][$nameField])) {
                                        
                                        $array[$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                    }
                                }
                                
                            }
                        }
                }
                break;          
            case 'SmartFilter':
                $arrFilterSmart=[];
                if($array!=false and $defaultLang!=$lang){
                    foreach ($array as $key => $value) {
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
                            foreach ($array as $key => $parent) {
                                foreach ($parent as $nameField => $value) {
                                    if($nameField == 'cat' and !empty($translate[$parent['id_element']]['h1'])){$array[$key][$nameField]=$translate[$parent['id_element']]['h1'];}
                                    if (!empty($translate[$parent['id_element']][$nameField])) {
                                        
                                        $array[$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                    }
                                }
                                if(!empty($array[$key]['filters'])) {
                                            foreach ($parent['filters'] as $keySub => $filters) {
                                                foreach ($filters as $nameFieldSub => $valueSub) {
                                                    if($nameFieldSub == 'filter' and !empty($translate[$filters['id_element']]['h1'])){
                                                        $array[$key]['filters'][$keySub][$nameFieldSub]=$translate[$filters['id_element']]['h1'];}
                                                    if (!empty($translate[$filters['id_element']][$nameFieldSub])) {
                                                $array[$key]['filters'][$keySub][$nameFieldSub]=$translate[$filters['id_element']][$nameFieldSub];
                                                }
                                            }
                                            }
                                        }
                            }
                       
                    }
                }
                break;          
            case 'elements':
            $arrFilterPageElements = [];
                foreach ($array as $key => $value) {
                    $arrFilterPageElements[]=$value['id_element'];
                    if(!empty($value['filters'])){
                        foreach ($value['filters'] as $key2 => $value2) {
                        $arrFilterPageElements[]=$value2['id_element'];
                        }
                    }
                }
                if($array!=false and $defaultLang!=$lang){
                    
                    $translate = $this->Language_model->getLanguage($arrFilterPageElements, $lang);
                    if($translate['status']!=false)
                    {
                        

                        foreach ($array as $key => $parent) {
                            //print_r($parent);
                                if(is_array($parent)){
                                foreach ($parent as $nameField => $value) {
                                    if (!empty($translate[$parent['id_element']][$nameField]) ) {
                                        
                                        $array[$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                    }
                                    if($nameField=='filters' and !empty($parent['filters'])){
                                    foreach ($parent['filters'] as $keyFilter => $value2) {
                                        foreach ($value2 as $nameFilter => $valueFilter) {
                                            if(!empty($translate[$value2['id_element']][$nameFilter])){
                                                $array[$key][$nameField][$keyFilter][$nameFilter]=$translate[$value2['id_element']][$nameFilter];
                                            }
                                        }
                                    
                                    }
                                }
                                    
                                }
                                }
                            }
                        }
                }
                # code...
                break;      
            case 'news':
                    $NewsElements =[];
                    if($array!=false and $defaultLang!=$lang){
                        foreach ($array as $key => $value) {
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
                            foreach ($array as $key => $parent) {
                                    foreach ($parent as $nameField => $value) {
                                        if (!empty($translate[$parent['id_element']][$nameField])) {
                                            
                                            $array[$key][$nameField]=$translate[$parent['id_element']][$nameField];
                                        }
                                    }
                                    if(!empty($array[$key]['news'])) {
                                                foreach ($parent['news'] as $keyNews => $news) {
                                                    foreach ($news as $nameFieldNews => $valueNews) {
                                                        if (!empty($translate[$news['id_element']][$nameFieldNews])) {
                                                    $array[$key]['news'][$keyNews][$nameFieldNews]=$translate[$news['id_element']][$nameFieldNews];

                                                    }
                                                }
                                                if(!empty($array[$key]['news'][$keyNews]['tags'])) {
                                                            foreach ($news['tags'] as $keyTags => $tags) {
                                                                foreach ($tags as $nameFieldNewsTag => $valueNewsTag) {
                                                                    if (!empty($translate[$tags['element']][$nameFieldNewsTag])) {
                                                                $array[$key]['news'][$keyTags][$nameFieldNewsTag]=$translate[$tags['element']][$nameFieldNewsTag];

                                                                }
                                                            }
                                                            }
                                                        }
                                                }
                                            }

                                }
                            
                    }
                }
                break;  
            default:
                # code...
                break;
        }

        return $array;
    }
    else{
        return false;
    }
    }
  }

