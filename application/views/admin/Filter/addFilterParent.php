<script type="text/javascript">var Cats = <?=json_encode($Cats)?>;</script>
<div class="row">
                        <div class="col-md-6">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-social-dribbble font-blue-sharp"></i>
                                        <span class="caption-subject font-blue-sharp bold uppercase">Выберите родительский фильтр</span>
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
                                 <script type="text/javascript">var menu = <?=json_encode($Menu)?>;</script>
                                <div class="portlet-body">
                                    <div id="tree_1" class="tree-demo">
                                        <ul>
                                       
                                        
                                            <li> Root node 1
                                                <ul>
                                                    <li data-jstree='{ "selected" : true }'>
                                                        <a href="javascript:;"> Initially selected </a>
                                                    </li>
                                                    <li data-jstree='{ "icon" : "fa fa-briefcase icon-state-success " }'> custom icon URL </li>
                                                    <li data-jstree='{ "opened" : true }'> initially open
                                                        <ul>
                                                            <li data-jstree='{ "disabled" : true }'> Disabled Node </li>
                                                            <li data-jstree='{ "type" : "file" }'> Another node </li>
                                                        </ul>
                                                    </li>
                                                    <li data-jstree='{ "icon" : "fa fa-warning icon-state-danger" }'> Custom icon class (bootstrap) </li>
                                                </ul>
                                            </li>
                                            <li data-jstree='{ "type" : "file" }'>
                                                <a href="http://www.jstree.com"> Clickanle link node </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bubble font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">Выберите дочерние фильтры</span>
                                    </div>
                                    <div class="actions">
                                    <div class="btn-group"><a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" onclick="SaveFilters()"> Сохранить
                                                
                                            </a></div>
                                        <div class="btn-group">
                                            <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;"> Option 1</a>
                                                </li>
                                                <li class="divider"> </li>
                                                <li>
                                                    <a href="javascript:;">Option 2</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">Option 3</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">Option 4</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <select multiple="multiple" class="multi-select" id="FilterCat" name="FilterCat">
                                    <script type="text/javascript">console.log(<?=json_encode($FilterCat)?>)</script>
                                                <?php foreach ($FilterCat as $key => $value): ?>
                                                           <optgroup label='<?=$key?>'>
                                                                  <?php foreach ($value as $key1 => $value1): ?>
                                                               <option <?if (isset($value1['value'])) {
                                                                   echo 'selected="selected"';
                                                               }?> value="<?=$value1['id_filter']?>"><?=$value1['filter']?></option>
                                                                <?php endforeach ?>  
                                                            </optgroup>
                                                            <?php endforeach ?>
                                            </select>
                                </div>
                            </div>
                        </div>
                    </div>