<?php

    /* Disable WordPress Admin Bar */
    // show_admin_bar(false); // hide for everyone
    add_action('after_setup_theme', 'remove_admin_bar');
    function remove_admin_bar() {
        $current_user = wp_get_current_user();
        if ($current_user->user_login=='dylanspurgin') {
            show_admin_bar(false);
        }
    }


    function my_theme_enqueue_styles() {
        $parent_style = 'parent-style';

        wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style',
            get_stylesheet_directory_uri() . '/style.css',
            array( $parent_style ),
            wp_get_theme()->get('Version')
        );
    }
    add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');


    // Add site lead-in
    function your_theme_new_customizer_settings($wp_customize) {
        // add a setting for the site logo
        $wp_customize->add_setting('site_leadin');
        // Add a control to upload the logo
        $wp_customize->add_control(
            new WP_Customize_Control(
                $wp_customize,
                'site_leadin',
                array(
                    'label' => 'Site Lead In',
                    'section' => 'title_tagline',
                    'settings' => 'site_leadin',
                    'type' => 'textarea'
                )
        ));
    }
    add_action('customize_register', 'your_theme_new_customizer_settings');


    function theme_footer_js() {
        wp_enqueue_script('themeFooterJs', get_stylesheet_directory_uri().'/js/x-footer.js', array('jquery'), '0.9.3', TRUE);
    }
    add_action('wp_enqueue_scripts', 'theme_footer_js');


    #-----------------------------------------------------------------#
    # Create admin portfolio section
    #-----------------------------------------------------------------#
    function portfolio_register2() {

    	 $portfolio_labels = array(
    	 	'name' => __( 'Portfolio', 'taxonomy general name', NECTAR_THEME_NAME),
    		'singular_name' => __( 'Portfolio Item', NECTAR_THEME_NAME),
    		'search_items' =>  __( 'Search Portfolio Items', NECTAR_THEME_NAME),
    		'all_items' => __( 'Portfolio', NECTAR_THEME_NAME),
    		'parent_item' => __( 'Parent Portfolio Item', NECTAR_THEME_NAME),
    		'edit_item' => __( 'Edit Portfolio Item', NECTAR_THEME_NAME),
    		'update_item' => __( 'Update Portfolio Item', NECTAR_THEME_NAME),
    		'add_new_item' => __( 'Add New Portfolio Item', NECTAR_THEME_NAME)
    	 );

    	 $options = get_option('salient');
         $custom_slug = null;

    	 if(!empty($options['portfolio_rewrite_slug'])) $custom_slug = $options['portfolio_rewrite_slug'];

    	 $portolfio_menu_icon = (floatval(get_bloginfo('version')) >= "3.8") ? 'dashicons-art' : NECTAR_FRAMEWORK_DIRECTORY . 'assets/img/icons/portfolio.png';

    	 $args = array(
    			'labels' => $portfolio_labels,
    			'rewrite' => array('slug' => $custom_slug,'with_front' => false),
    			'singular_label' => __('Project', NECTAR_THEME_NAME),
    			'public' => true,
    			'publicly_queryable' => true,
    			'show_ui' => true,
    			'hierarchical' => false,
    			'menu_position' => 9,
    			'menu_icon' => $portolfio_menu_icon,
    			'supports' => array('title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields')
           );

        register_post_type( 'portfolio' , $args );
    }
    add_action('init', 'portfolio_register2');


    #-----------------------------------------------------------------#
    # Portfolio Meta Override
    #-----------------------------------------------------------------#
    include("portfolio-meta-override.php");
?>
