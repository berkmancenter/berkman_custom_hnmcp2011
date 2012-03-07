<?php get_header(); ?>

<?php 
if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>
			<h1><span><?php the_title(); ?></span></h1>
            <?php 
			$memberTitleRaw = wpautop (get_post_meta($post->ID, 'member_title', true));   
            $memberTitle = strip_tags($memberTitleRaw, '<br>'); ?>
              
            <div class="faculty_box">
				<?php if ( has_post_thumbnail() ) {the_post_thumbnail('thumbnail', array('class' => 'alignleft'));} ?>
                <h4><?php the_title(); ?></h4>
                <p class="faculty_title"><?php echo $memberTitle; ?></p>
                <?php the_content(); ?>
                <div class="endFloat"></div>
            </div>
		<a href="<?php echo get_permalink(30); ?>">Back to Our Team</a>
		<?php endwhile; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      


<?php get_sidebar(); ?>
<?php get_footer(); ?>