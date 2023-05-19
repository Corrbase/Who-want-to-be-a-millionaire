
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                <?php echo text($front, $language, 'title'); ?>
                            </h1>

                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo '/' . $language ; ?>/admin/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Questions</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>

        <div class="container-xl px-4 mt-n10">
            <div class="card">
                <div class="card-header"><?php echo text($front, $language, 'question_title'); ?></div>
                <div class="card-body"><?php echo text($front, $language, 'question_info'); ?></div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <div class="card-body"><?php echo text($front, $language, 'title'); ?></div>
                </div>
                <div>
                </div>

                <div class="card-body">

                    <div class="d-flex align-items-center">
                        <a href="javascript:void(0)" type="button" id="ClickToPage" data-id="" class="btn PreviousPage btn-outline-success m-1 ">&lt;</a>
                        <a href="javascript:void(0)" id="ClickToPage" data-id="" class="btn NextPage btn-outline-success m-1 ">&gt;</a>
                        <a href="/hy/admin/questions/create" class="font-weight-bold btn  btn-outline-success m-1">+</a>
                    </div>
                    <div class="d-flex">


                        <p class="mt-3"><?php
                            echo text($front, $language, 'table_page');
                            ?> <span class="page">0</span></p>
                        <p class="mt-3 m-3"><?php
                            echo text($front, $language, 'table_count');
                            ?> <span class="all_count">0</span></p>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="max-width: 120px">
                                <?php echo text($front, $language, 'table_num'); ?>
                            </th>
                            <th style="max-width: 300px">
                                <?php echo text($front, $language, 'table_question'); ?>
                            </th>
                            <th>
                                <?php echo text($front, $language, 'table_right_ans'); ?>
                            </th>
                            <th>
                                <?php echo text($front, $language, 'table_edit'); ?>
                            </th>
                            <th>
                                <?php echo text($front, $language, 'table_action'); ?>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="table-body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>



<script>
    $(document).on('click', '#ClickToPage', function (e){
        let a = $(this).attr("data-id");
        $.ajax({
            url: "/<?php echo $language; ?>/admin/questions/" + a,
            type: "GET",
            data: {

            },
            beforeSend:
                function() {
                    $('.table-body').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
                },
            success: function (response) {


                if (response) {
                    let request_data = JSON.parse(response)
                    if (response) {

                        change_default()
                        let data = request_data['questions']
                        let select1 = request_data['disabled1']
                        let select2 = request_data['disabled2'];
                        let Prev = request_data['PreviousPage'];
                        let Next = request_data['NextPage'];
                        let page = request_data['pagination'];
                        let Allcount = request_data['AllQuestionsCount'];
                        arr = {
                            'select1': select1,
                            'select2': select2,
                            'Prev': Prev,
                            'Next': Next,
                            'page': page,
                            'Allcount': Allcount,
                        }
                        let html = ''
                        data.forEach(function(question) {
                            html += '<tr>'
                            html += '<td>' + question.id + '</td>'
                            html += '<td style="max-width: 300px">' + question['<?php echo $language ?>'] + '</td>'
                            html += '<td>' + question['right_answer_<?php echo $language;?>'] + '</td>'
                            html += '<td>'
                            switch (question.difficulty) {
                                case 'normal':
                                    html += '<?php echo text($front, $language, 'table_diff_n'); ?>'
                                    break;
                                case 'easy':
                                    html += '<?php echo text($front, $language, 'table_diff_e'); ?>'
                                    break;
                                case 'hard':
                                    html += '<?php echo text($front, $language, 'table_diff_h'); ?>'
                                    break;
                                default:
                                    break;
                            }
                            html += '</td>'
                            html += '<td><a href="/<?php echo $language;?>/admin/questions/edit/' + question.id + '">' + '<?php echo text($front, $language, 'table_edit'); ?>' + '</a></td>'
                            html += '</tr>'
                        });

                        change(arr, html)
                        $('.table-body').html(html);

                    }
                }

            },
        });
    })
    $.ajax({
        url: "/<?php echo $language; ?>/admin/questions/1",
        type: "GET",
        data: {

        },
        beforeSend:
            function() {
                $('.table-body').html('<div class="loading p-15 m-auto"><img src="/assets/img/loading.gif" alt="" ></div>');
            },
        success: function (response) {
                let request_data = JSON.parse(response)
            if (response) {

                change_default()
                let data = request_data['questions']
                let select1 = request_data['disabled1']
                let select2 = request_data['disabled2'];
                let Prev = request_data['PreviousPage'];
                let Next = request_data['NextPage'];
                let page = request_data['pagination'];
                let Allcount = request_data['AllQuestionsCount'];
                arr = {
                    'select1': select1,
                    'select2': select2,
                    'Prev': Prev,
                    'Next': Next,
                    'page': page,
                    'Allcount': Allcount,
                }
                let html = ''
                data.forEach(function(question) {
                        html += '<tr>'
                        html += '<td>' + question.id + '</td>'
                        html += '<td style="max-width: 300px">' + question['<?php echo $language ?>'] + '</td>'
                        html += '<td>' + question['right_answer_<?php echo $language;?>'] + '</td>'
                        html += '<td>'
                    switch (question.difficulty) {
                        case 'normal':
                        html += '<?php echo text($front, $language, 'table_diff_n'); ?>'
                            break;
                        case 'easy':
                        html += '<?php echo text($front, $language, 'table_diff_e'); ?>'
                            break;
                        case 'hard':
                        html += '<?php echo text($front, $language, 'table_diff_h'); ?>'
                            break;
                        default:
                            break;
                    }
                        html += '</td>'
                        html += '<td><a href="/<?php echo $language;?>/admin/questions/edit/' + question.id + '">' + '<?php echo text($front, $language, 'table_edit'); ?>' + '</a></td>'
                        html += '</tr>'
                });

                change(arr, html)
                $('.table-body').html(html);

            }
        },
    });

</script>