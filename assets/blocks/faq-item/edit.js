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
	useInnerBlocksProps,
	InspectorControls,
} from '@wordpress/block-editor';

import { PanelBody, BaseControl, ToggleControl } from '@wordpress/components';

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
	const blockName = 'uc-faq-item';

	const blockProps = useBlockProps( {
		className: blockName,
	} );

	const { children, ...innerBlocksProps } = useInnerBlocksProps(
		useBlockProps( {
			allowedBlocks: [ 'core/paragraph', 'core/list' ],
			className: `${ blockName }__content`,
		} )
	);

	const { title, openByDefault } = attributes;

	const setTitle = ( value ) => {
		setAttributes( { title: value } );
	};

	const preventToggle = ( event ) => {
		if ( event.target.open === false ) {
			event.target.open = true;
		}
	};

	const setOpenByDefault = () => {
		setAttributes( { openByDefault: ! openByDefault } );
	};

	return (
		<li { ...blockProps }>
			<InspectorControls>
				<PanelBody
					title={ __(
						'FAQ Item Settings',
						'usercentrics-custom-blocks'
					) }
					initialOpen={ true }
				>
					<BaseControl
						id="faq-item-open-by-default"
						label={ __(
							'Open by default',
							'usercentrics-custom-blocks'
						) }
					>
						<ToggleControl
							label={ __(
								'Open by default',
								'usercentrics-custom-blocks'
							) }
							checked={ openByDefault }
							onChange={ setOpenByDefault }
						/>
					</BaseControl>
				</PanelBody>
			</InspectorControls>
			<details onToggle={ preventToggle } open={ true }>
				<summary className={ `${ blockName }__header` }>
					<RichText
						tagName="h3"
						className={ `${ blockName }__title` }
						value={ title }
						onChange={ setTitle }
						allowedFormats={ [] }
					/>
				</summary>
				<div { ...innerBlocksProps }>{ children }</div>
			</details>
		</li>
	);
}
