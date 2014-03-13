{*
This template is for send the new password to the USER

Variables:
    $Content = the new password
*}
<html>
<div>
    <h3>Seriously you have forgotten that password?</h3>
    <img style="width:50%;display:block;margin:auto;" src='http://{$globals.HOST}{$globals.SUBFOLDER}/resources/img/chloe.gif'></img>
    <p>Ok... No problem... This is your new one <b>{$Content}</b></p>
    <p>You must change your password now. Because i know this one, and i'm a crazy robot.</p>
</div>
</html>