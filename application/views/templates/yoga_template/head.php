<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<html lang="<?if(!empty($lang)) echo $lang ?>">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />

	    <title><?php if (isset($title)) {echo $title;} ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="author" />
    <meta name="keywords"
	      content="<?php if (isset($keywords)) {echo $keywords;}?>"/>
	<meta name="description"
	      content="<?php  if (isset($description)) {echo $description;}?>"/>
	
    <!-- <link rel="icon" href="<?=base_url()?>favicon.png" type="image/png"> -->
    <!-- BEGIN LAYOUT FIRST STYLES -->

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> -->

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
    
    
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->

<?php if (isset($this->data['page_level_css'] )): ?>
    <?php foreach ($this->data['page_level_css'] as $key => $value): ?>
        <?php foreach ($value as $key => $value): ?>
         <link href="<?=$value?>" type="text/css" rel="stylesheet">
     <?php endforeach ?>

 <?php endforeach ?>
<?php endif ?>
    

 <!-- END PAGE LEVEL PLUGINS -->

 <!-- BEGIN THEME GLOBAL STYLES -->

 <!-- END THEME GLOBAL STYLES -->
 <!-- BEGIN THEME LAYOUT STYLES -->

 <!-- END THEME LAYOUT STYLES -->

 </head>
 <script type="text/javascript">window.PrimeFilterFull = <?= (!empty($PrimeFilterFull)) ? json_encode($PrimeFilterFull) : '0' ;?>;</script>
    <!-- END HEAD -->