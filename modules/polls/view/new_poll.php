<?php
if (isset($GLOBALS['CLEANED_POST']["title"]) && $GLOBALS['CLEANED_POST']["options"]) {
    include_once("modules/polls/model/polls_BLL.php");
    $polls_inst = polls_BLL::getInstance();
    $polls_inst->insert_new_poll($GLOBALS['CLEANED_POST']["title"], $GLOBALS['CLEANED_POST']["options"]);
} else {
    ?>
    <div class="mod">
        <div id="polls_list_title" class="module_div_title"><h2><?php echo $cont->new_poll ?></h2></div>

        <?php
        $new_poll_fields = array(
            'module_title' => $cont->new_poll,
            'title_txt' => $cont->title,
            'title_ipt' => '<input type="text" placeholder="Write a title for the new poll" id="title_ipt">',
            'options_txt' => $cont->options,
            'options_ta' => '<textarea rows="6" placeholder="Each line count as one option" id="options_ta"></textarea>',
            'button' => '<button id="button">' . $cont->send . '</button>'
        );
        $GLOBALS['smarty']->assign('new_poll', $new_poll_fields);
        $GLOBALS['smarty']->display('polls/new_poll.tpl');
    }
    ?>

</div>
