
<p>Pagina principal para el modulo de tickets</p>
<div>
    <form method="POST" action="index.php?page=utickets">
       <input id="subject" type="text" placeholder="<?php echo $cont->subject;?>">
        <br>
        <textarea id="description" rows="4" cols="50" placeholder="<?php echo $cont->description;?>"></textarea>
        <br>
    </form>
    <input id="send" type="button" value="<?php echo $cont->send;?>">
</div>
<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="modules/user_tickets/js/sendticket.js"></script>
