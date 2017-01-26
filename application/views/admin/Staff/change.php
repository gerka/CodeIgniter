
<script type="text/javascript">

var site_url = "<?=site_url()?>";
var idStaff = <?=$staffItem['id_staff']?>;
var idElement = <?=$staffItem['id_element']?>;

</script>

<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal form-row-seperated" id="changeStaff" name="changeStaff">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i><?=$title?></div>
                    <div class="actions btn-set">
                        <button type="button" name="back" class="btn btn-secondary-outline">
                            <i class="fa fa-angle-left"></i> Back</button>
                        <button class="reset btn btn-secondary-outline">
                            <i class="fa fa-reply"></i> Reset</button>
                        <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" onclick="" />
                        <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
                         <a href="/<?=$staffItem['alias']?>" target="_blank" class="preview btn purple" > Просмотреть преподователя</a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable-bordered">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_general" data-toggle="tab"> Основные </a>
                            </li>
                            <li>
                                <a href="#tab_images" data-toggle="tab"> Файлы </a>
                            </li>
                            <li>
                                <a href="#tab_filters" data-toggle="tab"> Фильтры  </a>
                            </li>
                            <li>
                                <a href="#tab_language" data-toggle="tab"> Язык </a>
                            </li>
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ФИО:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Иван Васильевич Кузьмин" value="<?=$staffItem['name']?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Духовное имя:
                                            
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="etc" id="etc" placeholder="Иван Васильевич Кузьмин" value="<?=$staffItem['etc']?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Короткое описание:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description" id="description"><?=$staffItem['description']?></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Телефон:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="telephone" id="telephone"><?=$staffItem['telephone']?></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">E-mail:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="email" id="email"><?=$staffItem['email']?></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">site:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="site" id="site"><?=$staffItem['site']?></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Алиас:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="alias" id="alias" placeholder="" value="<?=$staffItem['alias']?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Сортировка:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="sort" id="sort" placeholder="0" value="<?=$staffItem['sort']?>"> </div>
                                    </div>
                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Учавствует в:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                        <select multiple="multiple" class="multi-select" id="CardsSelect" name="CardsSelect[]">

                                                        <?php foreach ($cards_select as $key => $value): ?>
                                                            <option value="<?=$value['id_post']?>" <?php if (isset($value['value']) and $value['value']==1): ?>
                                                                selected
                                                            <?php endif ?>><?=$value['card']?></option>
                                                        <?php endforeach ?>
                                                        
                                                    </select>
                                                        <span class="help-block"> select one or more categories </span>
                                                        </div>
                                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label col-md-2">Загрузка изображений</label>
                                        <div class="col-md-9">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                    <?php if (isset($staffItem['logo']) and $staffItem['logo']!=null and $staffItem['logo'] !=''): ?>
                                                            <img id="image_logo" src="/images/<?=$staffItem['logo']?>" alt="...">
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
                                <div class="alert alert-success margin-bottom-10">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                    <i class="fa fa-warning fa-lg"></i> Можно присвоить несколько значений</div>
                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Страна:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                        <select multiple="multiple" class="multi-select" id="filterCountry" name="filterCountry[]">

                                                        <?php foreach ($filterCountry as $key => $value): ?>
                                                            <option value="<?=$value['id_filter']?>" <?php if (isset($value['value_select']) and $value['value_select']==1): ?>
                                                                selected
                                                            <?php endif ?>><?=$value['value']?></option>
                                                        <?php endforeach ?>
                                                        
                                                    </select>
                                                        <span class="help-block"> select one or more categories </span>
                                                        </div>
                                                    </div>
                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Регион:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                        <select multiple="multiple" class="multi-select" id="filterRegion" name="filterRegion[]">

                                                        <?php foreach ($filterRegion as $key => $value): ?>
                                                            <option value="<?=$value['id_filter']?>" <?php if (isset($value['value_select']) and $value['value_select']==1): ?>
                                                                selected
                                                            <?php endif ?>><?=$value['value']?></option>
                                                        <?php endforeach ?>
                                                        
                                                    </select>
                                                        <span class="help-block"> select one or more categories </span>
                                                        </div>
                                                    </div>
                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Город:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                        <select multiple="multiple" class="multi-select" id="filterCity" name="filterCity[]">

                                                        <?php foreach ($filterCity as $key => $value): ?>
                                                            <option value="<?=$value['id_filter']?>" <?php if (isset($value['value_select']) and $value['value_select']==1): ?>
                                                                selected
                                                            <?php endif ?>><?=$value['value']?></option>
                                                        <?php endforeach ?>
                                                        
                                                    </select>
                                                        <span class="help-block"> select one or more categories </span>
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
                            <div class="tab-pane" id="tab_images">
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
            <button type="button" name="back" class="btn btn-secondary-outline">
                <i class="fa fa-angle-left"></i> Back</button>
                <button class="reset btn btn-secondary-outline">
                    <i class="fa fa-reply"></i> Reset</button>
                    <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" onclick="" />
                    <input type="button" class="btn btn-success send_data"  value="Сохранить и продолжить">
                    
                </div></div></div>
                <div id="small" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false">
                                        <div class="modal-body">
                                            <p> Вы хотите отчистить предыдущее значение? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Отмена</button>
                                            <button type="button" data-dismiss="modal" data-trigger="fileinput" onclick="$('.fileinput').fileinput('clear');" class="btn red">Отчистить</button>
                                        </div>
                                    </div>