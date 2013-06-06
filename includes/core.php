<?php

// check for namespacing collision
if( !class_exists( 'superAboutMagic' ) ) : 
class superAboutMagic {
	// CONSTRUCTOR
	function __construct() {
		//add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ) ); // load i18n
		add_shortcode( 'aboutmagic', array( &$this, 'shortcode' ) ); // register shortcode
	}

	function getPlatform($websites, $platform) {
		$images['twitter'] = home_url() . '/wp-content/plugins/aboutmagic-plugin/assets/img/socialicons/Twitter.png';
		$images['facebook'] = home_url() . '/wp-content/plugins/aboutmagic-plugin/assets/img/socialicons/Facebook.png';
		$images['linkedin'] = home_url() . '/wp-content/plugins/aboutmagic-plugin/assets/img/socialicons/LinkedIn.png';
		$images['wordpress'] = home_url() . '/wp-content/plugins/aboutmagic-master/assets/img/socialicons/WordPress.png';
		$images['googleplus'] = home_url() . '/wp-content/plugins/aboutmagic-master/assets/img/socialicons/Google.png';

		$site = '';
		foreach($websites as $web) {
			if ($web['platform'] == $platform) $site = $web['site_url'];
		}
		if ($site == '') return '';
		$html = '<a href="'.$site.'"><img width="30px" src="';
		$html .= $images[$platform];
		$html .= '"></a>';
		return $html;
	}
	
	// SHORTCODE
	function shortcode() {
		include(ABOUTMAGIC_DIR."vendor/autoload.php");
		include(ABOUTMAGIC_DIR."includes/layout.php");
//		return "."
		//return "HOLA MUNDO";
		$options = get_option('aboutmagic_options');
		$width = (isset($options['layout_width'])) ? $options['layout_width'] : '800px';

		$html .= '<div id="message-aboutmagic">Cargando perfiles, espere por favor... <span id="time-aboutmagic"></span></div>';
		$html .= '<div id="content-aboutmagic" style="display:none">';

		$options = get_option('aboutmagic_options');
		$ops['about_key'] = (isset($options['about_key'])) ? $options['about_key'] : '';
		$ops['cache_time'] = 14400;
		$ops['dir'] = ABOUTMAGIC_DIR . "cache/profiles/";
		$ops['fx'] = "sepia";

		$nicknames = (isset($options['about_profiles'])) ? $options['about_profiles'] : '';

		$aboutmagicservice = new \Sopinet\Aboutmagic\AboutMagicService();
		$profiles = $aboutmagicservice->getProfiles($nicknames, $ops);

	foreach($profiles as $profile) {
		if ($_GET['ok'] == 'print') {
			echo '<pre>';
			print_r($profile);
			echo '</pre>';
		}
			
			$img_avatar = ABOUTMAGIC_URL . "/cache/profiles/".$profile['avatarOK'];

$html .= '<div class="mosaic-god">';
$html .= '<div class="mosaic-block cover">';

	$html .= '<div class="mosaic-overlay">';
		$html .= '<div class="details">';
			$html .= '<span class="detupper">'.$profile['first_name'].' '.$profile['last_name'].'</span>';
		$html .= '</div>';
		$html .= '<div class="image_inside">';
			$html .= '<img height="155px" src="'.$img_avatar.'"/>';
		$html .= '</div>';
	$html .= '</div>';
	$html .= '<a href="http://about.me/'.$profile['user_name'].'" target="_blank" class="mosaic-full">';
		$html .= '<div class="mosaic-backdrop">';
		$html .= '<div class="details">';
		$html .= '<b><span class="detupper">'.$profile['first_name'].' '.$profile['last_name'].'</span></b>';

if ($profile['header'] != "") {
		$html .= '<br/>';
		$html .= '<i>'.$profile['header'].'</i>';
					}
		$html .= '<p>'.$profile['bio'].'</p>';
if (count($profile['tags']) != 0) {
		foreach($profile['tags'] as $pr) {
			$html .= '<u>'.$pr.'</u> ';
		}
	}
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</a>';

$html .= '</div>';

	$html .= '<div class="mosaic-links">';
	$html .= $this->getPlatform($profile['websites'],'twitter');
	$html .= $this->getPlatform($profile['websites'],'linkedin');
	$html .= $this->getPlatform($profile['websites'],'wordpress');
	$html .= $this->getPlatform($profile['websites'],'facebook');
	$html .= $this->getPlatform($profile['websites'],'googleplus');

	$html .= '</div>';


$html .= '</div>';

//$html .= '<div>RRSS</div>';
}
$html .= '<div class="clearfix"></div>';
$html .= '</div>';

$html .= '<br/><br/><p>powered by <a href="https://github.com/sopinet/aboutmagic-plugin" target="_blank">aboutmagic-plugin</a></p>';

		return $html;

		include(ABOUTMAGIC_DIR."includes/layout.php");
		return;
	}
}

endif; // end collision check

new superAboutMagic;
?>
