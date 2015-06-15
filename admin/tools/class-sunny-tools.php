<?php

/**
 *
 * @package    Sunny
 * @subpackage Sunny/admin/tools
 * @author     Tang Rufus <rufus@wphuman.com>
 * @since  	   1.4.0
 */
class Sunny_Tools {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.4.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The array of plugin settings.
	 *
	 * @since    1.4.0
	 * @access   private
	 * @var      array     $registered_tools    The array of plugin settings.
	 */
	private $registered_tools;

	/**
	 * The callback helper to render HTML elements for settings forms.
	 *
	 * @since    1.4.0
	 * @access   protected
	 * @var      Sunny_Callback_Helper    $callback    Render HTML elements.
	 */
	protected $callback;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.4.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name ) {

		$this->plugin_name = $plugin_name;
		$this->registered_tools = $this->set_registered_tools();

		if ( ! class_exists( 'Sunny_Callback_Helper' ) ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'settings/class-sunny-callback-helper.php';
		}
		$this->callback = new Sunny_Callback_Helper( $this->plugin_name );

	}

	/**
	 * Register all settings sections and fields.
	 *
	 * @since 	1.4.0
	 * @return 	void
	*/
	public function add_meta_boxes() {

		foreach( $this->registered_tools as $tool ) {

			/**
			 * First, we register a section. This is necessary since all future settings must belong to one.
			 */
			// add_meta_box( $id, $title, $callback, $post_type, $context, $priority, $callback_args );
			add_meta_box(
				'sunny_tools_box_' . $tool['id'],	// Meta box ID
				$tool['title'],						// Meta box Title
				array( $this, 'render_meta_box' ),	// Callback defining the plugin's innards
				'sunny_settings_tools',				// Screen to which to add the meta box
				'normal',							// Context
				'default',							// $priority
				array(
					'id' 		=> $tool['id'],
					'action' 	=> $tool['action'],
					'desc' 		=> $tool['desc'],
					'btn_text' 	=> isset( $tool['btn_text'] ) ? $tool['btn_text'] : __( 'Go', $this->plugin_name ),
					)
				);


			// add_settings_section( $id, $title, $callback, $page )
			add_settings_section(
				'sunny_tools_' . $tool['id'],
				__return_null(),
				'__return_false',
				'sunny_tools_' . $tool['id']
				);

			if ( ! isset( $tool['settings'] ) ) {

				continue;

			}

			// Then, we register all fields. Each field represents an element in the array.
			foreach ( $tool['settings'] as $option ) {

				$_name = isset( $option['name'] ) ? $option['name'] : '';

				// add_settings_field( $id, $title, $callback, $page, $section, $args )
				add_settings_field(
					'sunny_tools[' . $option['id'] . ']',
					$_name,
					method_exists( $this->callback, $option['type'] . '_callback' ) ? array( $this->callback, $option['type'] . '_callback' ) : array( $this->callback, 'missing_callback' ),
					'sunny_tools_' . $tool['id'],
					'sunny_tools_' . $tool['id'],
					array(
						'id'      => isset( $option['id'] ) ? $option['id'] : null,
						'desc'    => !empty( $option['desc'] ) ? $option['desc'] : '',
						'name'    => isset( $option['name'] ) ? $option['name'] : null,
						'size'    => isset( $option['size'] ) ? $option['size'] : null,
						'options' => isset( $option['options'] ) ? $option['options'] : '',
						'std'     => isset( $option['std'] ) ? $option['std'] : ''
						)
					);

			} // end foreach

		} // end foreach

	}

	/**
	 * Set the array of plugin settings
	 *
	 * @since 	1.4.0
	 * @return 	array 	$settings
	*/
	private function set_registered_tools() {

	/**
	 * 'Whitelisted' Sunny settings, filters are provided for each settings
	 * section to allow extensions and other plugins to add their own settings
	 */
	$tools[] = array(
		'id' 		=> 'connection_tester',
		'title' 	=> __( 'Test Connection', $this->plugin_name ),
		'action' 	=> 'sunny_connection_test',
		'btn_text' 	=> __( 'Test Connection', $this->plugin_name ),
		'desc'		=> __( "To check if <code>Sunny</code> can connect to CloudFlare's server. <a href='https://www.wphuman.com/make-cloudflare-supercharge-wordpress-sites/?utm_source=sunny&utm_medium=plugins&utm_term=Tools%20successful%20connection%20example&utm_content=settings%20page&utm_campaign=wordpress%20org#test-connection'>Here</a> is a successful example.", $this->plugin_name )
		);

	$tools[] = array(
		'id' 		=> 'zone_purger',
		'title' 	=> __( 'Zone Purger', $this->plugin_name ),
		'action' 	=> 'sunny_zone_purge',
		'btn_text' 	=> __( 'Clear all cache', $this->plugin_name ),
		'desc'		=> __( "Clear CloudFlare's cache.<br />This function will purge CloudFlare of any cached files. It may take up to 48 hours for the cache to rebuild and optimum performance to be achieved so this function should be used sparingly.", $this->plugin_name )
		);

	$tools[] = array(
		'id' 		=> 'url_purger',
		'title' 	=> __( 'URL Purger', $this->plugin_name ),
		'action' 	=> 'sunny_url_purge',
		'btn_text' 	=> __( 'Clear cache', $this->plugin_name ),
		'desc'		=> __( 'Purge a post by URL and (if enabled) its associated pages(e.g: categories, tags and archives).', $this->plugin_name ),
		'settings' 	=> array(
			'post_url' 	=> array(
				'id'   	=> 'post_url',
				'name' 	=> __( 'Post URL', $this->plugin_name ),
				'desc' 	=> __( 'The URL you want to purge. Start with <code>http://</code> or <code>https://</code>', $this->plugin_name ),
				'type' 	=> 'url',
				'std'  	=> get_option( 'home' ),
				)
			)
		);

	return $tools;

	} // end set_registered_tools

	/**
	 * Print the meta box on options page.
	 *
	 * @since     1.4.0
	 */
	public function render_meta_box( $post, $metabox ) {

		require( plugin_dir_path( dirname( __FILE__ ) ) . 'partials/sunny-tool-box-display.php' );

	} // end render_meta_box

}
