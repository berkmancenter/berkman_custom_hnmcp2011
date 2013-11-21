<?php

	/**
	 * This file contains new methods added by Travis Ballard Design
	 * www.travisballard.com - admin@ansimation.net
	 */

	class TBD_HNMCP
	{

		const HOMEPAGE_SLIDE_NUM = 4; // number of slides to display on the home page
		const HOMEPAGE_POSTS_NUM = 2; // number of posts to show below home page slideshow.

		public function __construct()
		{
			$this->load_dependencies();
			$this->hooks();
		}

		public function hooks()
		{
			add_action( 'init', array( $this, 'add_image_sizes' ) );
			add_action( 'init', array( $this, 'register_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		/**
		* load a template file from inc/tpl/
		*
		* @param mixed $file
		*/
		public static function load( $file )
		{
		    $file = sprintf( '%s/inc/tpl/%s.php', str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, get_bloginfo( 'stylesheet_directory' ) ), $file );
		    if( file_exists( $file ) && is_readable( $file ) )
		        include( $file );
		    else
		    {
		        if( ! is_readable( $file ) && file_exists( $file ) )
		            trigger_error( sprintf( 'Unable to load template file %s. File is not readable. Check permissions and try again.', $file ), E_USER_WARNING );
		        elseif( ! file_exists( $file ) )
		            trigger_error( sprintf( 'Unable to load template file %s. File does not exist.', $file ), E_USER_WARNING );
		    }
		}

		/**
		 * our own version of get_template_part that allows us to put the template files in the template folder
		 * for a cleaner structure to the codebase.
		 *
		 * @param mixed $slug
		 * @param mixed $name
		 */
		public static function get_template_part( $slug, $name = null )
		{
			do_action( "get_template_part_{$slug}", $slug, $name );

			$templates = array();
			if ( isset($name) )
				$templates[] = "{$slug}/{$name}.php";

			$templates[] = "{$slug}.php";

			self::locate_template($templates, true, false);
		}

		/**
		 * locate template in template folder, THEMEDIR/inc/tpl/
		 *
		 * @param mixed $template_names
		 * @param mixed $load
		 * @param mixed $require_once
		 * @param string $template_folder
		 * @return void
		 */
		public static function locate_template( $template_names, $load = false, $require_once = true, $template_folder = 'inc/tpl/' )
		{
			$located = '';

			foreach ( (array) $template_names as $template_name )
			{
				if ( !$template_name )
					continue;

				if ( file_exists( STYLESHEETPATH . '/' . $template_folder . $template_name))
				{
					$located = STYLESHEETPATH . '/' . $template_folder . $template_name;
					break;
				}
				else if ( file_exists(TEMPLATEPATH . '/' . $template_folder . $template_name) )
				{
					$located = TEMPLATEPATH . '/' . $template_folder . $template_name;
					break;
				}
			}

			if ( $load && '' != $located )
				load_template( $located, $require_once );

			return $located;
		}


		/**
		 * load class dependencies
		 */
		public function load_dependencies()
		{
			$path = sprintf( '%s/inc/lib/', get_stylesheet_directory() );
			foreach( glob( sprintf( '%s*.php', $path ) ) as $file ){
				if( is_readable( $file ) ){
					require_once( $file );
				}
			}
		}

		/**
		 * check if the post is to be displayed in the home page slideshow or not based on the meta value for
		 * @param int $post_id
		 * @return bool
		 */
		public static function is_post_featured_on_home_page( $post_id )
		{
			/* @var $post WP_Post */
			$val = get_post_meta( $post_id, 'home_page_feature_boolean', 1 );
			if( empty( $val ) || ! $val || $val != 'yes' )
				return false;

			return true;
		}

		/**
		 * register image sizes
		 */
		public function add_image_sizes()
		{
			add_image_size( 'home-slideshow-image', 640, 286, 1 );
		}

		/**
		 * register scripts
		 */
		public function register_scripts()
		{
			wp_register_script( 'home-slideshow', sprintf( '%s/inc/js/home-slideshow.js', get_stylesheet_directory_uri() ), array( 'jquery', 'ui-tabs-rotate' ), '1.0', false );
			wp_register_script( 'ui-tabs-rotate', sprintf( '%s/inc/js/jquery-ui-tabs-rotate.js', get_stylesheet_directory_uri() ), array( 'jquery' ), '1.0', false );
			wp_register_script( 'cycle', sprintf( '%s/inc/js/jquery.cycle.all.js', get_stylesheet_directory_uri() ), array( 'jquery' ), '1.0', false );
		}

		/**
		 * enqueueu script swhen required
		 */
		public function enqueue_scripts()
		{
			if( is_front_page() || is_home() )
				wp_enqueue_script( 'home-slideshow' );
		}
	}

	$tbd_hnmcp = new TBD_HNMCP(); // global instance