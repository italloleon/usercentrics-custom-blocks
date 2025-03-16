/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
// import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	useBlockProps,
	useInnerBlocksProps,
	RichText,
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
 * @param {Object}   root0
 * @param {Object}   root0.attributes
 * @param {Function} root0.setAttributes
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const blockName = 'uc-faq-list';
	const blockProps = useBlockProps( {
		className: blockName,
	} );

	const { children, ...innerBlocksProps } = useInnerBlocksProps(
		useBlockProps( {
			allowedBlocks: [ 'usercentrics-custom-blocks/faq-item' ],
			className: `${ blockName }__items`,
		} )
	);

	const { title } = attributes;

	const onChangeTitle = ( newTitle ) => {
		setAttributes( { title: newTitle } );
	};

	return (
		<section { ...blockProps }>
			<RichText
				tagName="h2"
				className={ `${ blockName }__title` }
				value={ title }
				onChange={ onChangeTitle }
			/>
			<ul { ...innerBlocksProps }>{ children }</ul>
		</section>
	);
}
