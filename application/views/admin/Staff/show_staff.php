<div class="row">
    <div class="col-md-12">
        
        <!-- Begin: life time stats -->
        <div class="portlet ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-shopping-cart"></i><?=$title?> </div>
                <div class="actions">
                    <a href="/admin/staff/create" class="btn btn-circle btn-info">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> Создать преподователя </span>
                    </a>
                    <!-- <div class="btn-group">
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
                    </div> -->
                </div>
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
                    <span class="caption-subject bold uppercase">Преподователи</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="staffs">
                    <thead>
                    <!-- <tr role="row" class="filter"><td>
                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="product_created_from" placeholder="From" id="fromPick">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td>
                            <td>
                                    <div class="input-group date date-picker" data-date-format="dd/mm/yyyy">
                                        <input type="text" class="form-control form-filter input-sm" readonly name="product_created_to " id="toPick" placeholder="To">
                                        <span class="input-group-btn">
                                            <button class="btn btn-sm default" type="button">
                                                <i class="fa fa-calendar"></i>
                                            </button>
                                        </span>
                                    </div>
                                </td><td><div class="margin-bottom-5">
                                        <button id="filterButton" class="btn btn-sm btn-success filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search</button>
                                    </div></td>
                                </tr> -->

                        <tr>
                                <th> ID </th>
                                <th> Имя&nbsp; </th>
                                <th> Описание </th>
                                <th> Сортировка </th>
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