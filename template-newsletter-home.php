<?php 
/*
Template Name: Current Newsletter
*/
?>
<?php get_header(); ?>


  
    
    
    
    <?php 
	wp_reset_query();
	global $more; 
	$taxArgs = array(
		'taxonomy' => 'issue',
		'orderby' => 'slug',
		'order' => 'DESC'
	);
	$issueList = get_categories( $taxArgs );
	$currentIssue = $issueList [0];
	$displayNewsletter = $currentIssue->name; 
	$displayNewsletterSlug = $currentIssue->slug;
	echo '<h1>HNCMP Newsletter - '.$displayNewsletter.'</h1>';    
	
	


	$args = array(
				'post_type' => 'newsletter',
				'tax_query' => array(
									array(
										'taxonomy' => 'issue',
										'field' => 'slug',
										'terms' => $displayNewsletterSlug
									)),
				'meta_key' => 'newsletter_article_rank',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'posts_per_page' => '-1'
			); 
		$currentProjectsList = get_posts($args); 
			foreach ( $currentProjectsList as $post) :  
				setup_postdata($post);
				$more = 0;
	
		get_template_part('newsletter_archive_format');
 endforeach; ?>

    
    
    
    
    

<?php get_sidebar(); ?>
<?php get_footer(); ?>