<?php
/*
Plugin Name: Twitter Auto Linker
Plugin URI: http://bitsolar.com/2009/02/22/releasing-twitter-auto-linker-version-10/
Description: Turns @<twitter user name> into clickable links! Just activate and enjoy.
Author: Anthony Crognale (BitSolar)
Author URI: http://bitsolar.com
Version: 1.0
*/

register_activation_hook(__FILE__, 'Twitter_Auto_Linker_activate');
register_deactivation_hook(__FILE__, 'Twitter_Auto_Linker_deactivate');

/*function Twitter_Auto_Linker_activate () {
	
}
function Twitter_Auto_Linker_activate () {

}*/
function Twitter_Auto_Linker_findTweets ($postText) {
	global $tweeters;
	$pattern = '/[@][a-zA-Z0-9]{1,}/';
	preg_match($pattern, $postText, $tweeters);
	foreach($tweeters as $tweeter) {
		$tweeterNew = preg_replace("/@/","",$tweeter);
		$postText = str_ireplace($tweeter, '@<a href="http://twitter.com/'.$tweeterNew.'">'.$tweeterNew.'</a>', $postText);
	}
	return $postText;
}
add_filter('the_content','Twitter_Auto_Linker_findTweets');
?>