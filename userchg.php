<?php
    session_start();
    require_once('./scripts/connect.php');
    if(!isset($_SESSION['login']['isLogged'])==1){
        header('Location:./index.php');
        exit();
    }
    if(($_SESSION['login']['roleID'])!=1){
        header('Location:./dashboard.php');
        exit();
    }
    if(!isset($_GET['userid'])){
        echo '<script>history.back();</script>';
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ustawienia użytkownika - Zarządzanie Urlopami</title>
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
    require_once("view/view_admin/navbar.php");

    $uid=$_GET['userid'];

    $fetchUser=$con->prepare('select id, login, name, surname, email, role_id, manager_id from user where id=:uid');
    $fetchUser->bindParam(':uid',$uid,PDO::PARAM_INT);
    $fetchUser->execute();
    $fetchUser=$fetchUser->fetch(PDO::FETCH_ASSOC);

    $fetchManager=$con->prepare('select id, concat(name," ",surname," (",login,")") as name from user where role_id in (1,2) and NOT id=:uid');
    $fetchManager->bindParam(':uid',$uid,PDO::PARAM_INT);
    $fetchManager->execute();

    $countManager=$fetchManager->rowCount();
    $fetchManager=$fetchManager->fetchAll(PDO::FETCH_ASSOC);

   
    
    //print_r($fetchManager);
?>
        <div class="mask d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-7" style="padding-top: 50px;">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Ustawienia użytkownika</h2>

                                <form method="post" action="./scripts/usersettings.php">

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="login">Login</label>
                                                <h4>
                                                    <?php echo $fetchUser['login']; ?>
                                                </h4>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="email">Adres e-mail</label>
                                                <h4>
                                                <?php echo $fetchUser['email']; ?>
                                                </h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="name">Imię</label>
                                                <h4>
                                                <?php echo $fetchUser['name']; ?>
                                                </h4>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <label class="form-label" for="surname">Nazwisko</label>
                                                <h4>
                                                <?php echo $fetchUser['surname']; ?>
                                                </h4>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <h6 class="mb-2 pb-1">Rola: </h6>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="role_id"
                                                       value="3"  
                                                       <?php if($fetchUser['role_id']==3) echo "checked";?>
                                                       name="role_id"/>
                                                <label class="form-check-label" for="roleUser">Użytkownik</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="role_id"
                                                       value="2" 
                                                       <?php if($fetchUser['role_id']==2) echo "checked";?>
                                                       name="role_id"/>
                                                <label class="form-check-label" for="roleManager">Przełożony</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <label class="form-label select-label">Przełożony</label><br/>
                                            <select name="managerid" class="select form-control-lg">
                                                <?php
                                                    for($i=0; $i<=($countManager-1); $i++){
                                                        
                                                        if($fetchManager[$i]['id']==$fetchUser['manager_id']){
                                                            echo '<option value="'.$fetchManager[$i]['id'].'" selected>'.$fetchManager[$i]['name'].'</option>';
                                                        }else{
                                                            echo '<option value="'.$fetchManager[$i]['id'].'">'.$fetchManager[$i]['name'].'</option>';
                                                        }
                                                    }
                                            
                                                ?>

                                            </select>

                                        </div>
                                    </div>

                                    <br/><br/>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Zmień ustawienia</button>
                                    </div>

                                    <br/>
                                    
                                    <input type="hidden" id="userid" name="userid" value="<?php echo $uid ?>" />

                                </form>

                                <?php
                                if(isset($_SESSION['success'])) {
                                    echo <<< ERROR
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <div>
                    $_SESSION[success]
                </div>
            </div>
        ERROR;
                                    unset($_SESSION['success']);
                                }
                                if(isset($_SESSION['error'])) {
                                    echo <<< ERROR
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    $_SESSION[error]
                </div>
            </div>
        ERROR;
                                    unset($_SESSION['error']);
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-5" style="padding-top: 50px;">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Zmiana hasła</h2>

                                <form method="post" action="./scripts/adminpasswordchg.php">

                                <input type="hidden" id="userid" name="userid" value="<?php echo $uid ?>" />

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="newpass1"/>
                                        <label class="form-label" for="form3Example4cg">Nowe hasło</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="newpass2"/>
                                        <label class="form-label" for="form3Example4cg">Powtórz hasło</label>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Zmień hasło</button>
                                    </div>

                                    <br/><br/>

                                </form>

                                <?php
                                if(isset($_SESSION['p_success'])) {
                                    echo <<< ERROR
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <div>
                    $_SESSION[p_success]
                </div>
            </div>
        ERROR;
                                    unset($_SESSION['p_success']);
                                }
                                if(isset($_SESSION['p_error'])) {
                                    echo <<< ERROR
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div>
                    $_SESSION[p_error]
                </div>
            </div>
        ERROR;
                                    unset($_SESSION['p_error']);
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</html>