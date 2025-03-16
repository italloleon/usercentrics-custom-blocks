<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
require_once( USERCENTRICS_CUSTOM_BLOCKS_PATH . 'assets/helpers/functions.php' );
$block_name = 'uc-faq-item';
$children = $content;

$block_wrapper_attributes = replace_class_name( $block_wrapper_attributes, $block_name );
?>
<li <?php echo $block_wrapper_attributes; ?>>
	<details <?php echo isset($attributes['openByDefault']) && $attributes['openByDefault'] ? 'open' : ''; ?>>
		<summary>
			<h3 class="<?php echo $block_name; ?>__title">
				<?php echo $attributes['title']; ?>
			</h3>
		</summary>
		<div class="<?php echo $block_name; ?>__content">
			<?php echo $children; ?>
		</div>
	</details>
</li>
