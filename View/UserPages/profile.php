<?php

?>
<div class="w-50 pt-5 m-auto">

    <li class="list-unstyled">
        <p>
            <?php
            echo text($front, $language, 'balance');
            ?>:
            <span style="color: #009576">
                    <?= $_SESSION['user_profile']['balance']; ?>
                </span>
        </p>
    </li>

    <div class="card-body mt-3">

        <table id="jquery-datatable-ajax-php" class="display table" style="width:100%">
            <thead>
            <tr>
                <th><?= text($front, $language, 'table_id' ); ?></th>
                <th><?= text($front, $language, 'table_prize' ); ?></th>
                <th><?= text($front, $language, 'table_question'); ?></th>
                <th><?= text($front, $language, 'table_status'); ?></th>

            </tr>
            </thead>
        </table>
    </div>
</div>

<script>

    var theadData = [
        { data: 'id' },
        { data: 'prize' },
        { data: 'level' },
        {
            data: null,
            "bSortable": false,
            "mRender": function (data) {

                var html = '';

                if (data.getted === true){
                    html += 'getted'
                }else{
                    switch (data.status) {
                        case 'Finished':
                            html += "<a class='link-primary link get-money' data-id='" + data.id + "' href='javascript:void(0)'>" + '<?= text($front, $language, 'table_prize_button'); ?>' + "</a>";
                            break;
                        case 'Canceled':
                            html += '<?= text($front, $language, 'game_status_canceled'); ?>';
                            break;
                        case 'waiting':
                            html += '<?= text($front, $language, 'game_status_waiting'); ?>';
                            break;

                    }
                }
                return html;

            },
        }
        ]

    datatable('#jquery-datatable-ajax-php', '/<?= $language; ?>/user/wins/pagination', theadData)

    $(document).on('click', '.get-money', function (e){
        let id = $(this).attr("data-id");
        $.ajax({
            url: "/<?= $language;?>/user/get_money/" + id,
            type: "POST",
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function (response) {
                location.reload()


            },
        });
    })
</script>

