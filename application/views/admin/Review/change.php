               <script type="text/javascript">
               var idReview = <?=json_encode($Review[0]['id_review'])?>;
               var reviewItem = <?=json_encode($Review[0]['body'])?>;
               var star_slide = <?=json_encode($Review[0]['rating'])?>;
               </script>
                            
                               <form  class="form-horizontal form-row-seperated" name="changeItem" id="changeItem" >
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-shopping-cart"></i>Редактирование отзыва № <?=$Review[0]['id_review']?> </div>
                                        

        <div class="actions btn-set">
            
                
                    <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" />
                    <input type="button" class="btn btn-success send_data"  value="Сохранить и продолжить">
                     
                </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                 
                                                    <a href="#tab_reviews" data-toggle="tab"> Отзыв
                                                        
                                                    </a>
                                                </li>
                                                
                                                
                                            </ul>
        <div class="tab-pane" id="tab_reviews">
        <div class="form-group ">
                                                <label class="control-label col-md-3">Аватарка</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                                                

                                                            <img id="image_logo" src="<?php if (isset($Review[0]['logo']) and $Review[0]['logo']!=null and $Review[0]['logo'] !=''): ?> /images/<?=$Review[0]['logo']?><?php endif ?>" alt="..." style="max-height: 150px;">
                                                        
                                                        
                                                                            </div>
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
                                                                    <div class="col-md-6">
                                                                        <input type="text" class="form-control" name="star_slide" id="star_slide" placeholder="" value=""> </div>
                                                                </div>
                                                        <div class="form-group">
                                                                    <label class="col-md-2 control-label">H1:
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-10">
                                                                        <input type="text" class="form-control" name="h1_review" id="h1_review" placeholder="" value="<?=$Review[0]['h1']?>"> </div>
                                                                </div>
                                                        <div class="form-group">
                                                                    <label class="col-md-2 control-label">E-mail:
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-10">
                                                                        <input type="text" class="form-control" name="email" id="email" placeholder="" value="<?=$Review[0]['e-mail']?>"> </div>
                                                                </div>
                                                        <div class="form-group">
                                                                    <label class="col-md-2 control-label">Телефон:
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-10">
                                                                        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="" value="<?=$Review[0]['telephone']?>"> </div>
                                                                </div>
                                                        <div class="form-group">
                                                                    <label class="col-md-2 control-label">Дата добавления:
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-10">
                                                                        <input type="text" class="form-control" placeholder="" disabled="disabled" value="<?=$Review[0]['date_create']?>"> </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-2 control-label">BODY:
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-10">

                                                            <div name="summernote" id="summernote_1"> </div>
                                                            
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
                                                                <input type="checkbox" id="public_review" value="1" <?php if ($Review[0]['public'] == 1):  ?>
                                                                    checked
                                                                <?php endif ?> > Опубликовано?
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-checkbox">
                                                                <input type="checkbox" id="archive_review" value="1" <?php if ($Review[0]['archive'] == 1):  ?>
                                                                    checked
                                                                <?php endif ?>> Убрать в архив?
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                                               </div>       
                                            </div>
      
                                            </div>
                                        
                            </form>
                        </div>