<?php

    add_action( 'after_setup_theme', 'salient_second_child_page_actions', 0 );

    function salient_second_child_page_actions () {
        add_action('add_meta_boxes', 'salient_second_child_page_hero_meta');
    }

    function salient_second_child_page_hero_meta () {
        $meta_box = array(
    		'id' => 'nectar-metabox-page-video',
    		'title' => 'Hero Video Settings',
    		'description' => 'If you have a video, please fill out the fields below.',
    		'post_type' => 'page',
    		'context' => 'normal',
    		'priority' => 'high',
    		'fields' => array(
    			array(
    					'name' => 'MP4 File URL',
    					'desc' => 'Please upload the .mp4 video file. <br/><strong>You must include both formats.</strong>',
    					'id' => '_wh_hero_video_mp4',
    					'type' => 'media',
    					'std' => ''
    				),
    			array(
    					'name' => 'WebM File URL',
    					'desc' => 'Please upload the .webm video file. <br/><strong>You must include both formats.</strong>',
    					'id' => '_wh_hero_video_webm',
    					'type' => 'media',
    					'std' => ''
    				),
    			array(
    					'name' => 'Hero / Preview Image',
    					'desc' => 'Will be shown before video loads or if no video is specified. Image should be at least 680px wide. Click the "Upload" button to begin uploading your image, followed by "Select File" once you have made your selection. Only applies to self hosted videos.',
    					'id' => '_wh_hero_video_poster',
    					'type' => 'file',
    					'std' => ''
    				)
    		)
    	);
        $callback = create_function( '$post,$meta_box', 'nectar_create_meta_box( $post, $meta_box["args"] );' );
    	add_meta_box( $meta_box['id'], $meta_box['title'], $callback, $meta_box['post_type'], $meta_box['context'], $meta_box['priority'], $meta_box );

    }

?>
