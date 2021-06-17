<div class="voting">
    <button class="voting__button" id="<?php echo $itemid ?>">
        <svg class="voting__icon">
        <use xlink:href="<?php echo get_template_directory_uri() ?>/build/svg/icons.svg#icon-thumbup" />
        </svg>
    </button>
    <div class="voting__counter">
        <?php if ($votenumber){
            echo $votenumber;
        } else { 
            echo '1';
        } ?>
    </div>
</div>