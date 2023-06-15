<script>
    function change(arr, html   ) {
        $('.previousPage').addClass(arr['select1']);
        $('.nextPage').addClass(arr['select2']);
        $('.previousPage').attr('data-id',arr['Prev'])
        $('.nextPage').attr('data-id',arr['Next'])
        $('.table-body').html(html);
        $('.page').html(arr['page']);
        $('.all_games').html(arr['allCount']);
    }
    function change_default() {
        $('.table-body').html('');
        $('.previousPage').removeClass('disabled');
        $('.nextPage').removeClass('disabled');
        $('.page').html(0);
        $('.all_games').html(0);
    }
</script>

</body>
</html>