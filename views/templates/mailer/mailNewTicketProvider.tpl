{*
This template is for send an advice to the PROVIDER when he has sended a new ticket.

Variables:
    $Content.idtp = The id of the ticket at the prov_tickets table
    $Content.subject = The subject of the ticket
    $Content.description = The message of the ticket
*}
<html>
<div>
<div id="content">You have sended the next ticket to our support team.<br>
    <b>{$Content.subject}</b><br>
    {$Content.description}
    <p>You can check the state of this ticket <a href="http://{$globals.HOST}{$globals.home[0]}?page=lticket&idt={$Content.idtp}">here</a></p>
    <p>We will answer your question as soon as possible</p>
    <p>If you has not sent this ticket, please contact us.</p>
</div>
</div>
</html>