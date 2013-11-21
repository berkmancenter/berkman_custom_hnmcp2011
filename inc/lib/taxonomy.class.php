<?php

    /**
    *   Custom Taxonomy Class by Travis Ballard ( admin@ansimation.net )
    *   Used to register a new taxonomy easily and efficiently with a single line of code
    */
    class Taxonomy
    {
        public function __construct( $name, $label, $post_type, $slug, $singular, $plural, $hierarchical = true, $args = array() )
        {
            $default_args = array(
                'labels' => array(
                    'name' => ucwords( strtolower( $label ) ),
                    'singular_name' => ucwords( strtolower( $singular ) ),
                    'search_items' => sprintf( 'Search %s', ucwords( strtolower( $plural ) ) ),
                    'all_items' => sprintf( 'All %s', ucwords( strtolower( $plural ) ) ),
                    'parent_item' => sprintf( 'Parent %s', ucwords( strtolower( $singular ) ) ),
                    'parent_item_colon' => sprintf( 'Parent %s:', ucwords( strtolower( $singular ) ) ),
                    'edit_item' => sprintf( 'Edit %s', ucwords( strtolower( $singular ) ) ),
                    'update_item' => sprintf( 'Update %s', ucwords( strtolower( $singular ) ) ),
                    'add_new_item' => sprintf( 'Add New %s', ucwords( strtolower( $singular ) ) ),
                    'new_item_name' => sprintf( 'New %s Name', ucwords( strtolower( $singular ) ) ),
                    'menu_name' => ucwords( strtolower( $label ) ),
                ),
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => $slug ),
                'hierarchical' => (bool)$hierarchical
            );

            $_args = array();
            foreach( $default_args as $_name => $default )
            {
                if( array_key_exists( $_name, $args ) )
                    $_args[$_name] = $args[$_name];
                else
                    $_args[$_name] = $default;
            }

            if( ! is_array( $post_type ) )
                $post_type = (array)$post_type;

            return register_taxonomy( $name, $post_type, $_args );
        }
    }