<div class="container">
    <div class="mask d-flex align-items-center h-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6" style="padding-top: 50px; width: 100%;">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Wszystkie urlopy</h2>

                            <?php // fetchuje ta sama tabele dwa razy zeby przyrownac i wyciagnac zjoinowane dane dla managera danej osoby
                            $queryVacation=$con->prepare('SELECT vacation.id, user.login, user.name, user.surname, vacation.start_date, vacation.end_date, vacation.created_at, vacation.is_accepted, concat(a.name," ",a.surname," (",a.login,")") as acceptedby FROM vacation INNER JOIN user ON vacation.user_id = user.id LEFT JOIN user a on a.id=vacation.accepted_by order by vacation.id asc');
                            $queryVacation->execute();
                            $vacation=$queryVacation->fetchAll(PDO::FETCH_ASSOC);
                            $rowCount=$queryVacation->rowCount();
                            echo '<table class="table table-bordered">';
                            echo '<tr> <th>ID</th> <th>Użytkownik</th> <th>Imię</th> <th>Nazwisko</th> <th>Data początku</th> <th>Data końca</th> <th>Data utworzenia</th> <th>Akceptacja</th></tr>';
                            for($i=0; $i<=($rowCount-1); $i++){
                                echo '<tr>';
                                echo '<td>'.$vacation[$i]['id'].'</td>';
                                echo '<td>'.$vacation[$i]['login'].'</td>';
                                echo '<td>'.$vacation[$i]['name'].'</td>';
                                echo '<td>'.$vacation[$i]['surname'].'</td>';
                                echo '<td>'.$vacation[$i]['start_date'].'</td>';
                                echo '<td>'.$vacation[$i]['end_date'].'</td>';
                                echo '<td>'.$vacation[$i]['created_at'].'</td>';
                                //echo '<td>'.$vacations[$i]['is_accepted'].'</td>';
                                if($vacation[$i]['is_accepted']==1){
                                    echo '<td><a style="color:green;">Zaakceptowany przez '.$vacation[$i]['acceptedby'].'</a></td>';
                                }else{
                                    echo '<td><a href="./scripts/vacationaccept.php?vacation_id='.$vacation[$i]['id'].'">Zaakceptuj</a></td>';
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