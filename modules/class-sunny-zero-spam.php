<?php
/**
 * @package    Sunny
 * @subpackage Sunny/modules
 * @author     Tang Rufus <rufus@wphuman.com>
 * @since      1.4.11
 *
 */

/**
 * This class intergates with WordPress Zero Spam plugin.
 */
class Sunny_Zero_Spam extends Sunny_Abstract_Spam_Module {

	/**
	 * Set intergrated plugin slug during class initialization
	 *
	 * @since 		1.5.0
	 */
	protected function set_intergrated_plugin_slug() {
		$this->intergrated_plugin_slug = 'zero_spam';
	}

} // end Sunny_Zero_Spam
