<?php

    define( 'ATTACHMENTS_SETTINGS_SCREEN', false ); // disable the Settings screen
    add_filter( 'attachments_default_instance', '__return_false' ); // disable the default instance

    function wh_register_team_headshots( $attachments ) {
        $args = array(
            'label'         => 'Headshots',
            'post_type'     => array( 'portfolio' ),
            'position'      => 'normal',
            'priority'      => 'high',
            'filetype'      => array('image'),
            'note'          => 'Add up to two team headshots here.',
            'append'        => true,
            'button_text'   => __( 'Attach Image', 'attachments' ),
            'modal_text'    => __( 'Attach', 'attachments' ),
            'router'        => 'browse',
            'post_parent'   => false,
            'fields'        => array(),
        );
        $attachments->register( 'wh_team_headshots', $args ); // unique instance name
    }

    add_action( 'attachments_register', 'wh_register_team_headshots' );
?>
