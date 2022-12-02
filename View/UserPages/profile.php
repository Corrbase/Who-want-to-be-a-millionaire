<a href="" class="m-5 LogOut">logout</a>

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
</script>
