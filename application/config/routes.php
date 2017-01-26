<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes with
| underscores in the controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//BEGIN Constants

$route['admin/Constants/show'] = 'Constants/show';
$route['admin/Constants/save'] = 'Constants/Save';
//END Constants
//BEGIN Partners
$route['admin/partners/show_partners/(:num)'] = 'Partners/show_partners/$1';
$route['admin/partners/show_partners'] = 'Partners/show_partners';
$route['admin/partners/change/(:num)'] = 'Partners/change/$1';
$route['admin/partners/changePartners/(:num)'] = 'Partners/changePartners/$1';
$route['admin/partners/getPartners'] = 'Partners/getPartners';
// $route['admin/Partners/changeProperty/(:num)'] = 'Partners/changeProperty/$1';
// $route['admin/Partners/get_property_file/(:num)'] = 'Partners/getPropertyFile/$1';
// $route['admin/Partners/saveImage'] = 'Partners/saveImage';
//END Partners
//BEGIN ImageControl
$route['admin/imageControl/show_control'] = 'ImageControl/show_control';
$route['admin/imageControl/changeProperty/(:num)'] = 'ImageControl/changeProperty/$1';
$route['admin/imageControl/get_property_file/(:num)'] = 'ImageControl/getPropertyFile/$1';
$route['admin/imageControl/saveImage'] = 'ImageControl/saveImage';
$route['thumbnail/(:any)'] = 'ImageControl/thumbnail/$1';
$route['admin/uploadImages/(:any)'] = 'ImageControl/uploadImages/$1';
$route['admin/Image/deleteImage/(:num)/(:num)'] = 'ImageControl/deleteImageCard/$1/$2';
$route['admin/Image/load_last_images/(:num)/(:num)'] = 'ImageControl/loadLastImages/$1/$2';
$route['admin/imageControl/set_image_has_element/(:num)/(:num)'] = 'ImageControl/set_image_has_element/$1/$2';
$route['admin/cards/show_images/(:num)'] = 'itemcard/show_images/$1';
$route['admin/imageControl/get_property_folder/(:num)'] = 'ImageControl/getElementImage/$1';
//END ImageControl

//BEGIN EMAIL
$route['admin/email/Contact'] = 'Email/Contact';
$route['admin/email/show_admin'] = 'Email/show';
$route['admin/email/show_admin/(:any)'] = 'Email/show/$1';
$route['admin/email/save_Email_TPL/(:any)'] = 'Email/save_Email_TPL/$1';
$route['admin/email/Contact/$1'] = 'Email/Contact/$1';
$route['admin/email/Partners'] = 'Email/Partners';
$route['admin/email/Partners/(:any)'] = 'Email/Partners/$1';
$route['admin/email/Partners/change'] = 'Email/PartnersChange';
//END EMAIL

//BEGIN Tags
$route['admin/tags/getJson/(:any)'] = 'Tags/getJson/$1';
//$route['admin/tags/addTag/(:num)'] = 'Tags/addTag/$1';
$route['admin/tags/show_tags/(:num)'] = 'Tags/show_tags/$1';
$route['admin/tags/deleteTag/(:num)'] = 'Tags/deleteTag/$1';
$route['admin/tags/addTag'] = 'Tags/addTag';
$route['admin/tags/changeTag/(:num)'] = 'Tags/changeTag/$1';
$route['admin/tags/bloodhound_h1_tag'] = 'Tags/bloodhound_h1_tag';
$route['admin/tags/set_tags_has_news/(:num)'] = 'Tags/set_tags_has_news/$1';

$route['admin/tags/show_tags/(:num)'] = 'Tags/show_tags/$1';
$route['admin/tags/show_tags'] = 'Tags/show_tags';


//END Tags
//BEGIN Excel
$route['admin/excel/import'] = 'Excel/import';
$route['admin/excel/import/(:any)'] = 'Excel/import/$1';
//$route['admin/excel/importFilters'] = 'Excel/importFilters';
$route['admin/excel/importCard'] = 'Excel/importCard';
$route['admin/itemcard/importCard'] = 'itemcard/importCard';
$route['admin/Filter/importFilter'] = 'Filter/importFilter';
$route['admin/Excel/AddRelationFilter'] = 'Excel/AddRelationFilter';
//END Excel
//BEGIN Email

$route['admin/email/subscribe'] = 'Email/Subscribe';
$route['admin/email/addcamp'] = 'Email/AddCamp';
$route['admin/email/editcamp'] = 'Email/EditCamp';
//End Email
// BEGIN Menu module

