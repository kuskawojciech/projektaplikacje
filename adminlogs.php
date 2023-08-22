<!-- do poprawy !-->
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
    <title>Logi - Zarządzanie Urlopami</title>
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
                                <h2 class="text-uppercase text-center mb-5">Logi</h2>

                                <?php
                                $fetchLogs=$con->query('select user.login, logs.id_user, logs.ip, logs.type, logs.created_at, logs.who from logs join user on logs.id_user=user.id order by logs.id asc');
                                $rowCount=$fetchLogs->rowCount();
                                $fetchLogs=$fetchLogs->fetchAll(PDO::FETCH_ASSOC);
                                
                                echo '<table class="table table-bordered">';
                                echo '<tr> <th> Lp. </th> <th> Użytkownik </th> <th> IP </th> <th> Typ akcji </th> <th> Utworzono </th> <th> Who </th> </tr>';
                                for($i=0; $i<=($rowCount-1); $i++){
                                    $lp=$i+1;
                                    echo '<tr>';
                                    echo '<td>'.$lp.'</td>';
                                    echo '<td>'.$fetchLogs[$i]['login'].'</td>';
                                    echo '<td>'.$fetchLogs[$i]['ip'].'</td>';
                                    echo '<td>'.$fetchLogs[$i]['type'].'</td>';
                                    echo '<td>'.$fetchLogs[$i]['created_at'].'</td>';
                                    echo '<td>'.$fetchLogs[$i]['who'].'</td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                                ?>

                                <br/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>