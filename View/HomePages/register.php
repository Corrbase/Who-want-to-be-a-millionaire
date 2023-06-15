<?php

?>
        <form id="UserRegisterForm" class="w-25 m-auto pt-5 mt-5" method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <h1 class="pb-3">
                    <?php
                    echo text($front, $language, 'registration_title');
                    ?>
                </h1>
            </div>
            <div class="mb-3">
                <label  class="form-check-label">
                    <?php
                    echo text($front, $language, 'input_login');
                    ?>
                </label>
                <input type="login" value="" name="login" class="form-control" id="login" aria-describedby="emailHelp">
                <div id="loginHelp" class="form-text"><?php
                    echo text($front, $language, 'input_danger_minimum');
                    ?>։ 4</div>
            </div>
            <div class="mb-3">
                <label class="form-check-label">
                    <?php
                    echo text($front, $language, 'input_password');
                    ?>
                </label>
                <input type="password" name="password" class="form-control" >
                <div id="loginHelp" class="form-text"><?php
                    echo text($front, $language, 'input_danger_minimum');
                    ?>։ 4</div>
            </div>
            <div class="mb-3">
                <label class="form-check-label">
                    <?php
                    echo text($front, $language, 'input-rep-pass');
                    ?>
                </label>
                <input type="password" name="password_confirm" class="form-control" >
            </div>
            <div class="mb-3">
                <label class="form-check-label">
                    <?php
                    echo text($front, $language, 'input_name');
                    ?>
                </label>
                <input type="text" name="name" class="form-control" >
                <div id="loginHelp" class="form-text"><?php
                    echo text($front, $language, 'input_danger_minimum');
                    ?>: 3</div>
            </div>
            <div class="mb-3">
                <label class="form-check-label">
                    <?php
                    echo text($front, $language, 'input_sname');
                    ?>
                </label>
                <input type="text" name="sname" class="form-control" >
                <div id="loginHelp" class="form-text"><?php
                    echo text($front, $language, 'input_danger_minimum');
                    ?>։ 3</div>
            </div>
            <div class="mb-3">
                <label class="form-check-label">
                    <?php
                    echo text($front, $language, 'input_age');
                    ?>
                </label>
                <input type="number" min="18" max="100" name="age" class="form-control" >
                <div id="loginHelp" class="form-text">
                    <?php
                    echo text($front, $language, 'input_danger_minimum');
                    ?>
                    18
                </div>
            </div>

            <button class="btn btn-primary">
                <?php
                echo text($front, $language, 'input_button_register');
                ?>
            </button>

            <div class="mb-3">
                <div class="text-danger form-errors m-2">
                </div>
            </div>
        </form>

<script>

    $("#UserRegisterForm").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: '/r/user/register',
            data: form.serialize(),
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {
                let request_data = JSON.parse(data)

                if (request_data.success === true){
                    window.location.replace("/<?= $language; ?>/profile");
                }else {
                    $('.loading-refresh').removeClass('loading-form');
                    var err = Object.keys(request_data)


                    switch (err[0]) {
                        case 'error1':
                            $('.form-errors').html('<?= text($front, $language, 'error1');?>');
                            break
                        case 'error2':
                            $('.form-errors').html('<?= text($front, $language, 'error2');?>');
                            break
                        case 'error3':
                            $('.form-errors').html('<?= text($front, $language, 'error3');?>');
                            break
                        case 'error4':
                            $('.form-errors').html('<?= text($front, $language, 'error4');?>');
                            break
                        case 'error5':
                            $('.form-errors').html('<?= text($front, $language, 'error5');?>');
                            break
                        case 'error6':
                            $('.form-errors').html('<?= text($front, $language, 'error6');?>');
                            break
                        case 'error7':
                            $('.form-errors').html('<?= text($front, $language, 'error6');?>');
                            break
                    }
                }


            }
        })

    })
</script>
<!-- Tabs content -->

