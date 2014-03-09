<?php
/**
 * WordPress functions and definitions.
 *
 * Bootstraps the theme framework and creates the theme controller returned by peTheme() 
 *
 * @package WordPress
 * @subpackage Theme
 * @since 1.0
 */
?>
<?php

define("PE_THEME_NAME",'OneUp');

// bootstrap the framework
define("PE_THEME_PATH",dirname(__FILE__));
require("framework/php/boot.php");

// add the following part
add_filter("the_content_more_link","my_the_content_more_link",99);
function my_the_content_more_link($more) {
	return  sprintf('&nbsp;<a href="%s" class="read-more">%s</a>',get_permalink(),'more');
}

?>