<?php
/*
Plugin Name: AI-Asas inne och utelista
Description: Show an selected image and redirects to Asas inne och utelista.
Author: Joel Bernerman
Version: 0.1
*/

//main widget function
function asa_inne_ute_widget($args) {
    // extract the arg passed by theme
    extract($args);  

    // get option (picture url)
    $options = get_option("asa_inne_ute_picture_url_widget");

    //get latest inne-ute
    $myposts = get_posts('numberposts=1&category='. get_category_by_slug('inne-utelistan')->term_id .'&order=DESC&orderby=date');
    // get the latest list
    foreach( $myposts as $inne_post ) {
       $latest_inne_ute = $inne_post->guid;
    }
 
    // not sure if we need theese extracted args but it is said to be good for compability
// widget layout with img scr url set by options.
?>

<div class="r_side">
  <div id="inneutelista">
    <a title="Inne- och utelistan" href="<?php echo $latest_inne_ute?>">
    <img alt="Till Åsas kungliga inne- och utelista" src="<?php echo $options['asa_inne_ute_picture_url']; ?>" title="Till Åsas kungliga inne- och utelista"/></a>
  </div>
</div>

<?php
}

// Controlpanel function
function asa_inne_ute_control() {
    // get option
    $options = get_option("asa_inne_ute_picture_url_widget");
    // sets an message of not specified option
    if (!is_array( $options )){
        $options = array(
          'asa_inne_ute_picture_url' => ''
        );
    }

    // check whether post has occured.
    if ($_POST['asa_inne_ute_submit'])
    {
        // set option to selected image url.
        $options['asa_inne_ute_picture_url'] = htmlspecialchars($_POST['asa_inne_ute_picture']);
        // update our settings
        update_option("asa_inne_ute_picture_url_widget", $options);
    }
    ?>
        <p>
            <label for="asa-inne-ute-picture">Klipp ut "Fil URL" fr&aring;n mediabibioteket och skriv in här:</label><br>
	    <input type="text" id="asa_inne_ute_picture" name="asa_inne_ute_picture" size="80" value="<?php echo $options['asa_inne_ute_picture_url'] ?>" />
            <input type="hidden" id="asa_inne_ute_submit" name="asa_inne_ute_submit" value="1" />
        </p>
    <?php
}




// init the widget function
function init_asa_inne_ute(){
    register_sidebar_widget("Asas inne och utelista", "asa_inne_ute_widget");
    register_widget_control("Asas inne och utelista", "asa_inne_ute_control", 500, 200 );
}

// call at right action
add_action("plugins_loaded", "init_asa_inne_ute");

?>
