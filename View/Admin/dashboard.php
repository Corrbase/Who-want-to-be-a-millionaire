

    <main>
        <header class="py-10 mb-4 bg-gradient-primary-to-secondary">
            <div class="container-xl px-4">
                <div class="text-center">
                    <h1 class="text-white">Who want to be a millionaire</h1>
                    <p class="lead mb-0 text-white-50">Professionall admin panel</p>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4">
            <div class="row">
                <div class="row">
                    <div class="col col-md-6 mb-4">
                        <!-- Dashboard info widget 2-->
                        <div class="card border-start-lg border-start-secondary h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="small fw-bold text-secondary mb-1">Wins up 5 level</div>
                                        <div class="h5"><?php echo $view_array['UpToFive']; ?></div>
                                    </div>
                                    <div class="ms-2"><svg class="svg-inline--fa fa-tag fa-2x text-gray-200" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tag" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M48 32H197.5C214.5 32 230.7 38.74 242.7 50.75L418.7 226.7C443.7 251.7 443.7 292.3 418.7 317.3L285.3 450.7C260.3 475.7 219.7 475.7 194.7 450.7L18.75 274.7C6.743 262.7 0 246.5 0 229.5V80C0 53.49 21.49 32 48 32L48 32zM112 176C129.7 176 144 161.7 144 144C144 126.3 129.7 112 112 112C94.33 112 80 126.3 80 144C80 161.7 94.33 176 112 176z"></path></svg><!-- <i class="fas fa-tag fa-2x text-gray-200"></i> Font Awesome fontawesome.com --></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6 mb-4">
                        <!-- Dashboard info widget 3-->
                        <div class="card border-start-lg border-start-success h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <div class="small fw-bold text-success mb-1">All games</div>
                                        <div class="h5"><?php echo $view_array['AllGames']; ?></div>
                                    </div>
                                    <div class="ms-2"><svg class="svg-inline--fa fa-arrow-pointer fa-2x text-gray-200" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-pointer" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M318.4 304.5c-3.531 9.344-12.47 15.52-22.45 15.52h-105l45.15 94.82c9.496 19.94 1.031 43.8-18.91 53.31c-19.95 9.504-43.82 1.035-53.32-18.91L117.3 351.3l-75 88.25c-4.641 5.469-11.37 8.453-18.28 8.453c-2.781 0-5.578-.4844-8.281-1.469C6.281 443.1 0 434.1 0 423.1V56.02c0-9.438 5.531-18.03 14.12-21.91C22.75 30.26 32.83 31.77 39.87 37.99l271.1 240C319.4 284.6 321.1 295.1 318.4 304.5z"></path></svg><!-- <i class="fas fa-mouse-pointer fa-2x text-gray-200"></i> Font Awesome fontawesome.com --></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<!--        <div class="card mb-4 m-5">-->
<!--            <div class="card-header">-->
<!--                Top 5 players-->
<!--            </div>-->
<!--            <div class="card-body">-->
<!--                <table class="table table-hover">-->
<!---->
<!---->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <th>-->
<!--                            #-->
<!--                        </th>-->
<!--                        <th>-->
<!--                            name-->
<!--                        </th>-->
<!--                        <th>-->
<!--                            level-->
<!--                        </th>-->
<!--                        <th>-->
<!--                            prize-->
<!--                        </th>-->
<!--                        <th>-->
<!--                            status-->
<!--                        </th>-->
<!--                        <th>-->
<!--                            action-->
<!--                        </th>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    --><?php
//                    foreach ($view_array['top_gamers'] as $gamer){
//                        echo '<tr>';
//                            echo '<td>';
//                            echo $gamer['id'];
//                            echo '</td>';
//
//                            echo '<td>';
//                            echo $gamer['name'];
//                            echo '</td>';
//
//                            echo '<td>';
//                            echo $gamer['level'];
//                            echo '</td>';
//
//                            echo '<td>';
//                            echo $gamer['prize'];
//                            echo '</td>';
//
//                            echo '<td>';
//                            if ($gamer['status'] == 'Finished'){
//                                echo 'Ավարտած';
//                            }elseif ($gamer['status'] == 'Waiting'){
//                                echo 'Ընթացքի մեջ';
//                            }else{
//                                echo 'չեղարկված';
//                            }
//                            echo '</td>';
//
//                            echo '<td>';
//                            echo '<a href="/r/admin/delete/user/' . $gamer['id'] . '"' .'>Ջնջել</a>';
//                            echo '</td>';
//                        echo '</tr>';
//                    }
//                    ?>
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->

        <div class="row m-4">
            <div class="col mb-4">
                <!-- Dashboard example card 2-->
                <a class="card lift h-100" href="/admin/documentation">
                    <div class="card-body d-flex justify-content-center flex-column">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book feather-xl text-secondary mb-3"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                <h5>Documentation</h5>
                                <div class="text-muted small">Documentation of game</div>
                            </div>
                            <img src="/assets/img/illustrations/processing.svg" alt="..." style="width: 8rem">
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </main>

