<div class="loading-refresh" style="z-index: 2000"></div>
<div class="content">

</div>

<script>
    $.ajax({
        type: "GET",
        url: '/<?php echo $language?>/play/gone',
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
            url: '/<?php echo $language?>/play/gone',
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
                console.log(request_data)
                if (request_data.status == 1){
                    $.ajax({
                        type: "GET",
                        url: '/<?php echo $language?>/play/gone',
                        // data: function (params){
                        //     return{
                        //         question_number: question_number,
                        //         question_answer: question_answer,
                        //     }
                        // },

                        success: function(data)
                        {
                            $(".answer-button[data-id=" + request_data.question_num + "]").css('background-color', '#7de051');
                            setTimeout(function (){$('.content').html(data);}, 2000)

                        }
                    })
                }else{
                    if (request_data.prize == 1){
                        var LostWin = '<?php echo text($front, $language, 'game_lost_noprize'); ?> ' + request_data.prize_count;
                    }else {
                        var LostWin = '<?php echo text($front, $language, 'game_lost_prize'); ?>' ;
                    }
                    $.ajax({
                        type: "GET",
                        url: '/test',
                        // data: function (params){
                        //     return{
                        //         question_number: question_number,
                        //         question_answer: question_answer,
                        //     }
                        // },

                        success: function()
                        {
                            $(question_id).css('background-color', '#f65c5c');
                                $(".answer-button[data-answer='"+request_data.right+"']").css('background-color', '#7de051');
                            
                            setTimeout(function (){$('.content').html('<h1 class="text-center p-2">' + LostWin + '<a href="/"><?php echo text($front, $language, 'game_main_page_button'); ?></a>  </h1>');}, 2000)

                        }
                    })


                }
            }
        })

    })
    $(document).on('click', ".Bonus" ,function(e) {

        let bonus_name = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: '/<?php echo $language?>/play/gone',
            data: {
                bonus: bonus_name,
            },
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data) {
                $('.loading-refresh').removeClass('loading-form');

                $('.bonus_request').text(data);



            }
        })

    })
    $(document).on('click', ".end_game" ,function(e) {

        let prize = $('.NowFond').attr("data-price");

        $.ajax({
            type: "POST",
            url: '/<?php echo $language?>/play/gone',
            data: {
                end_game: true,
                prize: prize
            },
            beforeSend:
                function() {
                    $('.loading-refresh').addClass('loading-form');
                },
            success: function(data) {
                $('.loading-refresh').removeClass('loading-form');
                let request_data = JSON.parse(data)
                if (request_data.end == false){
                    $('.content').html('<h1 class="text-center p-2"> <?php echo text($front, $language, 'game_stop_noprize'); ?>  <a href="/"><?php echo text($front, $language, 'game_main_page_button'); ?></a>  </h1>');
                }else {
                    $('.content').html('<h1 class="text-center p-2"> <?php echo text($front, $language, 'game_stop_prize'); ?> '+prize+'<a href="/"><?php echo text($front, $language, 'game_main_page_button'); ?></a>  </h1>');
                }
                $('.bonus_request').text(data);



            }
        })

    })


</script>