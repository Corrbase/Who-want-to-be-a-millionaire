   <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                <?= text($front, $language, 'title'); ?>
                            </h1>

                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="<?= '/' . $language ; ?>/admin/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Questions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <div class="card">
                <div class="card-header"><?= text($front, $language, 'question_title'); ?></div>
                <div class="card-body"><?= text($front, $language, 'question_info'); ?></div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <div class="card-body"><?= text($front, $language, 'title'); ?></div>
                </div>
                <div>
                </div>

                <div class="card-body">
                    <div class="container mt-1">
                        <div class="pb-2">
                            <a href="/<?= $language ?>/admin/questions/create" class="link link-blue p-2">Create question</a>
                        </div>
                        <table id="jquery-datatable-ajax-php" class="display table" style="width:100%">
                            <thead>
                            <tr>
                                <th><?= text($front, $language, 'table_num' ); ?></th>
                                <th><?= text($front, $language, 'table_question' ); ?></th>
                                <th><?= text($front, $language, 'table_right_ans'); ?></th>
                                <th>lvl</th>
                                <th><?= text($front, $language, 'table_action' ); ?></th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>



<script>

    var theadData = [
        { data: 'id' },
        { data: '<?= $language ?>' },
        { data: 'right_answer_<?= $language ?>' },
        { data: 'level' },
        {
            data: null,
            "bSortable": false,
            "mRender": function (o) { return '<a href=/<?= $language ?>/admin/questions/edit/' + o.id + '>' + 'Edit' + '</a>'; }
        }]
    datatable('#jquery-datatable-ajax-php', '/<?= $language; ?>/admin/questions/pagination', theadData)

</script>