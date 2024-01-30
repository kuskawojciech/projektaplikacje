<?php
    session_start();
    require_once('./scripts/connect.php');
    if(!isset($_SESSION['login']['isLogged'])){
        header('Location:index.php');
        exit();
    }

    switch($_SESSION['login']['roleID']){
        case 1:{
            $role="view_admin";
            break;
        }
        case 2:{
            $role="view_manager";
            break;
        }
        case 3:{
            $role="view_user";
            break;
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Urlopy - Zarządzanie przedsiębiorstwem</title>
    <link rel="stylesheet" href="./style/css/bootstrap.css">
    <link rel="stylesheet" href="./style/css/style.css">
    <script 
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" 
    crossorigin="anonymous"> </script>
    <script src="./style/js/bootstrap.js"></script>
</head>
<body>
<?php 
    require_once("view/$role/navbar.php");
?>
<!-- fetchowanie panelu głownego i navbara zależnie od roli !-->
<?php 
    require_once("view/$role/main.php");

?>
</html>