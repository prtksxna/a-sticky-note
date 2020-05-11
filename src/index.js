/* eslint no-unused-vars: 0 */
import { registerBlockType } from '@wordpress/blocks';
import {
	RichText,
	AlignmentToolbar,
	BlockControls,
} from '@wordpress/block-editor';

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
	},
	example: {
		attributes: {
			content: 'Type something…',
			alignment: 'center',
		},
	},
	edit( props ) {
		const {
			attributes: { content, alignment },
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
				<RichText
					tagName="p"
					className={ className }
					style={ { textAlign: alignment } }
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
				tagName="p"
				value={ props.attributes.content }
			/>
		);
	},
} );
