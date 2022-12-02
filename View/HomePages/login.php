

<!-- Tabs navs -->
<ul class="nav nav-tabs mb-3 m-auto text-center w-25" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">User</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Admin Panel</a>
    </li>
</ul>
<!-- Tabs navs -->

<!-- Tabs content -->
<div class="tab-content" id="ex1-content">
    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        <form id="UserLoginForm" class="w-25 m-auto pt-5 mt-5" method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <h1 class="pb-3">
                    User login
                </h1>
            </div>
            <div class="mb-3">
                <label  class="form-label">Login</label>
                    <input type="login" value="" name="user_login" class="form-control" id="login" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="user_password" class="form-control" id="exampleInputPassword1">
            </div>
            <button class="btn btn-primary">Login</button>
            <div class="mb-3">
                <div class="form-errors  form-label text-danger">

                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
        <form id="AdminLoginForm" class="w-25 m-auto pt-5 mt-5" method="POST" action="/r/admin/login" enctype="multipart/form-data">
            <div class="mb-3">
                <h1 class="pb-3">
                    Admin panel
                </h1>
            </div>
            <div class="mb-3">
                <label  class="form-label">Login</label>
                <input type="login" value="" name="admin_login" class="form-control"  aria-describedby="emailHelp">
                <div id="loginHelp" class="form-text">Admin panel username</div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="admin_password" class="form-control" >
            </div>
            <button class="btn btn-primary">Login</button>
            <div class="mb-3">
                <div class="form-errors  form-label text-danger">

                </div>
            </div>
        </form>
    </div>

</div>

<script>

    $("#AdminLoginForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: 'r/admin/login',
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
    $("#UserLoginForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: 'r/user/login',
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

