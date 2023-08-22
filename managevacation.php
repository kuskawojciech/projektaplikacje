<?php
    session_start();
    if(!(($_SESSION['login']['isLogged']==1)&&($_SESSION['login']['roleID']==2))){
        header('Location:./index.php');
        exit();
    }
    $uid=$_SESSION['login']['userID'];
    require_once('./scripts/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menadżer urlopów</title>
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
        require_once('./view/view_manager/navbar.php');
?>
<div class="container">
    <div class="mask d-flex align-items-center h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6" style="padding-top: 50px; width: 100%;">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Zarządzanie urlopami</h2>

                            <?php
                            $fetchVacation=$con->prepare('SELECT vacation.id as vacationid, vacation.start_date, vacation.end_date, vacation.created_at, user.id as user_id, concat(user.name," ",user.surname) as username, vacation.is_accepted, vacation.message FROM vacation JOIN user on vacation.user_id=user.id WHERE user.manager_id = :uid order by vacation.id asc');
                            $fetchVacation->bindParam('uid',$uid,PDO::PARAM_INT);
                            $fetchVacation->execute();
                            $vacations=$fetchVacation->fetchAll(PDO::FETCH_ASSOC);
                            $rowCount=$fetchVacation->rowCount();
                            echo '<table class="table table-bordered">';
                            echo '<tr> <th>Lp.</th> <th>Imie i nazwisko</th> <th>Data początku</th> <th>Data końca</th> <th>Data utworzenia</th> <th>Notatka</th> <th>Akceptacja</th></tr>';
                            for($i=0; $i<=($rowCount-1); $i++){
                                $lp=$i+1;
                                echo '<tr>';
                                echo '<td>'.$lp.'</td>';
                                echo '<td>'.$vacations[$i]['username'].'</td>';
                                echo '<td>'.$vacations[$i]['start_date'].'</td>';
                                echo '<td>'.$vacations[$i]['end_date'].'</td>';
                                echo '<td>'.$vacations[$i]['created_at'].'</td>';
                                echo '<td>'.$vacations[$i]['message'].'</td>';
                                //echo '<td>'.$vacations[$i]['is_accepted'].'</td>';
                                if($vacations[$i]['is_accepted']==1){
                                    echo '<td><a style="color:green;">Zaakceptowany</a></td>';
                                }else{
                                    echo '<td><a href="./scripts/vacationaccept.php?vacation_id='.$vacations[$i]['vacationid'].'">Zaakceptuj</a></td>';
                                }
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