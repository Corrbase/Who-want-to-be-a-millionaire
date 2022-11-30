<header class="p-3 bg-dark text-white">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-secondary">Home</a></li>
                <li><a href="/game" class="nav-link px-2 text-white">PLay</a></li>
            </ul>



            <?php
            if (isset($_SESSION['admin_profile']['profile']) == 1){
                echo ' <div class="text-end">
                        <a href="/admin/home" class="btn btn-outline-light me-2">Admin panel</a>
                    </div>';
            }elseif (isset($_SESSION['user_profile']['profile']) == 1){
                echo ' <div class="text-end">
                        <a href="#" class="btn btn-outline-light me-2">Profile</a>
                    </div>';
            }else{
                echo '<div class="text-end">
                        <a href="/login" class="btn btn-outline-light me-2">Login</a>
                        <a href="/register" class="btn btn-warning">Sign-up</a>
                    </div>' ;
            }
            ?>


        </div>
    </div>
</header>