<?php
    session_start();
    if($_SESSION['login']['isLogged']==1){
        session_destroy();
        session_start();
        session_regenerate_id();
        $_SESSION['success']="Wylogowano pomyślnie!";
        header('Location:../index.php');
    }else{
        header('Location:../index.php');
    }
?>