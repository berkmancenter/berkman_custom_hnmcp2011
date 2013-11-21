<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<style type="text/css">@import url("<?php bloginfo('stylesheet_url'); ?>");</style>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo dirname(get_bloginfo('stylesheet_url')).'/images/favicon.ico' ?>">
<?php
if (is_front_page()) {
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
}?>
<?php wp_head(); ?>
<?php
if (is_front_page()) { ?>
<script type="text/javascript">
 jQuery(document).ready(function($) {

	$("#featured").tabs({fx:{opacity: "toggle"}}).tabs("hnmcp_rotate", 5000, true );

	$("#featured").hover(
		function() { jQuery("#featured").tabs("hnmcp_rotate",0,true); },
		function() { jQuery("#featured").tabs("hnmcp_rotate",5000,true); }
	);

	$('.ui-tabs-nav-item').click(function(){
		if( ! jQuery(this).hasClass( 'ui-tabs-selected' ) )
		{
			$( '.ui-tabs-selected').removeClass( 'ui-tabs-selected' );
			jQuery(this).addClass( 'ui-tabs-selected' );
		}
	});
});

</script>
<?php } ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper-html">

  <div id="wrapper-page" class="floatbox-980">
    <div id="header">
      <div id="logo">
        <h3>Harvard Negotiation &amp; Mediation Clinical Program</h3>
        <a href="<?php echo site_url(); ?>"><img src="<?php echo get_bloginfo('stylesheet_directory') ?>/images/shim.gif" width="980" height="134" alt="HNMCP home page" class="logo-plcmnt" /></a>
        <p>at Harvard Law School</p>
      </div>
    </div>
    <!-- end of header -->
    <div id="nav">
      <?php wp_nav_menu( array( 'menu' => 'Primary Menu' ) ); ?>
	   <div class="search">
		   <form action="<?php echo site_url(); ?>">
			   <input type="text" size="20" name="s" id="search-input" /><input type="submit" value="Search" id="search-submit" />
		   </form>
	   </div>
    </div><!-- end of nav -->
    <div id="page_content">
      <div id="main-content-block"> 
