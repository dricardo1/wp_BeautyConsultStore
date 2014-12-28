<?php global $jaw_data; ?>
<?php
global $post;
if (jaw_template_get_var('id', '') != '') {
    $post = get_post((int) jaw_template_get_var('id', 0));
    ?>
    <div  style="background: url('<?php echo jaw_template_get_var('image_src'); ?>');">
        <?php
        the_content();
        ?> 
    </div>
<?php } ?>
