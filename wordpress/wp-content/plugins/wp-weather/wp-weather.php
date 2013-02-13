<?php
/*
Plugin Name: WP-Weather
Description: Display current weather conditions with Weather Underground and IPinfoDB
Version: 1.0
Author: Jason Corradino
Author URI: http://imyourdeveloper.com
License: GPL2

Copyright 2012  Jason Corradino  (email : Jason@ididntbreak.it)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

include_once("wp-weather-widget.php");

class WP_Weather_Admin {
	/**
	 * Initializes Facebook Importer admin functionality
	 *
	 * @author Jason Corradino
	 *
	 */
	function init() {
		add_action('admin_init', array(__CLASS__, "plugin_init"));
		add_action('admin_menu', array(__CLASS__, "setup_pages"));
	}
	
	/**
	 * Initializes the plugin settings pages and fields on admin_init
	 *
	 * @author Jason Corradino
	 *
	 */
	function plugin_init() {
		if ($_GET['page'] == 'wp_weather') {
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_register_script('wp-weather-script', WP_PLUGIN_URL.'/wp-weather/assets/wp-weather.js', array('jquery','media-upload','thickbox'));
			wp_enqueue_script('wp-weather-script');
			wp_register_style( 'wp-weather-style', WP_PLUGIN_URL.'/wp-weather/assets/wp-weather-sprite-template.css');
			wp_enqueue_style( 'wp-weather-style' );
		};
		register_setting( 'wp_weather_options', 'wp_weather_options', array(__CLASS__, "validate_fields"));
		add_settings_section('weather_underground_api', 'Weather Underground API', array(__CLASS__, "wunderground_api_text"), 'wp_weather');
		add_settings_field('weather_underground_api_field', 'API Key', array(__CLASS__, "wunderground_api_textbox"), 'wp_weather', 'weather_underground_api');
		add_settings_section('ipinfodb_api', 'IPinfoDB API', array(__CLASS__, "ipinfodb_api_text"), 'wp_weather');
		add_settings_field('ipinfodb_api_field', 'API Key', array(__CLASS__, "ipinfodb_api_textbox"), 'wp_weather', 'ipinfodb_api');
		add_settings_section('image_select', 'Imageset', array(__CLASS__, "image_select_text"), 'wp_weather');
		add_settings_field('image_select_field', 'Select Imageset', array(__CLASS__, "image_select_checkboxes"), 'wp_weather', 'image_select');
		add_settings_section('image_select_custom', '', array(__CLASS__, "image_select_text_custom"), 'wp_weather');
		add_settings_field('image_select_custom_field', 'Upload Custom Sprite', array(__CLASS__, "image_select_checkboxes_custom"), 'wp_weather', 'image_select');
	}
	
	/**
	 * Validates and saves option information
	 *
	 * @author Jason Corradino
	 *
	 */
	function validate_fields() {
		$options = get_option('wp_weather_options');
		
		if ($options['imageset_sprite'] != $_POST['upload_image']) {
			$conditions = array("chanceflurries","chancerain","chancesleet","chancesnow","chancetstorms","clear","cloudy","flurries","fog","hazy","mostlycloudy","mostlysunny","partlycloudy","partlysunny","sleet","rain","snow","sunny","tstorms");
			foreach ($conditions as $condition) {
				if ($out != "") {$out .= ", ";}
				$out .= ".weather_$condition";
			}
			$out .= " {background-image: url({$_POST['upload_image']});}\n";
			$css = file_get_contents(plugin_dir_path(__FILE__).'assets/wp-weather-sprite-template.css');
			$out .= $css;
			file_put_contents(plugin_dir_path(__FILE__).'assets/wp-weather.css', $out);
		}
		
		return array(
			"wunderground_api" => $_POST['weather_underground_api_field'],
			"ipinfodb_api" => $_POST['ipinfodb_api_field'],
			"imageset" => $_POST['imageset'],
			"imageset_sprite" => $_POST['upload_image']
		);
	}
	
	/**
	 * Sets text to display on options page above profile selection
	 *
	 * @author Jason Corradino
	 *
	 */
	function wunderground_api_text() {
		echo '<p>Your Weather Underground API key, can be found <a href="http://www.wunderground.com/weather/api/">here</a>.</p>';
		return true;
	}

	/**
	 * Sets text to display on options page next to profile selection
	 *
	 * @author Jason Corradino
	 *
	 */
	function wunderground_api_textbox() {
		$options = get_option('wp_weather_options');
		echo '<input type="text" name="weather_underground_api_field" id="wunderground-api" value="'.$options['wunderground_api'].'" />';
	}
	
	
	/**
	 * Sets text to display on options page above profile selection
	 *
	 * @author Jason Corradino
	 *
	 */
	function ipinfodb_api_text() {
		echo '<p>Your IPinfoDB API key, can be found <a href="http://ipinfodb.com/ip_location_api.php">here</a>.</p>';
		return true;
	}

	/**
	 * Sets text to display on options page next to profile selection
	 *
	 * @author Jason Corradino
	 *
	 */
	function ipinfodb_api_textbox() {
		$options = get_option('wp_weather_options');
		echo '<input type="text" name="ipinfodb_api_field" id="ipinfodb-api" value="'.$options['ipinfodb_api'].'" />';
	}
	
	/**
	 * Sets text to display on options page above profile selection
	 *
	 * @author Jason Corradino
	 *
	 */
	function image_select_text() {
		echo '<p>These are the imagesets available, select the one you would like to use, or submit your own.</p>';
		return true;
	}

	/**
	 * Sets text to display on options page next to profile selection
	 *
	 * @author Jason Corradino
	 *
	 */
	function image_select_checkboxes() {
		$options = get_option('wp_weather_options');
		if ($options['imageset'] == "") {
			$options['imageset'] = "k";
		}
		$conditions = array("chanceflurries","chancerain","chancesleet","chancesnow","chancetstorms","clear","cloudy","flurries","fog","hazy","mostlycloudy","mostlysunny","partlycloudy","partlysunny","sleet","rain","snow","sunny","tstorms");
		$image_sets = range("a", "k");
		echo '
		<style>
			.imageset {
				float: left;
				clear: both;
				margin-bottom: 20px;
				border: 1px solid #cccccc;
				background-color: #ececec;
				padding: 10px 10px 2px 10px;
			}
			.imageset input {
				float: left;
				margin: 50px 12px 0 6px;
			}
			.imageset .images {
				width: 525px;
				float: left;
			}
			.imageset .images img {
				margin: 5px;
			}
			.imageset #upload_image_button {
				margin: 0 5px 10px 0;
			}
			.imageset .weather_sprite_icon {
				width: 42px;
				height: 42px;
				float: left;
				margin: 7px 4px 7px 4px;
			}
		</style>
		';
		foreach ($image_sets as $image_set) {
			echo "<section class='imageset'><input type='radio' name='imageset' value='$image_set' ";
			if ($options['imageset'] == $image_set) {
				echo "checked='checked'";
			}
			echo "><div class='images'>";
				foreach ($conditions as $condition) {
					echo "<img src='http://icons-ak.wxug.com/i/c/$image_set/$condition.gif' height='42' />";
				}
			echo '</div></section>';
		}
	}
	function image_select_text_custom () {
		return true;
	}
	function image_select_checkboxes_custom () {
		$options = get_option('wp_weather_options');
		$conditions = array("chanceflurries","chancerain","chancesleet","chancesnow","chancetstorms","clear","cloudy","flurries","fog","hazy","mostlycloudy","mostlysunny","partlycloudy","partlysunny","sleet","rain","snow","sunny","tstorms");
		echo '
			<section class="imageset">
			<input type="radio" name="imageset" value="customSprite"';
			if ($options['imageset'] == "customSprite") {
				echo "checked='checked'";
			}
		echo '><div class="images">
			<div class="imageUploader">
		';
		foreach ($conditions as $condition) {
			echo '<div class="weather_'.$condition.' weather_sprite_icon" style="background-image:url(';
			echo ($options['imageset_sprite'] != "") ? $options['imageset_sprite'] : WP_PLUGIN_URL."/wp-weather/assets/wp-weather-sprite.png";
			echo ');"></div>';
		}
		echo '
			</div>
			<label for="upload_image" style="clear: both; float: left;">
				<input id="upload_image" type="hidden" name="upload_image" value="" />
				<input id="upload_image_button" type="button" value="Upload New Sprite" />
				<small>Click "Insert into Post" to set, use <a href="'.WP_PLUGIN_URL.'/wp-weather/assets/wp-weather-sprite.png" target="_blank">default sprite</a> as a template</small>
			</label>
			</div>
			</section>
		';
	}
	
	/**
	 * Creates the "Wall Content" menu item and removes "add new" photo
	 *
	 * @author Jason Corradino
	 *
	 */
	function setup_pages() {
		add_options_page('WP Weather', 'WP Weather', 'manage_options', 'wp_weather', array(__CLASS__, "plugin_options"));
	}
	
	/**
	 * Sets up options page
	 *
	 * @author Jason Corradino
	 *
	 */
	function plugin_options() {
		?>
			<div class="wrap">
				<div id="icon-edit" class="icon32 icon32-posts-facebook_images">
					<br>
				</div>
				<h2>WP Weather Settings</h2>
				<form action="options.php" method="post" id="facebookGalleryForm">
					<p><input name="Submit" type="submit" class="facebookGallerySubmit" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
					<?php settings_fields('wp_weather_options'); ?>
					<?php do_settings_sections('wp_weather'); ?>
					<p><input name="Submit" type="submit" class="facebookGallerySubmit" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
				</form>
			</div>
		<?php
	}
}

