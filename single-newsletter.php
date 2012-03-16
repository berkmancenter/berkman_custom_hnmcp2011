<?php get_header(); ?>

<?php wp_reset_query();
if (have_posts()) : 
	$testTerms = get_the_terms($post->ID, 'issue');
	foreach ($testTerms as $term):
	 
	$displayNewsletter = $term->name; 
	$displayNewsletterSlug = $term->slug;
	endforeach;
?>
	
		<?php while (have_posts()) : the_post(); ?>
			<h1><span><?php the_title(); ?></span></h1>
			<div class="posted_date"><span>posted: </span><?php echo get_the_date( 'F jS, Y'); ?></div>
			<?php the_content(); ?>
            <p class="back_to_TOC"><a href="<?php echo bloginfo('siteurl'); ?>/issues/<?php echo $displayNewsletterSlug ?>">&laquo; back to the <?php echo $displayNewsletter; ?> Table of Contents</a></p>
		<?php endwhile; ?>
				
	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      

<?php get_sidebar(); ?>
<?php get_footer(); ?>
