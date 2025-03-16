<?php

namespace ItalloLeonardo\UsercentricsCustomBlocks;

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

    public const BLOCKS = [
        'faq-item',
        'faq-list'
    ];

    private const BLOCKS_PATH = 'build/';

    public function __construct(string $plugin_path)
    {
        $this->plugin_path = $plugin_path;
        $this->blocks_path = $plugin_path . self::BLOCKS_PATH;
        $this->plugin_url = plugin_dir_url(dirname(__FILE__));
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
}
