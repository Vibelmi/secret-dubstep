<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<?php echo $GLOBALS["CLEANED_POST"]["product_name"]; ?>
<h2><?php echo $cont->title; ?></h2>
<div>
    <form id="addProductform" action="<?php echo $GLOBALS['URL']; ?>" method="post">
        <fieldset>
            <legend><?php echo $cont->general_data ?></legend>
            <div style="float:left; width:50%; box-sizing: border-box; padding:5px;">
                <label><?php echo $cont->product_name ?></label>
                <input type="text"  id="product_name">
            </div>
            <div style="float:left; width:50%; box-sizing: border-box; padding:5px;">
                <label><?php echo $cont->finish_date ?></label>
                <input type="text" id="datepicker">
            </div>
        </fieldset>
        <br/>
        <fieldset>
            <legend><?php echo $cont->thresholds ?></legend>
            <div style="float:left; width:50%; box-sizing: border-box; padding:5px;">
                <label><?php echo $cont->units ?></label>
                <input type="text" class="threshold">
            </div>
            <div style="float:left; width:50%; box-sizing: border-box; padding:5px;">
                <label><?php echo $cont->price ?></label>
                <input type="text" class="threshold">
            </div>
        </fieldset>
        <br/>
        <div id="tabs" class="tab-container">
            <ul class='etabs'>
                <?php
                foreach ($GLOBALS["allowedLanguages"] as $value) {
                    echo "<li class='tab'><a href=#$value>$value</a></li>";
                }
                ?>
            </ul>
            <?php
            foreach ($GLOBALS["allowedLanguages"] as $value) {
                echo "<div id=$value><label>$cont->short</label><textarea placeholder='$cont->short_PH' style='width:100%; resize: none;'></textarea>";
                echo "<br/>";
                echo "<label>$cont->specs</label><textarea placeholder='$cont->specs_PH' style='width:100%; height:200px; resize: none;'></textarea></div>";
            }
            ?>
        </div>
		<br/>
		<fieldset>
		<legend><?php echo $cont->images ?></legend>
        <div style="float:left; width:50%; box-sizing: border-box; padding:5px;">
                <label><?php echo $cont->main_image ?></label>
                <input type="file" id="main_image">
        </div>
		</fieldset>
		<br/>
		<input style="float:left; width:100%; box-sizing: border-box; padding:25px;" type="submit" id="submit" value="<?php echo $cont->send_button ?>">
    </form>
</div>
<script type="text/javascript">
    include("modules/addProduct/js/setBasics.js");
</script>
