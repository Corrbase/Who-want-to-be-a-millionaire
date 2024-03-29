
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin panel</title>
    <link href="/css/styles.css" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.png" />
    <script data-search-pseudo-elements defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <script src="/js/scripts.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

</head>
<body class="nav-fixed">
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
<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0" id="sidebarToggle"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?= '/' . $language ; ?>/admin/home">
        <?php
        echo text($header, $language, 'main_dashboard');
        ?>
    </a>
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="/<?= $language;?>/home">
        <?php
        echo text($header, $language, 'go_to_main_page');
        ?>
    </a>


    <ul class="navbar-nav align-items-center ms-auto">
        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="/assets/img/illustrations/profiles/profile-1.png"></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img" src="/assets/img/illustrations/profiles/profile-1.png">
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?= $_SESSION['admin_profile']['login'] ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a href="javascript:void(0)" onclick="chnageLang()" class="dropdown-item">
                    <div class="dropdown-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg></div>

                    <?php if ($language == 'en'){echo 'hy'; }else{echo "en";} ?>
                </a>
                <script>
                    function chnageLang(){
                        var pathname = window.location.pathname
                        let url = pathname.slice(3);
                        console.log(url)
                        let language = '<?= $language?>'
                        if (language == 'hy'){
                            newurl = '/en' + url
                        }else {
                            newurl = '/hy' + url
                        }
                        window.location.replace(newurl);
                    }

                </script>
                <a class="dropdown-item LogOut" href="javascript:void(0)">
                    <div class="dropdown-item-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg></div>
                    <?php
                    echo text($header, $language, 'log_out_btn');
                    ?>

                </a>
            </div>
        </li>
    </ul>
</nav>

<script>

    $(document).on('click', '.LogOut', function (e){
        $.ajax({
            type: "POST",
            url: '/r/admin/logOut',
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data) {
                window.location.replace("/<?= $language;?>/login");
            }
        })
    })
</script>

<div id="layoutSidenav">