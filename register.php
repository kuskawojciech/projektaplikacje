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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja użytkownika - Zarządzanie przedsiębiorstwem</title>
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
?>
        <div class="mask d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6" style="padding-top: 50px; width: 70%;">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Rejestracja użytkownika</h2>

                                <form method="post" action="./scripts/register.php">

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="login" class="form-control form-control-lg" name="login"/>
                                                <label class="form-label" for="login">Login</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="email" id="email" class="form-control form-control-lg" name="email"/>
                                                <label class="form-label" for="email">Adres e-mail</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="name" class="form-control form-control-lg" name="name"/>
                                                <label class="form-label" for="name">Imię</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <div class="form-outline">
                                                <input type="text" id="surname" class="form-control form-control-lg" name="surname"/>
                                                <label class="form-label" for="surname">Nazwisko</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 d-flex align-items-center">

                                            <div class="form-outline datepicker w-100">
                                                <input type="date" class="form-control form-control-lg" id="birthday" name="birthday"/>
                                                <label for="birthday" class="form-label">Data urodzenia</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4">

                                            <h6 class="mb-2 pb-1">Rola: </h6>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="role_id"
                                                       value="3" checked name="role_id"/>
                                                <label class="form-check-label" for="roleUser">Użytkownik</label>
                                            </div>

                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="role" id="role_id"
                                                       value="2" name="role_id"/>
                                                <label class="form-check-label" for="roleManager">Przełożony</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="password" id="password" class="form-control form-control-lg" name="newpass1"/>
                                                <label class="form-label" for="password">Hasło</label>
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-4 pb-2">

                                            <div class="form-outline">
                                                <input type="password" id="password" class="form-control form-control-lg" name="newpass2"/>
                                                <label class="form-label" for="password">Powtórz hasło</label>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Utwórz konto</button>
                                    </div>

                                    <br/><br/>

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
                </div>
            </div>
        </div>
</html>