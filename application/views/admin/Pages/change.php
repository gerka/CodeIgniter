<script type="text/javascript">
var site_url = "<?=site_url()?>";
</script>
<div class="row">
    <div class="col-md-12">
        <div class="form-horizontal form-row-seperated">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i>
                        <?=$title?>
                    </div>
                    <div class="actions btn-set">
            <a name="back" class="btn btn-secondary-outline">
                <i class="fa fa-angle-left"></i> Back</a>
            
            <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" />
            <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
            <a href="/<?=$PageItem['alias']?>" target="_blank" class="archive btn btn-sm btn-default btn-circle btn-editable" > Просмотреть страницу</a>
        </div>
                </div>
                <div class="portlet-body">
                    <div class="tabbable-bordered">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_general" data-toggle="tab"> Основные </a>
                            </li>
                            <li>
                                <a href="#tab_meta" data-toggle="tab"> Meta-информация </a>
                            </li>
                            <li>
                                <a href="#tab_include" data-toggle="tab"> Подключения </a>
                            </li>
                            <li>
                                <a href="#tab_language" data-toggle="tab"> Язык </a>
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
                                            <input type="text" class="form-control" name="h1" id="h1" value="<?=$PageItem['h1']?>" placeholder=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <script type="text/javascript">
                                        var pageItem = <?=json_encode($PageItem['body'])?>;
                                        var idPage = "<?=$PageItem['idPage']?>";
                                        console.log(<?=json_encode($PageItem)?>);
                                        var idElement = "<?=$PageItem['id_element']?>"
                                        </script>
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
                                            <textarea class="form-control" name="preview_text" id="preview_text"><?=$PageItem['preview_text']?></textarea>
                                            <span class="help-block"> shown in product listing </span>
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
                                                        <input type="checkbox" id="public" value="1"> Опубликовано?
                                                        <span></span>
                                                    </label>
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="archive" value="1"> Убрать в архив?
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">URL:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="alias" id="alias" value="<?=$PageItem['alias']?>" placeholder=""> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_meta">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Title:</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control maxlength-handler" name="title" id="title" maxlength="100" value="<?=$PageItem['title']?>" placeholder="">
                                            <span class="help-block"> max 100 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Keywords:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" id="meta_keywords" name="meta_keywords" maxlength="1000"><?=$PageItem['meta_keywords']?></textarea>
                                            <span class="help-block"> max 1000 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Meta Description:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" name="description" id="description" maxlength="255"><?=$PageItem['description']?></textarea>
                                            <span class="help-block"> max 255 chars </span>
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
                            <div class="tab-pane" id="tab_include">
                                <div class="form-body">
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">CSS</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" id="css" name="css" ><?=$PageItem['css']?></textarea>
                                            <span class="help-block"> через символ перевода строки </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">JS:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" id="js" name="js"><?=$PageItem['js']?></textarea>
                                            <span class="help-block"> через символ перевода строки </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Plugins:</label>
                                        <div class="col-md-10">
                                            <textarea class="form-control maxlength-handler" rows="8" name="plugin" id="plugin"><?=$PageItem['plugin']?></textarea>
                                            <span class="help-block"> через символ перевода строки </span>
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
<div class="row ">
    <div class="col-md-6 col-md-push-6">
        <div class="actions btn-set">
            <a name="back" class="btn btn-secondary-outline">
                <i class="fa fa-angle-left"></i> Back</a>
            
            <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" />
            <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
            <a href="/<?=$PageItem['alias']?>" target="_blank" class="archive btn btn-sm btn-default btn-circle btn-editable" > Просмотреть страницу</a>

        </div>
    </div>
</div>
