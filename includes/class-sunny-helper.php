<?php
/**
 * @package    Sunny
 * @subpackage Sunny_Helper
 * @author     Tang Rufus <tangrufus@gmail.com>
 * @license    GPL-2.0+
 * @link       http://tangrufus.com
 * @copyright  2014 Tang Rufus
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Helper class. Dealing user inputs in WordPress admin dashboard.
 */
class Sunny_Helper {
	/**
	  * sanitize input to an alphanumeric-only string
	  *
	  * @since     1.0.0
	  *
	  * @param 	  string  $input  	The unsanitized string.
	  *
	  * @return   string            The sanitized alphanumeric-only string.
	  */
	public static function sanitize_alphanumeric( $input ) {

		return preg_replace('/[^a-zA-Z0-9]/', '' , strip_tags( stripslashes( $input ) ) );

	}

	 /**
	  * to check if a url live in site's domain
	  *
	  * @since     1.1.0
	  *
	  * @param    string  $url      The test url
	  *
	  * @return   boolean           True if a url is in site's domain
	  */
	 public static function url_match_site_domain( $url ) {


		return ( self::get_domain( $url ) == Sunny::get_instance()->get_domain() );

	 } // end url_match_site_domain( $url )

	/**
	 * @see   https://gist.github.com/pocesar/5366899
	 *
	 * @param   string  $domain   Pass $_SERVER['SERVER_NAME'] here
	 * @param   bool  $debug
	 *
	 * @return  string
	 *
	 * @since  	1.2.3
	 */
	public static function get_domain( $domain ) {

		$original = $domain = parse_url( strtolower( esc_url_raw( $domain ) ), PHP_URL_HOST );

		if ( filter_var( $domain, FILTER_VALIDATE_IP ) ) {

			return $domain;

		}

		$arr = array_slice(array_filter(explode('.', $domain, 4), function($value){
			return $value !== 'www';
				}), 0); //rebuild array indexes

		if ( 2 < count( $arr ) ) {

			$count = count( $arr );
			$_sub = explode('.', $count === 4 ? $arr[3] : $arr[2]);

			if ( 2 === count( $_sub ) ) { // two level TLD

				$removed = array_shift( $arr );
				if ( 4 === $count ) { // got a subdomain acting as a domain

					$removed = array_shift( $arr );
				}

			} elseif ( 1 === count( $_sub ) ) { // one level TLD

				$removed = array_shift( $arr ); //remove the subdomain

				if ( 2 === strlen( $_sub[0] ) && 3 === $count ) { // TLD domain must be 2 letters

					array_unshift( $arr, $removed );

				} else {

					// non country TLD according to IANA
					$tlds = array(
						'aero',
						'arpa',
						'asia',
						'biz',
						'cat',
						'com',
						'coop',
						'edu',
						'gov',
						'info',
						'jobs',
						'mil',
						'mobi',
						'museum',
						'name',
						'net',
						'org',
						'post',
						'pro',
						'tel',
						'travel',
						'xxx',
						);


					if ( 2 < count($arr)  && in_array( $_sub[0], $tlds ) !== false ) { //special TLD don't have a country

					array_shift( $arr );

				}
			}

			} else { // more than 3 levels, something is wrong

				for ( $i = count( $_sub ); $i > 1; $i--) {

					$removed = array_shift($arr);

				}
			}

		} elseif ( 2 === count( $arr ) ) {

			$arr0 = array_shift( $arr );

			if ( false === strpos( join( '.', $arr ), '.')
					&& false === in_array( $arr[0], array( 'localhost', 'test', 'invalid' ) ) ) { // not a reserved domain

				// seems invalid domain, restore it
				array_unshift( $arr, $arr0 );

		}
	}

	return join('.', $arr);

	} // end get_domain( $domain )

	/**
	 * Log debug messages in php error log.
	 *
	 * @since 	1.0.0
	 *
	 * @param 	$response 	The response after api call, could be WP Error object or HTTP return object
	 * @param 	$action 	The API action
	 * @param 	$target 	The Url/IP that API calls
	 *
	 * @return    void      No return
	 */
	public static function write_report( $response, $action, $target ) {

		if ( ! defined( 'WP_DEBUG' ) || WP_DEBUG == false || 'false' === WP_DEBUG ) {

			return;

		}

		if ( is_wp_error( $response ) ) {

			error_log( "Sunny: $action $target WP Error " . $response->get_error_message() );

		}// end WP Error
		else {
			// API made
			$response_array = json_decode( $response['body'], true );

			if ( 'error' == $response_array['result'] ) {

				error_log( "Sunny: $action $target API Error " . $response_array['msg'] );

			} else {

				error_log( "Sunny: $action $target Success" );

			}

		}

	} // end write_report

	/**
	 * Retrieve the real ip address of the user in the current request.
	 *
	 * @return string The real ip address of the user in the current request.
	 *
	 * @since  1.3.0
	 *
	 * @see  sucuri-scanner.php sucuriscan_get_remoteaddr()
	 */
	public static function get_remoteaddr() {

		$alternatives = array(
			'HTTP_X_REAL_IP',
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
			'REMOTE_ADDR',
			'SUCURI_RIP',
			);
		foreach($alternatives as $alternative){

			if( !isset( $_SERVER[$alternative] ) )
				continue;

			$remote_addr = preg_replace('/[^0-9a-z.,: ]/', '', $_SERVER[$alternative]);

			if($remote_addr)
				break;

		} //end foreach

		if( $remote_addr == '::1' )
			$remote_addr = '127.0.0.1';

		return $remote_addr;

	} // get_remoteaddr

	/**
	 * Check whether the IP address specified is a valid IPv4 format.
	 *
	 * @param  string  $remote_addr The host IP address.
	 * @return boolean              TRUE if the address specified is a valid IPv4 format, FALSE otherwise.
	 *
	 * @since  1.3.0
	 * @see  sucuri-scanner.php sucuriscan_is_valid_ipv4
	 */
	public static function is_valid_ipv4( $remote_addr='' ){
		if( preg_match('/^([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})\.([0-9]{1,3})$/', $remote_addr, $match) ){
			for( $i=0; $i<4; $i++ ){
				if( $match[$i] > 255 ){ return FALSE; }
			}

			return TRUE;
		}

		return FALSE;

	} // end is_valid_ipv4

	/**
	 * Check whether the IP address is a localhost ip.
	 *
	 * @param  string  $remote_addr The host IP address.
	 * @return boolean              TRUE if the address specified is a localhost IP, FALSE otherwise.
	 *
	 * @since  1.3.0
	 */
	public static function is_localhost( $remote_addr = '' ){

		$localhost = array(
			'127.0.0.0',
			'127.0.0.1',
			'127.0.0.2',
			'127.0.0.3',
			'127.0.0.4',
			'127.0.0.5',
			'127.0.0.6',
			'127.0.0.7',
			'127.0.0.8',
			'127.0.0.9',
			'127.0.1.0',
			'::1'
			);

		return in_array( $remote_addr, $localhost );

	} // end is_localhost

}// end Sunny_Helper class