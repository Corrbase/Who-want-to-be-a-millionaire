


<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            <?php $front = $view_array['front'];echo text($front, $language, 'title'); ?>
                        </h1>
                        <div class="page-header-subtitle"><?php echo text($front, $language, 'title_info'); ?></div>
                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/users">Users</a></li>
                        <li class="breadcrumb-item active">edit_user</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>
    <?php
    $user = $view_array['user'][0];
    if ($user['Role'] == 'User'){
        $dis1 = 'selected';
        $dis2 = '';
    }elseif ($user['Role'] == 'Admin'){
        $dis2 = 'selected';
        $dis1 = '';
    }
    ?>
    <div class="container-xl px-4 mt-n10">
        <div class="card mb-4">
            <div class="card-header"><?php echo text($front, $language, 'user_info'); ?> <span class="text-muted"><?php echo $user['login']; ?></span></div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" id="edit_user">


                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1 f-1" for="Right_answer"><?php echo text($front, $language, 'select_name'); ?> <span class="text-danger"><?php echo text($front, $language, 'min3sym'); ?></span></label>
                            <input class="form-control" id="Name" type="text" placeholder="<?php echo text($front, $language, 'select_name'); ?>" value="<?php echo $user['name']; ?>" name="name">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="sname"><?php echo text($front, $language, 'select_sname'); ?> <span class="text-danger"><?php echo text($front, $language, 'min3sym'); ?></span></label>
                            <input class="form-control" id="sname" type="text" placeholder="<?php echo text($front, $language, 'select_sname'); ?>" name="sname" value="<?php echo $user['sname']; ?>">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1  text-success" for="balance "><?php echo text($front, $language, 'select_balance'); ?> <span class="text-muted"></span></label>
                            <input class="form-control" id="balance" type="number" min="0" placeholder="<?php echo text($front, $language, 'select_balance'); ?>" name="balance" value="<?php echo $user['balance']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="Wrong3"><?php echo text($front, $language, 'select_age'); ?> <span class="text-danger"><?php echo text($front, $language, 'min18year'); ?></span></label>
                            <input class="form-control" id="age" type="number" min="18" max="99" placeholder="Age" name="age" value="<?php echo $user['age']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1">Role</label>
                        <select name="Role" class="form-select" aria-label="Default select example">
                            <option selected="" disabled=""><?php echo text($front, $language, 'select_role_btn'); ?></option>

                            <option name="Admin" value="Admin" <?php echo $dis2 ?>><?php echo text($front, $language, 'select_role_user'); ?></option>
                            <option name="User" value="User" <?php echo $dis1 ?>><?php echo text($front, $language, 'select_role_admin'); ?></option>
                        </select>
                    </div>
                    <!-- Submit button-->
                    <button class="btn btn-primary" type="submit"><?php echo text($front, $language, 'title'); ?></button>
                    <div class="text-danger form-errors m-2">
                    </div>
                    <div class="text-green form-accept m-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
        <!-- Button trigger modal -->
</main>


<script>
    $("#edit_user").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: '/r/admin/user/edit/<?php echo $user['id']?>',
            data: form.serialize(),
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {
                let request_data = JSON.parse(data)
                $('.loading-refresh').removeClass('loading-form');

                if (request_data.success === 'error1'){
                    $('.form-errors').text("<?php echo text($front, $language, 'error1'); ?>");
                    $('.form-accept').text('');
                }else if(request_data.success === 'error2') {
                    $('.form-errors').text("<?php echo text($front, $language, 'error2'); ?>");
                    $('.form-accept').text('');
                }else if(request_data.success === 'error3') {
                    $('.form-errors').text("<?php echo text($front, $language, 'error3'); ?>");
                    $('.form-accept').text('');
                }else if(request_data.success === 'error4') {
                    $('.form-errors').text("<?php echo text($front, $language, 'error4'); ?>");
                    $('.form-accept').text('');
                }else if(request_data.success === true) {
                    $('.form-errors').text('');
                    $('.form-accept').text('<?php echo text($front, $language, 'save_changes'); ?>');
                }
            }
        })

    })
</script>