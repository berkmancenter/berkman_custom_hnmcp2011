<div class="news_wrapper">
	<?php if (has_post_thumbnail()) { the_post_thumbnail('project-thumb', array('class' => 'project_list_page_img')); } else { ?>
    <div class="project_img_holder"></div><?php } ?>
    <div class="project_inner_wrapper">
        <h4><?php echo get_the_title(); ?></h4>
		<div class="posted_date"><span>posted: </span><?php echo get_the_date( 'F jS, Y'); ?></div>
        <?php the_excerpt(); ?>
    </div>
    <div class="endFloat"></div>
</div>
