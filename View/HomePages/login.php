<?php
$front = $view_array['front'];
?>
    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
        <form id="UserLoginForm" class="w-25 m-auto pt-5 mt-5" method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <h1 class="pb-3">
                    <?php
                    echo text($front, $language, 'login_title');
                    ?>
                </h1>
            </div>
            <div class="mb-3">
                <label  class="form-label">
                    <?php
                    echo text($front, $language, 'input_login');
                    ?>
                </label>
                    <input type="login" value="" name="user_login" class="form-control" id="login" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label class="form-label">
                    <?php
                    echo text($front, $language, 'input_password');
                    ?>
                </label>
                <input type="password" name="user_password" class="form-control" id="exampleInputPassword1">
            </div>
            <button class="btn btn-primary">
                <?php
                echo text($front, $language, 'login_button');
                ?>
            </button>
            <div class="mb-3">
                <div class="form-errors  form-label text-danger">

                </div>
            </div>
        </form>
    </div>

<script>

    $("#UserLoginForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: '/r/user/login',
            data: form.serialize(),
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {

                let request_data = JSON.parse(data)
                if (request_data.success === true){

                    window.location.replace("/<?php echo $language;?>/admin/home");
                }else{
                    $('.loading-refresh').removeClass('loading-form');
                    console.log(request_data.error)
                    $('.form-errors').html(request_data.error);

                }
            }
        })

    })
</script>
<!-- Tabs content -->

