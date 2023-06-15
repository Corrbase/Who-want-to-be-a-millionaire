
<html lang="en">
<head>
    <title>Ով է ուզում դառնալ միլիոնատեր</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Armenian&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="/assets/img/logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
    <script src="/js/notify.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">


    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <style>
        *{
            font-family: 'Noto Sans Armenian', sans-serif;
        }
    </style>
</head>

<body>
<script>
    function datatable(className, url, columns){
        $(document).ready(function() {
            $(className).DataTable({
                language: {
                    "lengthMenu":     "_MENU_",
                    "search": "<?= text($datatable, $language, 'search' ); ?>",
                    "searchPlaceholder": "<?= text($datatable, $language, 'search' ); ?>",
                    "infoEmpty": "<?= text($datatable, $language, 'no_data' ); ?>",
                    "paginate": {
                        "previous": "<?= text($datatable, $language, 'previous' ); ?>",
                        "next": "<?= text($datatable, $language, 'next' ); ?>",
                    },
                    "info": "<?= text($datatable, $language, 'page' ); ?>: _PAGE_ <?= text($datatable, $language, 'all_pages' ); ?>: _PAGES_",
                },
                'processing': true,
                'serverSide': true,
                'pageLength': 5,
                "lengthMenu": [[5, 10, 25, 50, 100, 200], [5, 10, 25, 50, 100, 200]],
                'serverMethod': 'post',
                'ajax': {
                    'url':url
                },
                'columns': columns,
            });
        } );
    }
</script>

<div class="loading-refresh" style="z-index: 2000"></div>
