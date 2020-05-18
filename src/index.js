/* eslint no-unused-vars: 0 */
import { registerBlockType } from '@wordpress/blocks';
import {
	RichText,
	AlignmentToolbar,
	BlockControls,
	InspectorControls,
	ColorPalette,
} from '@wordpress/block-editor';
import { PanelBody, PanelRow } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

registerBlockType( 'sticky-note/sticky-note', {
	title: 'Sticky note',
	icon: 'pressthis',
	category: 'layout',
	styles: [
		{
			name: 'paper',
			label: 'Paper', // TODO: What to do here? Use _x
			isDefault: true,
		},
		{
			name: 'flat',
			label: 'Flat',
		},
	],
	supports: {
		align: true,
		alignWide: false,
		reusable: false,
		lightBlockWrapper: true,
		__experimentalColor: { gradients: true },
	},
	attributes: {
		content: {
			type: 'array',
			source: 'children',
			selector: 'p',
		},
		alignment: {
			type: 'string',
			default: 'none',
		},
		color: {
			type: 'string',
			default: '#f9eeaa',
		},
	},
	example: {
		attributes: {
			content: 'Type something…',
			alignment: 'center',
		},
	},
	edit( props ) {
		const {
			attributes: { content, alignment, color },
			setAttributes,
			className,
		} = props;

		const onChangeContent = ( newContent ) => {
			setAttributes( { content: newContent } );
		};

		const onChangeAlignment = ( newAlignment ) => {
			props.setAttributes( {
				alignment: newAlignment === undefined ? 'none' : newAlignment,
			} );
		};

		const onChangeColor = ( newColor ) => {
			props.setAttributes( {
				color: newColor === undefined ? '#f9eeaa' : newColor,
			} );
		};

		return (
			<div>
				{
					<BlockControls>
						<AlignmentToolbar
							value={ alignment }
							onChange={ onChangeAlignment }
						/>
					</BlockControls>
				}
				{
					<InspectorControls>
						<PanelBody title={ __( 'Color' ) }>
							<PanelRow>
								<ColorPalette
									disableCustomColors={ false }
									value={ color }
									onChange={ onChangeColor }
									clearable={ true }
								/>
							</PanelRow>
						</PanelBody>
					</InspectorControls>
				}
				<RichText
					tagName="p"
					className={ className }
					style={ { textAlign: alignment, backgroundColor: color } }
					onChange={ onChangeContent }
					value={ content }
				/>
			</div>
		);
	},
	save: ( props ) => {
		return (
			<RichText.Content
				className={ `sticky-note-${ props.attributes.alignment }` }
				style={ { backgroundColor: props.attributes.color } }
				tagName="p"
				value={ props.attributes.content }
			/>
		);
	},
} );
