<?php
/*
 * Plugin Name: Countdown (for Victoria and daniels wedding)
 * Description: Add a jQuery countdown function.
 * Author: Joel Bernerman
 * Version: 0.1
 *
 *
 * Copyright 2010 Aller Internet
 *
 * Licensed under the EUPL, Version 1.1 or â~@~S as soon they will be approved
 * by the European Commission - subsequent versions of the EUPL (the "Licence");
 * You may not use this work except in compliance with the Licence.
 * You may obtain a copy of the Licence at: http://ec.europa.eu/idabc/eupl
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the Licence is distributed on an "AS IS" basis, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *
 * See the Licence for the specific language governing permissions and
 * limitations under the Licence.
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
