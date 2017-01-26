<script type="text/javascript">
var site_url = "<?=site_url()?>";
var idMenu = <?=json_encode($PartnerItem['id_menu'])?>;
var idPartner = <?=json_encode($PartnerItem['id'])?>;
</script>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal form-row-seperated" name="changeItem">
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
            <a href="/partners" target="_blank" class="archive btn purple btn-sm btn-default btn-circle btn-editable" > Просмотреть страницу партнеров</a>
            
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
                                        <label class="col-md-2 control-label">Имя:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" id="name" value="<?=$PartnerItem['name']?>" placeholder=""> </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Компания:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="company" id="company"><?=$PartnerItem['company']?></textarea>
                                            <span class="help-block"> shown in product listing </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">E-mail:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="email" id="email"><?=$PartnerItem['email']?></textarea>
                                            <span class="help-block">  </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Телефон:
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="phone" id="phone"><?=$PartnerItem['phone']?></textarea>
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
                                                        <input type="checkbox" value="1" id="public" <?=$retVal = ($PartnerItem['approve']) ? 'checked' : '' ;?>> Опубликовано?
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
                                            <input type="text" class="form-control" name="url" id="url" value="<?=$PartnerItem['url']?>" placeholder=""> </div>
                                    </div>
                                    <div class="form-group">
                                                            <label class="control-label col-md-2">Меню:
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
                                    <div class="form-group ">
                                                                    <label class="control-label col-md-2">Загрузка изображений</label>
                                                                    <div class="col-md-9">
                                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                            <div class="fileinput-preview thumbnail imageControl" style="width: 200px; height: 150px;">
                                                                                <?php if (isset($PartnerItem['image']) and $PartnerItem['image']!=null and $PartnerItem['image'] !=''): ?>
                                                            <img id="image_logo" src="/images/<?=$PartnerItem['image']?>" alt="...">
                                                        <?php endif ?>
                                                        
                                                                            </div>
                                                                            
                                                                                <span class="btn red btn-outline btn-file">
                                                                                    <span class="fileinput-new"> Select image </span>
                                                                                    <span class="fileinput-exists"> Change </span>
                                                                                    <input type="file" id="logo" name="file"> </span>
                                                                                    <a href="#small" class="btn red fileinput-exists" data-toggle="modal"> Remove </a>
                                                                                
                                                                            </div>
                                                                            <div class="clearfix margin-top-10">
                                                                                <span class="label label-success">NOTE!</span> Для того чтобы отредактировать картинку достаточно кликнуть на нее.  </div>
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
    <div class="col-md-6 col-md-push-6">
        <div class="actions btn-set">
            <a name="back" class="btn btn-secondary-outline">
                <i class="fa fa-angle-left"></i> Back</a>
            
            <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" />
            <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
            <a href="/partners" target="_blank" class="archive btn purple btn-sm btn-default btn-circle btn-editable" > Просмотреть страницу партнеров</a>
            

        </div>
    </div>
</div>
