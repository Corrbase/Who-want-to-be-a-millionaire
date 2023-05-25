
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
                        <li class="breadcrumb-item"><a href="<?php echo '/' . $language ; ?>/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Games</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">
                <?php
                
                echo text($front, $language, 'all_games');
                ?>
            </div>
            <div class="card-body">
                <?php
                echo text($front, $language, 'game_info');
                ?>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <?php
                        echo text($front, $language, 'title');
                        ?>
            </div>

            <div class="card-body ">



                <div class="d-flex align-items-center">


                    <a href="javascript:void(0)" type="button" id="ClickToPage" data-id="" class="btn PreviousPage btn-outline-success m-1 ">&lt;</a>
                    <a href="javascript:void(0)" id="ClickToPage" data-id="" class="btn NextPage btn-outline-success m-1 ">&gt;</a>
                </div><div class="d-flex">


                    <p class="mt-3"><?php
                        echo text($front, $language, 'table_page');
                        ?> <span class="page">0</span></p>
                    <p class="mt-3 m-3"><?php
                        echo text($front, $language, 'table_count');
                        ?> <span class="all_count">0</span></p>
                </div>
                <table class="table table-hover">


                    <thead>
                    <tr>
                        <th>
                            #id
                        </th>
                        <th>
                            <?php
                            echo text($front, $language, 'table_login');
                            ?>
                        </th>
                        <th>
                            <?php
                            echo text($front, $language, 'table_lvl');
                            ?>
                        </th>
                        <th>
                            <?php
                            echo text($front, $language, 'table_prize');
                            ?>
                        </th>
                        <th>
                            <?php
                            echo text($front, $language, 'table_status');
                            ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="table-body">

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</main>


