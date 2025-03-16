<?php

namespace ItalloLeonardo\UsercentricsCustomBlocks;

/**
 * Class to check for specific blocks on a page and load scripts accordingly.
 *
 * This class checks if the current page or post has a specific block
 * and adds the appropriate script to the footer when needed.
 *
 * @since      1.0.0
 * @package    Usercentrics_Custom_Blocks
 * @author     Itallo Leonardo
 */
class BlockScriptLoader
{
    /**
     * The block name to check for.
     *
     * @var string
     */
    private string $block_name;

    /**
     * Constructor.
     *
     * @param string $block_name The block name to check for.
     * @param string $script_url The URL of the script to load.
     */
    public function __construct(string $block_name)
    {
        $this->block_name = $block_name;
    }

    /**
     * Initialize the class.
     *
     * @return void
     */
    public function init()
    {
        add_action('wp_footer', [$this, 'maybeLoadScript']);
    }

    /**
     * Check if the current post has the specified block and load the script if needed.
     *
     * @return void
     */
    public function maybeLoadScript()
    {
        // Only check on singular posts/pages
        if (!is_singular()) {
            return;
        }

        $post_id = get_the_ID();

        // Check if the post has the specified block
        if ($post_id && has_block($this->block_name, $post_id)) {
            // Add the script tag to the footer
            echo '<script id="usercentrics-custom-blocks-ld-json" type="application/ld+json"></script>';
        }
    }
}
