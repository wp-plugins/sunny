<?php
/**
 * Represents the URL Purger view for the administration dashboard.
 *
 * @link       http://tangrufus.com
 * @since      1.1.0
 *
 * @package    Sunny
 * @subpackage Sunny/admin/partials
 */
?>

<?php $id = $metabox['args']['id']; ?>
<?php $desc = $metabox['args']['desc']; ?>

<div id="<?php echo $id; ?>" class="wrap">
	<form id="sunny_<?php echo $id; ?>_form" method="POST">
		<?php echo $desc ?>
		<br />
		<?php settings_fields( 'sunny_tools_' . $id ); ?>
		<?php do_settings_sections( 'sunny_tools_' . $id ); ?>
		<?php submit_button( 'testing', 'primary', $id . '_button' ); ?>
	</form>
	<br class="clear">
	<div id="sunny_<?php echo $id; ?>_result" style="display: none">
		<h3 id="sunny_<?php echo $id; ?>_result_heading">Result</h3>
		<img id="sunny_<?php echo $id; ?>_form_spinner" style="display: none" src="<?php echo admin_url(); ?>images/spinner-2x.gif">
	</div>
</div>
