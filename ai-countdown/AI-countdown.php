<?php
/*
 * Plugin Name: AI-Countdown (for Victoria and daniels wedding). 
 * Description: Add a jQuery countdown function. And an imagemap for header picture making half of it href to the wedding category.
 * Author: Joel Bernerman
 * Version: 0.2
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



// all work is done by js and css files
// include js properly.
function countdown_init() {
    // no hardcoded plugindir allowed
    $folder = basename(dirname(__FILE__));
    wp_enqueue_script( 'countdown', WP_PLUGIN_URL . '/' . $folder  .'/js/countdown.js', array('jquery'));
}

// ínclude css properly
function countdown_add_stylesheet() {
    // no hardcoded plugindir allowed
    $folder = basename(dirname(__FILE__));
    $styleUrl = WP_PLUGIN_URL .'/'. $folder . '/css/style.css';
    $styleFile = WP_PLUGIN_DIR . '/'. $folder .'/css/style.css';
    if ( file_exists($styleFile) ) {
        wp_register_style('countdown', $styleUrl);
        wp_enqueue_style( 'countdown');
    }
}

// connect functions to actions.
add_action('wp_print_styles', 'countdown_add_stylesheet');
add_action('init', 'countdown_init');

?>
