<?php

namespace ItalloLeonardo\UsercentricsCustomBlocks\Tests;

use WP_Mock;

class TestSimple extends \WP_Mock\Tools\TestCase
{
    public function setUp(): void
    {
        WP_Mock::setUp();
    }

    public function tearDown(): void
    {
        WP_Mock::tearDown();
    }

    /**
     * A simple test to verify WP_Mock is working correctly
     */
    public function testWordPressFunctionMocking()
    {
        // Mock a WordPress function
        WP_Mock::userFunction('wp_get_theme', [
            'times' => 1,
            'return' => 'mocked-theme',
        ]);

        // Call the mocked function
        $theme = wp_get_theme();
        
        // Assert that it returns the mock value
        $this->assertEquals('mocked-theme', $theme);
        
        // Check that all expected methods were called
        $this->assertConditionsMet();
    }

    /**
     * Test hooks can be properly mocked
     */
    public function testHooksMocking()
    {
        // Set up the action expectation
        WP_Mock::expectActionAdded('init', 'test_function');
        
        // Call the actual function with the expectation
        add_action('init', 'test_function');
        
        // Assert that all hooks were properly added
        $this->assertHooksAdded();
    }
} 