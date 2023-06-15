
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            <?= text($front, $language, 'title'); ?>
                        </h1>

                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="<?= '/' . $language ; ?>/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= '/' . $language ; ?>/admin/users">Users</a></li>
                        <li class="breadcrumb-item active">Add</li>

                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header"><?= text($front, $language, 'add_title'); ?></div>
            <div class="card-body"><?= text($front, $language, 'add_info'); ?></div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <?= text($front, $language, 'title'); ?>
            </div>
            <div>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" id="create_user">



                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1 f-1" for="Right_answer"><?= text($front, $language, 'select_name'); ?> <span class="text-danger"><?= text($front, $language, 'min3sym'); ?></span></label>
                            <input class="form-control" id="Name" type="text" placeholder="<?= text($front, $language, 'select_name'); ?>" name="name">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="sname"><?= text($front, $language, 'select_sname'); ?> <span class="text-danger"><?= text($front, $language, 'min3sym'); ?></span></label>
                            <input class="form-control" id="sname" type="text" placeholder="<?= text($front, $language, 'select_sname'); ?> " name="sname">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1  text-success" for="balance "><?= text($front, $language, 'select_balance'); ?> <span class="text-muted"><?= text($front, $language, 'auto'); ?></span></label>
                            <input class="form-control" id="balance" type="number" min="0" placeholder="<?= text($front, $language, 'select_balance'); ?>" value="0" name="balance">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="Wrong3"><?= text($front, $language, 'select_age'); ?> <span class="text-danger"><?= text($front, $language, 'min18year'); ?></span></label>
                            <input class="form-control" id="age" type="number" min="18" max="99" placeholder="<?= text($front, $language, 'select_age'); ?>" name="age">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="login"><?= text($front, $language, 'select_login'); ?> <span class="text-danger"><?= text($front, $language, 'min4sym'); ?></span></label>

                        <input class="form-control" id="login" type="login" placeholder="<?= text($front, $language, 'select_login'); ?>" name="login">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="password"><?= text($front, $language, 'select_pass'); ?> <span class="text-danger"><?= text($front, $language, 'min4sym'); ?></span></label>

                        <input class="form-control" id="Password" type="password" placeholder="<?= text($front, $language, 'select_pass'); ?>" name="password">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1"><?= text($front, $language, 'select_role_text'); ?></label>
                        <select name="role" class="form-select" aria-label="Default select example">
                            <option selected="" disabled=""><?= text($front, $language, 'select_role_btn'); ?></option>

                            <option name="Admin" value="Admin" ><?= text($front, $language, 'select_role_admin'); ?></option>
                            <option name="User" value="User" selected><?= text($front, $language, 'select_role_user'); ?></option>
                        </select>
                    </div>
                    <!-- Submit button-->
                    <button class="btn btn-primary" type="submit"><?= text($front, $language, 'select_btn'); ?></button>
                    <div class="text-danger form-errors m-2">
                    </div>
                    <div class="text-green form-accept m-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<div class="loading-refresh" style="z-index: 2000"></div>

<script>
    $("#create_user").submit(function(e) {

        e.preventDefault();
        var form = $(this);

        $.ajax({
            type: "POST",
            url: '/r/admin/users/add',
            data: form.serialize(),
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {
                let request_data = JSON.parse(data)
                $('.loading-refresh').removeClass('loading-form');
                    var err = Object.keys(request_data)


                    switch (err[0]) {
                        case 'error1':
                            $('.form-accept').empty();
                            $('.form-errors').html('<?= text($front, $language, 'error1');?>');
                            break
                        case 'error2':
                            $('.form-accept').empty();
                            $('.form-errors').html('<?= text($front, $language, 'error2');?>');
                            break
                        case 'error3':
                            $('.form-accept').empty();
                            $('.form-errors').html('<?= text($front, $language, 'error3');?>');
                            break
                        case 'error4':
                            $('.form-accept').empty();
                            $('.form-errors').html('<?= text($front, $language, 'error4');?>');
                            break
                        case 'error5':
                            $('.form-accept').empty();
                            $('.form-errors').html('<?= text($front, $language, 'error5');?>');
                            break
                        case 'error6':
                            $('.form-accept').empty();
                            $('.form-errors').html('<?= text($front, $language, 'error6');?>');
                            break
                        case 'error7':
                            $('.form-accept').empty();
                            $('.form-errors').html('<?= text($front, $language, 'error7');?>');
                            break
                    }

                if (request_data.success === true){
                    $('.form-accept').html('<?= text($front, $language, ''); ?>');
                    $('.form-errors').empty();
                }else{
                    $('.form-accept').empty();
                    $('.form-errors').html('<?= text($front, $language, 'exist_user');    ?>');
                }
            }
        });
    })


</script>