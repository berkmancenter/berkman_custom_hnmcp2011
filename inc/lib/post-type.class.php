<?php

    /**
    *   Custom Post Type class by Travis Ballard ( admin@ansimation.net )
    *
    *   Used to register new post types without having to rewrite this whole block multiple times.
    */
    class PostType
    {
        public function __construct( $post_type_name, $menu_name, $slug, $singular, $plural, $args = array() )
        {
            $_args = array();
            $default_args = array(
                'public' => true,
                'publicly_queryable' => true,
                'exclude_from_search'=> false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_position' => null,
                'menu_icon' => null,
                'hierarchical' => false,
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
                'has_archive' => true,
                'register_meta_box_cb' => '',
                'rewrite' => array( 'slug' => $slug ),
                'query_var' => true,
                'can_export' => true
            );

            foreach( $default_args as $name => $default )
            {
                if( array_key_exists( $name, $args ) )
                    $_args[$name] = $args[$name];
                else
                    $_args[$name] = $default;
            }

            $_args['labels'] = array(
                'name' => $menu_name,
                'singular_name' => $singular,
                'add_new' => sprintf( 'Add New %s', ucwords( strtolower( $singular ) ) ),
                'add_new_item' => sprintf( 'Add New %s', ucwords( strtolower( $singular ) ) ),
                'edit_item' => sprintf( 'Edit %s', ucwords( strtolower( $singular ) ) ),
                'new_item' => sprintf( 'New %s', ucwords( strtolower( $singular ) ) ),
                'all_items' => sprintf( 'All %s', ucwords( strtolower( $plural ) ) ),
                'view_item' => sprintf( 'View %s', ucwords( strtolower( $singular ) ) ),
                'search_items' => sprintf( 'Search %s', ucwords( strtolower( $plural ) ) ),
                'not_found' =>  sprintf( 'No %s found.', strtolower( $plural ) ),
                'not_found_in_trash' => sprintf( 'No %s found in the trash.', strtolower( $plural ) ),
                'parent_item_colon' => '',
                'menu_name' => $menu_name
            );

            return register_post_type( $post_type_name, $_args );
        }
    }