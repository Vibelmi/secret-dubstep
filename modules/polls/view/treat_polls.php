<?php
include_once("modules/polls/model/polls_BLL.php");

if (isset($GLOBALS['CLEANED_POST']["poll_id"]) && isset($GLOBALS['CLEANED_POST']["option"])) {
    $polls_inst = polls_BLL::getInstance();
    if($GLOBALS['CLEANED_POST']["option"]==='state'){
    $polls_inst->change_active_poll($GLOBALS['CLEANED_POST']["poll_id"]);
    }
    else if($GLOBALS['CLEANED_POST']["option"]==='modify'){
    $polls_inst->change_active_poll($GLOBALS['CLEANED_POST']["poll_id"]);
    } 
   else if($GLOBALS['CLEANED_POST']["option"]==='delete'){
    $polls_inst->delete_poll($GLOBALS['CLEANED_POST']["poll_id"]);
    }    
}
else {
    $polls_inst = polls_BLL::getInstance();
    $list_polls = $polls_inst->list_polls();

    ?>
<div class="mod">
<div id="treat_polls" class="module_div_title"><h2><?php echo $cont->treat ?></h2></div>
<div id="treat_polls_content" class="module_div_content">
        <h3><?php echo $cont->select_one_option ?></h3>
        <input type="radio" name="to_do" value="state"><span><?php echo $cont->state ?></span><br>
       <!-- <input type="radio" name="to_do" value="modify"><span><?php echo $cont->modify ?></span><br>-->
        <input type="radio" name="to_do" value="delete"><span><?php echo $cont->delete ?></span><br>

        <p></p>
        <select id="treat_polls_list">
    <?php
    foreach ($list_polls[0] as $key => $poll) {
        ?>
                <option value="<?php echo $poll['poll_id'] ?>"><?php echo $poll['title'] ?></option>
                <?php
            }
            ?>
            }
        </select>
        <br>
        <br>
        <button><?php echo $cont->launch_treat ?></button>
    </div>
    <?php
}
?>
</div>
<script src="modules/polls/js/treat_polls_events.js"></script>