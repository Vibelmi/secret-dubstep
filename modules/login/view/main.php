<script>
    include("modules/login/js/jquery.lightbox_me.js");
    include("modules/login/js/js.js");
</script>
<button id="btnlogin"><?php echo $cont->login ?></button>

<div id="sign_up" style="display: none; left: 50%; margin-left: -223px; z-index: 1002; position: absolute; top: 839px; margin-top: 0px;">
    <img id="ximg" height="20" width="20" src="modules/login/images/x.png" alt="x">
    <h2 id="see_id" class="loginh2"><?php echo $cont->login ?></h2>
    <div id="sign_up_form">
        <input id="email" type="email" class="logininput" placeholder="<?php echo $cont->user ?>"><br><br>
        <input id="pass" class="logininput" type="password" placeholder="<?php echo $cont->pass ?>"><br><br>
        <button id="btnenter" class="btnenter"><?php echo $cont->login ?></button><br><br>
        <input id="checkboxprov" class="checkbox" type="checkbox"><label class="labelcheck" for="checkboxprov"><?php echo $cont->provider ?></label><br><br>
        <div id="actions">
            <a class="logina" id="cancel" href="#"><?php echo $cont->rememberpass ?></a>
            <a class="logina" id="register" href="#"><?php echo $cont->register ?></a>
            <br><br>
        </div>
    </div>
    <div id="sign_in">
        <br>
        <h3 id="left_out" class="sprited"><?php echo $cont->signin ?></h3>
        <div id="facebook" class="singin"><img class="singinimg" width="25" height="25" alt="facebook" src="modules/login/images/facebook.png"><p class="singinp"><?php echo $cont->signinfacebook ?></p></div>
        <br>
        <div id="google" class="singin"><img class="singinimg" width="25" height="25" alt="google" src="modules/login/images/google.jpg"><p class="singinp"><?php echo $cont->signingoogle ?></p></div>
        <br>
        <div id="twitter" class="singin"><img class="singinimg" width="25" height="25" alt="twitter" src="modules/login/images/twitter.png"><p class="singinp"><?php echo $cont->signintwitter ?></p></div>
    </div>
</div>