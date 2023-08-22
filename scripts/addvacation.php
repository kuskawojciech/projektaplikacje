<?php
    session_start();
    require_once('./connect.php');
    if($_SESSION['login']['isLogged']==0){
        header('location:../index.php');
        exit();
    }
    if(empty($_POST['start_date']) && (empty($_POST['end_date']))){
        $_SESSION['error']="Wypełni oba pola daty!";
        echo '<script>history.back();</script>';
        exit();
    }else{
        if(strlen($_POST['message'])<=250){
            if(empty($_POST['message'])){
                $message='';
            }else{
                $message=$_POST['message'];
            }
        }else{
            $_SESSION['error']="Zbyt długa notatka (max 250 znaków)";
            echo '<script>history.back();</script>';
            exit();
        }


        if($_POST['start_date']>$_POST['end_date']){
            $_SESSION['error']="Dzień początku urlopu musi być przed dniem zakończenia";
            echo '<script>history.back();</script>';
            exit();
        }
        
        $uid=$_SESSION['login']['userID'];

        $insertVacation=$con->prepare('INSERT INTO vacation (user_id, created_at, start_date, end_date, message) VALUES (:uid, current_timestamp(), :start_date, :end_date, :message);');
        $insertVacation->bindParam('uid',$uid,PDO::PARAM_INT);
        $insertVacation->bindParam('start_date',$_POST['start_date'],PDO::PARAM_STR);
        $insertVacation->bindParam('end_date',$_POST['end_date'],PDO::PARAM_STR);
        $insertVacation->bindParam('message',$message,PDO::PARAM_STR);
        $insertVacation->execute();
 
        header('Location:../dashboard.php');
    }
?>