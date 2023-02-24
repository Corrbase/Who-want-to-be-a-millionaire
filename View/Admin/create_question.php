
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                            Create question
                        </h1>

                    </div>
                </div>
                <nav class="mt-4 rounded" aria-label="breadcrumb">
                    <ol class="breadcrumb px-3 py-2 rounded mb-0">
                        <li class="breadcrumb-item"><a href="/admin/home">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/questions">Questions</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </header>

    <div class="container-xl px-4 mt-n10">
        <div class="card">
            <div class="card-header">Create question</div>
            <div class="card-body">You can edit the questions and change difficulty of question</div>
        </div>
        <div class="card mt-5">
            <div class="card-header">
                Question
            </div>
            <div>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="POST" id="create_question">
                    <div class="mb-3">
                        <label class="small mb-1" for="Question">Question</label>

                        <input class="form-control" id="Question" type="text" placeholder="Question" name="question">
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1 f-1 text-success" for="Right_answer">Right answer</label>
                            <input class="form-control" id="Right_answer" type="text" placeholder="RightAnswer" name="right_answer">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="Wrong1">Other variants</label>
                            <input class="form-control" id="Wrong1" type="text" placeholder="Wrong Answer" name="wrong_answer_1">
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1" for="Wrong2">Other variants</label>
                            <input class="form-control" id="Wrong2" type="text" placeholder="Wrong Answer" name="wrong_answer_2">
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1" for="Wrong3">Other variants</label>
                            <input class="form-control" id="Wrong3" type="text" placeholder="Wrong Answer" name="wrong_answer_3">
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
                    <div class="mb-3">
                        <label class="small mb-1">Active</label>
                        <select name="Active" class="form-select" aria-label="Default select example">
                            <option selected="" disabled="">Select a role:</option>

                            <option name="On" value="1" selected="">On</option>
                            <option name="Off" value="0">Off</option>
                        </select>
                    </div>
                    <!-- Submit button-->
                    <button class="btn btn-primary" type="submit">Save changes</button>
                    <div class="text-danger form-errors m-2">
                    </div>
                    <div class="text-green form-accept m-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>



<script>
    $("#create_question").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);

        $.ajax({
            type: "POST",
            url: '/r/admin/question/create',
            data: form.serialize(),
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {
                $('.loading-refresh').removeClass('loading-form');

                if ($.trim(data)){
                    $('.form-errors').text('please fill all');
                    $('.form-accept').text('');
                }else {
                    $('.form-errors').text('');
                    $('.form-accept').text('You crate a question.');
                }
            }
        })

    })
</script>