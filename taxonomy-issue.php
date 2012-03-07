<?php get_header(); ?>


<?php wp_reset_query(); ?>
	<h1>Archived Newsletter: 
	<?php 
	// the following line of code returns the taxonomy's name for this archive
	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?>
    </h1>
		<?php 
		global $more;

	$args = array(
				'post_type' => 'newsletter',
				'tax_query' => array(
									array(
										'taxonomy' => 'issue',
										'field' => 'slug',
										'terms' => $term
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