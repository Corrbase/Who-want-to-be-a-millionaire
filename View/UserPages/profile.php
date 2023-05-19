    <?php

?>
<div class="w-50 pt-5 m-auto">

        <li class="list-unstyled">
            <p>
                <?php
                echo text($front, $language, 'balance');
                ?>:
                <span style="color: #009576">
                    <?php echo $_SESSION['user_profile']['balance']; ?>
                </span>
            </p>
        </li>

    <div class="card-body mt-3">

        <div class="d-flex align-items-center">


            <a href="javascript:void(0)" type="button" id="ClickToPage" data-id="" class="btn PreviousPage btn-outline-success m-1 ">&lt;</a>
            <a href="javascript:void(0)" id="ClickToPage" data-id="" class="btn NextPage btn-outline-success m-1 ">&gt;</a></div><div class="d-flex">


            <p class="mt-3">
                <?php
                echo text($front, $language, 'table_page');
                ?>
                <span class="page">0</span></p>
            <p class="mt-3 m-3">
                <?php
                echo text($front, $language, 'table_all_games');
                ?><span class="all_games">0</span></p>
        </div>
        <table class="table table-hover">


            <thead>
            <tr>
                <th>
                    #id
                </th>
                <th>
                    <?php
                    echo text($front, $language, 'table_name');
                    ?>
                </th>
                <th>
                    <?php
                    echo text($front, $language, 'table_question');
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

<script>
    $(document).ready(function () {
        $.ajax({
            url: "/<?php echo $language;?>/user/wins/1",
            type: "GET",
            data: {

            },
            beforeSend:
                function() {

                },
            success: function (response) {

                if (response) {
                    let request_data = JSON.parse(response)
                    if (request_data === false){
                        $('.table-body').html('');
                        $('.PreviousPage').addClass('disabled');
                        $('.NextPage').addClass('disabled');
                        $('.page').html(0);
                        $('.all_games').html(0);
                    }else{
                        change_default()

                        let data = request_data['question']
                        let select1 = request_data['disabled1']
                        let select2 = request_data['disabled2'];
                        let Prev = request_data['PreviousPage'];
                        let Next = request_data['NextPage'];
                        let page = request_data['pagination'];
                        let Allcount = request_data['AllUsersCount'];
                        console.log(request_data)
                        arr = {
                            'select1': select1,
                            'select2': select2,
                            'Prev': Prev,
                            'Next': Next,
                            'page': page,
                            'Allcount': Allcount,
                        }


                        let html = '';
                        data.forEach(function(gamer) {
                            html += '<tr>';
                            html += '<td>' + gamer['id'] + '</td>';
                            html += '<td>' + gamer['name'] + '</td>';
                            html += '<td>' + gamer['level'] + '</td>';
                            html += '<td>' + gamer['prize'] + '</td>';
                            html += '<td>';

                            if (gamer['getted'] == true) {
                                html += 'getted';
                            } else if (gamer['status'] == 'Finished') {
                                html += "<button class='btn btn-outline-primary get-money' data-id='" + gamer['id'] + "'>" + '<?php echo text($front, $language, 'table_prize_button'); ?>' + "</button>";
                            } else if (gamer['status'] == 'Canceled') {
                                html += '<?php echo text($front, $language, 'game_status_canceled'); ?>';
                            } else if (gamer['status'] == 'waiting') {
                                html += '<?php echo text($front, $language, 'game_status_waiting'); ?>';
                            }

                            html += '</td>';
                            html += '</tr>';

                        });

                        change(arr, html)

                    }

                }
            },
        });
    })
//
    $(document).on('click', '.get-money', function (e){
        let id = $(this).attr("data-id");
        $.ajax({
            url: "/<?php echo $language;?>/user/get_money/" + id,
            type: "POST",
            data: {

            },
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                   },
            success: function (response) {
                location.reload()


            },
        });
    })
    $(document).on('click', '#ClickToPage', function (e){
        let a = $(this).attr("data-id");
        $.ajax({
            url: "/<?php echo $language;?>/user/wins/" + a,
            type: "GET",
            data: {

            },
            beforeSend:
                function() {

                },
            success: function (response) {

                if (response) {
                    let request_data = JSON.parse(response)
                    if (request_data === false){
                        $('.table-body').html('');
                        $('.PreviousPage').addClass('disabled');
                        $('.NextPage').addClass('disabled');
                        $('.page').html(0);
                        $('.all_games').html(0);
                    }else{
                        change_default()

                        let data = request_data['question']
                        let select1 = request_data['disabled1']
                        let select2 = request_data['disabled2'];
                        let Prev = request_data['PreviousPage'];
                        let Next = request_data['NextPage'];
                        let page = request_data['pagination'];
                        let Allcount = request_data['AllUsersCount'];
                        console.log(request_data)
                        arr = {
                            'select1': select1,
                            'select2': select2,
                            'Prev': Prev,
                            'Next': Next,
                            'page': page,
                            'Allcount': Allcount,
                        }


                        let html = '';
                        data.forEach(function(gamer) {
                            html += '<tr>';
                            html += '<td>' + gamer['id'] + '</td>';
                            html += '<td>' + gamer['name'] + '</td>';
                            html += '<td>' + gamer['level'] + '</td>';
                            html += '<td>' + gamer['prize'] + '</td>';
                            html += '<td>';

                            if (gamer['getted'] == true) {
                                html += 'getted';
                            } else if (gamer['status'] == 'Finished') {
                                html += "<button class='btn btn-outline-primary get-money' data-id='" + gamer['id'] + "'>" + '<?php echo text($front, $language, 'table_prize_button'); ?>' + "</button>";
                            } else if (gamer['status'] == 'Canceled') {
                                html += '<?php echo text($front, $language, 'game_status_canceled'); ?>';
                            } else if (gamer['status'] == 'waiting') {
                                html += '<?php echo text($front, $language, 'game_status_waiting'); ?>';
                            }

                            html += '</td>';
                            html += '</tr>';

                        });

                        change(arr, html)

                    }

                }


            },
        });
    })
</script>

