
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            Games
                        </h1>
                        
                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="<?= '/' . $language ; ?>/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Games</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="container mt-1">

            </div>
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
                <table id="jquery-datatable-ajax-php" class="display table" style="width:100%">
                    <thead>
                    <tr>
                        <th>#id</th>
                        <th><?= text($front, $language, 'table_login' ); ?></th>
                        <th><?= text($front, $language, 'table_lvl' ); ?></th>
                        <th><?= text($front, $language, 'table_prize'); ?></th>
                        <th><?= text($front, $language, 'table_status' ); ?></th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</main>


<script>

    var theadData = [
        { data: 'id' },
        { data: 'name' },
        { data: 'level' },
        { data: 'prize' },
        {
            data: null,
            "bSortable": false,
            "mRender": function (o) {
                var html = ''
                html += ' <select class= "d-inline status-change form-select form-select-sm m-1"> <option selected="" disabled="">Select a status:</option>'
                html += '<option name="Waiting" data-id="' + o.id + '" value="waiting" selected=""'

                if (o.status == 'waiting' ){
                    html += 'selected'
                }
                html += '>In process</option> <option name="Canceled" data-id="' + o.id + '" value="Canceled" '
                if (o.status == 'Canceled' ){
                    html += 'selected'
                }
                html += '>Canceled</option> <option name="Finished" data-id="' + o.id + '" value="Finished"'
                if (o.status == 'Finished' ){
                    html += 'selected'
                }
                html += '>Finished</option> </select>'
                html += '</td>'
                return '<div class="d-flex"><a class="btn-danger Delete_user btn d-inline" data-id="'+o.id+'" href="javascript:void(0)">' + 'Delete' + '</a>' + html + '<div>';
            }
        }]
    datatable('#jquery-datatable-ajax-php', '/<?= $language; ?>/admin/games/pagination', theadData)

    $(document).on('change', ".status-change" ,function(e){
        let id = $(this).find(':selected').attr('data-id');
        let status = this.value;
        $.ajax({
            url: "/r/admin/game/change_status/" + id,
            type: "POST",
            data: {
                value: status
            },
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function (response) {
                $('.loading-refresh').removeClass('loading-form');

            },
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
                location.reload()
            },
        });

    });



</script>