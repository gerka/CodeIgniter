<? 
$Review['archive']=0;
$Review['public']=0;
$Review['h1']=0;
?>
<style type="text/css">

</style>

<script type="text/javascript">console.log(<?=json_encode($menu)?>)</script>
<!-- BEGIN PAGE BASE CONTENT -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- <div class="m-heading-1 border-green m-bordered">
                                <h3>Twitter Bootstrap Wizard Plugin</h3>
                                <p> This twitter bootstrap plugin builds a wizard out of a formatter tabbable structure. It allows to build a wizard functionality using buttons to go through the different wizard steps and using events allows to hook into
                                    each step individually. </p>
                                <p> For more info please check out
                                    <a class="btn red btn-outline" href="http://vadimg.com/twitter-bootstrap-wizard-example" target="_blank">the official documentation</a>
                                </p>
                            </div> -->
                            <div class="portlet light bordered" id="form_wizard_1">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-red"></i>
                                        <span class="caption-subject font-red bold uppercase"> Создание карточки -
                                            <span class="step-title"> Шаг 1 из 4 </span>
                                        </span>
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
                                <div class="portlet-body form">
                                    <form class="form-horizontal" action="#" name="changeItem" id="createItem" method="POST">
                                        <div class="form-wizard">
                                            <div class="form-body">
                                                <ul class="nav nav-pills nav-justified steps">
                                                    <li>
                                                        <a href="#tab1" data-toggle="tab" class="step">
                                                            <span class="number"> 1 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Основные настройки </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab2" data-toggle="tab" class="step">
                                                            <span class="number"> 2 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Добавьте фильтры </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab3" data-toggle="tab" class="step active">
                                                            <span class="number"> 3 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Контент </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab4" data-toggle="tab" class="step">
                                                            <span class="number"> 4 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Карта </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab5" data-toggle="tab" class="step">
                                                            <span class="number"> 5 </span>
                                                            <span class="desc">
                                                                <i class="fa fa-check"></i> Проверка данных </span>
                                                        </a>
                                                    </li>
                                                    
                                                </ul>
                                                <div id="bar" class="progress progress-striped" role="progressbar">
                                                    <div class="progress-bar progress-bar-success"> </div>
                                                </div>
                                                <div class="tab-content">
                                                    <div class="alert alert-danger display-none">
                                                        <button class="close" data-dismiss="alert"></button> У вас есть ошибки в форме. Пожалуйста устраните их. </div>
                                                    <div class="alert alert-success display-none">
                                                        <button class="close" data-dismiss="alert"></button> Отлично все заполнено! </div>
                                                    <div class="tab-pane active" id="tab1">
                                                        <h3 class="block">Введите основные параметры карточки</h3>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Заголовок
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="h1" id="h1" />
                                                                <span class="help-block"> Название вашей карточки </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">E-mail
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="e_mail" id="e_mail" />
                                                                <span class="help-block"> Для связи </span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Меню
                                                            <span class="required"> * </span>
                                                            <span class="help-block"> Место в каталоге </span>
                                                                </label>
                                                            <div class="col-md-4">
                                                                
                                                                 <select name="MenuAdd" id="MenuAdd" >
                                                                    <?php foreach ($menu as $key => $value): ?>
                                                                    <option value="<?=$value['id_menu']?>"><?=$value['value']?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">URL:
                                                                <span class="required"> * </span>
                                                                <span class="help-block"> Место на нашем сайте </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class=" form-control" name="alias" id="alias" placeholder="" value=""> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Ссылка:
                                                                <span class="help-block"> На сайт </span>
                                                            </label>
                                                            <div class="col-md-4">
                                                                <input type="text" class="form-control" name="link" id="link" placeholder="" value=""> </div>
                                                        </div>
                                                        
                                                        <div class="form-group ">
                                                            <label class="control-label col-md-3">Загрузка изображений</label>
                                                            <div class="col-md-4">
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
                                                    <div class="tab-pane" id="tab2">
                                                        <h3 class="block">Добавьте предложенный набор фильтров</h3>
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label">Рекомендуемый набор фильтров:
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                        <select multiple="multiple" class="multi-select filters" id="FilterSelect" name="FilterSelect[]">
                                                        <optgroup label=''><option></option></optgroup>
                                                        </select>
                                                        <span class="help-block"> select one or more categories </span>
                                                        </div>
                                                    </div>
                                                        <div class="form-group">
                                                        <label class="col-md-3 control-label">Дополнительные фильтры:
                                                            <span class="required">  </span>
                                                        </label>
                                                        <div class="col-md-4">
                                                            
                                                             <select multiple="multiple" class="multi-select filters" id="DopFilterSelect" name="DopFilterSelect[]">
                                                        <optgroup label=''><option></option></optgroup>
                                                        </select>
                                                            
                                                        </div>
                                                    </div>
                                                        
                                                        
                                                        <!-- <div class="form-group">
                                                            <label class="control-label col-md-3">Remarks</label>
                                                            <div class="col-md-4">
                                                                <textarea class="form-control" rows="3" name="remarks"></textarea>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="tab-pane" id="tab3">
                                                        <h3 class="block">Заполните контент карточки</h3>
                                                            <div class="form-group">
                                                            <label class="col-md-3 control-label">BODY:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div name="summernote" id="summernote_1"> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Короткое описание:
                                                                <span class="required"> * </span>

                                                            </label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" name="preview_text" id="preview_text"></textarea>
                                                                <span class="help-block"> Показывается в предпросмотре </span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Дата:
                                                                <span class="help-block"> Проведения мероприятия </span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <div id="reportrange" class="btn default">
                                                                    <i class="fa fa-calendar"></i> &nbsp;
                                                                    <span> </span>
                                                                    <b class="fa fa-angle-down"></b>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Регулярное расписание:
                                                                <span class="help-block"> Проведения занятий </span>
                                                            </label>
                                                            <div class="col-md-9">
                                                                <div class="portlet-body">

                                                    <div class="input-group">
                                                        <input type="text" id="timePickerFrom" class="form-control timepicker ">
                                                        <span class="input-group-addon"> to </span>
                                                        <input type="text" id="timePickerTo" class="form-control timepicker ">
                                                    </div>
                                                
                                                    <div class="table-scrollable">
                                                        
                                                     <table class="table table-hover">
                                                            
                                                            <tbody>
                                                                <tr>
                                                                    
                                                                    
                                                                </tr>
                                                                    <tr > <td>ПН</td> 
                                                                    <td > 
                                                                    <a href="javascript:;" data-day="Mon" class="btn btn-icon-only green add">
                                                                         <i class="fa fa-plus"></i>
                                                                        </a> 
                                                                    </td>
                                                                    <td>
                                                                    <input type="text" class="tags" data-role="tagsinput" id="Mon"/>
                                                                    </td>
                                                                    </tr>
                                                                    <tr> <td>ВТ</td>
                                                                    <td> 
                                                                    <a href="javascript:;" data-day="Tue" class="btn btn-icon-only green add">
                                                                         <i class="fa fa-plus"></i>
                                                                        </a> 
                                                                    </td>
                                                                    <td>
                                                                    <input type="text" class="tags" data-role="tagsinput" id="Tue"/>
                                                                    </td>
                                                                    </tr >
                                                                    <tr> <td>СР</td>
                                                                    <td> 
                                                                    <a href="javascript:;" data-day="Wed" class="btn btn-icon-only green add">
                                                                         <i class="fa fa-plus"></i>
                                                                        </a> 
                                                                    </td>
                                                                    <td>
                                                                    <input type="text" class="tags" data-role="tagsinput" id="Wed"/>
                                                                    </td>
                                                                    </tr>
                                                                    <tr> <td>ЧТ</td>
                                                                    <td> 
                                                                    <a href="javascript:;" data-day="Thu" class="btn btn-icon-only green add">
                                                                         <i class="fa fa-plus"></i>
                                                                        </a> 
                                                                    </td>
                                                                    <td>
                                                                    <input type="text" class="tags" data-role="tagsinput" id="Thu"/>
                                                                    </td>
                                                                    </tr>
                                                                    <tr> <td>ПТ</td>
                                                                    <td> 
                                                                    <a href="javascript:;" data-day="Fri" class="btn btn-icon-only green add">
                                                                         <i class="fa fa-plus"></i>
                                                                        </a> 
                                                                    </td>
                                                                    <td>
                                                                    <input type="text" class="tags" data-role="tagsinput" id="Fri"/>
                                                                    </td>
                                                                    </tr>
                                                                    <tr> <td>СБ</td>
                                                                    <td> 
                                                                    <a href="javascript:;" data-day="Sat" class="btn btn-icon-only green add">
                                                                         <i class="fa fa-plus"></i>
                                                                        </a> 
                                                                    </td>
                                                                    <td>
                                                                    <input type="text" class="tags" data-role="tagsinput" id="Sat"/>
                                                                    </td>
                                                                    </tr>
                                                                    <tr> <td>ВС</td>
                                                                    <td> 
                                                                    <a href="javascript:;" data-day="Sun" class="btn btn-icon-only green add">
                                                                         <i class="fa fa-plus"></i>
                                                                        </a> 
                                                                    </td>
                                                                    <td>
                                                                    <input type="text" class="tags" data-role="tagsinput" id="Sun"/>
                                                                    </td>
                                                                     </tr>
                                                                    
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="tab-pane" id="tab4">
                                                        <h3 class="block">Заполните геоданные</h3>

                                                        

                                                        <div class="col-md-6">
                                                            <div class="portlet light bordered">
                                                                <div class="portlet-title">
                                                                    <div class="caption">
                                                                        <i class="icon-bar-chart font-dark hide"></i>
                                                                        <span class="caption-subject font-dark bold uppercase">Настройка карты</span>
                                                                        <span class="caption-helper"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="portlet-body">
                                                                    <div class="form-body" id="code">
                                                                    <div class="form-group">
                                                                    <label>Какие настройки показать?</label>
                                                                    <div class="mt-radio-inline">
                                                                        <label class="mt-radio">
                                                                            <input type="radio" name="OptionMap"  id="optionsRadiosMapSimple" value="Simple" checked> Простые?
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="mt-radio">
                                                                            <input type="radio" name="OptionMap"  id="optionsRadiosMapHard" value="Hard"> Сложные?
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="mt-radio">
                                                                            <input type="radio" name="OptionMap"  id="optionsRadiosMapDisable" value="Disable"> Не использовать карту?
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                    </div>
                                                                    
                                                                        <div class="form-group">
                                                                            <label for="" class="col-md-4 control-label">Название точки: </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class=" input form-control" id="map_title" name="map_title" value="My Business Name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="col-md-4 control-label">Адрес точки: </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="input form-control" id="address" name="address" value="Луначарского 11 к1">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group hidden" id='hidMap1'>
                                                                            <label for="" class="col-md-4 control-label">Координаты: </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="input form-control" id="coordinates" name="coordinates" value="" placeholder="e.g: 53.2734,-7.77832031">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="col-md-4 control-label">Вид карты: </label>
                                                                            <div class="col-md-8">
                                                                                <select size="1" id="t" class="form-control" name="t">
                                                                                    <option value="">
                                                                                        Map
                                                                                    </option>
                                                                                    <option value="k">
                                                                                        Satellite
                                                                                    </option>
                                                                                    <option value="h">
                                                                                        Hybrid
                                                                                    </option>
                                                                                    <option value="p">
                                                                                        Terrain
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group hidden" id='hidMap2'>
                                                                            <label for="" class="col-md-4 control-label">Zoom: </label>
                                                                            <div class="col-md-8">
                                                                                <select size="1" id="zoom" class="form-control" name="zoom">
                                                                                    <option value="0" id="zoom_custom">max.zoom out</option>
                                                                                    <option value="1">
                                                                                        4.000 km
                                                                                    </option>
                                                                                    <option value="2">
                                                                                        2.000 km (world)
                                                                                    </option>
                                                                                    <option value="3">
                                                                                        1.000 km
                                                                                    </option>
                                                                                    <option value="4">
                                                                                        400 km (continent)
                                                                                    </option>
                                                                                    <option value="5">
                                                                                        200 km
                                                                                    </option>
                                                                                    <option value="6">
                                                                                        100 km (country)
                                                                                    </option>
                                                                                    <option value="7">
                                                                                        50 km
                                                                                    </option>
                                                                                    <option value="8">
                                                                                        30 km
                                                                                    </option>
                                                                                    <option value="9">
                                                                                        15 km (area)
                                                                                    </option>
                                                                                    <option value="10">
                                                                                        8 km
                                                                                    </option>
                                                                                    <option value="11">
                                                                                        4 km
                                                                                    </option>
                                                                                    <option value="12">
                                                                                        2 km (city)
                                                                                    </option>
                                                                                    <option value="13">
                                                                                        1 km
                                                                                    </option>
                                                                                    <option value="14" selected="selected">
                                                                                        400 m (district)
                                                                                    </option>
                                                                                    <option value="15">
                                                                                        200 m
                                                                                    </option>
                                                                                    <option value="16">
                                                                                        100 m
                                                                                    </option>
                                                                                    <option value="17">
                                                                                        50 m (street)
                                                                                    </option>
                                                                                    <option value="18">
                                                                                        20 m
                                                                                    </option>
                                                                                    <option value="19">
                                                                                        10 m
                                                                                    </option>
                                                                                    <option value="20">
                                                                                        5 m (house)
                                                                                    </option>
                                                                                    <option value="21">
                                                                                        2,5 m
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group hidden" id='hidMap3'>
                                                                            <label for="" class="col-md-4 control-label">Высота карты: </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="input form-control" id="h" name="h" value="370">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group hidden" id='hidMap4'>
                                                                            <label for="" class="col-md-4 control-label">Ширина карты: </label>
                                                                            <div class="col-md-8">
                                                                                <input type="text" class="input form-control" id="w" name="w" value="720" disabled="disabled">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group hidden" id='hidMap5'>
                                                                            <label class="col-md-4 control-label">Статус:
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                            <div class="col-md-8">
                                                                                <div class="form-control height-auto">
                                                                                    <div class="mt-checkbox-inline">
                                                                                        <label class="mt-checkbox">
                                                                                            <input type="checkbox" id="autofit" name="autofit" checked> Авто-подстройка?
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="mt-checkbox">
                                                                                            <input type="checkbox" id="info" name="info" value="A" checked> Показывать PopUp?
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group hidden" id='hidMap6'>
                                                                            <label for="" class="col-md-4 control-label">Ваш код: </label>
                                                                            <div class="col-md-8">
                                                                                <textarea rows="3" id='map_frame' class="distance-container form-control" cols="50" readonly="readonly" onclick="jQuery(this).select();"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="row">
                                                                <div class="portlet light bordered">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i class="icon-bar-chart font-dark hide"></i>
                                                                            <span class="caption-subject font-dark bold uppercase">Контактная информация</span>
                                                                            <span class="caption-helper"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="form-group">
                                                                            <label for="" class="col-md-3 control-label">Телефон: 
                                                                            <span class="help-block">Для связи</span>
                                                                            </label>
                                                                            <div class="col-md-4">
                                                                                <input type="text" class="input form-control" id="phone" name="phone" value="" placeholder="+7-999-99-99">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="" class="col-md-3 control-label">Контактное лицо: 
                                                                            <span class="help-block">Для связи</span>
                                                                            </label>
                                                                            <div class="col-md-4">
                                                                                <input type="text" class="input form-control" id="contact_name" name="contact_name" value="" placeholder="Alice Wong">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="portlet light bordered">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i class="icon-bar-chart font-dark hide"></i>
                                                                            <span class="caption-subject font-dark bold uppercase">Предпросмотр карты</span>
                                                                            <span class="caption-helper"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div class="row">
                                                                            <div id="map" class="col-md-8 col-sm-8" style=" overflow-x: scroll; ">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab5">
                                                        <h3 class="block">Подтвердите введенную информацию</h3>
                                                        <h4 class="form-section">Основная информация</h4>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Заголовок:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="h1"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">E-mail:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="e_mail"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Место в каталоге:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="MenuAdd"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Ссылка в нашем каталоге:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="alias"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Ссылка на ваш ресурс:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="link"> </p>
                                                            </div>
                                                        </div>
                                                        <h4 class="form-section">Фильтры</h4>
                                                        
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Выбраны из рекомендуемых фильтров:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="FilterSelect[]"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Выбраны из дополнительных фильтров:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="DopFilterSelect[]"> </p>
                                                            </div>
                                                        </div>
                                                        <h4 class="form-section">Контент</h4>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Короткое описание:</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="preview_text"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Дата проведения</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="reportrange"> </p>
                                                            </div>
                                                        </div>
                                                        <h4 class="form-section">Карта</h4>
                                                
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Адрес</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="address"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Телефон</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="phone"> </p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Имя для связи</label>
                                                            <div class="col-md-4">
                                                                <p class="form-control-static" data-display="contact_name"> </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <a href="javascript:;" class="btn default button-previous disabled" style="display: none;">
                                                            <i class="fa fa-angle-left"></i> Back </a>
                                                        <a href="javascript:;" class="btn btn-outline green button-next"> Continue
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                        <a href="javascript:;" class="btn green button-submit send_data" style="display: none;"> Submit
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
    <!-- <div class="row"> -->
    
  
    <!-- <div class="row ">
        <div class="col-md-12 col-md-push-3">
            <div class="actions btn-set">
                <button class="reset btn btn-secondary-outline">
                    <i class="fa fa-reply"></i> Reset</button>
                <input type="button" class="btn blue send_data_close" value="Сохранить и выйти" onclick="" />
                <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
            </div>
        </div>
    </div> -->
<div id="small" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" data-attention-animation="false">
                                        <div class="modal-body">
                                            <p> Вы хотите отчистить предыдущее значение? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Отмена</button>
                                            <button type="button" data-dismiss="modal" data-trigger="fileinput" onclick="$('.fileinput').fileinput('clear');" class="btn red">Отчистить</button>
                                        </div>
                                    </div>