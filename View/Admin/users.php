
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            <?php text($front, $language, 'title'); ?>
                        </h1>

                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="<?= '/' . $language ; ?>/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header"><?= text($front, $language, 'users_title'); ?></div>
            <div class="card-body"><?= text($front, $language, 'users_info'); ?></div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                <?= text($front, $language, 'title'); ?>
            </div>

            <div class="card-body">
                <div class="container mt-1">
                    <table id="jquery-datatable-ajax-php" class="display table" style="width:100%">
                        <thead>
                        <tr>
                            <th><?= text($front, $language, 'table_num' ); ?></th>
                            <th><?= text($front, $language, 'table_login' ); ?></th>
                            <th><?= text($front, $language, 'table_name' ); ?></th>
                            <th><?= text($front, $language, 'table_balance' ); ?></th>
                            <th><?= text($front, $language, 'table_role' ); ?></th>
                            <th><?= text($front, $language, 'table_action' ); ?></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>



<script type="text/javascript">
    var theadData = [
            { data: 'id' },
            { data: 'login' },
            { data: 'name' },
            { data: 'balance' },
            { data: 'Role' },
            {
                data: null,
                "bSortable": false,
                "mRender": function (o) { return '<a href=/<?= $language ?>/admin/user/edit/' + o.id + '>' + 'Edit' + '</a>'; }
            }]
    datatable('#jquery-datatable-ajax-php', '/<?= $language; ?>/admin/users/pagination', theadData)

</script>