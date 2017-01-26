<script type="text/javascript">
    
  var $email_tpl = <?=json_encode($email_tpl)?>;
  var $lang = <?=json_encode($lang)?>;
  var $templateEdit = <?=json_encode($templateEdit)?>;
  console.log($email_tpl);
 // console.log(<?=$templateEdit?>);

</script>
   <style type="text/css">
       .CodeMirror {
        height: 198px;

    }
   </style>
<div class="well">
    <h4><span class="font-red-thunderbird font-lg bold uppercase">Переменные</span></h4>
     В шаблонах доступны переменные:<br>
    <span class="font-red-thunderbird font-lg bold "> #email# : </span> От кого <br>
    <span class="font-red-thunderbird font-lg bold "> #name# :</span> Имя <br>
    <span class="font-red-thunderbird font-lg bold "> #phone# : </span>Телефон <br>
    <span class="font-red-thunderbird font-lg bold "> #url# :</span> Сайт <br>
    <span class="font-red-thunderbird font-lg bold "> #company#: </span>Компания  <br>
 </div>
  <div class="row">
      <div class="col-md-12">
        <div class="tabbable-line boxless tabbable-reversed" id='forBlock'>
          <ul class="nav nav-tabs">
                <? $active = true;?>
              <?php foreach ($email_tpl->$templateEdit as $key => $value): ?>
            
                <li class="<?=($active) ? 'active' : '' ;?>">
                    <a href="#<?=$key?>_tab" data-toggle="tab" aria-expanded="<?=($active) ? 'true' : '' ;?>"> <?=$key?> </a>
                </li>
                <? $active = false;?>
              <?php endforeach ?>
          </ul>
          <div class="tab-content">
               <? $active = true;?>
              <?php foreach ($email_tpl->$templateEdit as $key2 => $value2): ?>

                <div class="tab-pane <?=($active) ? 'active' : '' ;?>" id="<?=$key2?>_tab">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                Редактирорвание <?=$key2?> версии шаблона
                            </div>
                            <div class="actions btn-set">
            
                                    <input type="button" class="btn blue send_data_close" value="Сохранить и выйти">
                                    <input type="button" class="btn btn-success send_data" value="Сохранить и продолжить">
                                     <!-- <a href="/" target="_blank" class="preview btn purple"> Просмотреть шаблон </a> -->
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form action="#" class="form-horizontal form-bordered form-label-stripped">
                                    <div class="form-body">
                                        <?php foreach ($value2 as $key3 => $value3): ?>
                                            <div class="form-group">
                                                <label class="col-md-2"><h3><?=$key3?></h3></label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control CodeMirror" id="<?=$key3?>_<?=$key2?>"><?=$value3?></textarea>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                <? $active = false;?>
              <?php endforeach ?>  
          </div> 
        </div>
      </div>
  </div>
