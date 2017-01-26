
<!-- BEGIN SAMPLE TABLE PORTLET-->
                            <div class="portlet">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-shopping-cart"></i>Просмотр шаблонов </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-scrollable">
                                        <table class="table table-striped table-bordered table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <i class="fa fa-briefcase"></i> From </th>
                                                                                                        <th> </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($email_tpl as $key2 => $value2): ?>
                                            	<tr>
                                            	<td><?=$value2?></td>
                                                    <td>
                                                        <a href="show_admin/<?=$value2?>" class="btn dark btn-sm btn-outline sbold uppercase">
                                                            <i class="fa fa-share"></i> edit </a>
                                                    </td>
													
                                                </tr>
                                            <?php endforeach ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- END SAMPLE TABLE PORTLET-->