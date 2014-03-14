{*
This template is for send the link for validate the USER account

Variables:
    $Content.id = the id of the user
    $Content.number = the validation number
*}
<html>
<div>
    <h2 style="text-align:center;font-size:28px">Welcome to our family!</h2>
    <b style="background:#08C;color:white;font-size:22px;padding:15px;display:block;text-align:center;">We are pleased to count with you as a member of our awesome and dynamic community of monkeys!</b>
	<p style="margin:30px 10px;">We need that you confirm your account entering this <a href="http://{$globals.HOST}{$globals.home[0]}?page=registry&id={$Content.id}&number={$Content.number}">link</a>.</p> 
	<p style="margin:30px 10px;">This is because we need to know that this is your real email addres, because we will use this one for contact with you <span style="font-size:6px;">and for sending some spam =D</span></p> 
</div>
</html>