<?php get_header(); ?>


<?php wp_reset_query();
if (have_posts()) : ?>
	<h1>Projects by Type: 
	<?php 
	// the following line of code returns the taxonomy's name for this archive
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?>
    </h1>
	<?php
	$mySemesterName = $term->name; 
	$mySemesterID = $term->term_id;
	$thisPostID = $post->ID;?>
    
      <?php wp_reset_query(); 
        $args = array (
        'post_type' => 'project',
        'posts_per_page' => '-1',
		'orderby' => 'title',
		'order' => 'ASC',
        'tax_query' => array(
						array(
							'taxonomy' => 'project_type',
							'field' => 'id',
							'terms' => $mySemesterID
						)));
        $allProjectsBySem = get_posts($args); 
        	
			if ($allProjectsBySem) :?>
            <?php foreach ($allProjectsBySem as $post) : ?> 
            <?php setup_postdata($post); ?>
			<?php get_template_part('project_archive_format'); ?>
            <?php endforeach;?>
           <?php endif; ?>
           

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      


<?php get_sidebar(); ?>
<?php get_footer(); ?>