class WP_Weather {
	function get_current_conditions($zip="") {
		$user = get_current_user_id();
		$city  = get_user_meta( $user, 'user_city', true );
		$state = get_user_meta( $user, 'user_state', true );
		if ($zip != "") { // use pre-set zip
			$transient = get_transient("conditions-$zip");
			if ($transient == "") {
				$conditions = $this->wunderground_api($zip);
				set_transient("conditions-$zip", $conditions, 900);
			} else {
				$conditions = $transient;
			}
		} elseif  ($city != "" && $state != "") { // use user state/city
			$transient = get_transient("conditions-$city-$state");
			if ($transient == "") {
				$contions = $this->wunderground_api("$state/$city");
				set_transient("conditions-$city-$state", $conditions, 900);
			} else {
				$conditions = $transient;
			}
		} else { // lookup weather based on IP location
			$location = $this->location_api();
			if ($location->statusCode == "OK") {
				$coords['lon'] = $location->longitude;
				$coords['lat'] = $location->latitude;
				$locationCode = ($location->zipCode != "" && $location->zipCode != "-") ? $location->zipCode : "{$location->countryCode}-{$location->cityName}";
				$transient = get_transient("conditions-$locationCode");
				if ($transient == "") {
					$conditions = $this->wunderground_api("{$coords['lat']},{$coords['lon']}");
					set_transient("conditions-$locationCode", $conditions, 900);
				} else {
					$conditions = $transient;
				}
			}
		}
		
		if ($conditions != "") {
			return $conditions;
		} else {
			return false;
		}
	}
	
