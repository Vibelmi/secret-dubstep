<h2><?php echo $cont->title; ?></h2>
<div>
    <form id="listticketform" action="<?php echo $GLOBALS['URL']; ?>" method="post">
        <input name="passwordt" id="passwordt" type="password" placeholder="<?php echo $cont->password; ?>">
    </form>
    <input id="sendg" type="button" value="<?php echo $cont->send; ?>">
</div>
<script type="text/javascript">
    include("modules/list_tickets/js/listguestticket.js");
</script>