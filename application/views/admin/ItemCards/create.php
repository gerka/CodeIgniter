<? 
$Review['archive']=0;
$Review['public']=0;
$Review['h1']=0;
?>
    <!-- <div class="row"> -->
    <div class="col-md-12">
        <form class="form-horizontal form-row-seperated" name="changeItem" id="createItem">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i><?=$title?> </div>
                    <div class="actions btn-set">
                        <button class="reset btn btn-secondary-outline">
                            <i class="fa fa-reply"></i> Reset</button>
                        <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" />
                        <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable-bordered">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_general" data-toggle="tab"> Основные </a>
                            </li>
                            <li >
                                <a href="#tab_content" data-toggle="tab"> Контент </a>
                            </li>
                            <li>
                                <a href="#tab_dop" data-toggle="tab"> Контакты </a>
                            </li>
                            <li>
                                <a href="#tab_staff" data-toggle="tab"> Преподователи </a>
                            </li>
                            <li id="afterInsert">
                                <a href="#tab_meta" data-toggle="tab"> Meta-информация </a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Заголовок:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="h1" id="h1" placeholder="" value=""> </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Категории (фильтры):
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <div class="form-control height-auto">
                                                <div class="scroller" style="height:275px;" data-always-visible="1">
                                                    <ul class="list-unstyled">
                                                        <?php foreach ($cards_cat_filter as $key => $value): ?>
                                                        <li>
                                                            <label>
                                                                <?=$key?>
                                                            </label>
                                                            <ul class="list-unstyled">
                                                                <?php foreach ($value as $key1 => $value1): ?>
                                                                <li>
                                                                    <label>
                                                                        <input type="checkbox" name="filters" value="<?=$value1['id_filter']?>" <?if (isset($value1[ 'value'])) { echo "checked"; }?>>
                                                                        <?=$value1['filter'];?>
                                                                    </label>
                                                                </li>
                                                                <?php endforeach ?>
                                                            </ul>
                                                            <?php endforeach ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="help-block"> select one or more categories </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Статус:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <div class="form-control height-auto">
                                                <div class="mt-checkbox-inline">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="public" value="1" checked> Опубликовано?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="archive" value="1"> Убрать в архив?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="slider" value="1"> В слайдер?
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                                            <label class="col-md-2 control-label">Available Date:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                                                    <input type="text" class="form-control" name="product[available_from]">
                                                                    <span class="input-group-addon"> to </span>
                                                                    <input type="text" class="form-control" name="product[available_to]"> </div>
                                                                <span class="help-block"> availability daterange. </span>
                                                            </div>
                                                        </div> -->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">URL:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class=" form-control" name="alias" id="alias" placeholder="" value=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Ссылка:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="link" id="link" placeholder="" value=""> </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label col-md-2">Загрузка изображений</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                </div>
                                                <span class="btn red btn-outline btn-file">
                                                                                    <span class="fileinput-new"> Select image </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" id="logo" name="file"> </span>
                                                <a href="#small" class="btn red fileinput-exists" data-toggle="modal" > Remove </a>
                                            </div>
                                            <div class="clearfix margin-top-10">
                                                <span class="label label-success">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                                            <label class="col-md-2 control-label">Price:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="product[price]" placeholder=""> </div>
                                                        </div> -->
                                    <!-- <div class="form-group">
                                                            <label class="col-md-2 control-label">Status:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <select class="table-group-action-input form-control input-medium" name="product[status]">
                                                                    <option value="">Select...</option>
                                                                    <option value="1">Published</option>
                                                                    <option value="0">Not Published</option>
                                                                </select>
                                                            </div>
                                                        </div> -->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_content">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">BODY:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <div name="summernote" id="summernote_1"> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Короткое описание:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="preview_text" id="preview_text"></textarea>
                                            <span class="help-block"> Показывается в предпросмотре </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_meta">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Title:</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control maxlength-handler" name="title" id="title" maxlength="100" placeholder="" value="">
                                            <span class="help-block"> max 100 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Keywords:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" id="meta_keywords" name="meta_keywords" maxlength="1000"></textarea>
                                            <span class="help-block"> max 1000 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Description:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" name="description" id="description" maxlength="255"></textarea>
                                            <span class="help-block"> max 255 chars </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_images">
                                <div class="alert alert-success margin-bottom-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <i class="fa fa-warning fa-lg"></i> Image type and information need to be specified. </div>
                                <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
                                    <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn btn-success">
                                        <i class="fa fa-plus"></i> Select Files </a>
                                    <a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn btn-primary">
                                        <i class="fa fa-share"></i> Upload Files </a>
                                </div>
                                <div class="row">
                                    <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12"> </div>
                                </div>
                                <table class="table table-bordered table-hover" id="datatable_images">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th width="8%"> Image </th>
                                            <th width="25%"> Label </th>
                                            <th width="8%"> Sort Order </th>
                                            <th width="10%"> Base Image </th>
                                            <th width="10%"> Small Image </th>
                                            <th width="10%"> Thumbnail </th>
                                            <th width="10%"> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="/assets/pages/media/works/img1.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                    <img class="img-responsive" src="/assets/pages/media/works/img1.jpg" alt=""> </a>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="product[images][1][label]" value="Thumbnail image"> </td>
                                            <td>
                                                <input type="text" class="form-control" name="product[images][1][sort_order]" value="1"> </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][1][image_type]" value="1"> </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][1][image_type]" value="2"> </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][1][image_type]" value="3" checked> </label>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-default btn-sm">
                                                    <i class="fa fa-times"></i> Remove </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_staff">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Выберите преподователей</label>
                                        <div class="col-md-9">
                                            <select multiple="multiple" class="multi-select" id="staffSelect" name="staffSelect">
                                                <?php foreach ($staffCard as $key => $value): ?>
                                                <option value="<?=$value['id_staff']?>">
                                                    <?=$value['name']?>
                                                </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane" id="tab_language">
                                <div class="form-body">
                                <div class="alert alert-success margin-bottom-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <i class="fa fa-warning fa-lg"></i> Не забывайте перевести нужно все что связано с карточкой фильтры категории и так далее. Иначе значения для иностранных пользователей просто не будут показываться. </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Выберите язык, который хотите заполнить</label>
                                        <div class="col-md-8">
                                                            <select size="1" id="language_select" class="form-control" name="language_select">
                                                                <option value="">
                                                                    По умолчанию
                                                                </option>
                                                                <option value="eng">
                                                                    Английский
                                                                </option>
                                                                
                                                            </select>
                                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="tab-pane" id="tab_reviews">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Бал:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="star_slide" id="star_slide" placeholder="" value=""> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Заголовок:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="h1_review" id="h1_review" placeholder="" value=""> </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">BODY:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-10">
                                        <div name="summernote" id="summernote_2"> </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Статус:
                                        <span class="required"> * </span>
                                    </label>
                                    <div class="col-md-10">
                                        <div class="form-control height-auto">
                                            <div class="mt-checkbox-inline">
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="public_review" value="1"> Опубликовано?
                                                    <span></span>
                                                </label>
                                                <label class="mt-checkbox">
                                                    <input type="checkbox" id="archive_review" value="1"> Убрать в архив?
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-1">
                                        <button type="button" id="addReview" class="btn blue">Добавить отзыв</button>
                                    </div>
                                </div>
                                <div class="table-container">
                                    <table class="table table-striped table-bordered table-hover" id="datatable_reviews">
                                        <thead>
                                            <tr role="row" class="heading">
                                                <th width="5%"> Review&nbsp;# </th>
                                                <th width="10%"> Review&nbsp;Date </th>
                                                <th width="10%"> h1 </th>
                                                <th width="20%"> Review&nbsp;Content </th>
                                                <th width="10%"> Status </th>
                                                <th width="10%"> Actions </th>
                                            </tr>
                                            <tr role="row" class="filter">
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="product_review_no"> </td>
                                                <td>
                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="product_review_date_from" placeholder="From">
                                                        <span class="input-group-btn">
                                                                                <button class="btn btn-sm default" type="button">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </button>
                                                                            </span>
                                                    </div>
                                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                                        <input type="text" class="form-control form-filter input-sm" readonly name="product_review_date_to" placeholder="To">
                                                        <span class="input-group-btn">
                                                                                <button class="btn btn-sm default" type="button">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </button>
                                                                            </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="h1"> </td>
                                                <td>
                                                    <input type="text" class="form-control form-filter input-sm" name="body"> </td>
                                                <td>
                                                    <select name="product_review_status" class="form-control form-filter input-sm">
                                                        <option value="">Select...</option>
                                                        <option value="public">Опубликовано</option>
                                                        <option value="non-public">Не опубликовано</option>
                                                        <option value="archive">В архиве</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="margin-bottom-5">
                                                        <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                                            <i class="fa fa-search"></i> Search</button>
                                                    </div>
                                                    <button class="btn btn-sm btn-danger filter-cancel">
                                                        <i class="fa fa-times"></i> Reset</button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody> </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_dop">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-bar-chart font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold uppercase">Контактная информация</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Телефон: </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="input form-control" id="phone" name="phone" value="" placeholder="+7-999-99-99">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="portlet light bordered">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="icon-bar-chart font-dark hide"></i>
                                                        <span class="caption-subject font-dark bold uppercase">Предпросмотр карты</span>
                                                        <span class="caption-helper"></span>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div id="map" class="col-md-8 col-sm-8" style=" overflow-x: scroll; ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-bar-chart font-dark hide"></i>
                                                    <span class="caption-subject font-dark bold uppercase">Настройка карты</span>
                                                    <span class="caption-helper"></span>
                                                </div>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="form-body" id="code">
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Название точки: </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class=" input form-control" id="map_title" name="map_title" value="My Business Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Адрес точки: </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="input form-control" id="address" name="address" value="Луначарского 11 к1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Координаты: </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="input form-control" id="coordinates" name="coordinates" value="" placeholder="e.g: 53.2734,-7.77832031">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Вид карты: </label>
                                                        <div class="col-md-8">
                                                            <select size="1" id="t" class="form-control" name="t">
                                                                <option value="">
                                                                    Map
                                                                </option>
                                                                <option value="k">
                                                                    Satellite
                                                                </option>
                                                                <option value="h">
                                                                    Hybrid
                                                                </option>
                                                                <option value="p">
                                                                    Terrain
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Zoom: </label>
                                                        <div class="col-md-8">
                                                            <select size="1" id="zoom" class="form-control" name="zoom">
                                                                <option value="0" id="zoom_custom">max.zoom out</option>
                                                                <option value="1">
                                                                    4.000 km
                                                                </option>
                                                                <option value="2">
                                                                    2.000 km (world)
                                                                </option>
                                                                <option value="3">
                                                                    1.000 km
                                                                </option>
                                                                <option value="4">
                                                                    400 km (continent)
                                                                </option>
                                                                <option value="5">
                                                                    200 km
                                                                </option>
                                                                <option value="6">
                                                                    100 km (country)
                                                                </option>
                                                                <option value="7">
                                                                    50 km
                                                                </option>
                                                                <option value="8">
                                                                    30 km
                                                                </option>
                                                                <option value="9">
                                                                    15 km (area)
                                                                </option>
                                                                <option value="10">
                                                                    8 km
                                                                </option>
                                                                <option value="11">
                                                                    4 km
                                                                </option>
                                                                <option value="12">
                                                                    2 km (city)
                                                                </option>
                                                                <option value="13">
                                                                    1 km
                                                                </option>
                                                                <option value="14" selected="selected">
                                                                    400 m (district)
                                                                </option>
                                                                <option value="15">
                                                                    200 m
                                                                </option>
                                                                <option value="16">
                                                                    100 m
                                                                </option>
                                                                <option value="17">
                                                                    50 m (street)
                                                                </option>
                                                                <option value="18">
                                                                    20 m
                                                                </option>
                                                                <option value="19">
                                                                    10 m
                                                                </option>
                                                                <option value="20">
                                                                    5 m (house)
                                                                </option>
                                                                <option value="21">
                                                                    2,5 m
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Высота карты: </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="input form-control" id="h" name="h" value="370">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Ширина карты: </label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="input form-control" id="w" name="w" value="720" disabled="disabled">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Статус:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-8">
                                                            <div class="form-control height-auto">
                                                                <div class="mt-checkbox-inline">
                                                                    <label class="mt-checkbox">
                                                                        <input type="checkbox" id="autofit" name="autofit" checked> Авто-подстройка?
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="mt-checkbox">
                                                                        <input type="checkbox" id="info" name="info" value="A" checked> Показывать PopUp?
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="col-md-4 control-label">Ваш код: </label>
                                                        <div class="col-md-8">
                                                            <textarea rows="3" id='map_frame' class="distance-container form-control" cols="50" readonly="readonly" onclick="jQuery(this).select();"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        </div>
    </div>
  
    <div class="row ">
        <div class="col-md-12 col-md-push-3">
            <div class="actions btn-set">
                <button class="reset btn btn-secondary-outline">
                    <i class="fa fa-reply"></i> Reset</button>
                <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" onclick="" />
                <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
            </div>
        </div>
    </div>
<div id="small" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false">
                                        <div class="modal-body">
                                            <p> Вы хотите отчистить предыдущее значение? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Отмена</button>
                                            <button type="button" data-dismiss="modal" data-trigger="fileinput" onclick="$('.fileinput').fileinput('clear');" class="btn red">Отчистить</button>
                                        </div>
                                    </div>