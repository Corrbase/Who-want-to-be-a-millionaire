<?php

include "Core/Core.php";
class Game extends Core {
    public function __construct($settings)
    {
        parent::__construct($settings);
    }

    public function question_name($question){
        echo '<div class="m-auto w-25  rounded-1" style="background-color: #00b0b5">
                    <p class="text-center text-light p-2">
                        ' . $question . '
                    </p>
                </div>';
    }
    public function random_answers($wrongs, $right)
    {

        $random = rand(1, 4);
        $this->{'rand' . $random}($wrongs, $right);

    }
    public function fond($ajax){
        echo '<div class="m-auto w-25  rounded-1 d-flex justify-content-between">
                    <p class="m-5 NowFond" data-price = '  . $ajax['now_fond'] . '>
                        ' . 'Your fond: <span class="text-danger">'  . $ajax['now_fond'] . '
                    </span></p>
                    <p class="m-5">
                        '. 'Next fond: <span class="text-danger">' . $ajax['next_fond'] . '
                    </span></p>
                </div>';
    }
    public function bonuses()
    {
        echo '<div>
                    <div class="d-flex justify-content-between m-auto mt-2" style="width: 150px" >
                        <div>
                            <button type="button" data-id="call_to_friend" class="Bonus rounded-5 btn btn-primary"><i class="fa fa-phone"></i></button>
                        </div>
                        <div>
                            <button type="button" data-id="Voice" class="Bonus rounded-5 btn btn-primary"><i class="fa fa-users"></i></button>
                        </div>
                        <div>
                            <button type="button" data-id="50" class="Bonus rounded-5 btn btn-primary fw-bold">%</button>
                        </div>
                    </div>
                    <div class="text-center bonus_request">
                    
</div>
                </div>';
    }


    public function rand1($wrongs, $right){
        echo '<div>

                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="1"  data-answer="' . $right . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $right . '
                            </p>
                        </button>
                        <button data-id="2"  data-answer="' . $wrongs[1] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[1] . '
                            </p>
                        </button>
                    </div>
                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="3"  data-answer="' . $wrongs[2] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[2] . '
                            </p>
                        </button>
                        <button data-id="4"  data-answer="' . $wrongs[0] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[0] . '
                            </p>
                        </button>
                    </div>
                </div>';
    }
    public function rand2($wrongs, $right){
        echo '<div>

                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="1"  data-answer=" ' . $wrongs[1] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[1] . '
                            </p>
                        </button>
                        <button data-id="2"  data-answer="' . $right . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $right . '
                            </p>
                        </button>
                    </div>
                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="3"  data-answer="' . $wrongs[2] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[2] . '
                            </p>
                        </button>
                        <button data-id="4"  data-answer="' . $wrongs[0] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[0] . '
                            </p>
                        </button>
                    </div>
                </div>';
    }
    public function rand3($wrongs, $right){
        echo '<div>

                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="1"  data-answer="' . $wrongs[2] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[2] . '
                            </p>
                        </button>
                        <button data-id="2"  data-answer="' . $wrongs[1] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[1] . '
                            </p>
                        </button>
                    </div>
                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="3"  data-answer="' . $right . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $right . '
                            </p>
                        </button>
                        <button data-id="4"  data-answer="' . $wrongs[0] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[0] . '
                            </p>
                        </button>
                    </div>
                </div>';
    }
    public function rand4($wrongs, $right){
        echo '<div>

                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="1"  data-answer="' . $wrongs[0] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[0] . '
                            </p>
                        </button>
                        <button data-id="2"  data-answer="' . $wrongs[1] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[1] . '
                            </p>
                        </button>
                    </div>
                    <div class="d-flex m-auto w-50 justify-content-between">
                        <button data-id="3"  data-answer="' . $wrongs[2] . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $wrongs[2] . '
                            </p>
                        </button>
                        <button data-id="4"  data-answer="' . $right . '" type="button" class="answer-button w-50 border border-light text-black rounded-3" style="background-color: #efe8af">
                            <p class=" text-center p-2 m-2">
                                ' . $right . '
                            </p>
                        </button>
                    </div>
                </div>';
    }
}