<script type="text/javascript">
var site_url = "<?=site_url()?>";
var FilterCat = <?=json_encode($FilterCat)?>;
console.log(FilterCat);
</script>
<div class="row">
    <div class="col-md-12">
        <form name="importItem" id="importItem" class="form-horizontal form-row-seperated">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i>
                        <?=$title?>
                    </div>
                    
                </div>
                <div class="portlet-body">
                    <div class="tabbable-bordered">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_cards" data-toggle="tab"> Фильтры </a>
                            </li>
                            <!-- <li>
                                <a href="#tab_meta" data-toggle="tab"> Meta-информация </a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_cards">
                                <div class="form-body">
                                    <div class="alert alert-success margin-bottom-10">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                                        <i class="fa fa-warning fa-lg"></i> 
                                                        Раздел работает на загрузку.
                                                        Загрузите Excell файл как минимум с 2 столбцами для сравнения. 
                                                       <!--  Не забывайте загружать файлы Excel  -->
                                                         </div>
                                                    <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
                                                        <a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn btn-success">
                                                            <i class="fa fa-plus"></i> Select Files </a>
                                                        <a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn btn-primary">
                                                            <i class="fa fa-share"></i> Upload Files </a>
                                                    </div>
                                                    <div class="row">
                                    <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12"> </div>
                                </div>

                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
<div class="portlet light bg-inverse">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-red-sunglo"></i>
                                                    <span class="caption-subject font-red-sunglo bold uppercase">Настройки связей</span>
                                                    <span class="caption-helper"></span>
                                                </div>
                                                
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="#" class="horizontal-form">
                                                    <div class="form-body">
                                                        <h3 class="form-section">Выбор категорий</h3>
                                                        
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Родитель</label>
                                                                    <select id="idParentCat" data-name="idParentCat" class="form-control">
                                                                        <?php foreach ($FilterCat as $key => $value): ?>
                                                                        <option value="<?=$value['idfilter_cat']?>">
                                                                            <?=$value['h1']?>
                                                                        </option>
                                                                        <?php endforeach ?>                                                                    </select>
                                                                    <span class="help-block"> Выберите родительскую категорию фильтров из базы</span>
                                                                </div>
                                                               
                                            
                                        
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Дочерний</label>
                                                                    <select id="idChildCat" data-name="idChildCat" class="form-control">
                                                                        <?php foreach ($FilterCat as $key => $value): ?>
                                                                        <option value="<?=$value['idfilter_cat']?>">
                                                                            <?=$value['h1']?>
                                                                        </option>
                                                                        <?php endforeach ?>                                                                    </select>
                                                                    <span class="help-block"> Выберите дочернюю категорию фильтров в базе</span>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            
                                                        </div>
                                                        <!--/row--><h3 class="form-section">Выбор категорий </h3>
                                                        
                                                        <!--/row-->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Родитель</label>
                                                                    <select id="parentCat" data-name="parentCat" class="form-control selectPreview">
                                                                        <option value="NotInclude">Сначала загрузите файл</option>
                                                                    </select>
                                                                    <span class="help-block"> Выберите родительскую категорию фильтров</span>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Дочерний</label>
                                                                    <select id="childCat" data-name="childCat" class="form-control selectPreview">
                                                                        <option value="NotInclude">Сначала загрузите файл</option>
                                                                    </select>
                                                                    <span class="help-block"> Выберите дочернюю категорию фильтров </span>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            
                                                        </div>
                                                        <!--/row-->
                                                        
                                                        <div class="row">
                                                            <div class="col-md-12 ">
                                                                <div class="form-group">
                                                                    <label>Сравнение по:</label>
                                                                    <select id="compareField" data-name="compareField" class=" form-control">
                                                                  <option value="value">Значению</option>
                                                                  <option value="h1">Заголовку</option>
                                                                  <option value="id">Идентификатору</option>
                                                                </select> </div>

                                                            </div>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-actions left">
                                                        <input type="button" id="base-load" class="btn btn-success " value="Загрузить в базу">
                                                    </div>
                                                </form>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
    </div>
</div>
<div class="row " id="previewTable">
    <!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet box yellow">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-comments"></i>Предпросмотр в табличном виде </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable" >
                                        <table class="table table-bordered table-hover" id="TablePreviewContainer">
                                            <thead>
                                                <tr id="headPreviewTable">
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="rowPreviewTable">
                                                
                                                    <!-- <td> 1 </td>
                                                    <td class="active"> active </td>
                                                    <td class="success"> success </td>
                                                    <td class="warning"> warning </td>
                                                    <td class="danger"> danger </td> -->
                                                                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->
</div>

<div class="row ">
    <div class="col-md-7 col-md-push-5">
        <!-- <div class="actions btn-set">
            <button type="button" name="back" class="btn btn-secondary-outline">
                <i class="fa fa-angle-left"></i> Back</button>
            <button class="btn btn-secondary-outline">
                <i class="fa fa-reply"></i> Reset</button>
            <input type="button" class="btn blue send_data_close" value="Сохранить и выйти"  />
            <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
        </div> -->
    </div>
</div>
