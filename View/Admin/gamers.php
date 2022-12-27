
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            Gamers
                        </h1>
                        
                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Games</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">All gamers is here</div>
            <div class="card-body">You can edit the gamer and change status of gamer or delete gamer</div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                All gamers
            </div>
            <div>
            </div>
            <div class="card-body table-body">

            </div>
        </div>
    </div>
</main>



<script>
    $(document).on('click', '#ClickToPage', function (e){
        let a = $(this).attr("data-id");
        $.ajax({
            url: "/admin/gamers/" + a,
            type: "GET",
            data: {

            },
            beforeSend:
                function() {
                    $('.table-body').html('<table class="table table-hover"> <button type="button" class="btn btn-outline-success m-1"><</button> <button type="button" class="m-1 btn btn-outline-success">></button> <p>Page:</p> <thead> <tr> <th># </th> <th> name </th> <th>level</th> <th>prize</th> <th>status</th> <th>action</th></tr> </thead> <tbody></tbody> </table> <div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {


                if (response) {
                    $('.table-body').html(response);
                }

            },
        });
    })
    $(document).on('change', ".status-change" ,function(e){
        let a = $(this).find(':selected').attr('data-id');
        let b = this.value;
        $.ajax({
            url: "/r/admin/gamer/change_status/" + a,
            type: "POST",
            data: {
                value: b
            },
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function (response) {
                $('.loading-refresh').removeClass('loading-form');
            },
            error: function (error) {

            }
        });

    });
    $(document).on('click', ".Delete_user" ,function(e){
        let a = $(this).attr('data-id');

        $.ajax({
            url: "/r/admin/delete/user/" + a,
            type: "POST",
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function (response) {

                $.ajax({
                    url: "/admin/gamers/1",
                    type: "GET",
                    data: {

                    },
                    beforeSend:
                        function() {
                            },
                    success: function (response) {

                        if (response) {
                            $('.table-body').html(response);
                        }
                        $('.loading-refresh').removeClass('loading-form');
                    },
                    error: function (error) {

                    }
                });
            },
            error: function (error) {

            }
        });

    });
    $.ajax({
            url: "/admin/gamers/1",
            type: "GET",
            data: {

            },
            beforeSend:
                function() {
                    $('.table-body').html('<table class="table table-hover"> <button type="button" class="btn btn-outline-success m-1"><</button> <button type="button" class="btn btn-outline-success m-1">></button><p>Page:</p><thead> <tr> <th># </th> <th> name </th> <th>level</th> <th>prize</th> <th>status</th> <th>action</th></tr> </thead> <tbody></tbody> </table> <div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {

                if (response) {
                    $('.table-body').html(response);
                }
            },
        });



</script>