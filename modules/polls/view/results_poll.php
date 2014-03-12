<?php
include_once("modules/polls/model/polls_BLL.php");
$polls_inst = polls_BLL::getInstance();
$list_polls = $polls_inst->list_polls();
?>   
<div class="mod">
    <div class="module_div_title"><h2>POLL RESULTS</h2></div>
    <div id="polls_list" class="module_div_content">
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
                            <?php
                            echo $option['option_text'] . ' ';
                            $answer = $polls_inst->count_votes($option['option_id']);
                            echo '[ ' . $answer['count'] . ' ' . $cont->votes . ' ]';
                            ?>        

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
</div>

<script src="modules/polls/js/show_poll_events.js"></script>