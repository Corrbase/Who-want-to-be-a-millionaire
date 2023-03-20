<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/<?php echo $language; ?>/home" class="nav-link px-2 text-secondary">
                        <?php
                            echo text($header, $language, 'main_page');
                        ?>
                    </a></li>
                <li><a href="<?php echo '/' . $language ; ?>/game" class="nav-link px-2 text-white">
                        <?php
                        echo text($header, $language, 'play');
                        ?>
                    </a></li>
                <li>

                </li>
            </ul>



            <?php
            if (isset($_SESSION['admin_profile']['profile']) == 1){
                echo ' <div class="text-end">
                        <a href="/admin/home" class="btn btn-outline-light me-2">'. text($header, $language, 'admin_panel') .'</a>
                    </div>';
            }elseif (isset($_SESSION['user_profile']['profile']) == 1){
                echo ' 
                    <div class="text-end">
                   
                        <a href="" class="LogOut btn btn-outline-light me-2">'. text($header, $language, 'logout') .'</a>
                        <a href="/'. $language .'/profile" class="btn btn-outline-light me-2">'. text($header, $language, 'profile') .'</a>
                       
                    </div>
                    <script >
                        $(document).on("click", ".LogOut", function (e){
        $.ajax({
            type: "POST",
            url: "/r/user/logOut",
            beforeSend:
                function() {
                    $(".loading-refresh").addClass("loading-form");
                },
            success: function(data) {
                window.location.replace("/login");
            }
        })
    })
                    </script>
                    
                    ';
            }else{
                echo '<div class="text-end">
                        <a href="/'. $language .'/login" class="btn btn-outline-light me-2">'. text($header, $language, 'login') .'</a>
                        <a href="/'. $language .'/register" class="btn btn-warning">'. text($header, $language, 'registration') .'</a>
                    </div>' ;
            }
            ?>


        </div>
    </div>
</header>