<?php
    session_start();
    require_once('./scripts/connect.php');
    if(!isset($_SESSION['login']['isLogged'])){
        header('Location:index.php');
        exit();
    }
    if(!$_SESSION['login']['roleID']==1){
        header('Location:dashboard.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista użytkowników - Zarządzanie Urlopami</title>
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
        require_once('./view/view_admin/navbar.php');
    ?>
    <div class="container">
        <div class="mask d-flex align-items-center h-100">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6" style="padding-top: 50px; width: 100%;">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Użytkownicy</h2>
                                <div class="d-flex justify-content-center">
                                    <a href="./register.php" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Dodaj użytkownika</a>
                                </div>
                                <br/><br/>
                                <?php
                                $queryUser='SELECT u.id as userid, u.login, u.name, u.surname, u.birthday, m.id as manager_id, role.role, concat(m.name," ",m.surname," (",m.login,")") as manager_name FROM user u join user m on m.id=u.manager_id join role on u.role_id=role.id where u.id>0 order by u.id asc';
                                $fetchUser=$con->query($queryUser);
                                $rowCount=$fetchUser->rowCount();
                                $fetchUser=$fetchUser->fetchAll(PDO::FETCH_ASSOC);
                                echo '<table class="table table-bordered">';
                                echo '<tr> <th> ID </th> <th> Login </th> <th> Imię </th> <th> Nazwisko </th> <th> Data urodzenia </th> <th> Przełożony </th> <th> ID przełożonego </th> <th> Rola </th> 
                                <th> <a href="./register.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg></a> </th> </tr>';
                                for($i=0; $i<=($rowCount-1); $i++){
                                    echo '<tr>';
                                    echo '<td>'.$fetchUser[$i]['userid'].'</td>';
                                    echo '<td>'.$fetchUser[$i]['login'].'</td>';
                                    echo '<td>'.$fetchUser[$i]['name'].'</td>';
                                    echo '<td>'.$fetchUser[$i]['surname'].'</td>';
                                    echo '<td>'.$fetchUser[$i]['birthday'].'</td>';
                                    echo '<td>'.$fetchUser[$i]['manager_name'].'</td>';
                                    echo '<td>'.$fetchUser[$i]['manager_id'].'</td>';
                                    echo '<td>'.$fetchUser[$i]['role'].'</td>';
                                    //echo '<td><a href="'.$fetchUser[$i]['userid'].'.php">Zmień</a></td>';
                                    echo '<td><a href="./userchg.php?userid='.$fetchUser[$i]['userid'].'">Zmień</a></td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>