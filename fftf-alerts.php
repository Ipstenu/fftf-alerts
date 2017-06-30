<?php
/*
Plugin Name: FFTF Alerts
Plugin URI: https://halfelf.org/plugins/fftf-alerts
Description: Show Fight for the Future alerts on your website
Version: 1.0.0
Author: Mika Epstein (Ipstenu)
Author URI: https://halfelf.org
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: fftf-alerts

	Copyright 2017 Mika A. Epstein (email: ipstenu@halfelf.org)

	This file is part of FFTF Alerts, a plugin for WordPress.

	FFTF Alerts is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, version 3 of the License.

	FFTF Alerts is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	A copy of the Licence has been inlcuded in the plugin, but can also
	be downloaded at https://www.gnu.org/licenses/gpl-3.0.html	
	
*/

/*
 * class FFTF_Alerts
 *
 * Main class for plugin
 *
 * @since 1.0.0
 */

class FFTF_Alerts {

	protected static $version;
	protected static $settings;
	protected static $fights;

	/**
	 * Constructor
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_script' ) );

		// Create Defaults
		self::$version    = '1.0.0';
		$default_settings = array (
			'version'          => self::$version,
			'blackoutcongress' => false,
			'battleforthenet'  => false,
		);
		self::$settings   = get_option( 'fftf_alerts_options', $default_settings );
		self::$fights     = array ( 
			'blackoutcongress' => array( 
				'name'  => __( 'Blackout Congress', 'fftf-alerts' ),
				'date'  => 'Ongoing',
				'url'   => 'https://www.blackoutcongress.org',
				'js'    => 'https://www.blackoutcongress.org/detect.js',
				'debug' => 'fftf_redirectjs = { alwaysRedirect: true }',
			),
			'battleforthenet'  => array( 
				'name'  => __( 'Battle for the Net', 'fftf-alerts' ),
				'date'  => '2017-07-12',
				'url'   => 'https://www.battleforthenet.com/july12/',
				'js'    => 'https://widget.battleforthenet.com/widget.js',
				'debug' => '',
			),
		);
	}
	
	/**
	 * Admin Init
	 * @since 1.0.0
	 */
	public function admin_init() {
		$plugin = plugin_basename(__FILE__);
		add_filter( "plugin_action_links_$plugin", array( $this, 'add_settings_link' ) );
		add_filter( 'plugin_row_meta', array( $this, 'donate_link' ), 10, 2 );

	    // Register Settings
		$this->register_settings();
	}

	/**
	 * Enqueue Scripts
	 * @since 1.0.0
	 */
	public function wp_enqueue_script() {
		// Activate JS based on settings
		// If the setting is active, then display. Else, don't.
		foreach ( self::$settings as $setting => $value ) {
			if ( is_bool( $value ) && $value == true ) {
				wp_enqueue_script( $setting, self::$fights[ $setting ][ 'js' ], array( 'jquery' ), self::$version );
				
				// Debug mode, which doesn't ALWAYS work but that's their fault...
				if ( WP_DEBUG == true && self::$fights[ $setting ][ 'debug' ] !== '' ) {
					wp_add_inline_script( $setting, self::$fights[ $setting ][ 'debug' ] );
				}
			}
		}
	}

	/**
	 * Admin Menu Callback
	 *
	 * @since 1.0.0
	 */
    function admin_menu() {
		// Add settings page on Tools
		add_management_page( __( 'FFTF Alerts', 'fftf-alerts' ), __( 'FFTF Alerts', 'fftf-alerts' ), 'manage_options', 'fftf-alerts-settings', array( $this, 'fftfalert_settings' ) );
	}

