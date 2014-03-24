
<div>
    <form id="ticketform">
        <textarea name="description" id="description" placeholder="<?php echo $cont->description; ?>"></textarea>
        <br>
        <input id="sendr" type="button" value="<?php echo $cont->send; ?>">
    </form>
</div>
<script type="text/javascript">
    include("modules/create_tickets/js/sendticket.js");
</script>
