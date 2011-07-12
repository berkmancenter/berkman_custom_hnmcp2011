<div class="news_wrapper">
	
    <div class="newsletter_inner_wrapper">
        <h4><?php echo get_the_title(); ?></h4>
		<div class="posted_date"><span>posted: </span><?php echo get_the_date( 'F jS, Y'); ?></div>
        <?php the_content(' ... continue reading &rarr;'); ?>
    </div>
    <div class="endFloat"></div>
</div>
