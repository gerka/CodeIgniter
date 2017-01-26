<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="ru">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title><?php echo $title;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- <link rel="icon" href="<?=base_url()?>favicon.png" type="image/png"> -->
    <!-- BEGIN LAYOUT FIRST STYLES -->
    <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
    <!-- END LAYOUT FIRST STYLES -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>global/plugins/bootstrap-select/css/bootstrap-select.min.css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?php echo asset_url();?>global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>global/plugins/bootstrap-summernote/summernote.css">

    <link href="<?php echo asset_url();?>global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo asset_url();?>global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<?php if (isset($this->data['page_level_css'] )): ?>
    <?php foreach ($this->data['page_level_css'] as $key => $value): ?>
        <?php foreach ($value as $key => $value): ?>
         <link href="<?=$value?>" type="text/css" rel="stylesheet">
     <?php endforeach ?>

 <?php endforeach ?>
<?php endif ?>
    
<?php if (isset($this->data['page_head_js'] )): ?>
    <?php foreach ($this->data['page_head_js'] as $key => $value): ?>
        <?php foreach ($value as $key => $value): ?>
           <script src="<?=$value?>" type="text/javascript"></script>
     <?php endforeach ?>

 <?php endforeach ?>
<?php endif ?>
    

 <!-- END PAGE LEVEL PLUGINS -->

 <!-- BEGIN THEME GLOBAL STYLES -->
 <link href="<?php echo asset_url();?>global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
 <link href="<?php echo asset_url();?>global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
 <!-- END THEME GLOBAL STYLES -->
 <!-- BEGIN THEME LAYOUT STYLES -->
 <link href="<?php echo asset_url();?>layouts/layout6/css/layout.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo asset_url();?>layouts/layout6/css/custom.min.css" rel="stylesheet" type="text/css" />
 <!-- END THEME LAYOUT STYLES -->
 <!-- <link rel="shortcut icon" href="favicon.ico" /> --> </head>
    <!-- END HEAD -->