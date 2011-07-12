<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<style type="text/css">@import url("<?php bloginfo('stylesheet_url'); ?>");</style>
<?php wp_head(); ?>
</head>

<body>
<div id="wrapper-html"><!-- end of pre-header -->
  <div id="wrapper-page" class="floatbox-980">
    <div id="header"><h3>SolarCream Sunscreen&reg; - the best all natural non-toxic sunscreen</h3></div>
    <!-- end of header -->
    <div id="nav">
      <?php wp_nav_menu( array( 'menu' => 'Primary Menu' ) ); ?>
    </div><!-- end of nav -->
    
    <?php if (is_front_page()){ ?>
    <div id="home-page-splash"><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/button-buy.jpg" alt="buy all-natural sunscreen" width="285" height="138" class="buy-learn-buttons" /></a><a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/button-learn.jpg" alt="learn the advantages of all-natural sunscreen" width="285" height="138" class="buy-learn-buttons" /></a></div><!-- end of home page splash --><?php } ?>
    <div id="content">
      <div id="main-content-block"> 
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
	<?php endif; ?>      </div>
      <!-- end of main content block -->
      <div id="sidebar"></div>
      <!-- end of sidebar --> 
      <div class="endFloat"></div>
    </div>
    <!-- end of content -->
  <div id="footer"><div class="floatbox-980" id="footer-content">
  
    <?php $footerInfo = get_page_by_title( 'Footer' );
	setup_postdata($footerInfo);
	the_content(); ?>

  
  </div><!-- end of footer inner --></div> <!-- end of footer --> 
</div>    
    
  </div>
  <!-- end of wrapper-page -->

<!-- end of wrapper-html -->
<?php wp_footer(); ?>
</body>
</html>
