<?php get_header(); ?>


<?php wp_reset_query();
if (have_posts()) : ?>
	<h1>Projects by Semester: 
	<?php 
	// the following line of code returns the taxonomy's name for this archive
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?>
    </h1>
		<?php while (have_posts()) : the_post(); 
		
			get_template_part('project_archive_format');
			
		 endwhile; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      


<?php get_sidebar(); ?>
<?php get_footer(); ?>