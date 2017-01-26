<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo asset_url();?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php if (!empty($this->data['page_level_plugin'])): ?>
<?php foreach ($this->data['page_level_plugin'] as $key => $value): ?>
   <?php foreach ($value as $key => $value): ?>
   <script src="<?=$value?>" type="text/javascript"></script>
   <?php endforeach ?>
<?php endforeach ?>
<?php endif ?>
<script src="<?php echo asset_url();?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?php echo asset_url();?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php if (!empty($this->data['page_level_script'])): ?>
<?php foreach ($this->data['page_level_script'] as $key => $value): ?>
<?php foreach ($value as $key => $value): ?>
   <script src="<?=$value?>" type="text/javascript"></script>
<?php endforeach ?>
   
<?php endforeach ?>
<?php endif ?>
<script type="text/javascript" src="<?php echo asset_url();?>global/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
<script src="<?php echo asset_url();?>pages/scripts/login-5.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo asset_url();?>layouts/layout6/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?php echo asset_url();?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script data-preload="true" data-path="<?php echo asset_url();?>global/plugins/pixie" src="<?php echo asset_url();?>global/plugins/pixie/pixie-integrate.js"></script>

<script>
jQuery(document).ready(function() 
{
   //App.init(); // init metronic core componets
   //Layout.init(); // init layout
   // QuickSidebar.init() // init quick sidebar
   // Index.init();   
   // Index.initDashboardDaterange();
   // Index.initJQVMAP(); // init index page's custom scripts
   // Index.initCalendar(); // init index page's custom scripts
   // Index.initCharts(); // init index page's custom scripts
   // Index.initChat();
   // Index.initMiniCharts();
   // Index.initIntro();
   // Tasks.initDashboardWidget();
});
</script>
<!-- END JAVASCRIPTS -->
