
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            All users
                        </h1>

                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/home">Users</a></li>
                        <li class="breadcrumb-item active">Add</li>

                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">All questions is here</div>
            <div class="card-body">Here you can add new users or edit that</div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                users
            </div>
            <div>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" id="create_user">


                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1 f-1" for="Right_answer">Name <span class="text-danger">( Min: 3 sybhols )</span></label>
                            <input class="form-control" id="Name" type="text" placeholder="name" name="right_answer">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="sname">Sname <span class="text-danger">( Min: 3 sybhols )</span></label>
                            <input class="form-control" id="sname" type="text" placeholder="sname" name="sname">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1  text-success" for="balance ">Balance <span class="text-muted">( Automatically it's 0, you can skip this input )</span></label>
                            <input class="form-control" id="balance" type="number" min="0" placeholder="balance" value="0" name="balance">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="Wrong3">Age <span class="text-danger">( Min: 18 year )</span></label>
                            <input class="form-control" id="age" type="number" min="18" max="99" placeholder="Age" name="age">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="login">Login <span class="text-danger">( Min: 4 sybhols )</span></label>

                        <input class="form-control" id="login" type="login" placeholder="login" name="login">
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1" for="password">Password <span class="text-danger">( Min: 4 sybhols )</span></label>

                        <input class="form-control" id="Password" type="password" placeholder="Password" name="password">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1">Role</label>
                        <select name="Active" class="form-select" aria-label="Default select example">
                            <option selected="" disabled="">Select a role:</option>

                            <option name="Admin" value="Admin" >Admin</option>
                            <option name="User" value="User" selected>User</option>
                        </select>
                    </div>
                    <!-- Submit button-->
                    <button class="btn btn-primary" type="submit">Save changes</button>
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
                $('.loading-refresh').removeClass('loading-form');

                if ($.trim(data)){
                    $('.form-errors').text('please fill all');
                    $('.form-accept').text('');
                }else {
                    $('.form-errors').text('');
                    $('.form-accept').text('You crate a question.');
                }
            }
        });
    })


</script>