<nav class="nav">
<?php
global $language;
global $home;
if(isset($_SESSION["token"])){
    switch($_SESSION["token"]){
        case 0:
            echo '<ul>
                                    <li class="current"><a href="'.$home[0].'?lang='.$language.'">Home</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=ctickets">Send ticket</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=ltickets">List tickets</a></li>
                  </ul>';
            break;
        case 1:
            echo '<ul>
                                    <li class="current"><a href="'.$home[0].'?lang='.$language.'">Home</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=ctickets">Send ticket</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=ltickets">List tickets</a></li>
                  </ul>';
            break;
        case 10:
            echo '<ul>
                                    <li class="current"><a href="'.$home[0].'?lang='.$language.'">Home</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=add_Product">Add product</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=ltickets">List tickets</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=admin_polls">Manage polls</a></li>
                 </ul>';
            break;
    }
}else{
                echo '<ul>
                                    <li class="current"><a href="'.$home[0].'?lang='.$language.'">Home</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=registry">Registry</a></li>
                                    <li><a href="'.$home[0].'?lang='.$language.'&page=ctickets">Send ticket</a></li>
                      </ul>';
}

?>
</nav>
