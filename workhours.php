<?php
    session_start();
    require_once('./scripts/connect.php');
    if(!isset($_SESSION['login']['isLogged'])){
        header('Location:index.php');
        exit();
    }

    switch($_SESSION['login']['roleID']){
        case 1:{
            $role="view_admin";
            break;
        }
        case 2:{
            $role="view_manager";
            break;
        }
        case 3:{
            $role="view_user";
            break;
        }
        
    }

    $currentDate = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Godziny pracy - Zarządzanie przedsiębiorstwem</title>
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
    require_once("view/$role/navbar.php");
?>
<div class="container">
    <div class="mask d-flex align-items-center h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center h-100">
                <div class="col-5" style="padding-top: 50px;">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Dodaj obecność</h2>

                            <form method="post" action="./scripts/registerwork.php">

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline w-100">
                                            <input type="datetime-local" 
                                            class="form-control form-control-lg" 
                                            id="start_date" 
                                            name="start_date" 
                                            value="<?php echo $currentDate.'T07:00';?>" 
                                            min="<?php echo $currentDate.'T07:00';?>" 
                                            max="<?php echo $currentDate.'T07:00';?>"
                                            readonly/>
                                            <label for="start_date" class="form-label">Godzina rozpoczęcia</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline w-100">
                                            <input type="datetime-local" 
                                            class="form-control form-control-lg" 
                                            id="end_date" name="end_date" 
                                            value="<?php echo $currentDate.'T15:00';?>" 
                                            min="<?php echo $currentDate.'T15:00';?>" 
                                            max="<?php echo $currentDate.'T15:00';?>"
                                            readonly/>
                                            <label for="end_date" class="form-label">Godzina zakończenia</label>
                                        </div>

                                    </div>
                                </div>
                                <br/>

                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Dodaj obecność</button>
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
                <div class="col-7" style="padding-top: 50px;">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Zarejestrowane godziny pracy</h2>
                            <?php
                            $queryworkhours=$con->prepare('SELECT workhours.id, user.name, user.surname, workhours.start_time, workhours.end_time, workhours.created_at, workhours.is_accepted FROM workhours INNER JOIN user ON workhours.user_id = user.id WHERE user.id = :uid order by workhours.id asc');
                            $queryworkhours->bindParam(':uid',$_SESSION['login']['userID'],PDO::PARAM_INT);
                            $queryworkhours->execute();
                            $workhours=$queryworkhours->fetchAll(PDO::FETCH_ASSOC);
                            $rowCount=$queryworkhours->rowCount();
                            echo '<table class="table table-bordered">';
                            echo '<tr> <th>Imię</th> <th>Nazwisko</th> <th>Godzina początku</th> <th>Godzina końca</th> <th>Data</th> <th>Akceptacja</th></tr>';
                            for($i=($rowCount-1); $i>=0; $i--){
                                echo '<tr>';
                                echo '<td>'.$workhours[$i]['name'].'</td>';
                                echo '<td>'.$workhours[$i]['surname'].'</td>';
                                echo '<td>'.$workhours[$i]['start_time'].'</td>';
                                echo '<td>'.$workhours[$i]['end_time'].'</td>';
                                echo '<td>'.$workhours[$i]['created_at'].'</td>';
                                if($workhours[$i]['is_accepted']==1){
                                    echo '<td><a style="color:green;">Zaakceptowane</a></td>';
                                }else{
                                    echo '<td>W akceptacji</td>';
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
</html>