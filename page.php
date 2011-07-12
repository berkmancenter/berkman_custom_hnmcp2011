<?php get_header(); ?>
           <?php if(is_front_page()){ 
		   wp_reset_query();
				$args = array(
					'post_type' => array('post', 'project', 'newsletter'),
					'posts_per_page' => '4',
					'meta_query' => array(
										array(
											'key' => 'home_page_feature_boolean',
											'value' => 'yes'											
										) ),
					'order' => 'DESC'
				);
				$homePagePosts = get_posts($args);
				if ($homePagePosts) {
					$counter = 1;
					echo '<div id="featured" ><ul class="ui-tabs-nav">';
					foreach ( $homePagePosts as $post) :  
					setup_postdata($post); ?>

						<li class="ui-tabs-nav-item <?php if ($counter == 1) { echo 'ui-tabs-selected' ; } ?>" id="nav-fragment-<?php echo $counter; ?>">
                        <a href="#fragment-<?php echo $counter; ?>"><?php the_title(); ?></a>
                        </li>

					<?php 
					$counter +=1;
					endforeach;
					echo '</ul>';
					rewind_posts();
					$counter = 1;
					foreach ( $homePagePosts as $post) :  
					setup_postdata($post); ?>
						<div id="fragment-<?php echo $counter ?>" class="ui-tabs-panel <?php if($counter != 1){ echo 'ui-tabs-hide'; } ?>" style="">
                        	<a href="<?php echo get_permalink(); ?>">
							<?php if (has_post_thumbnail()) { the_post_thumbnail('featured_on_home'); } ?>
                            </a>
                            <div class="read_feature">read article &raquo;</div>
	    				</div>
					<?php 
					$counter += 1 ;
					endforeach;
					echo '</div><!-- end of featured -->';
				wp_reset_query();
				}
				
			 } ?>  


<?php wp_reset_query();
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




<?php get_sidebar(); ?>
<?php get_footer(); ?>