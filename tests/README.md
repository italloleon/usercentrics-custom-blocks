# Usercentrics Custom Blocks Tests

This directory contains unit tests for the Usercentrics Custom Blocks WordPress plugin.

## Setup

The testing environment uses:
- PHPUnit for the test framework
- WP_Mock for mocking WordPress functions

## Running Tests

To run all tests:

```bash
composer test
```

Or you can run phpunit directly:

```bash
./vendor/bin/phpunit
```

To run a specific test file:

```bash
./vendor/bin/phpunit tests/TestUsercentricsCustomBlocks.php
```

## Writing Tests

### Test Structure

Tests should follow this structure:

1. Create a new file named `Test{ClassToTest}.php` in the `tests` directory
2. Extend the `\WP_Mock\Tools\TestCase` class
3. Use `setUp()` and `tearDown()` methods to initialize and clean up WP_Mock
4. Write test methods that start with "test"

### Mocking WordPress Functions

Use WP_Mock to mock any WordPress functions your code relies on. For example:

```php
// Mock a WordPress function
WP_Mock::userFunction('wp_enqueue_script')
    ->with('handle', 'src', [], 'version', true)
    ->once();

// Mock a filter hook
WP_Mock::onFilter('the_content')
    ->with('original content')
    ->reply('filtered content');

// Mock an action hook
WP_Mock::expectActionAdded('init', [$object, 'method']);
```

### Asserting Expectations

After calling the method you want to test, verify the expectations were met:

```php
$this->assertConditionsMet(); // For general WP_Mock expectations
$this->assertHooksAdded();    // For hooks expected to be added
```

## Example Test

See `TestUsercentricsCustomBlocks.php` for an example of testing the plugin's main class.

## Best Practices

1. Test each method independently
2. Mock all WordPress functions and hooks
3. Focus on testing your plugin's functionality, not WordPress itself
4. Keep tests fast and isolated from each other
5. Write both success and failure cases 