<h2 class="guesttitle"><?php echo $result["subject"] ?></h2>
<?php
if (sizeof($responses) !== 0) {
    for ($i = 0; $i < sizeof($responses); $i++) {
        echo '
<div class="guestdiv">
        
    <section class="guest">' . $result["description"] . '</section>
</div>
<div class="guestdiv">
    <section class="admin">' . $responses[$i]["response"] . '</section>
</div>';
    }
} else {
    echo '
<div class="guestdiv">
        
    <section class="guest">' . $result["description"] . '</section>
</div>';
}
?>
<textarea name="description" id="description" placeholder="<?php echo $cont->description; ?>"></textarea>
<br>
<input type="button" id="sendr" value="Send">