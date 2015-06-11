<!DOCTYPE html>
<html lang="zh-tw" class="<?=$global['browser_agent']['browser']?><?if(!empty($global['browser_agent']['browser_ie'])){echo ' '.$global['browser_agent']['browser_ie'];}?>">
<head>
	<meta charset="utf-8">
	<title><?=$global['website_title_name']?> - <?=$global['website_title_introduction']?></title>
	<?if(isset($global['website_metatag_array'])):?>
	<?foreach($global['website_metatag_array'] as $value):?>
	<meta name="keywords" content="<?=$value?>">
	<?endforeach?>
	<?endif?>
	<base href="<?=prep_url($_SERVER['HTTP_HOST'].base_url())?>" />
	<script src="app/js/jquery-1.11.1.min.js"></script>
	<script src="app/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="app/js/jquery-ui-1.11.4.custom/jquery-ui.css"></link>
	<script src="app/js/fanswoo-1.3.1.js"></script>
	<script src="app/js/script_common.js"></script>
    <?if(empty($global['script_meta']) == FALSE):?>
    <?=$global['script_meta']?>
    <?endif?>
	<?if(!empty($global['js'])):?>
	<?foreach($global['js'] as $value):?>
	<script src="app/js/<?=$value?>.js"></script>
	<?endforeach?>
	<?endif?>
	<?if(!empty($global['website_script_plugin_ga'])):?><script><?=$global['website_script_plugin_ga']?></script><?endif?>
	<?if(!empty($global['website_script_plugin_fb'])):?><script><?=$global['website_script_plugin_fb']?></script><?endif?>
	<?if(!empty($global['website_script_plugin_custom'])):?><script><?=$global['website_script_plugin_custom']?></script><?endif?>
	<link rel="shortcut icon" href="app/img/favicon.ico"></link>
	<link rel="stylesheet" type="text/css" href="app/css/temp/reset.css"></link>