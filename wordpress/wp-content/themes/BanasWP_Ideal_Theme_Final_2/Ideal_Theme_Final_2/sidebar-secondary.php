<?php if ( !theme_dynamic_sidebar( 'secondary' ) ) : ?>
<?php $style = theme_get_option('theme_sidebars_style_secondary'); ?>

<?php ob_start();?>
      <ul>
        <?php wp_get_archives('type=monthly&title_li='); ?>
      </ul>
<?php theme_wrapper($style, array('title' => __('Archives', THEME_NS), 'content' => ob_get_clean())); ?>

<?php ob_start();?>
      <ul>
        <?php wp_list_bookmarks('orderby=rating&title_li=&categorize=0'); ?>
      </ul>
<?php theme_wrapper($style, array('title' => __('Bookmarks', THEME_NS), 'content' => ob_get_clean())); ?>

<?php endif; ?>