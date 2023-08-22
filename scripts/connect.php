<?php
    $user = 'root';
    $password = '';

    try{
        $con = new PDO('mysql:host=localhost;dbname=projekt_wsb', $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo 'Error'.$e->getMessage();
    }
?>