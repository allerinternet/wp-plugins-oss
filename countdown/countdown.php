<?php
/*
Plugin Name: Countdown (for Victoria and daniels wedding)
Description: Add a jQuery countdown function.
Author: Joel Bernerman
Version: 0.1
*/


function countdown_init() {
    wp_enqueue_script( 'countdown', WP_PLUGIN_URL.'/countdown/js/countdown.js', array('jquery'));
}

function countdown_add_stylesheet() {
    $styleUrl = WP_PLUGIN_URL . '/countdown/css/style.css';
    $styleFile = WP_PLUGIN_DIR . '/countdown/css/style.css';
    if ( file_exists($styleFile) ) {
        wp_register_style('countdown', $styleUrl);
        wp_enqueue_style( 'countdown');
    }
}

add_action('wp_print_styles', 'countdown_add_stylesheet');
add_action('init', 'countdown_init');

?>
