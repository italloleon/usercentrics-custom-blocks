<?php

namespace ItalloLeonardo\UsercentricsCustomBlocks;

use ItalloLeonardo\UsercentricsCustomBlocks\BlockScriptLoader;

/**
 * The main plugin class.
 *
 * This is the main class that handles the registration and initialization
 * of the custom Gutenberg blocks for Usercentrics.
 *
 * @since      1.0.0
 * @package    Usercentrics_Custom_Blocks
 * @author     Itallo Leonardo
 */
class UsercentricsCustomBlocks
{
    private string $plugin_path;
    private string $blocks_path;
    private string $plugin_url;
    private BlockScriptLoader $blocks_script_loader;

    public const BLOCKS = [
        'faq-item',
        'faq-list'
    ];

    private const BLOCKS_PATH = 'build/';

    public function __construct(string $plugin_path, BlockScriptLoader $blocks_script_loader)
    {
        $this->plugin_path = $plugin_path;
        $this->blocks_path = $plugin_path . self::BLOCKS_PATH;
        $this->plugin_url = plugin_dir_url(dirname(__FILE__));
        $this->blocks_script_loader = $blocks_script_loader;
    }


    /**
     * Initialize the plugin.
     *
     * @since    1.0.0
     * @return   void
     */
    public function init()
    {
        // Register hooks
        add_action('init', [$this, 'registerBlocks']);
        // TODO: Uncomment when ready
        // add_action('enqueue_block_editor_assets', [$this, 'enqueueEditorAssets']);
        // add_action('wp_enqueue_scripts', [$this, 'enqueueFrontendAssets']);

        // Initialize the BlockScriptLoader for the FAQ item block
        $this->initBlockScriptLoader();
    }

    /**
     * Initialize the BlockScriptLoader for specific blocks.
     *
     * @since    1.0.0
     * @return   void
     */
    private function initBlockScriptLoader()
    {
        // Create a new BlockScriptLoader for the FAQ item block
        $this->blocks_script_loader->init();
    }

    /**
     * Register custom Gutenberg blocks.
     *
     * @since    1.0.0
     * @return   void
     */
    public function registerBlocks()
    {
        // Register blocks here
        if (function_exists('register_block_type')) {
            $block_list = self::BLOCKS;
            $blocks_path = $this->blocks_path;
            foreach ($block_list as $block) {
                register_block_type($this->blocks_path . $block . '/block.json');
            }
        }
    }

    /**
     * Enqueue editor assets.
     *
     * @since    1.0.0
     * @return   void
     */
    public function enqueueEditorAssets()
    {
        // Enqueue scripts and styles for the editor
    }

    /**
     * Enqueue frontend assets.
     *
     * @since    1.0.0
     * @return   void
     */
    public function enqueueFrontendAssets()
    {
        // Enqueue scripts and styles for the frontend
    }
}