<script>
    $(document).on('click', '#ClickToPage', function (e){
        let a = $(this).attr("data-id");
        $.ajax({
            url: "/<?php echo $language; ?>/admin/gamers/" + a,
            type: "GET",
            data: {

            },
            beforeSend:
                function() {
                },
            success: function (response) {
                let request_data = JSON.parse(response)
                if (response) {
                    change_default()
                    console.log(request_data)
                    let data = request_data['gamers']
                    let btnPrevious = request_data['btnPrevious']
                    let btnNext = request_data['btnNext'];
                    let Prev = request_data['PreviousPage'];
                    let Next = request_data['NextPage'];
                    let page = request_data['pagination'];
                    let Allcount = request_data['AllUsersCount'];

                    arr = {
                        'select1': btnPrevious,
                        'select2': btnNext,
                        'Prev': Prev,
                        'Next': Next,
                        'page': page,
                        'Allcount': Allcount,
                    }


                    let html = ''

                    data.forEach(function(gamer) {
                        html += '<tr>'
                        html += '<td>' + gamer['id'] + '</td>'
                        html += '<td>' + gamer['name'] + '</td>'
                        html += '<td>' + gamer['level'] + '</td>'
                        html += '<td>' + gamer['prize'] + '</td>'
                        html += '<td>'



                        html += ' <select class="status-change form-select form-select-sm"> <option selected="" disabled="">Select a status:</option>'
                        html += '<option name="Waiting" data-id="' + gamer['id'] + '" value="waiting" selected=""'
                        console.log(gamer['status'])
                        if (gamer['status'] == 'waiting' ){
                            html += 'selected'
                        }
                        html += '><?php echo text($front, $language, 'table_status_in_process'); ?></option> <option name="Canceled" data-id="' + gamer['id'] + '" value="Canceled" '
                        if (gamer['status'] == 'Canceled' ){
                            html += 'selected'
                        }
                        html += '><?php echo text($front, $language, 'table_status_canceled'); ?></option> <option name="Finished" data-id="' + gamer['id'] + '" value="Finished"'
                        if (gamer['status'] == 'Finished' ){
                            html += 'selected'
                        }
                        html += '><?php echo text($front, $language, 'table_status_finished'); ?></option> </select>'
                        html += '</td>'

                        html += '<td>'
                        html += '<a class="Delete_user" data-id ="' + gamer['id'] + '" href="javascript:void(0)">' + '<?php echo text($front, $language, 'table_delete'); ?>' + '</a>'
                        html += '</td>'

                        html += '</tr>'
                    });
                    change(arr, html)
                    $('.table-body').html(html);

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
                    url: "<?php echo '/' . $language ; ?>/admin/gamers/1",
                    type: "GET",
                    data: {

                    },
                    beforeSend:
                        function() {
                            },
                    success: function (response) {
                        $('.loading-refresh').removeClass('loading-form');
                        let request_data = JSON.parse(response)
                        if (response) {
                            change_default()
                            let data = request_data['gamers']
                            let btnPrevious = request_data['btnPrevious']
                            let btnNext = request_data['btnNext'];
                            let Prev = request_data['PreviousPage'];
                            let Next = request_data['NextPage'];
                            let page = request_data['pagination'];
                            let Allcount = request_data['AllUsersCount'];

                            arr = {
                                'select1': btnPrevious,
                                'select2': btnNext,
                                'Prev': Prev,
                                'Next': Next,
                                'page': page,
                                'Allcount': Allcount,
                            }


                            let html = ''

                            data.forEach(function(gamer) {
                                html += '<tr>'
                                html += '<td>' + gamer['id'] + '</td>'
                                html += '<td>' + gamer['name'] + '</td>'
                                html += '<td>' + gamer['level'] + '</td>'
                                html += '<td>' + gamer['prize'] + '</td>'
                                html += '<td>'



                                html += ' <select class="status-change form-select form-select-sm"> <option selected="" disabled="">Select a status:</option>'
                                html += '<option name="Waiting" data-id="' + gamer['id'] + '" value="waiting" selected=""'
                                console.log(gamer['status'])
                                if (gamer['status'] = 'waiting' ){
                                    html += 'selected'
                                }
                                html += '>In process</option> <option name="Canceled" data-id="' + gamer['id'] + '" value="Canceled" '
                                if (gamer['status'] = 'Canceled' ){
                                    html += 'selected'
                                }
                                html += '>Canceled</option> <option name="Finished" data-id="' + gamer['id'] + '" value="Finished"'
                                if (gamer['status'] = 'Finished' ){
                                    html += 'selected'
                                }
                                html += '>Finished</option> </select>'
                                html += '</td>'

                                html += '<td>'
                                html += '<a class="Delete_user" data-id ="' + gamer['id'] + '" href="javascript:void(0)">' + '<?php echo text($front, $language, 'table_delete'); ?>' + '</a>'
                                html += '</td>'

                                html += '</tr>'
                            });
                            change(arr, html)
                            $('.table-body').html(html);

                        }
                    },
                });
            },
        });

    });
    $.ajax({
            url: "/<?php echo $language; ?>/admin/gamers/1",
            type: "GET",
            data: {

            },
            beforeSend:
                function() {
                    $('.table-body').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {
                let request_data = JSON.parse(response)
                if (response) {
                    change_default()
                    let data = request_data['gamers']
                    let btnPrevious = request_data['btnPrevious']
                    let btnNext = request_data['btnNext'];
                    let Prev = request_data['PreviousPage'];
                    let Next = request_data['NextPage'];
                    let page = request_data['pagination'];
                    let Allcount = request_data['AllUsersCount'];

                    arr = {
                        'select1': btnPrevious,
                        'select2': btnNext,
                        'Prev': Prev,
                        'Next': Next,
                        'page': page,
                        'Allcount': Allcount,
                    }


                    let html = ''

                    data.forEach(function(gamer) {
                        html += '<tr>'
                        html += '<td>' + gamer['id'] + '</td>'
                        html += '<td>' + gamer['name'] + '</td>'
                        html += '<td>' + gamer['level'] + '</td>'
                        html += '<td>' + gamer['prize'] + '</td>'
                        html += '<td>'



                        html += ' <select class="status-change form-select form-select-sm"> <option selected="" disabled="">Select a status:</option>'
                        html += '<option name="Waiting" data-id="' + gamer['id'] + '" value="waiting" selected=""'
                        console.log(gamer['status'])
                        if (gamer['status'] == 'waiting' ){
                            html += 'selected'
                        }
                        html += '><?php echo text($front, $language, 'table_status_in_process'); ?></option> <option name="Canceled" data-id="' + gamer['id'] + '" value="Canceled" '
                        if (gamer['status'] == 'Canceled' ){
                            html += 'selected'
                        }
                        html += '><?php echo text($front, $language, 'table_status_canceled'); ?></option> <option name="Finished" data-id="' + gamer['id'] + '" value="Finished"'
                        if (gamer['status'] == 'Finished' ){
                            html += 'selected'
                        }
                        html += '><?php echo text($front, $language, 'table_status_finished'); ?></option> </select>'
                        html += '</td>'

                        html += '<td>'
                        html += '<a class="Delete_user" data-id ="' + gamer['id'] + '" href="javascript:void(0)">' + '<?php echo text($front, $language, 'table_delete'); ?>' + '</a>'
                        html += '</td>'

                        html += '</tr>'
                    });
                    change(arr, html)
                    $('.table-body').html(html);

                }
            },
        });



</script>