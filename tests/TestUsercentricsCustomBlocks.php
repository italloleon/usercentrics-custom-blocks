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
     * Test the plugin constructor sets properties correctly
     */
    public function testConstructorSetsProperties()
    {
        $plugin = new UsercentricsCustomBlocks('/test/path/');

        // Use reflection to access private properties
        $reflection = new \ReflectionClass($plugin);

        $pluginPathProperty = $reflection->getProperty('plugin_path');
        $pluginPathProperty->setAccessible(true);

        $blocksPathProperty = $reflection->getProperty('blocks_path');
        $blocksPathProperty->setAccessible(true);

        $pluginUrlProperty = $reflection->getProperty('plugin_url');
        $pluginUrlProperty->setAccessible(true);

        $pluginUrlToTest = 'http://example.com/wp-content/plugins/usercentrics-custom-blocks/';

        // Check properties were set correctly
        $this->assertEquals('/test/path/', $pluginPathProperty->getValue($plugin));
        $this->assertEquals('/test/path/build/', $blocksPathProperty->getValue($plugin));
        $this->assertEquals($pluginUrlToTest, $pluginUrlProperty->getValue($plugin));
    }

    /**
     * Test the registerSingleBlock method calls register_block_type with correct path
     */
    public function testRegisterSingleBlockCallsRegisterBlockType()
    {
        $mockPlugin = $this->getMockBuilder(UsercentricsCustomBlocks::class)
            ->setConstructorArgs(['/test/path/'])
            ->onlyMethods(['fileExists'])
            ->getMock();

        $mockPlugin->method('fileExists')
            ->willReturn(true);

        $blockName = 'test-block';

        $expectedPath = '/test/path/build/' . $blockName . '/block.json';

        WP_Mock::userFunction('register_block_type', [
            'times' => 1,
            'args' => [$expectedPath]
        ]);

        $reflection = new \ReflectionClass($mockPlugin);
        $method = $reflection->getMethod('registerSingleBlock');
        $method->setAccessible(true);

        $method->invoke($mockPlugin, $blockName);

        $this->assertConditionsMet();
    }

    /**
     * Test the registerSingleBlock method doesn't call register_block_type when file doesn't exist
     */
    public function testRegisterSingleBlockSkipsNonExistentFiles()
    {
        $mockPlugin = $this->getMockBuilder(UsercentricsCustomBlocks::class)
            ->setConstructorArgs(['/test/path/'])
            ->onlyMethods(['fileExists'])
            ->getMock();

        $mockPlugin->method('fileExists')
            ->willReturn(false);

        $blockName = 'non-existent-block';

        WP_Mock::userFunction('register_block_type', [
            'times' => 0
        ]);

        $reflection = new \ReflectionClass($mockPlugin);
        $method = $reflection->getMethod('registerSingleBlock');
        $method->setAccessible(true);

        $method->invoke($mockPlugin, $blockName);

        $this->assertConditionsMet();
    }

    /**
     * Test the registerBlocks method registers all blocks in the BLOCKS constant
     */
    public function testRegisterBlocksRegistersAllBlocks()
    {
        $mockPlugin = $this->getMockBuilder(UsercentricsCustomBlocks::class)
            ->setConstructorArgs(['/test/path/'])
            ->onlyMethods(['registerSingleBlock', 'functionExists'])
            ->getMock();

        $mockPlugin->method('functionExists')
            ->with('register_block_type')
            ->willReturn(true);

        $mockPlugin->expects($this->exactly(count(UsercentricsCustomBlocks::BLOCKS)))
            ->method('registerSingleBlock')
            ->withConsecutive(
                [$this->equalTo('faq-item')],
                [$this->equalTo('faq-list')]
            );

        $mockPlugin->registerBlocks();
    }

    /**
     * Test the registerBlocks method skips when function_exists returns false
     */
    public function testRegisterBlocksSkipsWhenFunctionDoesntExist()
    {
        // Create a partial mock to verify registerSingleBlock is not called
        // and to mock function_exists
        $mockPlugin = $this->getMockBuilder(UsercentricsCustomBlocks::class)
            ->setConstructorArgs(['/test/path/'])
            ->onlyMethods(['registerSingleBlock', 'functionExists'])
            ->getMock();

        // Set up the mock to return false for function_exists
        $mockPlugin->method('functionExists')
            ->with('register_block_type')
            ->willReturn(false);

        // Expect registerSingleBlock to never be called
        $mockPlugin->expects($this->never())
            ->method('registerSingleBlock');

        $mockPlugin->registerBlocks();
    }

    /**
     * Test the integration with WordPress hooks
     */
    public function testWordPressHooksIntegration()
    {
        $plugin = new UsercentricsCustomBlocks('/test/path/');

        // Test that init action is added
        WP_Mock::expectActionAdded('init', [$plugin, 'registerBlocks']);

        $plugin->init();

        // Verify the action was added
        $this->assertConditionsMet();
    }
}
