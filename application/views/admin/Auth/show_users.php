<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-shopping-cart"></i>Просмотр пользователей </div>
                <div class="actions">
                    <a href="/admin/auth/create" class="btn btn-circle btn-info">
                        <i class="fa fa-plus"></i>
                        <span class="hidden-xs"> Создать пользователя </span>
                    </a>
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
                <div class="table-container">
                    <div class="table-actions-wrapper">
                        <span> </span>
                        <select class="table-group-action-input form-control input-inline input-small input-sm">
                            <option value="">Select...</option>
                            <option value="publish">Publish</option>
                            <option value="unpublished">Un-publish</option>
                            <option value="delete">Delete</option>
                        </select>
                        <button class="btn btn-sm btn-success table-group-action-submit">
                            <i class="fa fa-check"></i> Подтвердить</button>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable" id="datatable_products">
                        <thead>
                            <tr role="row" class="heading">
                                <th width="1%">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" />
                                        <span></span>
                                    </label>
                                </th>
                                <th width="10%"> ID </th>
                                <th width="15%"> Имя пользователя </th>
                                <th width="15%"> Имя</th>
                                <th width="20%"> E-Mail</th>
                                <th width="20%"> Телефон</th>
                                <th width="10%"> Действия </th>
                            </tr>
                            <tr role="row" class="filter">
                                <td> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="id"> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="username"> </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="firstName">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="email">
                                </td>
                                <td>
                                    <input type="text" class="form-control form-filter input-sm" name="tel">
                                </td>
                                <td>
                                    <div class="margin-bottom-5">
                                        <button class="btn btn-sm btn-success filter-submit margin-bottom">
                                            <i class="fa fa-search"></i> Search</button>
                                    </div>
                                    <button class="btn btn-sm btn-default filter-cancel">
                                        <i class="fa fa-times"></i> Reset</button>
                                </td>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
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
        </div>
    </div>
</div>
