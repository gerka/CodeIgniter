 <script type="text/javascript">var menu = <?=json_encode($Menu)?>;console.log(menu);</script>

                        <div class="col-md-6">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-social-dribbble font-blue-sharp"></i>
                                        <span class="caption-subject font-blue-sharp bold uppercase">Структура данных</span>
                                        <div><input type="text" id="tree_1_q" name="tree_1_q"></div>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                
                                <div class="portlet-body">
                                  <div id="nanoGallery">
                                  </div>

                                                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Инструменты </div>
                                    <ul class="nav nav-tabs">
                                        <li class="">
                                            <a href="#copy" data-toggle="tab" aria-expanded="false"> Превью  </a>
                                        </li>
                                        <!-- <li class="">
                                            <a href="#change" data-toggle="tab" aria-expanded="false"> Изменение </a>
                                        </li> -->
                                        <li class="active">
                                            <a href="#properties" data-toggle="tab" aria-expanded="true"> Свойства </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="portlet-body form">
                                
                                        
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="properties">
                                        
                                        
                                            <p> Здесь расположены свойства контента </p>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">URL</label>
                                                <div class="col-md-9">
                                                    <input type="text" disabled="disabled" id='prop_url' class="form-control" > </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Включатели</label>
                                                <div class="col-md-9">
                                                    <div class="mt-checkbox-inline">
                                                    <label class="mt-checkbox">
                                                        <input type="checkbox" id="public_gallery" value="1"  > На главной в фотогаллерее?
                                                        <span></span>
                                                    </label>
                                                  </div>
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Размер файла</label>
                                                <div class="col-md-9">
                                                    <input type="text" disabled="disabled" id='prop_size' class="form-control" > </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Id Image</label>
                                                <div class="col-md-9">
                                                    <input type="text" id='prop_idImage' class="form-control" disabled="disabled"> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">ID USER</label>
                                                <div class="col-md-9">
                                                    <input type="text" id='prop_idUser' class="form-control" disabled="disabled""> </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Название</label>
                                                <div class="col-md-9">
                                                    <input type="text" id='prop_name' class="form-control"> </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Сортировка</label>
                                                <div class="col-md-9">
                                                    <input type="text" id='prop_sort' class="form-control" > </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Meta Key</label>
                                                <div class="col-md-9">
                                                    <input type="text" id='prop_m_key' class="form-control" > </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Meta Description</label>
                                                <div class="col-md-9">
                                                    <input type="text" id='prop_m_description' class="form-control" > </div>
                                            </div>
                                            <div id='image_preview' class="clearfix">
                                            </div>
                                             <div class="form-actions">
                                            <!-- <button type="button" class="btn default">Cancel</button> -->
                                            <button type="button" id="buttonProp" onclick="buttonProp()" class="btn green">Изменить свойства</button>
                                        </div>
                                        </div>
                                        
                                        </div>
                                        <div class="tab-pane " id="copy">
                                            <p> Инструмены связанные с базовыми действиями удаление, перемещение, копирование. </p>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                        
                    
                    <style type="text/css">
                    .jcrop-holder #preview-pane {
                        
  display: block;
  position: absolute;
  z-index: 2000;
  top: 10px;
  right: -280px;
  padding: 6px;
  border: 1px rgba(0,0,0,.4) solid;
  background-color: white;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 6px;
  -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
  box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
}
/* The Javascript code will set the aspect ratio of the crop
   area based on the size of the thumbnail preview,
   specified here */
   /*div.jcrop-tracker{
    width: 100%;
    position: relative;
   }*/
   /*.jcrop-holder img{
    position: relative!important;
   }*/
#preview-pane .preview-container {
  width: 250px;
  height: 170px;
  overflow: hidden;
}
</style>
<div id="static" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
  <div class="modal-body">
    <p>Вы не выбрали файл, папки не являются изменяемыми элементами.</p>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-primary">Ясно</button>
  </div>
</div>

                                        
                                    
