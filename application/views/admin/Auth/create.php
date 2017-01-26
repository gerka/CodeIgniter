<script type="text/javascript">
var site_url = "<?=site_url()?>";
</script>
<div class="row">
    <div class="col-md-12">
        <form name="createItem" class="form-horizontal form-row-seperated">
            <div class="portlet">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-shopping-cart"></i>
                        <?=$title?>
                    </div>
                    <div class="actions btn-set">
                        <button type="button" name="back" class="btn btn-secondary-outline">
                            <i class="fa fa-angle-left"></i> Back</button>
                        <button class="btn btn-secondary-outline">
                            <i class="fa fa-reply"></i> Reset</button>
                        <input type="button" class="btn blue send_data" value="Сохранить и выйти" onclick="location.href='/admin/auth/show_users'" />
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
                                <a href="#tab_meta" data-toggle="tab"> Meta-информация </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_general">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">E-Mail:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="email" id="e-mail" placeholder="" > </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Username:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="username" id="username" placeholder=""> </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Пароль:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="password" id="password" placeholder=""> </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label class="col-md-2 control-label">Повтор пароля:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Для вашей безопасности"> </div>
                                    </div> -->
                                </div>
                            </div>
                            <div class="tab-pane" id="tab_meta">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Имя:</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control maxlength-handler" name="first_name" id="first_name" maxlength="100" placeholder="">
                                            <span class="help-block"> max 100 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Фамилия:</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control maxlength-handler" name="last_name" id="last_name" maxlength="100" placeholder="">
                                            <span class="help-block"> max 100 chars </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Телефон:
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="tel" id="tel"  placeholder=""> </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Компания:</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control maxlength-handler" name="company" id="company" maxlength="100" placeholder="">
                                            <span class="help-block"> max 100 chars </span>
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
    <div class="col-md-7 col-md-push-5">
        <div class="actions btn-set">
            <button type="button" name="back" class="btn btn-secondary-outline">
                <i class="fa fa-angle-left"></i> Back</button>
            <button class="btn btn-secondary-outline">
                <i class="fa fa-reply"></i> Reset</button>
            <input type="button" class="btn blue send_data_close" value="Сохранить и выйти"  />
            <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
        </div>
    </div>
</div>
