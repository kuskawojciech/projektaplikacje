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
       
    foreach($_POST as $data){
        if(empty($data)){
            $_SESSION['p_error']="Wypełnij wszystkie pola!!";
            echo '<script>history.back();</script>';
            exit();
        }
    }
    if(!preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).{8,}/ ',$_POST['newpass1'])){
		$_SESSION['p_error']="Nowe hasło nie spełnia wymogów! (min. 8 znaków, min. 1 znak specjalny, min. 1 duży znak, min. 1 liczba)";
        echo '<script>history.back();</script>';
        exit();
    }
    

    if($_POST['newpass1']==$_POST['newpass2']){
       try{
            $con->beginTransaction();
            $hashPassword=(password_hash($_POST['newpass1'],PASSWORD_ARGON2ID));

            $insertPassword=$con->prepare('UPDATE `user` SET password = :hash WHERE `id` = :uid');
            $insertPassword->bindParam(':hash',$hashPassword,PDO::PARAM_STR);
            $insertPassword->bindParam(':uid',$_POST['userid'],PDO::PARAM_INT);
            $insertPassword->execute();

            $insertLogs=$con->prepare('INSERT INTO `logs` (id_user, ip, type, who) VALUES (:uid, :ip, 3, 2)');
            $insertLogs->bindParam(':uid',$_POST['userid'],PDO::PARAM_INT);
            $insertLogs->bindParam(':ip',$_SERVER['REMOTE_ADDR'],PDO::PARAM_STR);
            $insertLogs->execute();
            $con->commit();
            $_SESSION['p_success']="Zmieniono hasło!";
            echo '<script>history.back();</script>';
        }catch(PDOException $e){
            $con->rollback();
            echo $e->getMessage;
            $_SESSION['p_error']="Niezindentyfikowany błąd".$e;
            echo '<script>history.back();</script>';
            exit();
        }

    }else{
        $_SESSION['p_error']="Nowe hasła nie są zgodne!";
        echo '<script>history.back();</script>';
        exit();
    }
    
?>