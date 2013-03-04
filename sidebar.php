      </div><!-- end of main content block -->
      <div id="sidebar"> 
        
<?php if (is_page(30) || get_post_type() == 'faculty_staff' || is_page(766) ): 
		wp_reset_query();
		$args = array(
					'post_type' => 'faculty_staff',
					'meta_key' => 'member_rank',
					'orderby' => 'meta_value',
					'order' => 'ASC',
					'numberposts' => '-1'
					);
			$teamList = get_posts( $args );	
			echo '<h4>Our Team:</h4>';
			echo '<ul>';
			
			foreach ($teamList as $post) : ?>
			<li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
			
            <?php endforeach; ?>
			</ul>
	<?php endif; ?>

<?php 

$relatedToProjects = get_page_by_title( 'Projects & Clients' );
$releatedToProjectsID = $relatedToProjects->ID;
$primaryURL = get_bloginfo('siteurl');

if (is_page(array('projects-clients', 'becoming-a-client-of-hnmcp')) || is_tax( 'project_type' )  || is_tax('semester') || 'project' == get_post_type()) {
		
	echo '<h3>Project &amp; Client Archive</h3>';
	
	echo '
	<h4>Client List:</h4>
	<ul><li>
	<a href="'.$primaryURL.'/projects/">Alphabetically</a>
	</li></ul>';
	
	echo '<h4>See Projects By Semester:</h4>';  
				$semList = get_terms( 'semester', 
				array(
				'orderby'    => 'name',
				'order' => 'DESC',
				) );	
				?>	                
          
                    
                 <form action="<?php bloginfo('stylesheet_directory'); ?>/jump.php" method="post"> 
                    <select name=url> 
						<?php   
                        foreach ($semList as $semester) { ?>
                        <option value="<?php echo get_bloginfo('url').'/semester/'.$semester->slug;?>"><?php echo $semester->name ; ?></option> 			
                        <?php } ?>	                   
                     </select> 
                    <input type="submit" value="Submit"> 
                </form>
                
                
<?php 
	$typeArgs = array(
			'taxonomy' => 'project_type',
			'orderby' => 'slug',
			'order' => 'DESC'
			);
	$projectTypeList = get_categories( $typeArgs );	
	echo '<h4>See Projects By Type:</h4>'; ?>
	
	 <form action="<?php bloginfo('stylesheet_directory'); ?>/jump.php" method="post"> 
                    <select name=url> 
						<?php   
                        foreach ($projectTypeList as $ProjType) { ?>
                        <option value="<?php echo get_bloginfo('url').'/project-type/'.$ProjType->slug;?>"><?php echo $ProjType->name ; ?></option> 			
                        <?php } ?>	                   
                     </select> 
                    <input type="submit" value="Submit"> 
                </form>

<?php $sidebarProjectInfo = get_page_by_title( 'sidebar - Projects' );
	setup_postdata($sidebarProjectInfo);
	echo '<h3>Becoming a Client</h3>';
	the_content();

}
?>
        
<?php 
	$relatedToNews = get_page_by_title( 'News' );
	$relatedToNewsID = $relatedToNews->ID;
	$postType = get_post_type();

	if(is_tree($relatedToNewsID) || $postType == 'post') { 
		echo '<h3>News Archive</h3>';


	$args = array (
		'show_post_count'=>true,
		'type' => 'yearly',
	);
	echo '<ul>';
	wp_get_archives( $args );
	echo '</ul>';
	}

?>   
        
        
        
<?php 
	$currentNewsletter = get_page_by_title( 'Newsletter' );
	$relatedToNewsletterID = $currentNewsletter->ID;
	$postType = get_post_type();

	if(is_tree($relatedToNewsletterID) || $postType == 'newsletter' || is_tree($relatedToNewsID) || $postType == 'post') { 
		echo '<h3>Current Newsletter</h3>';

	wp_reset_query();
	$taxArgs = array(
		'taxonomy' => 'issue',
		'orderby' => 'slug',
		'order' => 'DESC'
	);
	$issueList = get_categories( $taxArgs );
	$currentIssue = $issueList [0];
	$displayNewsletter = $currentIssue->name; 
	$displayNewsletterSlug = $currentIssue->slug;
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
		echo '<ul>';
			foreach ( $currentProjectsList as $post) :  
				setup_postdata($post); ?>
			
            <li class="toc"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            
			<?php endforeach;
		echo '</ul>';
		
		
		wp_reset_query();
		
		
			$typeArgs = array(
			'taxonomy' => 'issue',
			'orderby' => 'slug',
			'order' => 'DESC'
			);
	$newsletterArchive = get_categories( $typeArgs );
	//if (count($newsletterArchive) > 1){
	echo '<h3>Newsletter Archive</h3>';
	echo '<ul>';
	
	foreach ($newsletterArchive as $pastIssue) : 
		if($pastIssue != $currentIssue){
			$myName = $pastIssue->name;
			$myLink = $pastIssue->slug;
			
			echo '<li><a href="'.get_bloginfo('url').'/issues/'.$myLink.'">'.$myName.'</a></li>';
		}
	endforeach;
	echo '</ul>';
	//}
	}
?>   
  
  
  


<?php 

//GET SIDEBAR CONTENT FOR PAGES, FROM SPECIAL 'SIDEBAR' PAGES

			  global $post;
			  $sidebarPageID = get_post_meta( $post->ID, 'sidebar_page_content', true );
			  //echo $sidebarPageID;
			  if ($sidebarPageID && $sidebarPageID != 'none') {
			  	$sidebarContent = get_page( $sidebarPageID );
				setup_postdata($sidebarContent);
				the_content();   
} 


?>

        
        
        
      </div>
      <!-- end of sidebar --> 