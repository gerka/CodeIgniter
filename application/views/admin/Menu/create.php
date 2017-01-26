<script type="text/javascript">
var site_url = "<?=site_url()?>";
</script>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal form-row-seperated" id="createFilter" name="createFilter">
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
                            <!-- <li>
                                                    <a href="#tab_images" data-toggle="tab"> Картинки </a>
                                                </li> -->
                            <!-- <li>
                                                    <a href="#tab_reviews" data-toggle="tab"> Reviews
                                                        <span class="badge badge-success"> 3 </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_history" data-toggle="tab"> History </a>
                                                </li>
 -->
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
                                        <label class="col-md-2 control-label">Родитель:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <select class="bs-select form-control" id="parent">
                                              <option value="0">В корне</option>
                                              <?php foreach ($Menu as $key => $value): ?>
                                                  <option value="<?=$value['id_menu']?>"><?=$value['value']?></option>
                                              <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Опубликовано:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <select class="bs-select form-control" id="public">
                                              <option value="1">Да</option>
                                              <option value="0">Нет</option>
                                                                                       
                                              
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                                            <label class="col-md-2 control-label">Выбор меню:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <div class="form-control height-auto">
                                                                    <div class="scroller" style="height:100px;" data-always-visible="1">
                                                                        <ul class="list-unstyled">
                                                                        
                                                                        
                                                                                          <?php foreach ($position_menu as $key => $value): ?>
                                                                                         <li><label>
                                                                                       <input type="checkbox" name="position" value="<?=$value['id_position']?>"><?=$value['position'];?></label></li>
                                                                                         <?php endforeach ?>
                                                                                    
                                                                             </ul>
                                                                    </div>
                                                                </div>
                                                                <span class="help-block"> select one or more categories </span>
                                                            </div>
                                                        </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Алиас:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="alias" id="alias" placeholder="" value=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Сортировка:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="sort" id="sort" placeholder="0" value="0"> </div>
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
                            <div class="tab-pane" id="tab_content">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Основной текст:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <div name="summernote" id="summernote_1"> </div>
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
            <button type="button" name="back" class="btn btn-secondary-outline">
                <i class="fa fa-angle-left"></i> Back</button>
                <button class="reset btn btn-secondary-outline">
                    <i class="fa fa-reply"></i> Reset</button>
                    <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" onclick="" />
                    <input type="button" class="btn btn-success send_data"  value="Сохранить и продолжить">
                    
                </div></div></div>

