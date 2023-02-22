<div class="w-50 pt-5 m-auto">

        <li class="list-unstyled">
            <p>
                Your balance:
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
            url: "/user/get_money/" + id,
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
            url: "/user/wins/" + a,
            type: "GET",
            data: {

            },
            beforeSend:
                function() {
                    $('.table-body').html('<table class="table table-hover"> <button type="button" class="btn btn-outline-success m-1"><</button> <button type="button" class="m-1 btn btn-outline-success">></button> <p>Էջ:</p> <thead> <tr> <th>#Համար </th> <th> Անուն </th> <th>Հարց</th> <th>Գումար</th> <th>Կարգավիճակ</th> </tr> </thead> <tbody></tbody> </table> <div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {


                if (response) {
                    $('.table-body').html(response);
                }

            },
        });
    })
    $.ajax({
        url: "/user/wins/1",
        type: "GET",
        data: {

        },
        beforeSend:
            function() {
                $('.table-body').html('<table class="table table-hover"> <button type="button" class="btn btn-outline-success m-1"><</button> <button type="button" class="btn btn-outline-success m-1">></button><p>Էջ:</p><thead> <tr> <th>#Համար </th> <th> Անուն </th> <th>Հարց</th> <th>Գումար</th> <th>Կարգավիճակ</th> </tr> </thead> <tbody></tbody> </table> <div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
            },
        success: function (response) {

            if (response) {
                $('.table-body').html(response);
            }
        },
    });



</script>

