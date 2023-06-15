


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
                            <div class="page-header-subtitle">Here you can edit you question and save it</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="<?= '/' . $language ; ?>/admin/home">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?= '/' . $language ; ?>/admin/questions">Questions</a></li>
                            <li class="breadcrumb-item active">edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <?php
        $question = $question[0];
        $wrongs_en = explode(',' , $question['wrong_answer_en']);
        $wrongs_hy = explode(',' , $question['wrong_answer_hy']);
        ?>
        <div class="container-xl px-4 mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Question Details</div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" method="POST" data-id="<?= $question['id']?>" id="edit_question">
                                <div class="armenian pb-5">
                                    <h2><?= text($front, $language, 'form_armenian'); ?></h2>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="Question"><?= text($front, $language, 'title'); ?></label>

                                        <input class="form-control" value="<?= $question['hy']; ?>" id="Question" type="text" placeholder="<?= text($front, $language, 'title'); ?>" name="question_hy">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1 f-1 text-success" for="Right_answer"><?= text($front, $language, 'select_right_ans'); ?></label>
                                            <input class="form-control" value="<?= $question['right_answer_hy'] ?>" id="Right_answer" type="text" placeholder="<?= text($front, $language, 'select_right_ans'); ?>" name="right_answer_hy">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="Wrong1"><?= text($front, $language, 'select_other_ans'); ?></label>
                                            <input class="form-control" value="<?= $wrongs_hy[0]; ?>" id="Wrong1" type="text" placeholder="<?= text($front, $language, 'select_other_ans'); ?>" name="wrong_answer_1_hy">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="Wrong2"><?= text($front, $language, 'select_other_ans'); ?></label>
                                            <input class="form-control" id="Wrong2" value="<?= $wrongs_hy[1]; ?>" type="text" placeholder="<?= text($front, $language, 'select_other_ans'); ?>" name="wrong_answer_2_hy">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="Wrong3"><?= text($front, $language, 'select_other_ans'); ?></label>
                                            <input class="form-control" id="Wrong3" value="<?= $wrongs_hy[2]; ?>" type="text" placeholder="<?= text($front, $language, 'select_other_ans'); ?>" name="wrong_answer_3_hy">
                                        </div>
                                    </div>

                                </div>
                                <div class="english pb-2">
                                    <h2><?= text($front, $language, 'form_english'); ?></h2>
                                    <div class="mb-3">
                                        <label class="small mb-1" for="Question"><?= text($front, $language, 'title'); ?></label>

                                        <input class="form-control" value="<?= $question['en']; ?>" id="Question" type="text" placeholder="<?= text($front, $language, 'title'); ?>" name="question_en">
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1 f-1 text-success" for="Right_answer"><?= text($front, $language, 'select_right_ans'); ?></label>
                                            <input class="form-control" value="<?= $question['right_answer_en'] ?>" id="Right_answer" type="text" placeholder="<?= text($front, $language, 'select_right_ans'); ?>" name="right_answer_en">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="Wrong1"><?= text($front, $language, 'select_other_ans'); ?></label>
                                            <input class="form-control" value="<?= $wrongs_en[0]; ?>" id="Wrong1" type="text" placeholder="<?= text($front, $language, 'select_other_ans'); ?>" name="wrong_answer_1_en">
                                        </div>
                                    </div>
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="Wrong2"><?= text($front, $language, 'select_other_ans'); ?></label>
                                            <input class="form-control" id="Wrong2" value="<?= $wrongs_en[1]; ?>" type="text" placeholder="<?= text($front, $language, 'select_other_ans'); ?>" name="wrong_answer_2_en">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="Wrong3"><?= text($front, $language, 'select_other_ans'); ?></label>
                                            <input class="form-control" id="Wrong3" value="<?= $wrongs_en[2]; ?>" type="text" placeholder="<?= text($front, $language, 'select_other_ans'); ?>" name="wrong_answer_3_en">
                                        </div>
                                    </div>

                                </div>
                                <hr>

                                <div class="pt-3 pb-2">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div class="w-100 p-1">
                                            <label class="small mb-1"><?= text($front, $language, 'select_diff'); ?></label>
                                            <select name="difficulty" class="form-select" aria-label="Default select example">
                                                <option selected="" disabled=""><?= text($front, $language, 'select_diff_place'); ?></option>

                                                <option name="easy" value="easy" selected=""><?= text($front, $language, 'select_diff_e'); ?></option>
                                                <option name="normal" value="normal"><?= text($front, $language, 'select_diff_n'); ?></option>
                                                <option name="hard" value="hard"><?= text($front, $language, 'select_diff_h'); ?></option>
                                            </select>
                                        </div>

                                        <div class="w-100 p-1">
                                            <label class="small mb-1"><?= text($front, $language, 'select_lvl'); ?></label>
                                            <select name="level" class="form-select" aria-label="Default select example">
                                                <option selected="" disabled=""><?= text($front, $language, 'select_choose'); ?></option>

                                                <?php
                                                $a = 1;
                                                while ($a<= $levels){
                                                    echo $a;
                                                    echo "<option name='level' value='$a'";
                                                    if ($question['level'] == $a){
                                                        echo "selected";
                                                    }
                                                    echo ">$a</option>";
                                                    $a++;
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="w-100 p-1">
                                            <label class="small mb-1"><?= text($front, $language, 'select_active'); ?></label>
                                            <select name="Active" class="form-select" aria-label="Default select example">
                                                <option selected="" disabled=""><?= text($front, $language, 'select_active_place'); ?></option>

                                                <option name="On" value="1" selected=""><?= text($front, $language, 'select_active_on'); ?></option>
                                                <option name="Off" value="0"><?= text($front, $language, 'select_active_off'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">

                                    </div>
                                </div>
                                <!-- Submit button-->
                                <button class="btn btn-primary" type="submit"><?= text($front, $language, 'select_btn'); ?></button>
                                <div class="text-danger form-errors m-2">
                                </div>
                                <div class="text-green form-accept m-2">
                                </div>
                            </form>
                        </div>
                    </div>
            <!-- Button trigger modal -->
    </main>


<script>
    $("#edit_question").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: '/r/admin/question/edit/<?= $question['id']?>',
            data: form.serialize(),
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {
                let request_data = JSON.parse(data)
                $('.loading-refresh').removeClass('loading-form');
                console.log(request_data)
                switch(request_data.success) {
                    case 'error1':
                        $('.form-errors').text("<?= text($front, $language, 'error1'); ?>");
                        $('.form-accept').text('');
                        break;
                    case 'error2':
                        $('.form-errors').text("<?= text($front, $language, 'error2'); ?>");
                        $('.form-accept').text('');
                        break;
                    case 'error4':
                        $('.form-errors').text("<?= text($front, $language, 'error4'); ?>");
                        $('.form-accept').text('');
                        break;
                    case 'success':
                        $('.form-errors').text("");
                        $('.form-accept').text('<?= text($front, $language, 'success'); ?>');
                        break;
                }


            }
        })

    })
</script>