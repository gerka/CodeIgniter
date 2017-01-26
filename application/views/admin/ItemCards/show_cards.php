<div class="row">
                        <div class="col-md-12">
                            
                            <!-- Begin: life time stats -->
                            <div class="portlet ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-shopping-cart"></i>Просмотр карточек </div>
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
                                            <a class="btn btn-circle btn-default dropdown-toggle" href="javascript:;" data-toggle="dropdown">
                                                <i class="fa fa-share"></i>
                                                <span class="hidden-xs"> Инструменты </span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
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
                                        <span class="caption-subject bold uppercase">Карточки</span>
                                    </div>
                                    <div class="tools"> </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="cards">
                                        <thead>
                                            <tr>
                                                    <th> ID </th>
                                                    <th> Название&nbsp; </th>
                                                    <th> Меню </th>
                                                    <th> Дата создания </th>
                                                    
                                                    <th> Действия </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                            
                        </div>
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