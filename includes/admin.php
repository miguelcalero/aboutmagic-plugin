<?php
/* register menu item */
function aboutmagic_admin_menu_setup(){
	add_submenu_page(
 		'options-general.php',
 		'AboutMagic Settings',
 		'AboutMagic',
 		'manage_options',
 		'aboutmagic',
		'aboutmagic_admin_page_screen'
 );
}
add_action('admin_menu', 'aboutmagic_admin_menu_setup'); //menu setup

/* display page content */
function aboutmagic_admin_page_screen() {
 global $submenu;
// access page settings 
 $page_data = array();
 foreach($submenu['options-general.php'] as $i => $menu_item) {
 if($submenu['options-general.php'][$i][2] == 'aboutmagic')
 $page_data = $submenu['options-general.php'][$i];
 }

// output 
?>
<div class="wrap">
<?php screen_icon();?>
<h2><?php echo $page_data[3];?></h2>
<form id="aboutmagic_options" action="options.php" method="post">
<?php
settings_fields('aboutmagic_options');
do_settings_sections('aboutmagic'); 
submit_button('Save options', 'primary', 'aboutmagic_options_submit');
?>
 </form>
</div>
<?php
}
/* settings link in plugin management screen */
function aboutmagic_settings_link($actions, $file) {
if(false !== strpos($file, 'about-magic'))
 $actions['settings'] = '<a href="options-general.php?page=aboutmagic">Settings</a>';
return $actions; 
}
add_filter('plugin_action_links', 'aboutmagic_settings_link', 2, 2);




/* register settings */
function aboutmagic_settings_init(){

	register_setting(
 		'aboutmagic_options',
 		'aboutmagic_options',
 		'aboutmagic_options_validate'
 	);

	add_settings_section(
 		'aboutmagic_about',
 		'About.me Configuration', 
 		'aboutmagic_about_desc',
 		'aboutmagic'
 	);

	add_settings_field(
 		'aboutmagic_about_key',
 		'Key', 
 		'aboutmagic_about_keyfield',
 		'aboutmagic',
 		'aboutmagic_about'
	);

	add_settings_field(
 		'aboutmagic_about_profiles',
 		'Profiles (separated by commas)', 
 		'aboutmagic_about_profield',
 		'aboutmagic',
 		'aboutmagic_about'
  );

	add_settings_section(
 		'aboutmagic_layout',
 		'Layout Configuration', 
 		'aboutmagic_layout_desc',
 		'aboutmagic'
 	);

	add_settings_field(
 		'aboutmagic_layout_width',
 		'Total width in px', 
 		'aboutmagic_layout_widthfield',
 		'aboutmagic',
 		'aboutmagic_layout'
  );

	// Write here your about.me key as developer, find it in your profile
}

add_action('admin_init', 'aboutmagic_settings_init');

function aboutmagic_about_desc() {
	echo "<p>Enter your about.me developer Key and profiles separated by commas.</p>";
}

function aboutmagic_layout_desc() {
	echo "<p>Enter preferences about layout.</p>";
}

/* validate input */
function aboutmagic_options_validate($input){
// TODO: Validate key and profiles?
	return $input;

/* global $allowedposttags, $allowedrichhtml;
if(isset($input['authorbox_template']))
 $input['authorbox_template'] = wp_kses_post($input['authorbox_template']);
return $input;*/
}

/* description text */
/*
function aboutmagic_about_desc(){
echo "<p>Enter the template markup for author box using placeholders: [gauthor_name], [gauthor_url], [gauthor_desc] for name, URL and description of author correspondingly.</p>";
}
*/

/* filed output */
function aboutmagic_about_keyfield() {
 $options = get_option('aboutmagic_options');
 $about = (isset($options['about_key'])) ? $options['about_key'] : '';
 $about = esc_textarea($about); //sanitise output
?>
	<input type="text" id="about_key" name="aboutmagic_options[about_key]" value="<?php echo $about;?>"/>
<?php
}

function aboutmagic_about_profield() {
 $options = get_option('aboutmagic_options');
 $profiles = (isset($options['about_profiles'])) ? $options['about_profiles'] : '';
 $profiles = esc_textarea($profiles); //sanitise output
?>
	<input type="text" id="about_profiles" name="aboutmagic_options[about_profiles]" value="<?php echo $profiles;?>"/>
<?php
}

function aboutmagic_layout_widthfield() {
 $options = get_option('aboutmagic_options');
 $width = (isset($options['layout_width'])) ? $options['layout_width'] : '';
 $width = esc_textarea($width); //sanitise output
?>
	<input type="text" id="layout_width" name="aboutmagic_options[layout_width]" value="<?php echo $width;?>"/>
<?php
}
?>
