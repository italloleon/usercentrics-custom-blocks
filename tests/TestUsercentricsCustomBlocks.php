<?php

namespace ItalloLeonardo\UsercentricsCustomBlocks\Tests;

use ItalloLeonardo\UsercentricsCustomBlocks\UsercentricsCustomBlocks;
use WP_Mock;
use WP_Mock\Tools\TestCase;

class TestUsercentricsCustomBlocks extends TestCase
{
    public function setUp(): void
    {
        WP_Mock::setUp();

        WP_Mock::userFunction('plugin_dir_url', [
            'return' => 'http://example.com/wp-content/plugins/usercentrics-custom-blocks/'
        ]);
    }

    public function tearDown(): void
    {
        WP_Mock::tearDown();
    }

    /**
     * Test that the plugin initializes correctly by adding actions
     */
    public function testInitAddsActions()
    {
        $plugin = new UsercentricsCustomBlocks(__DIR__);

        WP_Mock::expectActionAdded('init', [$plugin, 'registerBlocks']);

        $plugin->init();

        $this->assertConditionsMet();
    }

    /**
     * Test the plugin has the expected block list
     */
    public function testPluginHasExpectedBlocks()
    {
        $this->assertIsArray(UsercentricsCustomBlocks::BLOCKS);
        $this->assertContains('faq-item', UsercentricsCustomBlocks::BLOCKS);
        $this->assertContains('faq-list', UsercentricsCustomBlocks::BLOCKS);
        $this->assertCount(2, UsercentricsCustomBlocks::BLOCKS, 'Block count should match expected number');
    }

    /**
     * Test block registration with a valid block path
     */
    public function testValidBlockRegistration()
    {
        // Create a test subclass that exposes the protected method
        $plugin = new class ('/test/path/') extends UsercentricsCustomBlocks {
            public function publicRegisterSingleBlock($block)
            {
                return $this->registerSingleBlock($block);
            }

            protected function fileExists($path)
            {
                return true;
            }
        };

        $blockName = 'test-block';
        $expectedPath = '/test/path/build/' . $blockName . '/block.json';

        WP_Mock::userFunction('register_block_type', [
            'times' => 1,
            'args' => [$expectedPath]
        ]);

        $plugin->publicRegisterSingleBlock($blockName);

        $this->assertConditionsMet();
    }

    /**
     * Test block registration skips when file doesn't exist
     */
    public function testNonExistentBlockRegistration()
    {
        $plugin = new class ('/test/path/') extends UsercentricsCustomBlocks {
            public function publicRegisterSingleBlock($block)
            {
                return $this->registerSingleBlock($block);
            }

            protected function fileExists($path)
            {
                return false;
            }
        };

        $blockName = 'non-existent-block';

        WP_Mock::userFunction('register_block_type', [
            'times' => 0
        ]);

        $plugin->publicRegisterSingleBlock($blockName);

        $this->assertConditionsMet();
    }

    /**
     * Test the registerBlocks method registers all blocks in the BLOCKS constant
     */
    public function testRegisterBlocksRegistersAllBlocks()
    {
        $plugin = new class ('/test/path/') extends UsercentricsCustomBlocks {
            public $registeredBlocks = [];

            protected function registerSingleBlock($block)
            {
                $this->registeredBlocks[] = $block;
            }

            protected function functionExists($function)
            {
                return true;
            }
        };

        $plugin->registerBlocks();

        $this->assertEquals(UsercentricsCustomBlocks::BLOCKS, $plugin->registeredBlocks);
    }

    /**
     * Test the registerBlocks method skips when function_exists returns false
     */
    public function testRegisterBlocksSkipsWhenFunctionDoesntExist()
    {
        $plugin = new class ('/test/path/') extends UsercentricsCustomBlocks {
            public $registeredBlocks = [];

            protected function registerSingleBlock($block)
            {
                $this->registeredBlocks[] = $block;
            }

            protected function functionExists($function)
            {
                return false;
            }
        };

        $plugin->registerBlocks();

        $this->assertEmpty($plugin->registeredBlocks);
    }

    /**
     * Test the plugin properly constructs block paths from base path
     */
    public function testPluginConstructsProperBlockPaths()
    {
        $testPlugin = new class ('/test/path/') extends UsercentricsCustomBlocks {
            // Expose registerSingleBlock as a public method
            public function publicRegisterSingleBlock($block)
            {
                return $this->registerSingleBlock($block);
            }

            // Override fileExists to always return true for testing
            protected function fileExists($path)
            {
                return true;
            }
        };

        // The expected block path that should be constructed
        $blockName = 'test-block';
        $expectedPath = '/test/path/build/' . $blockName . '/block.json';

        // Use WP_Mock to verify register_block_type is called with the correct path
        WP_Mock::userFunction('register_block_type', [
            'times' => 1,
            'args' => [$expectedPath],
            'return' => true
        ]);

        // Call the public wrapper that will then call the real method with our path
        $testPlugin->publicRegisterSingleBlock($blockName);

        // Verify our expectations
        $this->assertConditionsMet();
    }
}
