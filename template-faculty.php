<?php 
/*
Template Name: Faculty
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
	$args = array(
				'post_type' => 'faculty_staff',
				'meta_key' => 'member_rank',
				'orderby' => 'meta_value_num',
				'order' => 'ASC',
				'posts_per_page' => '-1'
			); 
		$HNMCPstaff = get_posts($args); 
			foreach ( $HNMCPstaff as $post) :  
				setup_postdata($post);
				$memberTitleRaw = wpautop (get_post_meta($post->ID, 'member_title', true));   
				$memberTitle = strip_tags($memberTitleRaw, '<br>')
				  ?>
			<div class="faculty_box">
            <?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
} ?>

<h4><?php the_title(); ?></h4>
<p class="faculty_title"><?php echo $memberTitle; ?></p>
<?php the_content(); ?>
<div class="endFloat"></div>
            </div>
            
	<?php endforeach; ?>

    
    
    
    
    

<?php get_sidebar(); ?>
<?php get_footer(); ?>