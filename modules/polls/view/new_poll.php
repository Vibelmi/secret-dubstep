<?php
if (isset($GLOBALS['CLEANED_POST']["title"]) && $GLOBALS['CLEANED_POST']["options"]) { 
    include_once("modules/polls/model/polls_BLL.php");
    $polls_inst=polls_BLL::getInstance();
    $polls_inst->insert_new_poll($GLOBALS['CLEANED_POST']["title"],$GLOBALS['CLEANED_POST']["options"]);
    //print_r($insert_and_reload['title']);
    
    
    

} else {
    $new_poll_fields = array(
        'title_txt' => $cont->title,
        'title_ipt' => '<input type="text" id="title_ipt">',
        'options_txt' => $cont->options,
        'options_ta' => '<textarea rows="6" style="width:100%" id="options_ta"></textarea>',
        'button' => '<button id="button">' . $cont->send . '</button>'
    );
    $GLOBALS['smarty']->assign('new_poll', $new_poll_fields);
    $GLOBALS['smarty']->display('polls/new_poll.tpl');
}
?>