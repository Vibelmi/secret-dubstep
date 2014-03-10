{*
This template is for send an advice to the GUEST when he has sended a new ticket.

Variables:
    $Content.idtg = The id of the ticket at the guest_tickets table
    $Content.subject = The subject of the ticket
    $Content.description = The message of the ticket
    $Content.password = The password for read the ticket
*}  
<div>
<div id="content">You have sended the next ticket to our support team.<br>
    <div style="background:#CCC;padding:20px;">
    <b>{$Content.subject}</b><br>
    {$Content.description}
    </div>
    <p>You can check the state of this ticket here:</p>
    http://{$globals.HOST}{$globals.home[0]}index.php?page=lticket&idt={$Content.idtg}
    You should use the following password to read the ticket:
    <b>{$Content.password}</b></p>
    <p>We will answer your question as soon as possible</p>
    <p>If you has not sent this ticket, please contact us.</p>
</div>
</div>
