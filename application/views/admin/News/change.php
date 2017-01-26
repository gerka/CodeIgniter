<? 
$Review['archive']=0;
$Review['public']=0;
$Review['h1']=0;
?>

<script type="text/javascript">
var site_url = "<?=site_url()?>";
var idCards = '<?=$NewsItem['id_news']?>';
var idElement = '<?=$NewsItem['id_element']?>';
var tagsToAdd = JSON.parse('<?=json_encode($tagsAddedNews)?>');

</script>
<script type="text/javascript">
var newsItem = <?=json_encode($NewsItem['body'])?>;
//var newsDate = new Date('<?=strtotime($NewsItem['date_create'])?>');
// Split timestamp into [ Y, M, D, h, m, s ]
var t = "<?=$NewsItem['date_create']?>".split(/[- :]/);
// Apply each element to the Date function
var newsDate = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
var idNews = "<?=$NewsItem['id_news']?>";
console.log(<?=json_encode($NewsItem)?>);
</script>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal form-row-seperated" id="changeNewsForm" name="changeNewsForm">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i>Изменение новости <?=$NewsItem['h1']?></div>
                    <div class="actions btn-set">
                        <button type="button" name="back" class="btn btn-secondary-outline">
                            <i class="fa fa-angle-left"></i> Back</button>
                        <button class="btn btn-secondary-outline">
                            <i class="fa fa-reply"></i> Reset</button>
                        <input type="button"  class="btn blue send_data_close" value="Сохранить и выйти"  />
                        <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
                        <div class="btn-group">
                            <a class="btn btn-success dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                <i class="fa fa-share"></i> More
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <a href="/<?=$NewsItem['alias']?>" target="_blank" class="btn btn-circle btn-info">
                                            <i class="fa fa-plus"></i>
                                            <span class="hidden-xs"> Просмотреть </span>
                                        </a>
                            <div class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;"> Duplicate </a>
                                </li>
                                <li>
                                    <a href="javascript:;"> Delete </a>
                                </li>
                                <li class="dropdown-divider"> </li>
                                <li>
                                    <a href="javascript:;"> Print </a>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable-bordered">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_general" data-toggle="tab"> Основные </a>
                            </li>
                            <li>
                                <a href="#tab_content" data-toggle="tab"> Контент </a>
                            </li>
                            <li>
                                <a href="#tab_meta" data-toggle="tab"> Meta-информация </a>
                            </li>
                            <li>
                                <a href="#tab_language" data-toggle="tab"> Язык </a>
                            </li>
                            <!-- <li>
                                                    <a href="#tab_images" data-toggle="tab"> Картинки </a>
                                                </li> -->
                            <!-- <li>
                                                    <a href="#tab_reviews" data-toggle="tab"> Reviews
                                                        <span class="badge badge-success"> 3 </span>
                                                    </a>
                                                </li> -->
                                                <!-- <li>
                                                    <a href="#tab_history" data-toggle="tab"> History </a>
                                                </li> -->

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Заголовок:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="h1" id="h1" placeholder="" value="<?=$NewsItem['h1']?>"> </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Категории новостей:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <?php if (!empty($news_cat_filter)): ?>
                                            <div class="form-control height-auto">
                                                <div class="scroller" style="height:200px;" data-always-visible="1">
                                                    <div class="mt-radio-list">
                                                        <?php foreach ($news_cat_filter as $key => $value): ?>
                                                        <?php foreach ($value as $key1 => $value1): ?>
                                                        <label class="mt-radio mt-radio-outline">
                                                            <input type="radio" class="icheck" data-radio="iradio_flat-grey" <?php if ($NewsItem['id_cat'] == $value1['id']): ?>
                                                                checked
                                                            <?php endif ?> name="news_cats" value="<?=$value1['id']?>">
                                                            <?=$value1['cat'];?><span></span></label>
                                                        <?php endforeach ?>
                                                        <?php endforeach ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php else: ?>
                                            <button type="button" class="btn default btn-lg">Похоже мы не нашли категорий для новостей</button>
                                            <?php endif ?>
                                            <span class="help-block"> select one or more categories </span>
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
                                        <label class="col-md-2 control-label">Алиас:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="alias" id="alias" placeholder="" value="<?=$NewsItem['alias']?>"> </div>
                                    </div>
                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Статус:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                            <div class="form-control height-auto">
                                                        <div class="mt-checkbox-inline">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="public" value="1" <?php if ($NewsItem['public'] == 1):  ?>
                                                            checked
                                                        <?php endif ?> > Опубликовано?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="archive" value="1" <?php if ($NewsItem['archive'] == 1):  ?>
                                                            checked
                                                        <?php endif ?>> Убрать в архив?
                                                        <span></span>
                                                    </label>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Дата публикации </label>
                                                <div class="col-md-4">
                                                    <div class="input-group date form_datetime">
                                                        <input type="text" id="NewsDate" size="16" readonly class="form-control">
                                                        <span class="input-group-btn">
                                                            <button class="btn default date-set" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="form-group ">
                                        <label class="control-label col-md-2">Загрузка изображений</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                    <?php if (isset($NewsItem['logo']) and $NewsItem['logo']!=null and $NewsItem['logo'] !=''): ?>
                                                    <img id="preview_img" src="/images/<?=$NewsItem['logo']?>" alt="...">
                                                    <?php endif ?>
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
                            <div class="tab-pane" id="tab_content">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Контент:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <div name="summernote" id="summernote_1"> </div>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Выберите тэги:
                                        </label>
                                        <div class="col-md-10">
                                                    <select multiple="multiple" class="multi-select" id="tags" name="tags">
                                                        <?php foreach ($tagsNews as $key => $value): ?>
                                                            <option value="<?=$value['id_tag']?>"><?=$value['value']?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Короткое описание:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="preview_text" id="preview_text"><?=$NewsItem['preview_text']?></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_meta">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Title:</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control maxlength-handler" name="title" id="title" maxlength="100" placeholder="" value="<?=$NewsItem['title']?>">
                                            <span class="help-block"> max 100 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Keywords:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" id="meta_keywords" name="meta_keywords" maxlength="1000"><?=$NewsItem['meta_keywords']?></textarea>
                                            <span class="help-block"> max 1000 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Description:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" name="description" id="description" maxlength="255"><?=$NewsItem['description']?></textarea>
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
                                <table class="table table-bordered table-hover">
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
                                        <tr>
                                            <td>
                                                <a href="/assets/pages/media/works/img2.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                    <img class="img-responsive" src="/assets/pages/media/works/img2.jpg" alt=""> </a>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="product[images][2][label]" value="Product image #1"> </td>
                                            <td>
                                                <input type="text" class="form-control" name="product[images][2][sort_order]" value="1"> </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][2][image_type]" value="1"> </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][2][image_type]" value="2" checked> </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][2][image_type]" value="3"> </label>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-default btn-sm">
                                                    <i class="fa fa-times"></i> Remove </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="/assets/pages/media/works/img3.jpg" class="fancybox-button" data-rel="fancybox-button">
                                                    <img class="img-responsive" src="/assets/pages/media/works/img3.jpg" alt=""> </a>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" name="product[images][3][label]" value="Product image #2"> </td>
                                            <td>
                                                <input type="text" class="form-control" name="product[images][3][sort_order]" value="1"> </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][3][image_type]" value="1" checked> </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][3][image_type]" value="2"> </label>
                                            </td>
                                            <td>
                                                <label>
                                                    <input type="radio" name="product[images][3][image_type]" value="3"> </label>
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-default btn-sm">
                                                    <i class="fa fa-times"></i> Remove </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- <div class="row">
