<?php 
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'main-nav' => __( 'Main Nav' )
		)
	);
}

if ( function_exists( 'add_theme_support' ) ) { 
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 200, true );
	add_image_size( 'project-thumb', 150, 100, true );
	add_image_size('featured_on_home', 400, 250, true);
}

function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	if ( is_page($pid) )
	return true;            // we're at the page or at a sub page
	$anc = get_post_ancestors( $post->ID );
	foreach($anc as $ancestor) {
		if(is_page() && $ancestor == $pid) {
			return true;
		}
	}
               return false;  // we're elsewhere
}

function get_currentProjectParam() {
		$currentYear = date('Y');
	$currentMonth = date('m');
	 if ( $currentMonth < '09') {$currentMonthFormatted = '01'; } else {$currentMonthFormatted = '09';} ;  
	 $currentProjectParam = $currentYear.'-'.$currentMonthFormatted;
	 return $currentProjectParam;
}
function format_currentProjectParam($currentProjectParam) {
	list($myYear, $myMonth) = explode("-", $currentProjectParam);
	
	return $myYear;
}



// ADD CUSTOM POST TYPE FOR ***PROJECTS***

add_action('init', 'projects_register');
 
function projects_register() {
 
	$labels = array(
		'name' => _x('Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'project'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => dirname(get_bloginfo('stylesheet_url')).'/images/menu-star.png',
		'rewrite' => array('slug' => 'projects','with_front' => FALSE),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'has_archive' => true,
		'supports' => array('title','excerpt','thumbnail', 'revisions', 'editor')
	  ); 
 
register_post_type( 'project' , $args );
}

register_taxonomy("semester", array("project"), array("hierarchical" => true, 'label' => 'Semesters', 'singular_label'=> 'Semester', 'rewrite' => array('slug'=> 'semester', 'with_front'=> FALSE)));
register_taxonomy("project_type", array("project"), array("hierarchical" => true, 'label' => 'Project Type', 'singular_label'=> 'Project Type', 'rewrite' => array('slug'=> 'project-type', 'with_front'=> FALSE)));



// ADD CUSTOM POST TYPE FOR ***NEWSLETTER***

add_action('init', 'newsletter_register');
 
function newsletter_register() {
 
	$labels = array(
		'name' => _x('Newsletters', 'post type general name'),
		'singular_name' => _x('Newsletter Article', 'post type singular name'),
		'add_new' => _x('Add New', 'newsletter'),
		'add_new_item' => __('Add New Newsletter Article'),
		'edit_item' => __('Edit Newsletter Article'),
		'new_item' => __('New Newsletter Article'),
		'view_item' => __('View Newsletter Article'),
		'search_items' => __('Search Newsletter Articles'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => dirname(get_bloginfo('stylesheet_url')).'/images/newspaper-icon.png',
		'rewrite' => array('slug' => 'newsletters','with_front' => FALSE),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 6,
		'has_archive' => true,
		'supports' => array('title','excerpt','thumbnail', 'revisions', 'editor')
	  ); 
 
register_post_type( 'newsletter' , $args );
}

register_taxonomy("issue", array("newsletter"), array("hierarchical" => true, 'label' => 'Issues', 'singular_label'=> 'Issue', 'rewrite' => array('slug'=> 'issues', 'with_front'=> FALSE)));





add_action("admin_init", "admin_init");
 
function admin_init(){
	add_meta_box("project_client_name", "Project Details", "project_details", "project", "normal", "high");
    add_meta_box("member_title", "Faculty/Staff Additional Info", "faculty_staff_setup", "faculty_staff", "normal", "high");
	add_meta_box("sidebar_content", "Sidebar Content For This Page", "sidebar_content", "page", "normal", "high");
	add_meta_box("home_page_feature", "Featured On Home Page?", "home_page_feature", "post", "normal", "high");
	add_meta_box("home_page_feature", "Featured On Home Page?", "home_page_feature", "project", "normal", "high");
	add_meta_box("home_page_feature", "Featured On Home Page?", "home_page_feature", "newsletter", "normal", "high");
	add_meta_box("newsletter_extras", "Newsletter Extras", "newsletter_extras", "newsletter", "normal", "high");
}


function newsletter_extras(){
  global $post;
  echo '<input type="hidden" name="newsletter_extras_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
  $custom = get_post_custom($post->ID);
  $newsletterArticleRank = $custom["newsletter_article_rank"][0];
  ?>
  <p><label>Newsletter Article Rank <em>(the higher the number, the lower on the page it will show)</em>:</label><br />
  <input name="newsletter_article_rank" value="<?php echo $newsletterArticleRank; ?>" /></p>
  <?php
}
add_action( 'save_post', 'save_newsletter_extras' );
/**
 * Process the custom metabox fields
 */
function save_newsletter_extras($post_id) {
    global $post;
    // verify nonce
    if (!wp_verify_nonce($_POST['newsletter_extras_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

   if( $_POST ) {
        $old = get_post_meta($post_id, 'newsletter_article_rank', true);
        $new = $_POST['newsletter_article_rank'];
        if ($new && $new != $old){
            update_post_meta($post_id, 'newsletter_article_rank', $new);
        }
    }


}




function home_page_feature(){
	global $post;	
	echo '<input type="hidden" name="featured_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	$isChosen = get_post_meta( $post->ID, 'home_page_feature_boolean', true ); 
	 ?>
	<label>No</label><input type="radio" name="home_page_feature_boolean" value="no" <?php if($isChosen == 'yes'){ echo '';} else {echo 'checked="checked"';} ?> />&nbsp;&nbsp;&nbsp;
	<label>Yes</label><input type="radio" name="home_page_feature_boolean" value="yes" <?php if($isChosen == 'yes'){ echo 'checked="checked"';} ?> />
    
    <?php
}
add_action( 'save_post', 'save_is_featured' );
/**
 * Process the custom metabox fields
 */
function save_is_featured($post_id) {
    global $post;
    // verify nonce
    if (!wp_verify_nonce($_POST['featured_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

   if( $_POST ) {
        $old = get_post_meta($post_id, 'home_page_feature_boolean', true);
        $new = $_POST['home_page_feature_boolean'];
        if ($new && $new != $old){
            update_post_meta($post_id, 'home_page_feature_boolean', $new);
        }
    }


}


 
function project_details(){
  global $post;
  $custom = get_post_custom($post->ID);
  //$clientName = $custom["project_client_name"][0];
  $clientURL = $custom["project_client_url"][0];
  $projectStudents = $custom["project_students"][0];
  ?>
  <!--<p><label>Client:</label><br />
  <input name="project_client_name" value="<?php //echo $clientName; ?>" size="60"/></p>-->
  <p><label>Client URL <em>(include full URL like this: http://www.domain.com)</em>:</label><br />
  <input name="project_client_url" value="<?php echo $clientURL; ?>" size="60"/></p>
  <p><label>Students Involved:</label><br />
  <input name="project_students" value="<?php echo $projectStudents; ?>" size="60"/></p>
  <?php
}

function sidebar_content() {
	global $post;
    //remember the current $post object
    $real_post = $post;
    //get curent user info (we need the ID)
    //get_currentuserinfo();
    //create nonce
    echo '<input type="hidden" name="sidebar_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    //get saved meta
    $selected = get_post_meta( $post->ID, 'sidebar_page_content', true );
    //create a query for all of the user businesses posts
    $sidebar_query = new WP_Query();
    $sidebar_query->query(array(
                            'post_type' => 'page',
                            'posts_per_page' => -1,
							'orderby' => 'title',
							'order' => 'ASC'));
    if ($sidebar_query->have_posts()){
		
        echo '<select name="sidebar_page_content" id="sidebar_page_content">';
		echo '<option value="none">--select sidebar content--</option>';
        //loop over all post and add them to the select dropdown
        while ($sidebar_query->have_posts()){
            $sidebar_query->the_post();
            echo '<option value="'.$post->ID.'" ';
            if ( $post->ID == $selected){
                echo 'selected="selected"';
            }
            echo '>'.$post->post_title .'</option>';
        }
        echo '<select>';
    }
    //reset the query and the $post to its real value
    wp_reset_query();
    $post = $real_post;
}

//save SideBar content
add_action( 'save_post', 'save_sidebar_selection' );
/**
 * Process the custom metabox fields
 */
function save_sidebar_selection($post_id) {
    global $post;
    // verify nonce
    if (!wp_verify_nonce($_POST['sidebar_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    if( $_POST ) {
        $old = get_post_meta($post_id, 'sidebar_page_content', true);
        $new = $_POST['sidebar_page_content'];
        if ($new && $new != $old){
            update_post_meta($post_id, 'sidebar_page_content', $new);
        }
    }
}


function project_change_default_title( $title ){
     $screen = get_current_screen();
     if  ( 'project' == $screen->post_type ) {
          $title = 'Enter Client Name';
     }
     return $title;
}
add_filter( 'enter_title_here', 'project_change_default_title' );


// ADD CUSTOM POST TYPE FOR ***FACULTY AND STAFF***

add_action('init', 'faculty_register');
 
function faculty_register() {
 
	$labels = array(
		'name' => _x('Faculty &amp; Staff', 'post type general name'),
		'singular_name' => _x('Faculty/Staff Member', 'post type singular name'),
		'add_new' => _x('Add New', 'faculty_staff'),
		'add_new_item' => __('Add New Faculty/Staff Member'),
		'edit_item' => __('Edit Person'),
		'new_item' => __('New Faculty/Staff Member'),
		'view_item' => __('View Faculty/Staff'),
		'search_items' => __('Search Faculty/Staff'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
 
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => dirname(get_bloginfo('stylesheet_url')).'/images/bordone_headshot.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','excerpt','thumbnail', 'revisions', 'editor')
	  ); 
 
register_post_type( 'faculty_staff' , $args );
}
 
function faculty_staff_setup(){
  global $post;
  $custom = get_post_custom($post->ID);
  $memberDescription = $custom["member_title"][0];
  $memberRank = $custom["member_rank"][0];
  ?>
  <p><label>Faculty/Staff Title:</label><br />
  <textarea name="member_title" cols="50" rows="3"/><?php echo $memberDescription; ?></textarea></p>
  <p><label>Faculty/Staff Rank <em>(the higher the number, the lower on the page it will show)</em>:</label><br />
  <input name="member_rank" value="<?php echo $memberRank; ?>" /></p>
  <?php
}


// CHANGE DEFAULT TEXT THAT APPEARS IN 'TITLE' ENTRY FIELD

function faculty_change_default_title( $title ){
     $screen = get_current_screen();
     if  ( 'faculty_staff' == $screen->post_type ) {
          $title = 'Enter Faculty/Staff Member\'s Name Here';
     }
     return $title;
}
add_filter( 'enter_title_here', 'faculty_change_default_title' );



//SAVING CUSTOM FIELDS DATA

add_action('save_post', 'save_details');
function save_details(){
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return;
	if (defined('DOING_AJAX') && DOING_AJAX)
      return;
	
  global $post;
 
  //update_post_meta($post->ID, "project_client_name", $_POST["project_client_name"]);
  update_post_meta($post->ID, "project_client_url", $_POST["project_client_url"]);
  update_post_meta($post->ID, "project_students", $_POST["project_students"]);
  update_post_meta($post->ID, "member_title", $_POST["member_title"]);
  update_post_meta($post->ID, "member_rank", $_POST["member_rank"]);
}




?>