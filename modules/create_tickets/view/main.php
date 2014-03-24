
<h2><?php echo $cont->title; ?></h2>
<div>
    <form id="ticketform" action="<?php echo $GLOBALS['URL']; ?>" method="post">
        <?php
        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            echo "<input name='temail' id='temail' type='email' value='$email' disabled='disabled'>";
        }else{
            echo "<input name='temail' id='temail' type='email' placeholder='$cont->email'>";
        }
        ?>
        
        <br>
        <input name="subject" id="subject" type="text" placeholder="<?php echo $cont->subject; ?>">
        <br>
        <textarea name="description" id="description" placeholder="<?php echo $cont->description; ?>"></textarea>
        <br>
        <input id="send" type="button" value="<?php echo $cont->send; ?>">
    </form>
</div>
<script type="text/javascript">
    include("modules/create_tickets/js/sendticket.js");
</script>
