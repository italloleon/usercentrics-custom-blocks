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
class UsercentricsCustomBlocks {

    private string $plugin_path;
    private string $blocks_path;

    public const BLOCKS = [
        'faq-item',
        'faq-list'  
    ];

    public function __construct(string $plugin_path) {
        $this->plugin_path = $plugin_path;
        $this->blocks_path = $plugin_path . 'build/';
    }


    /**
     * Initialize the plugin.
     *
     * @since    1.0.0
     * @return   void
     */
    public function init() {
        // Register hooks
        add_action('init', [$this, 'register_blocks']);
        // add_action('enqueue_block_editor_assets', [$this, 'enqueue_editor_assets']);
        // add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
    }

    /**
     * Register custom Gutenberg blocks.
     *
     * @since    1.0.0
     * @return   void
     */
    public function register_blocks() {
        // Register blocks here
        if (function_exists('register_block_type')) {
            $block_list = self::BLOCKS;
            $blocks_path = $this->blocks_path;

            error_log(print_r($block_list, true));
        
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
    public function enqueue_editor_assets() {
        // Enqueue scripts and styles for the editor
    }

    /**
     * Enqueue frontend assets.
     *
     * @since    1.0.0
     * @return   void
     */
    public function enqueue_frontend_assets() {
        // Enqueue scripts and styles for the frontend
    }
} 