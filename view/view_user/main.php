<div class="container">
    <div class="mask d-flex align-items-center h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-5" style="padding-top: 50px;">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Wyślij wniosek o urlop</h2>

                            <form method="post" action="./scripts/addvacation.php">

                                <div class="row">
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="date" class="form-control form-control-lg" id="start_date" name="start_date"/>
                                            <label for="start_date" class="form-label">Urlop od</label>
                                        </div>

                                    </div>
                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                        <div class="form-outline datepicker w-100">
                                            <input type="date" class="form-control form-control-lg" id="end_date" name="end_date"/>
                                            <label for="end_date" class="form-label">Urlop do</label>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-8">

                                        <div class="form-outline">
                                            <textarea class="form-control form-control-lg" name="message"></textarea>
                                            <label class="form-label" for="lastNameName">Notatka (opcjonalnie)</label>
                                        </div>

                                    </div>
                                </div>

                                <br/>

                                <div class="d-flex justify-content-center">
                                    <button type="submit"
                                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Wyślij wniosek</button>
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
                            <h2 class="text-uppercase text-center mb-5">Bieżące wnioski o urlop</h2>

                            <?php
                            $queryVacation=$con->prepare('select vacation.start_date, vacation.end_date, vacation.created_at, vacation.is_accepted, concat(user.name," ",user.surname) as acceptedby from vacation left join user on user.id=vacation.accepted_by  where vacation.user_id=:userid');
                            $queryVacation->bindParam('userid',$_SESSION['login']['userID'],PDO::PARAM_INT);
                            $queryVacation->execute();
                            $vacation=$queryVacation->fetchAll(PDO::FETCH_ASSOC);
                            $rowCount=$queryVacation->rowCount();
                            echo '<table class="table table-bordered">';
                            echo '<tr> <th>Data początku</th> <th>Data końca</th> <th>Data utworzenia</th> <th>Akceptacja</th></tr>';
                            for($i=0; $i<=($rowCount-1); $i++){ // ($rowCount-1) bo indeksy zaczynaja sie od 0, a rowcount liczy ilosc rekordow
                                echo '<tr>';
                                echo '<td>'.$vacation[$i]['start_date'].'</td>';
                                echo '<td>'.$vacation[$i]['end_date'].'</td>';
                                echo '<td>'.$vacation[$i]['created_at'].'</td>';
                                //echo '<td>'.$vacations[$i]['is_accepted'].'</td>';
                                if($vacation[$i]['is_accepted']==1){
                                    echo '<td><a style="color:green;">Zaakceptowany przez '.$vacation[$i]['acceptedby'].'</a></td>';
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