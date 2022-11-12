<form id="idForm" class="w-25 m-auto pt-5 mt-5" method="POST" action="/r/admin/login" enctype="multipart/form-data">
    <div class="mb-3">
        <label  class="form-label">Login</label>
        <input type="login" value="<?php if (isset($_SESSION['login_values'])) echo $_SESSION['login_values']; ?>" name="login" class="form-control" id="login" aria-describedby="emailHelp">
        <div id="loginHelp" class="form-text">Admin panel username</div>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button class="btn btn-primary">Login</button>
    <div class="mb-3">
        <label for="" class="form-label text-danger">
            <?php

                if (isset($_SESSION['login_error']))
                {
                    echo $_SESSION['login_error'];
                }
            ?>
        </label>
    </div>
</form>

