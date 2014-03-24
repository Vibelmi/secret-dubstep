<div id="guesttickets">
    <h2 class="guesttitle"><?php echo $responses[0]["subject"] ?></h2>
    <?php
    $gemail = $responses[0]["email"];
    for ($i = 0; $i < sizeof($responses); $i++) {
        if (isset($responses[$i]["idrg"])) {
            echo ' <div class="admindiv">
                    <label id="admintime">' . $responses[$i]["date"] . '</label>
                    <br>
                    <section class="admin">' . $responses[$i]["response"] . '</section> 
              </div>';
        } else {
            echo ' <div class="guestdiv">
                    <label id="guesttime">' . $responses[$i]["date"] . '</label>
                    <br>
                    <section class="guest">' . $responses[$i]["description"] . '</section>
               </div>';
        }
    }
    ?>
</div>