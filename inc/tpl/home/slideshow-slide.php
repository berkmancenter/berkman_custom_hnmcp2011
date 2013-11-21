<li class="slideshow-slide">
	<?php

		$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'home-slideshow-image' );

		if( is_array( $image ) ){
			$image = $image[0];
		} else {
			$image = '';
		}

	?>
	<a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>" alt="" /></a>
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
</li>