$route['admin/menu/create'] = 'Menu/create';
$route['admin/menu/createMenu'] = 'Menu/createMenu';
$route['admin/menu/change/(:num)'] = 'Menu/change/$1';
$route['admin/menu/changeMenu/(:num)'] = 'Menu/changeMenu/$1';
$route['admin/menu/deleteMenu/(:num)'] = 'Menu/deleteMenu/$1';
$route['admin/menu/deleteMenu2/(:num)'] = 'Menu/deleteMenu2/$1';
$route['admin/menu/show_menu'] = 'Menu/show_menu';
$route['admin/menu/show_menu/(:num)'] = 'Menu/show_menu/$1';
$route['admin/menu/deleteMenu/(:num)'] = 'Menu/deleteMenu/$1';
$route['admin/menu/add_filter_menu'] = 'Menu/addFilter';
$route['admin/menu/add_card_menu'] = 'Menu/addCard';
$route['admin/menu/get_menu_have_filters/(:num)'] = 'Menu/get_menu_have_filters';
$route['admin/menu/set_menu_have_filters/(:num)'] = 'Menu/set_menu_have_filters';
$route['admin/menu/set_menu_have_cards/(:num)'] = 'Menu/set_menu_have_cards';
$route['admin/menu/get_menu_have_cards/(:num)'] = 'Menu/get_menu_have_cards';
$route['admin/menu/get_menu_have_cards'] = 'Menu/get_menu_have_cards';
$route['admin/menu/get_filters_have_menu/(:num)'] = 'Menu/get_filters_have_menu/$1';

// END Menu Module


$route['admin/assets/(:any)'] = 'assets/$1';
$route['assets/(:any)'] = 'assets/$1';
$route['admin/uploads/(:any)'] = 'uploads/$1';
$route['uploads/(:any)'] = 'uploads/$1';
$route['images/(:any)'] = 'images/$1';
//$route['third-party/(:any)'] = 'third-party/$1';
$route['admin/uploads/cards/(:any)'] = 'uploads/cards/$1';
$route['uploads/cards/(:any)'] = 'uploads/cards/$1';


$route['validation/(:any)'] = 'validation/valid/$1';

//BEGIN Язык
$route['admin/lang/getLanguageByElement/(:num)/(:any)'] = 'Language/getLanguageByElement/$1/$2';
$route['admin/lang/setLanguageByElement/(:num)/(:any)'] = 'Language/setLanguageByElement/$1/$2';
$route['admin/lang/getLanguageByElement/(:num)'] = 'Language/getLanguageByElement/$1';
$route['admin/filter/getRelationFilter/(:num)/(:any)'] = 'Filter/getRelationFilter/$1/$2';
$route['admin/tags/lang/setLanguageByElement/(:num)/(:any)'] ='Tags/setLanguageByElement/$1/$2';
//END Язык
//BEGIN Новости
$route['admin/news/createNews'] = 'news/createNews';
$route['admin/news/deleteNews/(:num)'] = 'news/deleteNews/$1';
$route['admin/news/create'] = 'news/create';
$route['admin/news/change/(:num)'] = 'news/change/$1';
$route['admin/news/changeNews/(:num)'] = 'news/changeNews/$1';
//$route['news/(:any)'] = 'news/view/$1';
//$route['news'] = 'news/index';
//$route['news/show_news/(:any)'] = 'news/show_news/$1';
$route['news/load_news/(:num)'] = 'news/loadNews/$1';
$route['admin/news/show_news/(:any)'] = 'news/show_news/$1';
$route['admin/news/show_news'] = 'news/show_news';
$route['admin/news/show_archive'] = 'news/show_archive';
$route['admin/news/show_archive/1'] = 'news/show_archive/1';
$route['admin/news/createCatNews'] = 'news/createCatNews';
$route['admin/news/delete_cat'] = 'news/delete_cat';
$route['admin/news/create_cat'] = 'news/create_cat';
$route['admin/news/show_cat/(:any)'] = 'news/show_cat/$1';
$route['admin/news/show_cat'] = 'news/show_cat';
$route['admin/news/change_cat/(:num)'] = 'news/change_cat/$1';
$route['admin/news/changeCatNews/(:num)'] = 'news/changeCatNews/$1';
$route['admin/news/replacecards'] = 'news/replaceNews';
//END Новости
//BEGIN Страницы
$route['admin/pages/show_pages/(:any)'] = 'Pages/show_pages/$1';
$route['admin/pages/show_pages'] = 'Pages/show_pages';
$route['admin/pages/createPage'] = 'Pages/createPage';
$route['pages/delete/(:num)'] = 'Pages/deletePage/$1';
$route['admin/pages/delete/(:num)'] = 'Pages/deletePage/$1';
$route['pages/create'] = 'Pages/create';
$route['admin/pages/create'] = 'Pages/create';
$route['admin/pages/change/(:num)'] = 'Pages/change/$1';
$route['admin/pages/changePage/(:num)'] = 'Pages/changePage/$1';
$route['pages/(:any)'] = 'Pages/view/$1';
$route['pages'] = 'Pages/index';
//END Страницы
//BEGIN BLOODHOUND
$route['admin/cards/bloodhound_h1'] = 'itemcard/bloodhound_h1';
$route['admin/staff/bloodhound_name'] = 'staff/bloodhound_name';
$route['admin/filter/bloodhound_h1'] = 'filter/bloodhound_h1';
$route['admin/news/bloodhound_h1'] = 'news/bloodhound_h1';
$route['admin/news/bloodhound_cat'] = 'news/bloodhound_cat';
//END BLOODHOUND
// BEGIN Отзывы
$route['admin/review/approve'] = 'Review/approve';
$route['admin/review/publicReview'] = 'Review/publicReview';
$route['admin/review/archiveReview/(:num)'] = 'Review/archiveReview/$1';
$route['admin/review/unPublicReview'] = 'Review/unPublicReview';
$route['admin/review/unArchiveReview'] = 'Review/unArchiveReview';
$route['review/show_review/(:any)'] = 'Review/show_review/$1';
$route['review/show_review'] = 'Review/show_review';
$route['review/show_news_review/(:any)'] = 'Review/show_news_review/$1';
$route['admin/review/createReview/(:num)'] = 'Review/createReview/$1';
$route['admin/review/createNewsReview/(:num)'] = 'Review/createReview/$1/news';
$route['admin/review/change/(:num)'] = 'Review/change/$1';
$route['admin/review/changeReview/(:num)'] = 'Review/changeReview/$1';
// END Отзывы
// BEGIN Карточки 
//$route['admin/cards/deleteImage'] = 'itemcard/deleteImage';
$route['cards/show_cards/(:any)'] = 'itemcard/show_cards/$1';
$route['cards/show_cards/(:any)'] = 'itemcard/show_cards/$1';
$route['show_cards/(:any)'] = 'itemcard/show_cards/$1';
$route['cards/show_cards'] = 'itemcard/show_cards';
$route['admin/cards/show_cards/(:any)'] = 'itemcard/show_cards/$1';
$route['admin/cards/show_cards'] = 'itemcard/show_cards';
$route['admin/cards/show_archive'] = 'itemcard/show_archive';
$route['admin/cards/show_archive/1'] = 'itemcard/show_archive/1';
$route['admin/itemcard/createCard'] = 'itemcard/createCard';
// $route['cards/deletecards/(:num)'] = 'itemcard/deleteCards/$1';
$route['admin/cards/deletecards'] = 'itemcard/deleteCards';
$route['admin/cards/archiveCards'] = 'itemcard/archiveCards';
$route['admin/cards/set_image_has_item_card/(:num)/(:num)'] = 'itemcard/set_image_has_item_card/$1/$2';


