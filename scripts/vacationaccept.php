<?php
    session_start();
    require_once('./connect.php');
    if(($_SESSION['login']['isLogged']==0)||($_SESSION['login']['roleID']==3)){// tylko admin lub manager moga wejść
        echo '<script>history.back();</script>';
        exit();
    }

    if(empty($_GET['vacation_id'])){
        echo '<script>history.back();</script>';
        exit();
    }
    
    $uid=$_SESSION['login']['userID'];
    
    $queryVacation=$con->prepare('select vacation.id, user.manager_id, vacation.user_id from vacation join user on user.id=vacation.user_id where vacation.id=:vid');
    $queryVacation->bindParam('vid',$_GET['vacation_id'],PDO::PARAM_INT);
    $queryVacation->execute();
    $getVacation=$queryVacation->fetch(PDO::FETCH_ASSOC);
    if(($getVacation['manager_id']==$_SESSION['login']['userID'])||($_SESSION['login']['roleID']==1)){
        $acceptVacation=$con->prepare('UPDATE vacation SET is_accepted = 1, accepted_by = :uid WHERE id=:vid');
        $acceptVacation->bindParam('vid',$_GET['vacation_id'],PDO::PARAM_INT);
        $acceptVacation->bindParam('uid',$_SESSION['login']['userID'],PDO::PARAM_INT);
        $acceptVacation->execute();
        header('Location:../managevacation.php');
    }
?>