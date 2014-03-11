<?php
include_once("modules/polls/model/polls_BLL.php");
$polls_inst = polls_BLL::getInstance();

if (isset($GLOBALS['CLEANED_POST']["option_id"])) {
    $polls_inst->vote($GLOBALS['CLEANED_POST']["option_id"]);
    //SELECT * FROM polls INNER JOIN polls_options ON polls.poll_id=polls_options.poll_id INNER JOIN polls_answers ON polls_options.option_id=polls_answers.option_id
    include_once("modules/polls/view/results_poll.php");
    
} else {
    $list_polls = $polls_inst->list_polls();
    ?>   
    <div id="polls_list">
        <?php
        foreach ($list_polls[0] as $key => $poll) {
            if ($poll['active']) {

                echo '<h4>' . $poll['title'] . '</h4>';
                echo '<div>';
                echo '<ul>';
                foreach ($list_polls[1] as $key => $option) {
                    if ($option['poll_id'] === $poll['poll_id']) {
                        ?>
                        <li>
                            <input type="radio" name="option" class="option" value="<?php echo $option['option_id'] ?>"><?php echo $option['option_text'] ?><br>
                        </li>                    
                        <?php
                    }
                }
                echo '</ul>';
                echo '</div>';
            };
        }
        ?>
    </div>	 
    <?php
}
?>
<script src="modules/polls/js/show_poll_events.js"></script>