$route['admin/cards/replacecards'] = 'itemcard/replaceCards';
$route['admin/cards/Delete'] = 'itemcard/deleteCards';
$route['cards/create'] = 'itemcard/create';
$route['admin/cards/create'] = 'itemcard/create';
// $route['cards/uploadimagescard2'] = 'itemcard/uploadImagesCard2';
// $route['admin/cards/uploadimagescard2'] = 'itemcard/uploadImagesCard2';
$route['cards/uploadimagescard2/(:any)'] = 'itemcard/uploadImagesCard2/$1';
$route['admin/cards/uploadimagescard2/(:any)'] = 'itemcard/uploadImagesCard2/$1';
$route['cards/uploadimagescard'] = 'itemcard/uploadImagesCard';
$route['admin/cards/uploadimagescard'] = 'itemcard/uploadImagesCard';
$route['cards/changeCards/(:num)'] = 'itemcard/changeCards/$1';
$route['admin/cards/changeCards/(:num)'] = 'itemcard/changeCards/$1';
$route['cards/change/(:num)'] = 'itemcard/change/$1';
$route['admin/cards/change/(:num)'] = 'itemcard/change/$1';
$route['cards/(:any)'] = 'itemcard/view/$1';
$route['cards'] = 'itemcard/index';
// END Карточки
// BEGIN Персонал
$route['admin/staff/create'] = 'Staff/create';
$route['admin/staff/createStaff'] = 'Staff/createStaff';
$route['admin/staff/change/(:num)'] = 'Staff/change/$1';
$route['admin/staff/changeStaff/(:num)'] = 'Staff/changeStaff/$1';
$route['admin/staff/show_staff'] = 'Staff/show_staff';
$route['admin/staff/show_staff/(:num)'] = 'Staff/show_staff/$1';
$route['admin/staff/set_staff_has_card/(:num)'] = 'Staff/set_staff_has_card/$1';
$route['admin/staff/deleteStaff/(:num)'] = 'Staff/deleteStaff/$1';
$route['admin/staff/set_image_has_staff/(:num)/(:num)'] = 'Staff/set_image_has_staff/$1/$2';
$route['admin/staff/show_images/(:num)'] = 'Staff/show_images/$1';

