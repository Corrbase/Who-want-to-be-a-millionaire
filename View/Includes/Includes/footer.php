<script>
    function change(arr, html   ) {
        $('.PreviousPage').addClass(arr['select1']);
        $('.NextPage').addClass(arr['select2']);
        $('.PreviousPage').attr('data-id',arr['Prev'])
        $('.NextPage').attr('data-id',arr['Next'])
        $('.table-body').html(html);
        $('.page').html(arr['page']);
        $('.all_games').html(arr['Allcount']);
    }
    function change_default() {
        $('.table-body').html('');
        $('.PreviousPage').removeClass('disabled');
        $('.NextPage').removeClass('disabled');
        $('.page').html(0);
        $('.all_games').html(0);
    }
</script>

</body>
</html>