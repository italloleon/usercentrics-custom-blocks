<?php
/**
 *
 *
 * @link              https://github.com/italloleon/usercentrics-custom-blocks
 * @since             1.0.0
 * @package           Usercentrics_Custom_Blocks
 *
 * @wordpress-plugin
 * Plugin Name:       Usercentrics Custom Blocks
 * Plugin URI:        https://github.com/italloleon/usercentrics-custom-blocks
 * Description:       A plugin created to register custom Gutenberg blocks for the Usercentrics company challenge for the Senior WordPress Developer role.
 * Version:           1.0.0
 * Author:            Itallo Leonardo
 * Author URI:        https://github.com/italloleon
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       usercentrics-custom-blocks
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

define( 'USERCENTRICS_CUSTOM_BLOCKS_PATH', plugin_dir_path( __FILE__ ) );
define( 'USERCENTRICS_CUSTOM_BLOCKS_URL', plugin_dir_url( __FILE__ ) );

use ItalloLeonardo\UsercentricsCustomBlocks\UsercentricsCustomBlocks;
use ItalloLeonardo\UsercentricsCustomBlocks\BlockScriptLoader;
function usercentrics_custom_blocks_init() {
	$faq_block_loader = new BlockScriptLoader('usercentrics-custom-blocks/faq-item');
	$usercentrics_custom_blocks = new UsercentricsCustomBlocks(USERCENTRICS_CUSTOM_BLOCKS_PATH, $faq_block_loader);

	$usercentrics_custom_blocks->init();
}

add_action( 'plugins_loaded', 'usercentrics_custom_blocks_init' );

