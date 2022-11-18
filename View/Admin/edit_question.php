
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                Edit Question
                            </h1>
                            <div class="page-header-subtitle">Here you can edit you question and save it</div>
                        </div>
                    </div>
                    <nav class="mt-4 rounded" aria-label="breadcrumb">
                        <ol class="breadcrumb px-3 py-2 rounded mb-0">
                            <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="/admin/questions">Questions</a></li>
                            <li class="breadcrumb-item active">edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </header>
        <?php
        $question = $view_array['question'][0];
        $wrongs = explode(',' , $question['wrong_answer'])
        ?>
        <div class="container-xl px-4 mt-n10">
                    <div class="card mb-4">
                        <div class="card-header">Question Details</div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" data-id="<?php echo $question['id']?>" id="edit_question">
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputQuestion">Question</label>

                                    <input class="form-control" id="inputQuestion" type="text" placeholder="Enter your email address" name="question" value="<?php echo $question['question'] ?>">
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1 f-1 text-success" for="inputFirstName">Right answer</label>
                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="right_answer" value="<?php echo $question['right_answer'] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Other variants</label>
                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="wrong_answer_1" value="<?php echo $wrongs[0] ?>">
                                    </div>
                                </div>
                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">Other variants</label>
                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="wrong_answer_2" value="<?php echo $wrongs[1] ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Other variants</label>
                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" name="wrong_answer_3" value="<?php echo $wrongs[2] ?>">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="small mb-1">difficulty</label>
                                    <select name="difficulty" class="form-select" aria-label="Default select example">
                                        <option selected="" disabled="">Select a role:</option>
                                        <option name="easy" value="easy" selected="">Easy</option>
                                        <option name="normal" value="normal">Normal</option>
                                        <option name="hard" value="hard">Hard</option>
                                    </select>
                                </div>
                                <!-- Submit button-->
                                <button class="btn btn-primary" type="submit">Save changes</button>
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
                url: '/r/admin/question/edit/<?php echo $question['id']?>',
                beforeSend:
                    function() {
                        $('.loading_popup').addClass('show fade').css('display', 'block');
                    },
                success: function(data)
                {
                    $('.modal').removeClass("loading");
                }
            })

        })
    </script>
</div>
</div>



</script>