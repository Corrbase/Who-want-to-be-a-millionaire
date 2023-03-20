<?php
$front = $view_array['front'];
?>
<div class="text-center m-auto w-75">
    <h4 class=" fw-bold mt-3">
        <?php
        echo text($front, $language, 'game_info');
        ?>
    </h4>
    <form action="play/name" class=" w-50 m-auto mt-2 d-flex pt-5 pb-5" method="POST" enctype="multipart/form-data">

            <button class="btn btn-outline-secondary m-auto" style="font-size: 20px"  type="submit" >
                <?php
                echo text($front, $language, 'game_button');
                ?>
            </button>

    </form>

</div>
