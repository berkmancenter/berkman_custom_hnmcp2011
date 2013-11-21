<?php

	$slide = 0;

	$q = new wp_query( array(
		'post_type' => array( 'post', 'project', 'newsletter' ),
		'post_status' => 'publish',
		'orderby' => 'id',
		'order' => 'desc',
		//'posts_per_page' => TBD_HNMCP::HOMEPAGE_SLIDE_NUM,
		'posts_per_page' => TBD_HNMCP::HOMEPAGE_SLIDE_NUM + TBD_HNMCP::HOMEPAGE_POSTS_NUM,
		'meta_key' => 'home_page_feature_boolean',
		'meta_value' => 'yes'
	) );

	if( $q->have_posts() )
	{
		?>
		<div id="home-slideshow">
			<a class="nav prev" href="javascript://"><</a>
			<ul>
				<?php while( $q->have_posts() )
				{
					$q->the_post();
					if( $slide++ < TBD_HNMCP::HOMEPAGE_SLIDE_NUM )
					{
						TBD_HNMCP::get_template_part( 'home', 'slideshow-slide' );

						if( $slide == TBD_HNMCP::HOMEPAGE_SLIDE_NUM )
						{
							// close main slideshow, we're now showing posts
							?>
									</ul>
									<a class="nav next" href="javascript://">></a>
								</div>
							<?php
						}
					}
					else
						TBD_HNMCP::get_template_part( 'home', 'post' );
				}
	}