// END Персонал
// BEGIN Filter
$route['admin/filter/uploadimagesfilter'] = 'itemcard/uploadImagesFilter';
$route['admin/filter/createFilter'] = 'filter/createFilter';
$route['admin/filter/createCatFilter'] = 'filter/createCatFilter';
$route['filter/deletefilter/(:num)'] = 'filter/deleteFilter/$1';
$route['admin/filter/deletefilter/(:num)'] = 'filter/deleteFilter/$1';
$route['admin/filter/deletefilter2/(:num)'] = 'filter/deleteFilter2/$1';
$route['filter/create'] = 'filter/create';
$route['admin/filter/create'] = 'filter/create';
$route['filter/change/(:num)'] = 'filter/change/$1';
$route['admin/filter/change/(:num)'] = 'filter/change/$1';
$route['filter/changeFilters/(:num)'] = 'filter/changeFilters/$1';
$route['admin/filter/changeFilters/(:num)'] = 'filter/changeFilters/$1';
$route['filter/(:any)'] = 'filter/view/$1';
$route['filter'] = 'filter/index';

$route['admin/filter/addParentFilter'] = 'filter/addParentFilter/';
$route['admin/filter/get_filters_by_parent/(:num)'] = 'filter/get_filters_by_parent/$1';
$route['admin/filter/set_filters_by_parent/(:num)'] = 'filter/set_filters_by_parent/$1';

$route['filter/show_filters/(:any)'] = 'filter/show_filters/$1';
$route['show_filters/(:any)'] = 'filter/show_filters/$1';
$route['filter/show_filters'] = 'filter/show_filters';
$route['admin/filter/show_filters/(:any)'] = 'filter/show_filters/$1';
$route['admin/filter/show_filters'] = 'filter/show_filters';

$route['filter/show_cat_filters/(:any)'] = 'filter/show_cat_filters/$1';
$route['show_cat_filters/(:any)'] = 'filter/show_cat_filters/$1';
$route['filter/show_cat_filters'] = 'filter/show_cat_filters';
$route['admin/filter/show_cat_filters/(:any)'] = 'filter/show_cat_filters/$1';
$route['admin/filter/show_cat_filters'] = 'filter/show_cat_filters';

$route['admin/filter/deletefiltercat/(:num)'] = 'filter/deleteFilterCat/$1';
$route['admin/filter/create_cat'] = 'filter/create_cat';
$route['admin/filter/change_cat/(:num)'] = 'filter/change_cat/$1';
$route['admin/filter/changeFiltersCat/(:num)'] = 'filter/changeFiltersCat/$1';
$route['admin/filter/countCards/(:num)'] = 'filter/countCards/$1';
$route['admin/filter/getRelationFilter/(:num)'] = 'filter/getRelationFilter/$1';
// END Filter
// BEGIN Авторизация
$route['admin/auth'] = 'auth/index';
$route['admin/auth/(:any)'] = 'auth/$1';
$route['admin/auth/create'] = 'auth/create';
$route['admin/auth/createUser/(:num)'] = 'auth/createUser';
$route['admin/auth/change/(:num)'] = 'auth/change/$1';
$route['admin/auth/changeUser/(:num)'] = 'auth/changeUser/$1';
$route['admin/auth/deleteuser/(:num)'] = 'auth/deleteUser/$1';
$route['admin/auth/show_users'] = 'auth/show_users';
$route['admin/auth/show_users/(:num)'] = 'auth/show_users/$1';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';
//$route['admin/auth/'] = 'auth/$1';
// END Авторизация
$route['pablicus/sessison/setSessionJS'] = 'pablicus/setSessionJS';
$route['pablicus/sessison/getSessionJS/(:any)'] = 'pablicus/getSessionJS/$1';
$route['admin'] = 'admin/index';
$route['admin/(:any)'] = 'admin/$1';
$route['default_controller'] = 'pablicus/view';
//$route['(:any)'] = $route['default_controller']."/$1";
$vlozhennost = 40;
$path="/$1";
$slug='(:any)';
for ($HowManyPaths=2; $HowManyPaths < $vlozhennost; $HowManyPaths++) 
{
	$route[$slug] = $route['default_controller'].$path;
	$slug = $slug.'/'.'(:any)';
	$path = $path.'/'.'$'.$HowManyPaths;
}
$route['404_override'] = '';

$route['translate_uri_dashes'] = FALSE;

//$route['(:any)/favicon.gif'] = '/favicon.gif';
//$route['(:any)'] = 'pages/view/$1';
