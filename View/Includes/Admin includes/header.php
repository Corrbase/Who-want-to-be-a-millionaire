
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">

                <div class="nav accordion" id="accordionSidenav">

                    <div class="sidenav-menu-heading">
                        <?php

                        echo text($header, $language, 'menu_title');
                        ?>
                    </div>
                        <!-- Sidenav Accordion (Dashboard)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">

                            <div class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg></div>
                            <?php
                            echo text($header, $language, 'menu_game_chapter');
                            ?>
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseDashboards" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="/admin/gamers">
                                    <?php
                                    echo text($header, $language, 'menu_game_chapter_games');
                                    ?>
                                </a>
    <!--                            <a class="nav-link" href="dashboard-2.html">Admins</a>-->
                                <a class="nav-link" href="/admin/questions">
                                    <?php
                                    echo text($header, $language, 'menu_game_chapter_questions');
                                    ?>
                                </a>
                            </nav>
                        </div>

                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse" data-bs-target="#collapseAdmin" aria-expanded="false" aria-controls="collapseAdmin">

                            <div class="nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                            </div>
                            <?php
                            echo text($header, $language, 'menu_admint_chapter');
                            ?>
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseAdmin" data-bs-parent="#accordionSidenav">
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="/admin/documentation">
                                    <?php

                                    echo text($header, $language, 'menu_admint_chapter_documentation');
                                    ?>
                                </a>
                            </nav>
                            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                                <a class="nav-link" href="/admin/users">
                                    <?php
                                    echo text($header, $language, 'menu_admint_chapter_users');
                                    ?>
                                </a>
                            </nav>
                        </div>

                    </div>

            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-title"><?php echo text($header, $language, 'menu_admint_chapter_admin_name');echo ' ' . $_SESSION['admin_profile']['login'] ?></div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">