	function location_api() {
		$options = get_option('wp_weather_options');
		//$uri = 'http://api.ipinfodb.com/v3/ip-city/?key='.$options["ipinfodb_api"].'&format=xml&ip='.$_SERVER['REMOTE_ADDR'];
		//$uri = 'http://api.ipinfodb.com/v3/ip-city/?key='.$options["ipinfodb_api"].'&format=xml&ip=141.101.116.82'; // London
		//$uri = 'http://api.ipinfodb.com/v3/ip-city/?key='.$options["ipinfodb_api"].'&format=xml&ip=98.226.88.41'; // Midlothian
		$uri = 'http://api.ipinfodb.com/v3/ip-city/?key='.$options["ipinfodb_api"].'&format=xml&ip=12.34.4.33'; // Chicago
		$data = $this->get_data($uri);
		if(substr_count($data,'ode>ERROR') ){
			return false;
		} else {
			$location = simplexml_load_string($data);
		}
		return $location;
	}
	
	function wunderground_api($query) {
		$options = get_option('wp_weather_options');
		$uri = "http://api.wunderground.com/api/{$options['wunderground_api']}/conditions/q/$query.json";
		$data = json_decode($this->get_data($uri));
		if ($data->response->error != "") {
			return false;
		} else {
			return $data;
		}
	}
	
	function get_data($uri, $timeout=2) {
		if($timeout==0 or !$timeout){$timeout=2;}
		if(ini_get('allow_url_fopen')) {
			$opts = array('http' => array('timeout' => $timeout));
			$context  = stream_context_create($opts);
			$return = @file_get_contents($uri,false,$context);
		} else {
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $uri);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_TIMEOUT, $timeout);
			$return = @curl_exec($ch);
			curl_close($ch);
		}
		return $return;
	}
}

if (is_admin()) {
	WP_Weather_Admin::init();
}
?>