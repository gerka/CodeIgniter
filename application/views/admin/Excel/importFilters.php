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
                                                        Раздел работает на загрузку. Находится в разработке. В данный момент есть загрузка карточек без фильтров. 
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
        <form class="form-horizontal form-row-seperated" id="createFilter" name="createFilter">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i>Создание фильтра </div>
                    <div class="actions btn-set">
                         <input type="button" id="base-load-filters" class="btn btn-success " value="Загрузить в базу">
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable-bordered">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_general" data-toggle="tab"> Основные </a>
                            </li>
                            <li>
                                <a href="#content" data-toggle="tab"> Контент </a>
                            </li>
                            <li>
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
                                            <select id="previewItemH1" data-name="Заголовок" class="selectPreview">
                                              <option value="NotInclude">Not include</option>
                                            </select> </div>
                                    </div>
                                    
                                    <div class="form-group form-md-line-input form-md-floating-label">
                                        <label class="control-label col-md-3">Выбор категории </label>
                                        <div class="col-md-4">
                                            <select class="bs-select form-control" data-live-search="true" data-size="8" id="id_cat" name="id_cat">
                                                <?php foreach ($FilterCat as $key => $value): ?>
                                                <option value="<?=$value['idfilter_cat']?>">
                                                    <?=$value['h1']?>
                                                </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Алиас(URL):
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <select id="previewItemAlias" data-name="URL" class="selectPreview">
                                              <option value="NotInclude">Not include</option>
                                            </select> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Сортировка:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <select id="previewItemSort" data-name="Сортировка" class="selectPreview">
                                              <option value="NotInclude">Not include</option>
                                            </select> </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="tab-pane" id="content">
                                <div class="form-body">
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Короткое описание:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <select id="previewItemDescription" data-name="Описание" class="selectPreview">
                                              <option value="NotInclude">Not include</option>
                                            </select>
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
                                            <select id="previewItemMetaTitle" data-name="Meta Title" class="selectPreview">
                                              <option value="NotInclude">Not include</option>
                                            </select>
                                            <span class="help-block"> max 100 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Keywords:</label>
                                        <div class="col-md-10">
                                            <select id="previewItemMetaKeywords" data-name="Meta Keywords" class="selectPreview">
                                              <option value="NotInclude">Not include</option>
                                            </select>
                                            <span class="help-block"> max 1000 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Description:</label>
                                        <div class="col-md-10">
                                            <select id="previewItemMetaDescription" data-name="Meta Description" class="selectPreview">
                                              <option value="NotInclude">Not include</option>
                                            </select>
                                            <span class="help-block"> max 255 chars </span>
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
