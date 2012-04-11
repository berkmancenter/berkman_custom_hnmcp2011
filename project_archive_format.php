<?php 			
				$listTypes = get_the_terms( $post->ID , 'project_type' );
				$lastTerm = end($listTypes);
				$students = get_post_meta($post->ID, 'project_students', true);
				$theSemesters = get_the_terms( $post->ID , 'semester' );
				foreach ($theSemesters as $semester): $mySemester = $semester->name; endforeach; ?>
<div class="project_wrapper">
	<?php if (has_post_thumbnail()) { the_post_thumbnail('project-thumb', array('class' => 'project_list_page_img')); } else { ?>
    <div class="project_img_holder"></div><?php } ?>
    <div class="project_inner_wrapper">
        <h4><?php the_title(); ?></h4>
        <div class="project_listing_detail"><strong>Semester: </strong><?php echo $mySemester ; ?></div>
        <div class="project_listing_detail"><strong>Project Type: </strong>
			<?php if($listTypes) { 
				foreach ($listTypes as $type) { 
					echo $type->name; 
					if ($type != $lastTerm) { echo ', '; }
					};  
				} ?></div>
        <div class="project_listing_detail"><strong>Students: </strong><?php echo $students; ?></div>
       
        <?php the_excerpt(); ?>
    </div>
    <div class="endFloat"></div>
</div>
<?php wp_reset_query(); ?>