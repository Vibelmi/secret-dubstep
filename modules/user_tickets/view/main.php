
<p>Pagina principal para el modulo de tickets</p>
<div>
    <form id="ticketform" action="<?php echo $GLOBALS['URL'];?>" method="post">
        
       <input name="subject" id="subject" type="text" placeholder="<?php echo $cont->subject;?>">
        <br>
        <textarea name="description" id="description" rows="4" cols="50" placeholder="<?php echo $cont->description;?>"></textarea>
        <br>
        <input id="send" type="button" value="<?php echo $cont->send;?>">
    </form>
</div>
<script type="text/javascript">
    include("modules/user_tickets/js/sendticket.js");
</script>
