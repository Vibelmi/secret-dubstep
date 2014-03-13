<nav id="mainMenu">
<?php
global $language;
global $home;
if(isset($_SESSION["token"])){
    switch($_SESSION["token"]){
        case 0:
            echo '  <a href="'.$home[0].'?lang='.$language.'">Home</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=ctickets">Send ticket</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=ltickets">List tickets</a>';
            break;
        case 1:
            echo '  <a href="'.$home[0].'?lang='.$language.'">Home</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=ctickets">Send ticket</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=ltickets">List tickets</a>';
            break;
        case 10:
            echo '  <a href="'.$home[0].'?lang='.$language.'">Home</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=ltickets">List tickets</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=add_Product">Add product</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=admin_polls">Manage polls</a>';
            break;
    }
}else{
                echo '<a href="'.$home[0].'?lang='.$language.'">Home</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=registry">Registry</a>
                    <a href="'.$home[0].'?lang='.$language.'&page=ctickets">Send ticket</a>';
}

?>
</nav>
