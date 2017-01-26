<div class="row">
                        <div class="col-md-12">
                            
                            <!-- Begin: life time stats -->
                            <div class="portlet ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-shopping-cart"></i>Просмотр новостей </div>
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
                                        
                                        
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-container">
                                        
                                        <table class="table table-striped table-bordered table-hover" id="datatable_products">
                                        <thead>
                                            <tr>
                                                <th> Group </th> 
                                                <th> ID </th>
                                                <th> Название </th>
                                                <th> Дата </th>
                                                <th> Действие </th>
                                               <!--  <th> Управление </th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
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
                                        </div></div>
                                    </div>