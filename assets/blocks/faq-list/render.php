<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
$block_name = 'uc-faq-list';
$children = $content;
$title = $attributes['title'] ?? 'Frequently Asked Questions';

$block_wrapper_attributes = get_block_wrapper_attributes([
	"class" => $block_name,
]);

$heading_id = 'faq-heading-' . uniqid();
?>
<section 
    aria-labelledby="<?php echo esc_attr($heading_id); ?>" 
    itemscope 
    itemtype="https://schema.org/FAQPage" 
    <?php echo $block_wrapper_attributes; ?>
>
	<h2 id="<?php echo esc_attr($heading_id); ?>" class="<?php echo $block_name; ?>__title">
		<?php echo $title; ?>
	</h2>
	<ul class="<?php echo $block_name; ?>__items">
		<?php echo $content; ?>
	</ul>
</section>
