<?php
/*
$frutas_list = array('Peras', 'Manzanas');
$GLOBALS['smarty']->assign('frutas', $frutas_list);
$GLOBALS['smarty']->display('polls/list_polls.tpl');
*/
include_once("modules/polls/model/polls_BLL.php");

$polls_inst = polls_BLL::getInstance();
$list_polls = $polls_inst->list_polls();
echo '<pre>';
//print_r($list_polls);
echo '</pre>';
//Get polls
$poll_arr = array();
while ($poll = $list_polls[0]->fetch_assoc()) {
    array_push($poll_arr, $poll);
    //$poll_n=$poll['poll_id'];    
}

//Get polls_options
$poll_options_arr = array();
while ($poll_options = $list_polls[1]->fetch_assoc()) {
    array_push($poll_options_arr, $poll_options);
}
echo '<pre>';
//print_r($poll_arr);
//print_r($poll_options_arr);

echo '</pre>';

//Paint
?>
<div id="polls_list">
        <?php
        foreach ($poll_arr as $key => $poll) {
            echo '<h3>' . $poll['title'] . '</h3>';
            echo '<div>';
            echo '<ul>';
            foreach ($poll_options_arr as $key => $option) {
                if ($option['poll_id'] === $poll['poll_id']) {
                    echo '<li>' . ($option['option_text'] . '</li>');
                }
            }
            echo '</ul>';
            echo '</div>';
        }
        ?>
    <div class="page_navigation"></div>
</div>	
<?php
?>

<script src="modules/polls/js/list_polls_events.js"></script>


