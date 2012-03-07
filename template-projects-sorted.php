<?php 
/*
Template Name: Projects Sorted
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
	
$sortOrder = $_GET['sort_order']; 
	
	//echo $sortOrder;
if ($sortOrder == 'clients'){
	$args = array(
				'post_type' => 'project',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => '-1'
			); 
	echo '<h1>HNMCP Clients</h1>';
}
if ($sortOrder == 'project_type'){
	$args = array(
				'post_type' => 'project',
				'orderby' => 'title',
				'order' => 'ASC',
				'posts_per_page' => '-1'
			); 
	echo '<h1>HNMCP Clients</h1>';
}

		$ClientList = get_posts($args); 
			foreach ( $ClientList as $post) :  
				setup_postdata($post);
	
	
	get_template_part('project_archive_format');
	
	?>



          
            
	<?php endforeach; ?>

    
    
    
    
   
<?php get_sidebar(); ?>
<?php get_footer(); ?>