<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package 	Sunny
 * @subpackage 	Sunny_Admin
 * @author 		Tang Rufus <tangrufus@gmail.com>
 * @license  	GPL-2.0+
 * @link  		http://tangrufus.com
 * @copyright 	2014 Tang Rufus
 * @since 		1.0.0
 */
?>

<div class="wrap" >
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<?php settings_errors(); ?>

	<?php $current_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'sunny_general_settings' ?>

	<h2 class="nav-tab-wrapper">
		<?php foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) { ?>
			<?php $active = $current_tab == $tab_key ? 'nav-tab-active' : ''; ?>
			<?php echo "<a class='nav-tab $active' href='admin.php?page=$this->plugin_slug&tab=$tab_key'>$tab_caption</a>"; ?>
		<?php } ?>
	</h2>

	<div class="postbox-container" style="width: 60%;">

		<div class="metabox-holder">
			<?php do_meta_boxes( $current_tab, 'advanced', NULL ); ?>
			<?php do_meta_boxes( $current_tab, 'normal', NULL ); ?>
		</div>

	</div>

	<div class="postbox-container side" style="width: 261px;">

		<div class="metabox-holder">
			<?php do_meta_boxes( $current_tab, 'side', NULL ); ?>
		</div>

	</div>

</div>