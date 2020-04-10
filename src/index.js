import { registerBlockType } from '@wordpress/blocks';
import {
  RichText,
  AlignmentToolbar,
  BlockControls
} from '@wordpress/block-editor';

registerBlockType( 'post-it/post-it', {
    title: 'Post it',
    icon: 'smiley',
    category: 'layout',
    styles: [
      {
        name: 'paper',
        label: 'Paper', // TODO: What to do here? Use _x
        isDefault: true,
      },
      { name: 'flat', label: 'Flat' },
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
        selector: 'p'
      },
      alignment: {
        type: 'string',
        default: 'none'
      }
    },
    example: {
      attributes: {
        content: 'Holllo',
        alignment: 'center'
      },
    },
    edit( props ) {
      const { attributes: { content, alignment }, setAttributes, className } = props;

      const onChangeContent = ( newContent ) => {
        setAttributes( { content: newContent } );
      };

      const onChangeAlignment = ( newAlignment ) => {
        props.setAttributes( { alignment: newAlignment === undefined ? 'none' : newAlignment } );
      };

      return (
        <div>
          {
            <BlockControls>
              <AlignmentToolbar
                value={alignment}
                onChange={onChangeAlignment}
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
    save: (props) => {
      return (
        <RichText.Content
          className={ `post-it-${ props.attributes.alignment }` }
          tagName="p"
          value={props.attributes.content}
        />
      );
    }
} );
