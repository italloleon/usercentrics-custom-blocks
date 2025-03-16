<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
$block_name = 'uc-faq-item';
$children = $content;
$block_wrapper_attributes = get_block_wrapper_attributes([
	"class" => $block_name,
]);

$title = $attributes['title'] ?? '';
?>
<li <?php echo $block_wrapper_attributes; ?> itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
	<details <?php echo isset($attributes['openByDefault']) && $attributes['openByDefault'] ? 'open' : ''; ?>>
		<summary class="<?php echo $block_name; ?>__header">
			<h3 itemprop="name" class="<?php echo $block_name; ?>__title">
				<?php echo $title; ?>
			</h3>
		</summary>
		<div class="<?php echo $block_name; ?>__content" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
			<div itemprop="text">
				<?php echo $children; ?>
			</div>
		</div>
	</details>
</li>
