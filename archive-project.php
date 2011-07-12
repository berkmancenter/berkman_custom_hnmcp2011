<?php get_header(); ?>


<?php wp_reset_query();
if (have_posts()) : ?>
	<h1>Clients:</h1>
		<?php 
		
			$args = array(
				'post_type' => 'project',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => '-1'
			); 
		$currentProjectsList = get_posts($args); 
			foreach ( $currentProjectsList as $post) :  
				setup_postdata($post);

		
			get_template_part('project_archive_format');
			
		 endforeach; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      


<?php get_sidebar(); ?>
<?php get_footer(); ?>