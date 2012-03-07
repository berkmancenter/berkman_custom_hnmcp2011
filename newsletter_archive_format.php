<div class="news_wrapper">
	
    <div class="newsletter_inner_wrapper">
        <h4><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<div class="posted_date"><span>posted: </span><?php echo get_the_date( 'F jS, Y'); ?></div>
        <?php the_content(' ... continue reading &rarr;'); ?>
    </div>
    <div class="endFloat"></div>
</div>
