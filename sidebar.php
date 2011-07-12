      </div><!-- end of main content block -->
      <div id="sidebar"> 
        
<?php 

$relatedToProjects = get_page_by_title( 'Projects & Clients' );
$releatedToProjectsID = $relatedToProjects->ID;

if (is_tree($releatedToProjectsID) || is_tax( 'project_type' )  || is_tax('semester') || 'project' == get_post_type()) {
		
	echo '<h3>Project &amp; Client Archive</h3>';
	
	echo '
	<h4>Client List:</h4>
	<ul><li>
	<a href="/projects/">Alphabetically</a>
	</li></ul>';
	
	
		$taxArgs = array(
			'taxonomy' => 'semester',
			'orderby' => 'slug',
			'order' => 'DESC'
			);
	$semesterList = get_categories( $taxArgs );
	
	echo '<h4>See Projects By Semester:</h4>';
	echo '<ul>';
	
	foreach ($semesterList as $semester) : 
	$myName = $semester->name;
	$myLink = $semester->slug;
    echo '<li><a href="/semester/'.$myLink.'">'.$myName.'</a></li>';
	endforeach;
	echo '</ul>';
	
	
	$typeArgs = array(
			'taxonomy' => 'project_type',
			'orderby' => 'slug',
			'order' => 'ASC'
			);
	$projectTypeList = get_categories( $typeArgs );
	
	echo '<h4>See Projects By Type:</h4>';
	echo '<ul>';
	
	foreach ($projectTypeList as $type) : 
	$myName = $type->name;
	$myLink = $type->slug;
    echo '<li><a href="/project-type/'.$myLink.'">'.$myName.'</a></li>';
	endforeach;
	echo '</ul>';

$sidebarProjectInfo = get_page_by_title( 'sidebar - Projects' );
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
		'show_post_count'=>true
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
			echo '<li><a href="/issues/'.$myLink.'">'.$myName.'</a></li>';
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
} ?>


        
        
        
      </div>
      <!-- end of sidebar --> 
