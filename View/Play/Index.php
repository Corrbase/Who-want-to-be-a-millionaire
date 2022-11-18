<div class="loading-refresh" style="z-index: 2000"></div>
<div class="content">

</div>

<script>
    $.ajax({
        type: "GET",
        url: 'play/gone',
        // data: function (params){
        //     return{
        //         question_number: question_number,
        //         question_answer: question_answer,
        //     }
        // },
        beforeSend:
            function() {
                $('.loading-refresh').addClass('loading-form');
            },
        success: function(data)
        {
            $('.loading-refresh').removeClass('loading-form');
            $('.content').html(data);
        }
    })
    $(document).on('click', ".answer-button" ,function(e) {

        let question_number = $(this).attr("data-id");
        let question_answer = $(this).attr("data-answer");
        let question_id = $(this)
        $.ajax({
            type: "POST",
            url: 'play/gone',
            data: {
                question_num: question_number,
                question_ans: question_answer
            },
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data)
            {
                $('.loading-refresh').removeClass('loading-form');
                let request_data = JSON.parse(data)
                if (request_data.status == 1){
                    $.ajax({
                        type: "GET",
                        url: 'play/gone',
                        // data: function (params){
                        //     return{
                        //         question_number: question_number,
                        //         question_answer: question_answer,
                        //     }
                        // },
                        beforeSend: function (){
                            console.log(data)
                            $(".answer-button[data-id="+request_data.question_num+"]").css('background-color', '#7de051');
                        },
                        success: function(data)
                        {
                            $('.content').html(data);
                        }
                    })
                }else{
                    $.ajax({
                        type: "GET",
                        url: '/test',
                        // data: function (params){
                        //     return{
                        //         question_number: question_number,
                        //         question_answer: question_answer,
                        //     }
                        // },
                        beforeSend: function (){
                            $(question_id).css('background-color', '#f65c5c');
                        },
                        success: function()
                        {

                            $('.content').text('You lost your prize is ' + $('.NowFond').attr('data-price'));
                        }
                    })


                }
            }
        })

    })
</script>