<div class="w-50 pt-5 m-auto">
    <ul class="d-flex justify-content-between">
        <li class="list-unstyled">
            <a href="" class="m-5 LogOut">logout</a>
        </li>
        <li class="list-unstyled">
            <p>
                Your balance:
                <?php echo $_SESSION['user_profile']['balance']; ?>
            </p>
        </li>

    </ul>
    <div class="card-body table-body mt-3">

    </div>
</div>

<script>
    $(document).on('click', '.LogOut', function (e){
        $.ajax({
            type: "POST",
            url: '/r/user/logOut',
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data) {
                $('.loading-refresh').removeClass('loading-form');
                window.location.replace("/login");
            }
        })
    })
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
                $('.loading-refresh').removeClass('loading-form');


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
                    $('.table-body').html('<table class="table table-hover"> <button type="button" class="btn btn-outline-success m-1"><</button> <button type="button" class="m-1 btn btn-outline-success">></button> <p>Page:</p> <thead> <tr> <th># </th> <th> name </th> <th>level</th> <th>prize</th> <th>status</th> <th>action</th></tr> </thead> <tbody></tbody> </table> <div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
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
                $('.table-body').html('<table class="table table-hover"> <button type="button" class="btn btn-outline-success m-1"><</button> <button type="button" class="btn btn-outline-success m-1">></button><p>Page:</p><thead> <tr> <th># </th> <th> name </th> <th>level</th> <th>prize</th> <th>status</th> <th>action</th></tr> </thead> <tbody></tbody> </table> <div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
            },
        success: function (response) {

            if (response) {
                $('.table-body').html(response);
            }
        },
    });



</script>

