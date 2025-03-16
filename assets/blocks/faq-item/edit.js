/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { 
	useBlockProps,
	RichText,
	useInnerBlocksProps
 } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const blockName = 'uc-faq-item';

	const blockProps = useBlockProps({
        className: blockName,
    });

	const { children, ...innerBlocksProps } = useInnerBlocksProps(useBlockProps({
		allowedBlocks: [ 'core/paragraph', 'core/list' ],
		className: `${blockName}__content`,
	}));

	const { title, openByDefault } = attributes;

	const setTitle = ( value ) => {
		setAttributes({ title: value });
	};

	const preventToggle = (event) => {
		if (event.target.open === false) {
			event.target.open = true;
		}
	}




	return (
		<li { ...blockProps }>
			<details onToggle={preventToggle} open={true}>
				<summary>
					<RichText
						tagName="h3"
						className={`${blockName}__title`}
						value={title}
						onChange={setTitle}
						allowedFormats={[]}
					/>
				</summary>
				<div { ...innerBlocksProps }>
					{ children }
				</div>
			</details>
		</li>
	);
}
