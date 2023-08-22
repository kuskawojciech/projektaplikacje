<?php
    session_start();
    require_once('./connect.php');
    if($_SESSION['login']['isLogged']==0){
        header('location:../index.php');
        exit();
    }
    if(($_SESSION['login']['roleID'])!=1){ //wpusci tylko admina
        header('Location:./dashboard.php');
        exit();
    }
    foreach($_POST as $data){
        if(empty($data)){
            $_SESSION['error']="Wypełnij wszystkie pola!!";
            echo '<script>history.back();</script>';
            exit();
        }        
    }
    
    $login=$_POST['login'];

    $fetchLogin=$con->prepare('select * from user where login = :login');
    $fetchLogin->bindParam('login',$login,PDO::PARAM_STR);
    $fetchLogin->execute();

    if($fetchLogin->rowCount()==1) {
        $_SESSION['error']="Istnieje taki użytkownik!";
        echo '<script>history.back();</script>';
        exit();
    }  
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']="Podaj poprawny email!";
        echo '<script>history.back();</script>';
        exit();
      }
    if(!preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\W).{8,}/ ',$_POST['newpass1'])){
		$_SESSION['error']="Nowe hasło nie spełnia wymogów! (min. 8 znaków, min. 1 znak specjalny, min. 1 duży znak, min. 1 liczba)";
        echo '<script>history.back();</script>';
        exit();
    }
    if($_POST['newpass1']!==$_POST['newpass2']){
        $_SESSION['error']="Podane hasła nie są zgodne!";
        echo '<script>history.back();</script>';
        exit();
    }
    
    $passwordHash=password_hash($_POST['newpass1'],PASSWORD_ARGON2ID);

    //echo $passwordHash;
    print_r($_POST);

    $insertUser=$con->prepare('INSERT INTO user(login, name, surname, email, birthday, password, role_id) VALUES (:login, :name, :surname, :email, :birthday, :password, :roleid)');
    $insertUser->bindParam('login',$login,PDO::PARAM_STR);
    $insertUser->bindParam('name',$_POST['name'],PDO::PARAM_STR);
    $insertUser->bindParam('surname',$_POST['surname'],PDO::PARAM_STR);
    $insertUser->bindParam('email',$_POST['email'],PDO::PARAM_STR);
    $insertUser->bindParam('birthday',$_POST['birthday'],PDO::PARAM_STR);
    $insertUser->bindParam('password',$passwordHash,PDO::PARAM_STR);
    $insertUser->bindParam('roleid',$_POST['role'],PDO::PARAM_INT);
    $insertUser->execute();

    

    if($insertUser->rowCount()==1){
        $_SESSION['success']="Dodano użytkownika <b>".$login."</b>!";
        header('Location:../register.php');
        $con=0;
        exit();
    }
?>