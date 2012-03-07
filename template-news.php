<?php 
/*
Template Name: News Home Page
*/
?>
<?php get_header(); ?>

<?php wp_reset_query();
if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>
			<h1><span><?php echo get_the_title(); ?></span></h1>

			<?php the_content(); ?>
            
            
		<?php endwhile; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      

<?php 
	wp_reset_query();
	$args = array (
		'post_type' => 'post',
		'posts_per_page' => '10',
		'orderby' => 'date',
		'order' => 'DESC'
	);
	$newsPosts = get_posts($args);
	if ($newsPosts) {
		foreach ($newsPosts as $post):
		setup_postdata($post); 
		
			get_template_part('news_archive_format');
		
		endforeach;
	}
wp_reset_query();
?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>