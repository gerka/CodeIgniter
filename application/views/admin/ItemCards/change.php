<? 
$Review['archive']=0;
$Review['public']=0;
$Review['h1']=0;
?>
<script type="text/javascript">
var cardsItem = <?=json_encode($CardsItem['body'])?>;
var idCards = '<?=$CardsItem['id_post']?>';
var idElement = '<?=$CardsItem['id_element']?>';
var idMenu = '<?=$menuCard['id_menu']?>';
var event2 = <?=($CardsItem['event']) ? $CardsItem['event'] : 0?>;

var raspisan =<?=($CardsItem['schedule']) ? $CardsItem['schedule'] : "{'Mon':'','Tue':'','Wed':'','Thu':'','Fri':'','Sat':'','Sun':''}" ?>;
console.log(event2);
</script>  
<!-- <div class="row"> -->
                        <div class="col-md-12">
                            
                               <form  class="form-horizontal form-row-seperated" name="changeItem" id="changeItem" >
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-shopping-cart"></i>Редактирование карточки № <?=$CardsItem['id_post']?> </div>
                                        

        <div class="actions btn-set">
            
                <button class="reset btn btn-secondary-outline">
                    <i class="fa fa-reply"></i> Reset</button>
                    <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" />
                    <input type="button" class="btn btn-success send_data"  value="Сохранить и продолжить">
                     <a href="/<?=$CardsItem['alias']?>" target="_blank" class="preview btn purple" > Просмотреть карточку</a>
                </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_general" data-toggle="tab"> Основные </a>
                                                </li>

                                                <li >
                                                    <a href="#tab_filters" data-toggle="tab"> Фильтры </a>
                                                </li>

                                                <li >
                                                    <a href="#tab_content" data-toggle="tab"> Контент </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_staff" data-toggle="tab"> Преподаватели </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_meta" data-toggle="tab"> Meta-информация </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_images" data-toggle="tab"> Картинки </a>
                                                </li>
                                                <li id='MapUp'>
                                                    <a href="#tab_dop" data-toggle="tab" > Контакты </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_date" data-toggle="tab"> Даты </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_reviews" data-toggle="tab"> Отзывы
                                                        <span class="badge badge-success"> <?=(!empty($countReview) ? $countReview:'')?> </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_language" data-toggle="tab"> Язык
                                                        
                                                    </a>
                                                </li>
                                                
                                                
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_general">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">H1:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="h1" id="h1" placeholder="" value="<?=$CardsItem['h1']?>"> </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="control-label col-md-2">Меню
                                                            <span class="required"> * </span>
                                                            <span class="help-block"> Место в каталоге </span>
                                                                </label>
                                                            <div class="col-md-9">
                                                                <script type="text/javascript">console.log(<?=json_encode($menu)?>)</script>
                                                                 <select name="MenuAdd" id="MenuAdd" >
                                                                    <?php foreach ($menu as $key => $value): ?>
                                                                    <option value="<?=$value['id_menu']?>"><?=$value['value']?></option>
                                                                    <?php endforeach ?>
                                                                </select>
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
                                                        <input type="checkbox" id="public" value="1" <?php if ($CardsItem['public'] == 1):  ?>
                                                            checked
                                                        <?php endif ?> > Опубликовано?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="archive" value="1" <?php if ($CardsItem['archive'] == 1):  ?>
                                                            checked
                                                        <?php endif ?>> Убрать в архив?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="slider" value="1" <?php if ($CardsItem['slider'] == 1):  ?>
                                                            checked
                                                        <?php endif ?>> В слайдере TOP?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="on_home" value="1" <?php if ($CardsItem['home'] == 1):  ?>
                                                            checked
                                                        <?php endif ?>> На главной?
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
                                                        <div class="form-group" data-id='url'>
                                                            <label class="col-md-2 control-label">URL:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class=" form-control" name="alias" id="alias" placeholder="" value="<?=$CardsItem['alias']?>"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Ссылка:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="link" id="link" placeholder="" value="<?=$CardsItem['link']?>"> </div>
                                                        </div>
                                                        <div class="form-group ">
                                                                    <label class="control-label col-md-2">Загрузка изображений</label>
                                                                    <div class="col-md-9">
                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                            <div class="fileinput-preview thumbnail " style="width: 200px; height: 150px;">
                                                                                <?php if (isset($CardsItem['logo']) and $CardsItem['logo']!=null and $CardsItem['logo'] !=''): ?>
                                                            <img id="image_logo" src="/images/<?=$CardsItem['logo']?>" alt="...">
                                                        <?php endif ?>
                                                        
                                                                            </div>
                                                                            
                                                                                <span class="btn red btn-outline btn-file">
                                                                                    <span class="fileinput-new"> Select image </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" id="logo" name="file"> </span>
                                                                                    <a href="#small" class="btn red fileinput-exists" data-toggle="modal"> Remove </a>
                                                                                
                                                                            </div>
                                                                            <div class="clearfix margin-top-10">
                                                                                <span class="label label-success">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                                                            </div>
                                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab_filters">
                                                    <div class="form-body">
                                                       <div class="form-group">
                                                        <label class="col-md-3 control-label">Рекомендуемый набор фильтров:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                        <select multiple="multiple" class="multi-select filters" id="FilterSelect" name="FilterSelect[]">
                                                        <optgroup label=''><option></option></optgroup>
                                                        <?php foreach ($cards_cat_filter as $key => $value): ?>
                                                           <optgroup label='<?=$key?>'>
                                                                  <?php foreach ($value as $key1 => $value1): ?>
                                                               <option <?if (isset($value1['value'])) {
                                                                   echo 'selected="selected"';
                                                               }?> value="<?=$value1['id_filter']?>"><?=$value1['filter']?></option>
                                                                <?php endforeach ?>  
                                                            </optgroup>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <span class="help-block"> select one or more categories </span>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label">Дополнительные фильтры:
                                                            <span class="required">  </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                             <select multiple="multiple" class="multi-select filters" id="DopFilterSelect" name="DopFilterSelect[]">
                                                        <optgroup label=''><option></option></optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group hidden">
                                                            <label class="col-md-2 control-label">Категории (фильтры):
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <div class="form-control height-auto">
                                                                <script type="text/javascript">console.log(<?=json_encode($cards_cat_filter)?>)</script>
                                                                    <div class="scroller" style="height:275px;" data-always-visible="1">
                                                                        <ul class="list-unstyled">
                                                                        
                                                                        <?php foreach ($cards_cat_filter as $key => $value): ?>
                                                                                    <li>
                                                                                <label>
                                                                                   <?=$key?></label>
                                                                                   
                                                                                   <ul class="list-unstyled">
                                                                                          <?php foreach ($value as $key1 => $value1): ?>
                                                                                         <li><label>
                                                                                       <input type="checkbox" name="filters" value="<?=$value1['id_filter']?>" <?if (isset($value1['value'])) {
                                                                                           echo "checked";
                                                                                       }?>>  <?=$value1['filter'];?></label></li>
                                                                                        <?php endforeach ?>  
                                                                                    </ul>

                                                                                    <?php endforeach ?>
                                                                                    
                                                                                    
                                                                             </ul>
                                                                    </div>
                                                                </div>
                                                                <span class="help-block"> select one or more categories </span>
                                                            </div>

                                                </div>
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
                                                                <textarea class="form-control" name="preview_text" id="preview_text"><?=$CardsItem['preview_text']?></textarea>
                                                                <span class="help-block"> shown in product listing </span>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab_date">
                                                    <!-- <div class="alert alert-success margin-bottom-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <i class="fa fa-warning fa-lg"></i> 
                                        
                                    </div> -->
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Дата:
                                                                <span class="help-block"> Проведения мероприятия </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <div id="reportrange" class="btn default">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Регулярное расписание:
                                                                <span class="help-block"> Проведения занятий </span>
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="portlet-body">

                                                    <div class="input-group">
                                                        <input type="text" id="timePickerFrom" class="form-control timepicker ">
                                                        <span class="input-group-addon"> to </span>
                                                        <input type="text" id="timePickerTo" class="form-control timepicker ">
                                                    </div>
                                                
                                    <div class="table-scrollable">
                                        
                                     <table class="table table-hover">
                                            
                                            <tbody>
                                                <tr>
                                                    
                                                    
                                                </tr>
                                                    <tr > <td>ПН</td> 
                                                    <td > 
                                                    <a href="javascript:;" data-day="Mon" class="btn btn-icon-only green add">
                                                         <i class="fa fa-plus"></i>
                                                        </a> 
                                                    </td>
                                                    <td>
                                                    <input type="text" class="tags" data-role="tagsinput" id="Mon"/>
                                                    </td>
                                                    </tr>
                                                    <tr> <td>ВТ</td>
                                                    <td> 
                                                    <a href="javascript:;" data-day="Tue" class="btn btn-icon-only green add">
                                                         <i class="fa fa-plus"></i>
                                                        </a> 
                                                    </td>
                                                    <td>
                                                    <input type="text" class="tags" data-role="tagsinput" id="Tue"/>
                                                    </td>
                                                    </tr >
                                                    <tr> <td>СР</td>
                                                    <td> 
                                                    <a href="javascript:;" data-day="Wed" class="btn btn-icon-only green add">
                                                         <i class="fa fa-plus"></i>
                                                        </a> 
                                                    </td>
                                                    <td>
                                                    <input type="text" class="tags" data-role="tagsinput" id="Wed"/>
                                                    </td>
                                                    </tr>
                                                    <tr> <td>ЧТ</td>
                                                    <td> 
                                                    <a href="javascript:;" data-day="Thu" class="btn btn-icon-only green add">
                                                         <i class="fa fa-plus"></i>
                                                        </a> 
                                                    </td>
                                                    <td>
                                                    <input type="text" class="tags" data-role="tagsinput" id="Thu"/>
                                                    </td>
                                                    </tr>
                                                    <tr> <td>ПТ</td>
                                                    <td> 
                                                    <a href="javascript:;" data-day="Fri" class="btn btn-icon-only green add">
                                                         <i class="fa fa-plus"></i>
                                                        </a> 
                                                    </td>
                                                    <td>
                                                    <input type="text" class="tags" data-role="tagsinput" id="Fri"/>
                                                    </td>
                                                    </tr>
                                                    <tr> <td>СБ</td>
                                                    <td> 
                                                    <a href="javascript:;" data-day="Sat" class="btn btn-icon-only green add">
                                                         <i class="fa fa-plus"></i>
                                                        </a> 
                                                    </td>
                                                    <td>
                                                    <input type="text" class="tags" data-role="tagsinput" id="Sat"/>
                                                    </td>
                                                    </tr>
                                                    <tr> <td>ВС</td>
                                                    <td> 
                                                    <a href="javascript:;" data-day="Sun" class="btn btn-icon-only green add">
                                                         <i class="fa fa-plus"></i>
                                                        </a> 
                                                    </td>
                                                    <td>
                                                    <input type="text" class="tags" data-role="tagsinput" id="Sun"/>
                                                    </td>
                                                     </tr>
                                                    
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="tab-pane" id="tab_meta">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Meta Title:</label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control maxlength-handler" name="title" id="title" maxlength="100" placeholder="" value="<?=$CardsItem['title']?>">
                                                                <span class="help-block"> max 100 chars </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Meta Keywords:</label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control maxlength-handler" rows="8" id="meta_keywords" name="meta_keywords" maxlength="1000"><?=$CardsItem['meta_keywords']?></textarea>
                                                                <span class="help-block"> max 1000 chars </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Meta Description:</label>
                                                            <div class="col-md-10">
                                                                <textarea class="form-control maxlength-handler" rows="8" name="description" id="description" maxlength="255"><?=$CardsItem['description']?></textarea>
                                                                <span class="help-block"> max 255 chars </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab_images">
                                                <div class="row">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-dark hide"></i>
                                        <span class="caption-subject font-dark bold uppercase">Загрузка видео</span>
                                        <span class="caption-helper"></span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label">Идентификатор видео на YouTube: </label>
                                        <div class="col-md-8">
                                        
                                        <?php if (!empty($CardsItem['video'])): ?>
                                            <input type="text" class="input form-control" id="video" name="video" value="<?=$CardsItem['video']?>" placeholder="<?=$CardsItem['video']?>" >
                                        <?php else: ?>
                                         <input type="text" class="input form-control" id="video" name="video" value="" placeholder="some identity like WRRF21321JN" >
                                         <?php endif ?>
                                        </div>
                                    </div> 
                                       

                                    </div> 
                                </div>
                                 </div>
                                                    <div class="alert alert-success margin-bottom-10">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                        <i class="fa fa-warning fa-lg"></i> Раздел работает на загрузку и удаление. Находится в разработке. Не забывайте загружать изображения того формата, который хотели бы увидеть на сайте. </div>
                                                    <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
                                                        <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn btn-success">
                                                            <i class="fa fa-plus"></i> Select Files </a>
                                                        <a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn btn-primary">
                                                            <i class="fa fa-share"></i> Upload Files </a>
                                                    </div>
                                                    <div class="row">
                                                        <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12"> </div>
                                                    </div>
                                                    <table class="table table-striped table-bordered table-hover" id="datatable_images">
                                                        <thead>
                                                            <tr role="row" class="heading">
                                                                <th width="8%"> Изображение  </th>
                                                                <th width="25%"> Ссылка </th>
                                                                <th width="8%"> Текст </th>
                                                                <th width="10%"> sort </th>
                                                                <th width="10%"> id_user </th>
                                                                <th width="10%"> logo </th>
                                                                <th width="10%"> Кнопки </th>
                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                           
                                                        </tbody>
                                                    </table>
                                                    <h4 class="block">Последние загруженные файлы</h4>
                                                    <div id='lastImagesBlock'>                           
                                                    <div class="row">
                                                <?if (!empty($lastImages)) {
                                                    foreach ($lastImages as $key => $value) {?>
                                                    
                                                        <div class="col-sm-6 col-md-3 addToElement" data-id="<?=$value['idImage']?>">
                                            <a href="javascript:;" class="thumbnail">
                                                <img src="/<?=$value['url']?>" alt="100%"> </a>
                                        </div>
                                                   <? }
                                                }?>
                                    </div>
                                </div>
                                    <button type="button" class="btn green-meadow" id="loadLast" data-page="0" onclick="initLoadButton()">Загрузить еще</button>
                                                </div>
                                                <div class="tab-pane" id="tab_staff">
                                                <div class="form-body">   
                                                <div class="form-group">
                                                <label class="control-label col-md-3">Выберите преподователей</label>
                                                <div class="col-md-9">
                                                    <select multiple="multiple" class="multi-select" id="staffSelect" name="staffSelect">
                                                        <?php foreach ($staffCard as $key => $value): ?>
                                                            <option value="<?=$value['id_staff']?>" <?php if (isset($value['value']) and $value['value']==1): ?>
                                                                selected
                                                            <?php endif ?>><?=$value['name']?></option>
                                                        <?php endforeach ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                                    <!-- <table class="table table-bordered table-hover" id="datatable_staff">
                                                        <thead>
                                                            <tr role="row" class="heading">
                                                                <th width="8%"> Лого </th>
                                                                <th width="25%"> Имя </th>
                                                                <th width="8%"> Описание </th>
                                                                <th width="10%"> архив </th>
                                                                <th width="10%"> В карточку </th>
                                                                <th width="10%"> </th>
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
                                                    </table> -->
                                                </div>
                                                <div class="tab-pane" id="tab_reviews">
                                                <div class="form-group ">
                                                <label class="control-label col-md-3">Аватарка</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                        <div>
                                                            <span class="btn red btn-outline btn-file">
                                                                <span class="fileinput-new"> Select image </span>
                                                                <span class="fileinput-exists"> Change </span>
                                                                <input type="file" name="reviewAvatar" id="reviewAvatar"> </span>
                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix margin-top-10">
                                                        <span class="label label-success">NOTE!</span> Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead. </div>
                                                </div>
                                            </div>

                                                <div class="form-group">
                                                            <label class="col-md-2 control-label">Бал:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="star_slide" id="star_slide" placeholder="" value=""> </div>
                                                        </div>
                                                
                                                <div class="form-group">
                                                            <label class="col-md-2 control-label">H1:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="h1_review" id="h1_review" placeholder="" value="<?=$Review['h1']?>"> </div>
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
                                                        <input type="checkbox" id="public_review" value="1" <?php if ($Review['public'] == 1):  ?>
                                                            checked
                                                        <?php endif ?> > Опубликовано?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="archive_review" value="1" <?php if ($Review['archive'] == 1):  ?>
                                                            checked
                                                        <?php endif ?>> Убрать в архив?
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <div class="col-md-1">
                                                <button type="button" id="addReview" class="btn blue">Добавить отзыв</button></div>
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
                                        
                                        <?php if (!empty($CardsItem['telephone'])): ?>
                                            <input type="text" class="input form-control" id="phone" name="phone" value="<?=$CardsItem['telephone']?>" placeholder="<?=$CardsItem['telephone']?>" >
                                        <?php else: ?>
                                         <input type="text" class="input form-control" id="phone" name="phone" value="" placeholder="+79991233223" >
                                         <?php endif ?>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label">E-mail: </label>
                                        <div class="col-md-8">
                                        <script>console.log(<?=json_encode($CardsItem)?>)</script>
                                        <?php if (!empty($CardsItem['e_mail'])): ?>
                                            <input type="text" class="input form-control" id="e_mail" name="e_mail" value="<?=$CardsItem['e_mail']?>" placeholder="<?=$CardsItem['e_mail']?>" >
                                        <?php else: ?>
                                         <input type="text" class="input form-control" id="e_mail" name="e_mail" value="" placeholder="test@test.com" >
                                         <?php endif ?>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label">Контактное лицо: </label>
                                        <div class="col-md-8">
                                        <script>console.log(<?=json_encode($CardsItem)?>)</script>
                                        <?php if (!empty($CardsItem['contact_name'])): ?>
                                            <input type="text" class="input form-control" id="contact_name" name="contact_name" value="<?=$CardsItem['contact_name']?>" placeholder="<?=$CardsItem['contact_name']?>" >
                                        <?php else: ?>
                                         <input type="text" class="input form-control" id="contact_name" name="contact_name" value="" placeholder="Alice Wong" >
                                         <?php endif ?>
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
                                        </div></div>
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
                                                                    <label>Какие настройки показать?</label>
                                                                    <div class="mt-radio-inline">
                                                                        <label class="mt-radio">
                                                                            <input type="radio" name="OptionMap"  id="optionsRadiosMapSimple" value="Simple" checked> Простые?
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="mt-radio">
                                                                            <input type="radio" name="OptionMap"  id="optionsRadiosMapHard" value="Hard"> Сложные?
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="mt-radio">
                                                                            <input type="radio" name="OptionMap"  id="optionsRadiosMapDisable" value="Disable"> Не использовать карту?
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label">Название точки: </label>
                                        <div class="col-md-8">
                                        <?php if (!empty($CardsItem['company_name'])): ?>
                                            <input type="text" class=" input form-control" id="map_title" name="map_title" value="<?=$CardsItem['company_name']?>">
                                        <?php else: ?>
                                         <input type="text" class=" input form-control" id="map_title" name="map_title" value="My Business Name">
                                         <?php endif ?>
                                        

                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="col-md-4 control-label">Адрес точки: </label>
                                        <div class="col-md-8"><input type="text" class="input form-control" id="address" name="address" value="<?=$CardsItem['adress']?>"></div>
                                    </div>
                                    <div class="form-group hidden"  id='hidMap1'>
                                        <label for="" class="col-md-4 control-label">Координаты: </label>
                                        <div class="col-md-8"><input type="text" class="input form-control" id="coordinates" name="coordinates" value="" placeholder="e.g: 53.2734,-7.77832031"></div>
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
                                            </select></div>
                                    </div>
                                    <div class="form-group hidden"  id='hidMap2'>
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
                                                    5 m  (house)
                                                </option>
                                                <option value="21">
                                                    2,5 m
                                                </option>
                                            </select></div>
                                    </div>
                                    <div class="form-group hidden"  id='hidMap3'>
                                        <label for="" class="col-md-4 control-label">Высота карты: </label>
                                        <div class="col-md-8"><input type="text" class="input form-control" id="h" name="h" value="370"></div>
                                    </div>
                                    <div class="form-group hidden"  id='hidMap4'>
                                        <label for="" class="col-md-4 control-label">Ширина карты: </label>
                                        <div class="col-md-8">
                                        <input type="text" class="input form-control" id="w" name="w" value="720" disabled="disabled"></div>
                                    </div>        
                                    <div class="form-group hidden"  id='hidMap5'>
                                                        <label class="col-md-4 control-label">Статус:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-8">
                                                            <div class="form-control height-auto">
                                                        <div class="mt-checkbox-inline">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="autofit" name="autofit" checked > Авто-подстройка?
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
                                    
                                    <div class="form-group hidden"  id='hidMap6'>
                                        <label for="" class="col-md-4 control-label">Ваш код: </label>
                                        <div class="col-md-8"><textarea rows="3" id='map_frame' class="distance-container form-control" cols="50" readonly="readonly" onclick="jQuery(this).select();"><?=$CardsItem['map']?></textarea></div>
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
                    <input type="button" class="btn btn-success send_data"  value="Сохранить и продолжить">
                    <a href="/<?=$CardsItem['alias']?>" target="_blank" class="preview btn purple" > Просмотреть карточку</a>
                </div>
                </div>
                </div>
               <div id="small" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false">
                                        <div class="modal-body">
                                            <p> Вы хотите отчистить предыдущее значение? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Отмена</button>
                                            <button type="button" data-dismiss="modal" data-trigger="fileinput" onclick="$('.fileinput').fileinput('clear');" class="btn green">Отчистить</button>
                                        </div>
                                    </div>