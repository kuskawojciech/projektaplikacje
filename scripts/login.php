<?php
    session_start();
    require_once('./connect.php');
    
    if(empty($_POST['login'])) {
        $_SESSION['error']="Podaj login!";
        echo '<script>history.back();</script>';
    } else{
        echo $_POST['login'];

        $query=$con->prepare('select id, login, password, role_id, concat(name," ",surname) as username from user where login = :login');
        $query->bindParam('login',$_POST['login'],PDO::PARAM_STR);
        $query->execute();
        if($query->rowCount()==1){
            $data=$query->fetch(PDO::FETCH_ASSOC);   
            if(password_verify($_POST['pass'],$data['password'])){
                $_SESSION['login']['isLogged']=1;
                $_SESSION['login']['login']=$data['login'];
                $_SESSION['login']['roleID']=$data['role_id'];
                $_SESSION['login']['userID']=$data['id'];
                $_SESSION['login']['username']=$data['username'];

                $insertLog=$con->prepare('INSERT INTO logs (id_user, ip, type) VALUES (:uid, :ip, 2)'); // insertuje log z poprawnym logowaniem
                $insertLog->bindParam(':uid',$data['id'],PDO::PARAM_INT);
                $insertLog->bindParam(':ip',$_SERVER['REMOTE_ADDR'],PDO::PARAM_STR);
                $insertLog->execute();

                header('Location:../dashboard.php');
                $error=0;
                exit();
            }else{
                $_SESSION['error']="Złe hasło!";

                $insertLog=$con->prepare('INSERT INTO logs (id_user, ip, type) VALUES (:uid, :ip, 1)'); //insertuje log z błedem logowania
                $insertLog->bindParam(':uid',$data['id'],PDO::PARAM_INT);
                $insertLog->bindParam(':ip',$_SERVER['REMOTE_ADDR'],PDO::PARAM_STR);
                $insertLog->execute();

                echo '<script>history.back();</script>';
            }
            
            $error=0;
        }else{
            $_SESSION['error']="Nie ma takiego użytkownika!";
            echo '<script>history.back();</script>';
        }
    }
?>