	/**
	 * Register Admin Settings
	 *
	 * @since 1.0.0
	 */
    function register_settings() {
	    register_setting( 'fftf-alerts', 'fftf_alerts_options', array( $this, 'fftfalert_sanitize' ) );

		// The main section
		add_settings_section( 'fftfalert-fights', __( 'Pick Your Battles', 'fftf-alerts' ), array( $this, 'fftf_settings_callback' ), 'fftf-alerts-settings' );
		
		// The Field
		add_settings_field( 'fftfalert_settings_fields', __( 'Available Battles to Fight', 'fftf-alerts' ), array( $this, 'fftf_settings_fields_callback' ), 'fftf-alerts-settings', 'fftfalert-fights' );
	}

	/**
	 * Settings Callback
	 *
	 * @since 1.0.0
	 */
	function fftf_settings_callback() {
	    ?>
	    <p><?php _e( 'To activate an alert for a fight, click the checkbox and save your settings.', 'fftf-alerts' ); ?></p>
	    <?php
	}

	/**
	 * Each Settings Callback
	 *
	 * @since 1.0.0
	 */
	function fftf_settings_fields_callback() {

		foreach ( self::$settings as $setting => $value ) {
			if ( is_bool( $value ) ) {	
				$fight   = self::$fights[ $setting ];
				
				$date = ( strtotime( $fight['date'] ) == false )? $fight['date'] : date_i18n( get_option( 'date_format' ), strtotime( $fight['date'] ) ); 
				
				?>
				<p><input type="checkbox" id="fftf_alerts_options[<?php echo $setting; ?>]" name="fftf_alerts_options[<?php echo $setting; ?>]" value="1" <?php echo checked( 1, $value ); ?> >
				<label for="fftf_alerts_options[<?php echo $setting; ?>]"><a href="<?php echo $fight['url']; ?>" target="_blank"><?php echo $fight['name']; ?></a> - <?php echo $date; ?></label></p>
				<?php
			}
		}
	}

	/**
	 * Options sanitization and validation
	 *
	 * @param $input the input to be sanitized
	 * @since 1.0.0
	 */
	function fftfalert_sanitize( $input ) {

		$options = self::$settings;

		foreach ( $options as $setting => $value ) {	
			
			$output[ $setting ] = false;
			if ( isset( $input[ $setting ] ) && $input[ $setting ] == true ) $output[ $setting ] = true;

		}

        $output[ 'version' ] = $options[ 'version' ];

		return $output;
	}
	
	/**
	 * donate link on manage plugin page
	 * @since 1.0.0
	 */
	function donate_link( $links, $file ) {
		if ($file == plugin_basename(__FILE__)) {
    		$donate_link = '<a href="https://store.halfelf.org/donate/">' . __( 'Donate', 'fftf-alerts' ) . '</a>';
    		$links[] = $donate_link;
        }
        return $links;
	}
	
	/**
	 * Call settings page
	 *
	 * @since 1.0
	 */
	function fftfalert_settings() {
		?>
		<div class="wrap">

			<h1><?php _e( 'Fight for the Future Alerts', 'fftf-alerts' ); ?></h1>
			
			<p><?php echo sprintf( __( '<a href="%1$s">Fight for the Future</a> is dedicated to protecting and expanding the Internet’s transformative power in our lives by creating civic campaigns that are engaging for millions of people.', 'fftf-alerts' ), 'https://fightforthefuture.org' ); ?></p>

			<p><?php _e( 'By default, modals will only display on their designated days. This is by design of Fight for the Future, and not a function of this plugin. If a fight is ongoing, it will always run.', 'fftf-alerts' ); ?></p>
			
			<?php settings_errors(); ?>
			
			<form action="options.php" method="POST" ><?php
				settings_fields( 'fftf-alerts' );
				do_settings_sections( 'fftf-alerts-settings' );
				submit_button( '', 'primary', 'update');
			?>
			</form>
		</div>

		<?php
	}

	/**
	 * Add settings link on plugin
	 *
	 * @since 1.0.0
	 */
	function add_settings_link( $links ) {
		$settings_link = '<a href="' . admin_url( 'tools.php?page=fftf-alerts-settings' ) .'">' . __( 'Settings', 'fftf-alerts' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

}

new FFTF_Alerts();