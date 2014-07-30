<?php
/**
 * Represents the `Purge All` button view for the administration dashboard.
 *
 * @package 	Sunny
 * @subpackage 	Sunny_Admin
 * @author 		Tang Rufus <tangrufus@gmail.com>
 * @license  	GPL-2.0+
 * @link  		http://tangrufus.com
 * @copyright 	2014 Tang Rufus
 */
?>

<?php $plugin = Sunny::get_instance(); ?>
<?php $plugin_slug = $plugin->get_plugin_slug(); ?>

<div id="sunny-account-settings" class="wrap">
	<form action="options.php" method="POST">
		<?php settings_fields( 'sunny_cloudflare_account_section' ); ?>
		<?php do_settings_sections( 'sunny_cloudflare_account_section' ); ?>
		<?php submit_button( __('Save', $plugin_slug ), 'primary' ); ?>
	</form>
</div>
