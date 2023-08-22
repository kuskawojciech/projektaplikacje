<?php
    session_start();
    require_once('./connect.php');
    if($_SESSION['login']['isLogged']==0){
        header('location:../index.php');
        exit();
    }
    if(!$_SESSION['login']['roleID']==1){
        header('Location:dashboard.php');
        exit();
    }

    $updateUser=$con->prepare('UPDATE `user` SET `manager_id`=:mid,`role_id`=:rid WHERE id=:uid');
    $updateUser->bindParam(':mid',$_POST['managerid'],PDO::PARAM_INT);
    $updateUser->bindParam(':rid',$_POST['role'],PDO::PARAM_INT);
    $updateUser->bindParam(':uid',$_POST['userid'],PDO::PARAM_INT);
    $updateUser->execute();

    if($updateUser->rowCount()==1){
        $_SESSION['success']="Zmieniono dane!";
        echo '<script>history.back();</script>';
        $con=0;
        exit();
    }else{
        $_SESSION['error']="Błąd!";
        echo '<script>history.back();</script>';
        $con=0;
        exit();
    }