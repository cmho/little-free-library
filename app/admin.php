<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {
    // Add postMessage support
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial('blogname', [
        'selector' => '.brand',
        'render_callback' => function () {
            bloginfo('name');
        }
    ]);
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
    wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});

function upload_file() {
    $ret = 0;
    if (isset($_POST)) {
        $attachment_id = media_handle_upload('file', 0);
        $ret = $attachment_id;
        $tags = array_map(
            function ($x) {
                return trim($x);
            },
            explode(",", $_POST['tags'])
        );
        if ($attachment_id) {
            wp_update_post(array(
                'ID' => $attachment_id,
                'post_title' => htmlspecialchars($_POST['title']),
                'meta_input' => array(
                    'author' => htmlspecialchars($_POST['author']),
                    'uploaded_by' => htmlspecialchars($_POST['uploaded_by'])
                )
            ));
            wp_set_object_terms($attachment_id, $tags, 'attachment_tag', true);
        }
    }

    if ($ret) {
        header('Location:'.get_the_permalink($attachment_id));
    } else {
        header('Location:'.$_SERVER['REFERRER']);
    }
}

add_action('admin_post_upload_file', __NAMESPACE__.'\\upload_file');
