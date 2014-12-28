<?php
global $post;
$post = get_page(jaw_template_get_var('page_id'));
if(isset($post->ID)){
?>
<div class="modal col-lg-8 fade" id="jaw_modal">
    <div class="modal-header col-lg-8">
        <a class="close" data-dismiss="modal"><i class="icon-cancel-circle"></i></a>
        <h3><?php echo $post->post_title; ?></h3>
    </div>
    <div class="modal-body col-lg-8">
        <p><?php echo apply_filters('the_content', $post->post_content); ?></p>
    </div>
    <div class="clear"></div>
</div>
<?php } ?>