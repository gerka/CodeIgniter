<script type="text/javascript">var $lang = <?=json_encode($lang)?>;var $Constants=<?=(!empty($constants)) ? $constants: '{}' ?></script>
<div class="row">
                        <div class="col-md-12">
                            
                            <!-- Begin: life time stats -->
                            <div class="portlet ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-shopping-cart"></i><?=$title?></div>
                                    <div class="actions">
                                    <?php if (!empty($buttons['action'])): ?>
                                        <?php foreach ($buttons['action'] as $key => $value): ?>
                                            <a href="<?=(!empty($value['link'])) ? $value['link'] : ''?>" class="btn btn-circle <?=(!empty($value['color'])) ? $value['color'] : ''?>">
                                            <i class="<?=(!empty($value['icon'])) ? $value['icon'] : ''?>"></i>
                                            <?=(!empty($value['hiddenMobile'])) ? '<span class="hidden-xs"> ': '<span>'?>
                                             <?=(!empty($value['title'])) ? $value['title'] : ''?> </span>
                                        </a>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                        
                                        
                                        <div class="btn-group">
                                            
                                            <div class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;"> Export to Excel </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> Export to CSV </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;"> Export to XML </a>
                                                </li>
                                                <li class="divider"></li>
                                                <a href="javascript:;"> Print Invoices </a>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                    </div>
<div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-dark"></i>
                                        <span class="caption-subject bold uppercase">Константы</span>
                                    </div>
                                    <div class="action"><div class=" pull-right">
                                            <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" onclick="SaveConstants()"> Сохранить</a>
                                            <a class="btn btn-circle btn-default" href="javascript:;" onclick="addConstants()" data-toggle="dropdown">
                                                <i class="fa fa-plus"></i>
                                                <span class="hidden-xs"> Добавить константу </span>
                                                
                                            </a>
                                            
                                            
                                        </div></div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                   
                                    <div class="form-group">
                                    <select data-selectsplitter-selector>
                                    <?$Constants = json_decode($constants);?>
                                    <?php foreach ($Constants  as $key => $value): ?>
                                        <optgroup label="<?=$key?>">
                                            <?php foreach ($value as $key2 => $value2): ?>
                                               <?php if (!is_object($value2)): ?>
                                                    <option value="<?=$key.'.'.$key2?>"><?=$key2.' : '.$value2?></option>
                                                
                                                <?php else: ?>
                                                    <option value="<?=$key.'.'.$key2?>"><?=$key2?></option>
                                                    <?php endif ?> 
                                            <?php endforeach ?>
                                        </optgroup>
                                    <?php endforeach ?>
                                    </select></div>
                                    <div class="form-group"></div>
                                    <div class="form-group"><script type="text/javascript"></script><textarea id="CodeMirror"></textarea></div>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                            
                        </div>
                    </div>
                    <div class="row">
                       <!--  <textarea id="CodeMirror" ><?=$constants?></textarea> -->
                    </div>
                    <div class="row">
                    <div id="delModal" class="modal fade" data-backdrop="delModal" data-keyboard="false" data-attention-animation="false">
                                        <div class="modal-body">
                                            <p> Вы действительно хотите удалить запись? </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-outline dark">Cancel</button>
                                            <button type="button" data-dismiss="modal" class="btn red">Удалить</button>
                                        </div></div>
                                    </div>
                                    <div class="modal fade bs-modal-sm" id="smallDel" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Удаление записи</h4>
                                                </div>
                                                <div class="modal-body"> Вы действительно хотите навсегда удалить запись? </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Нет</button>
                                                    <button type="button" id="DelItem" class="btn red-mint">Да</button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->