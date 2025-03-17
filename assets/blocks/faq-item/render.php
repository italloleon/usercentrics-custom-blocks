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
$item_id = 'faq-item-' . uniqid();
$content_id = 'faq-content-' . uniqid();
?>
<li <?php echo $block_wrapper_attributes; ?> itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
	<details 
		<?php echo isset($attributes['openByDefault']) && $attributes['openByDefault'] ? 'open' : ''; ?>
		class="<?php echo $block_name; ?>__details"
	>
		<summary 
			class="<?php echo $block_name; ?>__header" 
			aria-controls="<?php echo esc_attr($content_id); ?>"
			id="<?php echo esc_attr($item_id); ?>"
			aria-expanded="<?php echo isset($attributes['openByDefault']) && $attributes['openByDefault'] ? 'true' : 'false'; ?>"
		>
			<h3 itemprop="name" class="<?php echo $block_name; ?>__title">
				<?php echo $title; ?>
			</h3>
		</summary>
		<div 
			class="<?php echo $block_name; ?>__content" 
			itemprop="acceptedAnswer" 
			itemscope 
			itemtype="https://schema.org/Answer"
			id="<?php echo esc_attr($content_id); ?>"
			aria-labelledby="<?php echo esc_attr($item_id); ?>"
		>
			<div itemprop="text">
				<?php echo $children; ?>
			</div>
		</div>
	</details>
</li>
