// console.log( wp );
import block_icons from '../icons/index';

const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const { InspectorControls } = wp.editor;
const { PanelBody, PanelRow, TextControl, SelectControl } = wp.components;

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
  edit: ( props ) => {
    //console.log( props );
    return [
      <InspectorControls>
        <PanelBody title={ __( 'Basics', 'recipe' ) }>
          <PanelRow>
            <p>{ __( 'Configure the contents of your block here.', 'recipe' ) }</p>
          </PanelRow>

          <TextControl 
            label={ __( 'Ingredients', 'recipe' ) } 
            help={ __( 'Ex: tomatoes, lettuce, olive oil, etc.', 'recipe') }
            value="test"
            onChange={ (new_val) => {
              console.log(new_val);
            }}
          />

          <TextControl 
            label={ __( 'Cooking Time', 'recipe' ) } 
            help={ __( 'How long will this take to cook?', 'recipe') }
            value="test"
            onChange={ (new_val) => {
              console.log(new_val);
            }}
          />

          <TextControl 
            label={ __( 'Utensils', 'recipe' ) } 
            help={ __( 'Ex: spoon, knife, pots, pans', 'recipe') }
            value="test"
            onChange={ (new_val) => {
              console.log(new_val);
            }}
          />

          <SelectControl
            label={ __( 'Cooking Experience', 'recipe' ) }
            help={ __( 'How skilled should the reader be?', 'recipe' ) }
            value="Beginner"
            options={[
              {value: 'Beginner', label: 'Beginner'},
              {value: 'Intermediate', label: 'Intermediate'},
              {value: 'Expert', label: 'Expert'}
            ]}
            onChange={ (new_val) => {
              console.log(new_val);
            }}
          />

          <SelectControl
            label={ __( 'Meal Type', 'recipe' ) }
            help={ __( 'When is this best eaten', 'recipe' ) }
            value="Breakfast"
            options={[
              {value: 'Breakfast', label: 'Breakfast'},
              {value: 'Lunch', label: 'Lunch'},
              {value: 'Dinner', label: 'Dinner'}
            ]}
            onChange={ (new_val) => {
              console.log(new_val);
            }}
          />

        </PanelBody>
      </InspectorControls>,
      <div className={props.className}>
        <ul className="list-unstyled">
          <li>
            <strong>{ __( 'Ingredients', 'recipe' ) }: </strong> INGREDIENTS_PH
          </li>
          <li>
            <strong>{ __( 'Cooking Time', 'recipe' ) }: </strong> COOKING_TIME_PH
          </li>
          <li>
            <strong>{ __( 'Utensils', 'recipe' ) }: </strong> UTENSILS_PH
          </li>
          <li>
            <strong>{ __( 'Cooking Experience', 'recipe' ) }: </strong> LEVEL_PH
          </li>
          <li>
            <strong>{ __( 'Meal Type', 'recipe' ) }: </strong> TYPE_PH
          </li>
        </ul>
      </div>
    ];
  },
  save: ( props ) => {
    return <p>Hello World!</p>
  }
} );