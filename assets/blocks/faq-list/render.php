<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
require_once( USERCENTRICS_CUSTOM_BLOCKS_PATH . 'assets/helpers/functions.php' );
$block_name = 'uc-faq-list';
$children = $content;

$block_wrapper_attributes = replace_class_name( get_block_wrapper_attributes(), $block_name );
?>
<section <?php echo $block_wrapper_attributes; ?>>
	<ul class="<?php echo $block_name; ?>__list">
		<?php echo $content; ?>
	</ul>
</section>
