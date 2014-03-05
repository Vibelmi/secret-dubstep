<!---->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
    </head>
    <body>
        <div id="twitter_mod">
            <div id="twitter_logo">
                <img src="https://g.twimg.com/Twitter_logo_blue.png">
                <span>TWITTER</span>
                <p>Así, en crudo</p>
            </div>
            <?php
            $tweet = new tweet();
            $creation_data = $tweet->getCreation_data();
            $followers = $tweet->getFollowers(); //420
            $avatar = $tweet->getAvatar();
            $author = $tweet->getAuthor(); //Pepe
            $user = $tweet->getUser();     //@Pep
            $text = $tweet->getText();     //Sun is shining
            for ($i = 0; $i < $tweet->getTweet_length(); $i++) {
                ?>
                <div class="tweet">
                    <div>
                        <?php echo ('<img src=' . $avatar[$i] . '>') ?>                                                
                    </div>
                    <div>
                        <span class="author">                    
                            <?php echo $author[$i] ?>
                        </span>
                        <span class="user">
                            <?php echo ('@' . $user[$i]) ?>
                        </span>   
                        <br>
                        <span class="msg">
                            <?php echo $text[$i] ?>
                        </span>
                        <br>
                        <span class="followers">
                            <?php echo ('· ' . $followers[$i] . ' ' . $cont->followers) ?>
                        </span>                                                                 
                    </div>
                </div><!--En of .tweet-->
                <?php
            }
            ?>
            <div>
                <button id="more_tweets"><?php echo ($cont->more) ?></button>
                <script>
                    $(window).load(function() {
                        $('#more_tweets').click(function() {
                            window.open('<?php echo ('https://twitter.com/search?q=samsung%20galaxy%20s5%20lang%3A' . $GLOBALS['language'] . '&src=typd&f=realtime&lang=' . $GLOBALS['language']) ?>', '_blank');
                        });
                    });
                </script>
            </div>
        </div><!--En of twitter_mod-->
    </body>
</html>