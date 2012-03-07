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
    
	
	<?php //TEST GET PROJECTS AND ORDER BY TITLE
    wp_reset_query();
	$args = array(
		'number' => 2,
		'orderby' => 'name',
		'order' => 'DESC'
	);
	$currentProjects = get_terms('semester', $args); 
	$yearAstart = $currentProjects[0];
	$yearA = explode(' ', $yearAstart->name);
	$seasonNameA = $yearA[0];
	$yearA = $yearA[1];
	$yearAID = $yearAstart -> term_id;
	
	$yearBstart = $currentProjects[1];
	$yearB = explode(' ', $yearBstart->name);
	$seasonNameB = $yearB[0];
	$yearB = $yearB[1];
	$yearBID = $yearBstart -> term_id;

	$posttags = get_the_tags();
	print_r($posttags);
	
	if ($seasonNameA > $seasonNameB){
	echo '<h2>'.$seasonNameA.' '.$yearA.' Projects</h2>';
		$args = array(
						'post_type' => 'project',
						'tax_query' => array(
											array(
												'taxonomy' => 'semester',
												'field' => 'id',
												'terms' => $yearAID
											)),
						'orderby' => 'title',
						'order' => 'ASC',
						'posts_per_page' => '-1'
					); 		
			$currentProjectsList = get_posts($args); 
				foreach ( $currentProjectsList as $post) :  
					setup_postdata($post);
					get_template_part('project_archive_format');
				endforeach; 
				
				
					
	}
	else {
		echo '<h2>'.$seasonNameB.' '.$yearB.' Projects</h2>';
		$args = array(
						'post_type' => 'project',
						'tax_query' => array(
											array(
												'taxonomy' => 'semester',
												'field' => 'id',
												'terms' => $yearBID
											)),
						'orderby' => 'title',
						'order' => 'ASC',
						'posts_per_page' => '-1'
					); 		
			$currentProjectsList = get_posts($args); 
				foreach ( $currentProjectsList as $post) :  
					setup_postdata($post);
					get_template_part('project_archive_format');
				endforeach; 
	}
    //END TEST PROJECTS?>
    
	
	<?php 
	/*wp_reset_query();
	$taxArgs = array(
		'taxonomy' => 'semester',
		'orderby' => 'slug',
		'order' => 'DESC'
	);
	$semesterList = get_categories( $taxArgs );


		foreach ($semesterList as $semester) :    
			$myName = $semester->name;
			$myLink = $semester->slug;
		endforeach;

	$currentProjectParam = get_currentProjectParam();
	$currentSemesterTaxonomy = get_term_by( 'slug', $currentProjectParam, 'semester' );
	$formattedSemester = $currentSemesterTaxonomy->name;
		 
		if ($formattedSemester):	 
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
				endforeach; 
		endif;*/ ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>