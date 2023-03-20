<?php
$front = $view_array['front'];
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

    <div class="card-body table-body mt-3">

    </div>
</div>

<script>

    $(document).on('click', '.get-money', function (e){
        let id = $(this).attr("data-id");
        $.ajax({
            url: "/<?php echo $language;?>/user/get_money/" + id,
            type: "GET",
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
                    $('.table-body').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {


                if (response) {
                    $('.table-body').html(response);
                }

            },
        });
    })
    $.ajax({
        url: "/<?php echo $language;?>/user/wins/1",
        type: "GET",
        data: {

        },
        beforeSend:
            function() {
                $('.table-body').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
            },
        success: function (response) {

            if (response) {
                $('.table-body').html(response);
            }
        },
    });



</script>

