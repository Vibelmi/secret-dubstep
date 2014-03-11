<?php
/*
$frutas_list = array('Peras', 'Manzanas');
$GLOBALS['smarty']->assign('frutas', $frutas_list);
$GLOBALS['smarty']->display('polls/list_polls.tpl');
*/
include_once("modules/polls/model/polls_BLL.php");

$polls_inst = polls_BLL::getInstance();
$list_polls = $polls_inst->list_polls();


//Paint
?>
<style>
    #polls_list .button_active{
        height: 25px;
    }
</style>
<div id="polls_list_title"><h2><?php echo $cont->polls_list?></h2></div>
<div id="polls_list">
        <?php
        foreach ($list_polls[0] as $key => $poll) {
            //Poll is active?
            $active;
            if($poll['active']){
                $active='YES';
            }else{
                $active='NO';
            }
            if($active==='NO'){
            echo '<h3>' . $poll['title'] . '<img class="button_active" src="modules/polls/images/red_button.jpg" alt="POLL IS NOT ACTIVE" ></h3>';
            }
            else {
            echo '<h3>' . $poll['title'] . '<img class="button_active"src="modules/polls/images/green_button.jpg" alt="POLL IS ACTIVE"></h3>';
                
            }
            echo '<div>';
            echo '<ul>';
            foreach ($list_polls[1] as $key => $option) {
                
                if ($option['poll_id'] === $poll['poll_id']) {
                    $answer = $polls_inst->count_votes($option['option_id']);
                    echo '<li>' . ($option['option_text'] .'[ ' . $answer['count'] . ' ' . $cont->votes . ']</li>');
                    
                }
            }
            echo '</ul>';
            echo '</div>';
        }
        ?>
</div>	
<?php
?>

<script src="modules/polls/js/list_polls_events.js"></script>


