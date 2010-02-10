<?php
/*
 * Plugin name: Aller GA
 * Version: 0.2
 * Plugin URI: http://github.com/allerinternet/wp-plugins-oss/
 * Description: Adds javascript code for Google Analytics on a WP-site.
 * Author: Jonas Björk, jonas.bjork@aller.se
 *
 * Copyright 2010 Aller Internet
 *
 * Licensed under the EUPL, Version 1.1 or – as soon they will be approved 
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

add_option('aller-ga-enabled', false);
add_option('aller-ga-uid', '');

add_action('wp_head', 'aller_ga', 1);
add_action('admin_menu', 'aller_ga_menu');

function aller_ga() {

	if( get_option('aller-ga-enabled') ) {
		$uid = stripslashes(get_option('aller-ga-uid'));
		
		echo "<script type=\"text/javascript\">\n";
		echo "var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");\n";
		echo "document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));\n";
		echo "</script>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "try {\n";
		echo "\tvar pageTracker = _gat._getTracker(\"".$uid."\");\n";
		echo "\tpageTracker._trackPageview();\n";
		echo "} catch(err) {}</script>\n";
	}
} // aller_ga

function aller_ga_menu() {
	
	if( function_exists('add_management_page') ) {
		add_management_page('Aller GA', 'Aller GA', 'administrator', 'aller_ga', 'aller_ga_options' );
	}
	
} // aller_ga_menu

function aller_ga_options() {
	
	if( $_POST['aller-ga-submit'] ) {

		update_option( 'aller-ga-enabled', $_POST['aller-ga-enabled'] );
		update_option( 'aller-ga-uid', $_POST['aller-ga-uid'] );
		 
	}
	
	echo '<div class="wrap">';
	echo '<h2>Aller Google Analytics</h2>';
?>
<div>
<fieldset>
<form name="aller_ga_options_form" method="post" action="">
	<p>
		<input type="checkbox" name="aller-ga-enabled" id="aller-ga-enabled" value="1"" <?php echo checked( true, get_option('aller-ga-enabled') ); ?>" />
		<label for="aller-ga-enabled">Använd Aller Google Analytics</label>
	</p>
	<p>
		<label for="aller-ga-uid">UA-nummer:</label>
		<input type="text" name="aller-ga-uid" id="aller-ga-uid" value="<?php echo get_option('aller-ga-uid'); ?>" />
	</p>
	<p><em>Id för webbsida, som informellt kallas för UA-nummer, hittar du om du klickar på länken "kontrollera status" eller om du söker efter "UA-" i webbsidans källkod. Id för webbsida innehåller två delar: X (UA-XXXXX-YY) motsvarar ditt kontonummer och Y (UA-XXXXXX-YY) motsvarar profilnummer i ditt konto. Den fullständiga strängen (UA-XXXXX-YY) betyder samma sak som id för webbsida eller UA-nummer.</em></p>
</fieldset>
	<p><input type="submit" name="aller-ga-submit" value="Spara" /></p>	
</form>
</div>
<?

} // aller_ga_options()

?>