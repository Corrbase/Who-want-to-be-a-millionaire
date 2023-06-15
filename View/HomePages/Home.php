<?php



?>
<div class="px-4 pt-5 my-5 text-center border-bottom">
    <h1 class="display-4 fw-bold">
        <?php
            echo text($front, $language, 'home_title');
        ?>
    </h1>
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">
            <?php
            echo text($front, $language, 'home_info');
            ?>
        </p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
            <a href="<?= '/' . $language ; ?>/game" type="button" class="btn btn-primary btn-lg px-4 me-sm-3">
                <?php
                echo text($front, $language, 'home_button');
                ?>
            </a>

        </div>
    </div>
</div>
