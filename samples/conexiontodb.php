<?php
require "../connection/Db.class.php";
require "../connection/Conf.class.php";

//EJEMPLO DE CONEXION A LA DB CON UN REGISTRO DE USUARIO, LAS SQL SE DEBERIAN HACER CON EL SqlQueryBuilder

//INSTANCIEM LA DB
$bd=Db::getInstance();

//COMPROBACIONS DE SI ENS HA ARRIBAT X INFORMACIO PER AL REGISTRE
if (isset($_POST['username'], $_POST['email'], $_POST['password'])) {
    // Sanear y validar
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Email no valido
        echo "error1";
    }else{
 
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    //CREAMOS LA SENTENCIA SQL
    $sql = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
    //EJECUTAMOS EL SQL Y LO GUARDAMOS EN LA VARIABLE $stmt
    $stmt = $bd->ejecutar($sql);
    
    //COMPROBAMOS QUE NO ESTE DUPLICADO EL EMAIL
    }if ($stmt->num_rows == 1) {
        // Email duplicado
        echo "error2";
        }else{
            //CREAMOS EL SQL PARA INSERTAR EL USUARIO
            $insert_stmt = "INSERT INTO users (username, email, password, type) VALUES ('$username', '$email', '$password', 0)";
            //EJECUTAMOS EL INSERT
            $bd->ejecutar($insert_stmt);
            echo "registrado";
        }
        
    }

        //Insertar el nuevo usuario
        
        //PAGINA DE REGISTRO CORRECTO
        
?>