<div class="col-md-8">
<div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-green">
                                        <i class="icon-pin font-green"></i>
                                        <span class="caption-subject bold uppercase"> Изменение карточки товара</span>
                                    </div>
                                    <div class="actions">
                                        <div class="btn-group">
                                            <a class="btn btn-sm default dropdown-toggle" href="javascript:;" data-toggle="dropdown"> Settings
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-pencil"></i> Edit </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-trash-o"></i> Delete </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-ban"></i> Ban </a>
                                                </li>
                                                <li class="divider"> </li>
                                                <li>
                                                    <a href="javascript:;"> Make admin </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                
                                    
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control " id="title" name="title">
                                                <label for="title">Заголовок</label>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <textarea class="form-control" rows="3" id="description" name="description"></textarea>
                                                <label for="description">Короткое описание</label>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <textarea class="form-control" rows="3" id="body" name="body"></textarea>
                                                <label for="body">Полное описание</label>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control " id="meta_keywords" name="meta_keywords">
                                                <label for="meta_keywords">META-Слова</label>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control " id="link" name="link">
                                                <label for="link">Ссылка</label>
                                                <span class="help-block"></span>
                                            </div>
                                            <div class="form-group form-md-line-input form-md-floating-label">
                                                <input type="text" class="form-control " id="logo" name="logo">
                                                <label for="logo">Логотип</label>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="form-actions noborder">
                                        <input type="button" id="send_data" class="btn blue" value="Создать карточку товара" />
                                            
                                            <button type="button" class="btn default">Cancel</button>
                                        </div>
                                    </form>
                                </div>
</div>
</div>
</div> -->
<div class="actions btn-set">
    <button type="button" name="back" class="btn btn-secondary-outline">
        <i class="fa fa-angle-left"></i> Back</button>
    <button class="btn btn-secondary-outline">
        <i class="fa fa-reply"></i> Reset</button>
    <input type="button"  class="btn blue send_data_close" value="Сохранить и выйти"  />
    <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
    <div class="btn-group">
        <a class="btn btn-success dropdown-toggle" href="javascript:;" data-toggle="dropdown">
            <i class="fa fa-share"></i> More
            <i class="fa fa-angle-down"></i>
        </a>
        <div class="dropdown-menu pull-right">
            <li>
                <a href="javascript:;"> Duplicate </a>
            </li>
            <li>
                <a href="javascript:;"> Delete </a>
            </li>
            <li class="dropdown-divider"> </li>
            <li>
                <a href="javascript:;"> Print </a>
            </li>
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
