<script>
    include("modules/registry/js/registry.js");
</script>

<div id="registry">
    <h2 class="registryh2"><?php echo $cont->registry ?></h2>
    <div class="registrymain">
        <div class="registrydiv">
            <label for="name_registry" class="registrylabel"><?php echo $cont->name ?></label>
            <input id="name_registry" type="text" class="registryinput" placeholder="<?php echo $cont->name ?>"><br><br>
        </div>
        <div class="registrydiv">
            <label for="surname_registry" class="registrylabel"><?php echo $cont->surname ?></label>
            <input id="surname_registry" type="text" class="registryinput" placeholder="<?php echo $cont->surname ?>"><br><br>
        </div>
        <div class="registrydiv">
            <label for="fiscalid_registry" class="registrylabel"><?php echo $cont->fiscalid ?>*</label>
            <input id="fiscalid_registry" type="text" class="registryinput" placeholder="<?php echo $cont->fiscalid ?>"><br><br>
        </div>
        <div class="registrydiv">
            <label for="email_registry" class="registrylabel"><?php echo $cont->email ?></label>
            <input id="email_registry" type="email" class="registryinput" placeholder="<?php echo $cont->email ?>"><br><br>
        </div>
        <div class="registrydiv">
            <label for="pass_registry" class="registrylabel"><?php echo $cont->pass ?></label>
            <input id="pass_registry" class="registryinput" type="password" placeholder="<?php echo $cont->pass ?>"><br><br>
        </div>
        <div class="registrydiv">
            <label for="pass_registry_2" class="registrylabel"><?php echo $cont->pass2 ?></label>
            <input id="pass_registry_2" class="registryinput" type="password" placeholder="<?php echo $cont->pass2 ?>"><br><br>
        </div>
        <label id="optional">*<?php echo $cont->optional ?></label><br><br>
        <span id="errors"><?php echo $cont->errors ?></span><br><br>
        <button id="button_registry" class="registrybtn"><?php echo $cont->btnregistry ?></button><br><br>
    </div>
</div>
