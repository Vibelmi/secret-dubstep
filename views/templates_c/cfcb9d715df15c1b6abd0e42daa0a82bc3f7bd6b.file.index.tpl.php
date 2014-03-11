<?php /* Smarty version Smarty-3.1.16, created on 2014-03-10 22:57:29
         compiled from "views/templates/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2046459258531887f64be338-10017389%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfcb9d715df15c1b6abd0e42daa0a82bc3f7bd6b' => 
    array (
      0 => 'views/templates/index.tpl',
      1 => 1394484875,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2046459258531887f64be338-10017389',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_531887f6517306_31917414',
  'variables' => 
  array (
    'Styles' => 0,
    'Content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531887f6517306_31917414')) {function content_531887f6517306_31917414($_smarty_tpl) {?><link rel="stylesheet" type="text/css" href="css/hooks.css">
<link rel="stylesheet" type="text/css" href="css/general.css">
<?php echo $_smarty_tpl->tpl_vars['Styles']->value;?>

</head>
<body>
<header>
<div id="logo"><img src="resources/img/logo.png"></div><div id="header"><?php echo $_smarty_tpl->tpl_vars['Content']->value['header'];?>
</div>
<div class="clear"></div>
<div id="locationBar"><span>Home >> Products >> IPhone Reshulon</span><span id="langSelect">es | en | ru</span></div>
</header>
<section class="contentTop"><?php echo $_smarty_tpl->tpl_vars['Content']->value['contentTop'];?>
</section>
<section class="contentCenter"><?php echo $_smarty_tpl->tpl_vars['Content']->value['contentCenter'];?>
</section>
<section class="contentBottom"><?php echo $_smarty_tpl->tpl_vars['Content']->value['contentBottom'];?>
</section>
<aside class="bottomLeft"><?php echo $_smarty_tpl->tpl_vars['Content']->value['bottomLeft'];?>
</aside>
<aside class="bottomCenter"><?php echo $_smarty_tpl->tpl_vars['Content']->value['bottomCenter'];?>
</aside>
<aside class="bottomRight"><?php echo $_smarty_tpl->tpl_vars['Content']->value['bottomRight'];?>
</aside>
<div class="clear"></div>
<?php }} ?>
