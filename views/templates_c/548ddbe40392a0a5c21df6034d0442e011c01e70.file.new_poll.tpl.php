<?php /* Smarty version Smarty-3.1.16, created on 2014-03-11 14:23:29
         compiled from "views/templates/polls/new_poll.tpl" */ ?>
<?php /*%%SmartyHeaderCode:634390084531b040f021de8-85738967%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '548ddbe40392a0a5c21df6034d0442e011c01e70' => 
    array (
      0 => 'views/templates/polls/new_poll.tpl',
      1 => 1394544208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '634390084531b040f021de8-85738967',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_531b040f079d16_72406574',
  'variables' => 
  array (
    'new_poll' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_531b040f079d16_72406574')) {function content_531b040f079d16_72406574($_smarty_tpl) {?><script src="modules/polls/js/new_poll_events.js"></script>
<div id="new_poll_title">
    <h2><?php echo $_smarty_tpl->tpl_vars['new_poll']->value['module_title'];?>
</h2>
</div>
<div id="new_poll">
    <?php echo $_smarty_tpl->tpl_vars['new_poll']->value['title_txt'];?>
<br>
    <?php echo $_smarty_tpl->tpl_vars['new_poll']->value['title_ipt'];?>
<br>
    <?php echo $_smarty_tpl->tpl_vars['new_poll']->value['options_txt'];?>
<br>
    <?php echo $_smarty_tpl->tpl_vars['new_poll']->value['options_ta'];?>
<br>
    <?php echo $_smarty_tpl->tpl_vars['new_poll']->value['button'];?>

</div><?php }} ?>
