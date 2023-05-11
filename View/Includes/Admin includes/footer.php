
<footer class="footer-admin mt-auto footer-light">
    <div class="container-xl px-4">
        <div class="row">
            <div class="col-md-6 small">
                <?php
                echo text($header, $language, 'title');
                ?>
            </div>
        </div>
    </div>
</footer>
</div>
<script>
    function change(arr, html) {
        $('.PreviousPage').addClass(arr['select1']);
        $('.NextPage').addClass(arr['select2']);
        $('.PreviousPage').attr('data-id',arr['Prev'])
        $('.NextPage').attr('data-id',arr['Next'])
        $('.page').html(arr['page']);
        $('.all_count').html(arr['Allcount']);
    }
    function change_default() {
        $('.table-body').html('');
        $('.PreviousPage').removeClass('disabled');
        $('.NextPage').removeClass('disabled');
        $('.page').html(0);
        $('.all_count').html(0);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../../js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js" crossorigin="anonymous"></script>


</body>
</html>
