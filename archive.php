<?php get_header(); ?>


<?php wp_reset_query();
if (have_posts()) : ?>
	
    <h1>News Archive &#8212; <?php single_month_title( ' '); ?></h1>
    
		<?php while (have_posts()) : the_post(); 
			get_template_part('news_archive_format');
		 endwhile; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      


<?php get_sidebar(); ?>
<?php get_footer(); ?>