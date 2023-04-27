
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

                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header"><?php echo text($front, $language, 'users_title'); ?></div>
            <div class="card-body"><?php echo text($front, $language, 'users_info'); ?></div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <?php echo text($front, $language, 'title'); ?>
            </div>
            <div>
            </div>
            <div class="card-body table-body">
                <div class="d-flex justify-content-between">
                    <select name="active" class="m-1 w-25  form-select 2 select-role" aria-label="Default select example">
                        <option selected="" disabled="">Select a role:</option>

                        <option name="User" data-id="all" selected><?php echo text($front, $language, 'table_select_all'); ?></option>
                        <option name="User" data-id="User" ><?php echo text($front, $language, 'table_select_user'); ?></option>
                        <option name="Admin" data-id="Admin"><?php echo text($front, $language, 'table_select_admin'); ?></option>
                    </select>
                    <a href="/admin/users/add" class="font-weight-bold btn  btn-outline-success m-1">+</a>
                </div>
                <div class="users">

                </div>
            </div>
        </div>
    </div>
</main>



<script>
    $(document).on('change', '.select-role', function (e){
        var b = $(this).find(':selected').attr('data-id');
        console.log(b)
        $.ajax({
            url: "/<?php echo $language; ?>/admin/users/1",
            type: "GET",
            data: {
                role: b
            },
            beforeSend:
                function() {
                    $('.users').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {


                if (response) {
                    $('.users').html(response);
                }

            },
        });
    })
    $(document).on('click', '#ClickToPage', function (e){
        var b = $('.select-role').find(':selected').attr('data-id');
        let a = $(this).attr("data-id");
        $.ajax({
            url: "/<?php echo $language; ?>/admin/users/" + a,
            type: "GET",
            data: {
                role: b
            },
            beforeSend:
                function() {
                    $('.users').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {


                if (response) {
                    $('.users').html(response);
                }

            },
        });
    })
    $.ajax({


        url: "/<?php echo $language; ?>/admin/users/1",
        type: "GET",
        data: {
            role: 'all'
        },
        beforeSend:
            function() {
                $('.users').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
            },
        success: function (response) {
            if (response) {
                $('.users').html(response);
            }
        },
        error: function (error) {
        }
    });

</script>