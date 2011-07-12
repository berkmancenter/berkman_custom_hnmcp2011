<?php 
/*
Template Name: Projects Home
*/
?>
<?php get_header(); ?>

<?php 
if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>
			<h1><span><?php the_title(); ?></span></h1>

			<?php the_content(); ?>
		<?php endwhile; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      
    
    
    
    <?php 
	wp_reset_query();
	
	$taxArgs = array(
		'taxonomy' => 'semester',
		'orderby' => 'slug',
		'order' => 'DESC'
	);
	$semesterList = get_categories( $taxArgs );
	foreach ($semesterList as $semester) : 
    
	$myName = $semester->name;
	$myLink = $semester->slug;
//    echo '<a href="/semester/'.$myLink.'">'.$myName.'</a><br />';
	endforeach;
	
	
	
	$currentProjectParam = get_currentProjectParam();
	$currentSemesterTaxonomy = get_term_by( 'slug', $currentProjectParam, 'semester' );
	$formattedSemester = $currentSemesterTaxonomy->name;
		 
		 
	echo '<h2>'.$formattedSemester.' Projects</h2>';

	$args = array(
				'post_type' => 'project',
				'tax_query' => array(
									array(
										'taxonomy' => 'semester',
										'field' => 'slug',
										'terms' => $currentProjectParam
									)),
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => '-1'
			); 
			
			
			
		$currentProjectsList = get_posts($args); 
			foreach ( $currentProjectsList as $post) :  
				setup_postdata($post);
	
		get_template_part('project_archive_format');
 endforeach; ?>

    
    
    
    
    

<?php get_sidebar(); ?>
<?php get_footer(); ?>