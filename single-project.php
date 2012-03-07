<?php get_header(); ?>

<?php wp_reset_query();
if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); 
		
			$clientURL = get_post_meta($post->ID, 'project_client_url', true);
			$projectStudents = get_post_meta($post->ID, 'project_students', true);
			$theSemesters = get_the_terms( $post->ID , 'semester' );
			foreach ($theSemesters as $semester): $mySemester = $semester->name; endforeach;
			$projectTypes = get_the_terms( $post->ID , 'project_type' );
		?>
			<h1><span><a href="<?php echo $clientURL; ?>" target="_blank"><?php the_title(); ?></a></span>
            <?php if ($clientURL) { ?>
            	<a href="<?php echo $clientURL; ?>" target="_blank">
                	<img src="<?php echo dirname(get_bloginfo('stylesheet_url')).'/images/new_window_icon.gif' ; ?>" width="20" height="15" alt="visit <?php the_title(); ?> website" class="open_new_window" />
                </a><?php } ?>
            </h1>
		
        <div class="project_details">	
        <div class="project_listing_detail"><h4><span>Semester: </span><?php echo $mySemester ; ?></h4></div>
        <div class="project_listing_detail"><h4><span>Project Type: </span>
            <?php  
			$lastTerm = end ($projectTypes);
			foreach ( $projectTypes as $projectType): 
				echo $projectType->name; 
					if ($projectType != $lastTerm) { echo ', '; }
			endforeach;
			?></h4></div>
        <div class="project_listing_detail"><h4><span>Students: </span><?php echo $projectStudents ; ?></h4></div>
        </div><!-- end of project details -->
               
               <?php if (has_post_thumbnail()) { the_post_thumbnail('medium', array('class' => 'project_single_page_img')); } ?>
                
			<?php the_content(); ?>
		<?php endwhile; ?>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>
	<?php endif; ?>      

<?php get_sidebar(); ?>
<?php get_footer(); ?>