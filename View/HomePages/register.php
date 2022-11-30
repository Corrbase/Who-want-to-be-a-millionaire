



        <form id="UserLoginForm" class="w-25 m-auto pt-5 mt-5" method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <h1 class="pb-3">
                    Register new user
                </h1>
            </div>
            <div class="mb-3">
                <label  class="form-label">Login</label>
                <input type="login" value="" name="login" class="form-control" id="login" aria-describedby="emailHelp">
                <div id="loginHelp" class="form-text">login</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label class="form-label">Repeat password</label>
                <input type="password" name="repeat_password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="password" name="name" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label class="form-label">Sname</label>
                <input type="password" name="name" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label class="form-label">Age</label>
                <input type="number" min="18" max="100" name="age" class="form-control" id="exampleInputPassword1">
            </div>

            <button class="btn btn-primary">Register</button>

            <div class="mb-3">
                <div class="form-errors  form-label text-danger">

                </div>
            </div>
        </form>
    </div>

<script>

    $("#AdminRegisterForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: 'r/user/register',
            data: form.serialize(),
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {
                let request_data = JSON.parse(data)
                $('.loading-refresh').removeClass('loading-form');
                $('.form-error').html(request_data.error);
                if (request_data.success === true){
                    window.location.replace("/admin/home");
                }

            }
        })

    })
</script>
<!-- Tabs content -->

