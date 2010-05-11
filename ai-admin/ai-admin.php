<?php 
/* 
Plugin Name: AI Admin 
Plugin URI: http://allerinternet.se 
Description: Administrative tools for Aller Internet
Version: 0.2
Author: Kristian Erendi, Aller Internet
Author URI: http://allerinternet.se
*/  
global $wp_version;
$exit_msg = 'AI admin requires  WordPress MU 2.8.4a  or newer <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update</a>';

if (version_compare($wp_version, "2.8.4", "<")) {
	exit($exit_msg);
}

require_once 'Stats.php';
require_once 'DataStore.php';

$dataStore = new DataStore();
add_action('wp_footer', 'ai_print');



/**
 * Starts a statistics collection
 *
 * @return an instance of the Stats class
 * @author Aller Internet, Kristian Erendi
 */
function ai_stats_start(){
  $stats = new Stats();
  return $stats;
}

/**
 * Prints stats on web-page as an html comment
 *
 * @param string $stats  the Stats instance you got when you called ai_stats_start()
 * @param string $msg    the message which function you have been meassuring
 * @return void
 * @author Aller Internet, Kristian Erendi
 */
function ai_stats_print($stats, $msg){
  global $dataStore;
  $stats->storeDifference();
  $buf  = "\n<!--\n";
  $buf .= "AI-Admin ".$msg." \n";
  $buf .= "Memory used: $stats->memUsedFmted bytes\n";
  $buf .= "Time spent: $stats->timeSpent seconds\n";
  $buf .= "-->\n";
  $dataStore->addText($buf);
}


function ai_print(){
  global $dataStore;  
  echo $dataStore->storedText();
}



?>