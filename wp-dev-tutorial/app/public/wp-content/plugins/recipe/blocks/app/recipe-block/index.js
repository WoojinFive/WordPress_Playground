// console.log( wp );
import block_icons from '../icons/index';

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;

wp.blocks.registerBlockType( 'udemy/recipe', {
  title:            __( 'Recipe', 'recipe' ), // title: wp.i18n.__( 'Recipe', 'recipe' )
  description:      __(
    'Provides a short summary of a recipe.',
    'recipe'
  ),
  // coomon, formatting, layouts, widgets, embed
  category:         'common',
  icon:             block_icons.wapuu,
  keywords: [
    __( 'Food', 'recipe' ),
    __( 'Ingredients', 'recipe' ),
    __( 'Meal Type', 'recipe' )
  ],
  supports: {
    html:           false
  },
  save: () => {
    return <p>Hello World!</p>
  }
} );