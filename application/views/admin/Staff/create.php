<script type="text/javascript">
var site_url = "<?=site_url()?>";
</script>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal form-row-seperated" id="createStaff" name="createStaff">
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
                            
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ФИО:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Иван Васильевич Кузьмин" value=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Духовное имя:
                                            
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="etc" id="etc" placeholder="Иван Васильевич Кузьмин" value=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Короткое описание:
                                            
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="description" id="description"></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Телефон:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="telephone" id="telephone"></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">E-mail:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="email" id="email"></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">site:
                                           
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="site" id="site"></textarea>
                                            <span class="help-block"> shown in product listing </span>
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
                                            
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="sort" id="sort" placeholder="0" value="0"> </div>
                                    </div>
                                    <div class="form-group">
                                                        <label class="col-md-2 control-label">Учавствует в:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                        <select multiple="multiple" class="multi-select" id="CardsSelect" name="CardsSelect[]">

                                                        <?php foreach ($cards_select as $key => $value): ?>
                                                            <option value="<?=$value['id_post']?>"><?=$value['card']?></option>
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
