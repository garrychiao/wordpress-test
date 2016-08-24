<?php
/*
Plugin Name: Signature Shortcodes
Plugin URI: http://www.designova.net
Description: Plugin to be used with the premium WordPress theme Signature
Author: Designova
Author URI: http://www.designova.net
Version: 1.1
*/

/*
This example/starter plugin can be used to speed up Visual Composer plugins creation process.
More information can be found here: http://kb.wpbakery.com/index.php?title=Category:Visual_Composer
*/

// don't load directly
if (!defined('ABSPATH')) die('-1');

require_once 'core_functions.php';

function slider_body_classes( $classes ) {
       
    $classes[] = 'transparent-navigation';
     
    return $classes;
     
}

class VCExtendAddonClass {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );
 
        
        add_shortcode( 'signature_section', array( $this, 'render_signature_section' ) );

        add_shortcode( 'signature_text_block', array( $this, 'render_signature_text_block' ) );

        add_shortcode( 'signature_text_ticker', array( $this, 'render_signature_text_ticker' ) );

        add_shortcode( 'signature_adler_page_header', array( $this, 'render_signature_adler_page_header' ) );

        add_shortcode( 'signature_adler_section_header', array( $this, 'render_signature_adler_section_header' ) );

        add_shortcode( 'signature_adler_project_header', array( $this, 'render_signature_adler_project_header' ) );

        add_shortcode( 'signature_button', array( $this, 'render_signature_button' ) );

        add_shortcode( 'signature_icon_round_button', array( $this, 'render_signature_icon_round_button' ) );

        add_shortcode( 'signature_portfolio', array( $this, 'render_signature_portfolio' ) );

        add_shortcode( 'signature_liner', array( $this, 'render_signature_liner' ) );

        add_shortcode( 'signature_adler_liner_text', array( $this, 'render_signature_adler_liner_text' ) );

        add_shortcode( 'signature_adler_counter', array( $this, 'render_signature_adler_counter' ) );

        add_shortcode( 'signature_adler_team', array( $this, 'render_signature_adler_team' ) );

        add_shortcode( 'signature_adler_services', array( $this, 'render_signature_adler_services' ) );

        add_shortcode( 'signature_adler_image_slider', array( $this, 'render_signature_adler_image_slider' ) );

        add_shortcode( 'signature_adler_project_spec', array( $this, 'render_signature_adler_project_spec' ) );

        add_shortcode( 'signature_lightbox', array( $this, 'render_signature_lightbox' ) );        

        add_shortcode( 'signature_parallax_showcase', array( $this, 'render_signature_parallax_showcase' ) );

        add_shortcode( 'signature_blog_posts', array( $this, 'render_signature_blog_posts' ) );

        add_shortcode( 'signature_contact_form', array( $this, 'render_signature_contact_form' ) );

        add_shortcode( 'signature_map', array( $this, 'render_signature_map' ) );

        add_shortcode( 'signature_berend_features', array( $this, 'render_signature_berend_features' ) );

        add_shortcode( 'signature_berend_section_header', array( $this, 'render_signature_berend_section_header' ) );

        add_shortcode( 'signature_berend_services', array( $this, 'render_signature_berend_services' ) );

        add_shortcode( 'signature_berend_skillset', array( $this, 'render_signature_berend_skillset' ) );

        add_shortcode( 'signature_berend_clients', array( $this, 'render_signature_berend_clients' ) );
        
        add_shortcode( 'signature_berend_project_header', array( $this, 'render_signature_berend_project_header' ) );

        add_shortcode( 'signature_claus_fullscreen_slider', array( $this, 'render_signature_claus_fullscreen_slider' ) );

        add_shortcode( 'signature_claus_page_header', array( $this, 'render_signature_claus_page_header' ) );

        add_shortcode( 'signature_dierk_page_header', array( $this, 'render_signature_dierk_page_header' ) );

        add_shortcode( 'signature_dierk_split_section', array( $this, 'render_signature_dierk_split_section' ) );

        add_shortcode( 'signature_dierk_team', array( $this, 'render_signature_dierk_team' ) );

        add_shortcode( 'signature_dierk_services', array( $this, 'render_signature_dierk_services' ) );

        add_shortcode( 'signature_ebert_split_slider', array( $this, 'render_signature_ebert_split_slider' ) );

        add_shortcode( 'signature_ebert_masonry_image_gallery', array( $this, 'render_signature_ebert_masonry_image_gallery' ) );

        add_shortcode( 'signature_ebert_project_header', array( $this, 'render_signature_ebert_project_header' ) );

        add_shortcode( 'signature_franz_services', array( $this, 'render_signature_franz_services' ) );

        add_shortcode( 'signature_franz_project_header', array( $this, 'render_signature_franz_project_header' ) );

        add_shortcode( 'signature_carousel_wrap', array( $this, 'render_signature_carousel_wrap' ) );

        add_shortcode( 'signature_carousel_item', array( $this, 'render_signature_carousel_item' ) );

        add_shortcode( 'signature_gozzo_project_showcase', array( $this, 'render_signature_gozzo_project_showcase' ) );

        add_shortcode( 'signature_gozzo_masonry_image_gallery', array( $this, 'render_signature_gozzo_masonry_image_gallery' ) );

        add_shortcode( 'signature_gozzo_button', array( $this, 'render_signature_gozzo_button' ) );

        add_shortcode( 'signature_hans_splash_slider', array( $this, 'render_signature_hans_splash_slider' ) );

        add_shortcode( 'signature_hans_page_header', array( $this, 'render_signature_hans_page_header' ) );

        add_shortcode( 'signature_hans_team', array( $this, 'render_signature_hans_team' ) );

        add_shortcode( 'signature_hans_project_header', array( $this, 'render_signature_hans_project_header' ) );
        
        add_shortcode( 'signature_hans_services', array( $this, 'render_signature_hans_services' ) );

        add_shortcode( 'signature_igor_page_header', array( $this, 'render_signature_igor_page_header' ) );

        add_shortcode( 'signature_igor_content_slider', array( $this, 'render_signature_igor_content_slider' ) );

        add_shortcode( 'signature_igor_services', array( $this, 'render_signature_igor_services' ) );

        add_shortcode( 'signature_igor_team', array( $this, 'render_signature_igor_team' ) );

        add_shortcode( 'signature_johan_page_header', array( $this, 'render_signature_johan_page_header' ) );

        add_shortcode( 'signature_johan_services', array( $this, 'render_signature_johan_services' ) );

        add_shortcode( 'signature_johan_team', array( $this, 'render_signature_johan_team' ) );

        add_shortcode( 'signature_johan_counter', array( $this, 'render_signature_johan_counter' ) );

        add_shortcode( 'signature_karl_text_ticker', array( $this, 'render_signature_karl_text_ticker' ) );

        add_shortcode( 'signature_karl_team', array( $this, 'render_signature_karl_team' ) );

        add_shortcode( 'signature_text_eraser', array( $this, 'render_signature_text_eraser' ) );

        add_shortcode( 'signature_leon_team', array( $this, 'render_signature_leon_team' ) );

        add_shortcode( 'signature_leon_services', array( $this, 'render_signature_leon_services' ) );

        add_shortcode( 'signature_moritz_counter', array( $this, 'render_signature_moritz_counter' ) );

        add_shortcode( 'signature_moritz_team', array( $this, 'render_signature_moritz_team' ) );

        add_shortcode( 'signature_moritz_services', array( $this, 'render_signature_moritz_services' ) );

        add_shortcode( 'signature_nemo_team', array( $this, 'render_signature_nemo_team' ) );

        add_shortcode( 'signature_orwin_page_header', array( $this, 'render_signature_orwin_page_header' ) );

        add_shortcode( 'signature_orwin_process_carousel', array( $this, 'render_signature_orwin_process_carousel' ) );

        add_shortcode( 'signature_orwin_services', array( $this, 'render_signature_orwin_services' ) );

        add_shortcode( 'signature_orwin_team', array( $this, 'render_signature_orwin_team' ) );

        add_shortcode( 'signature_orwin_parallax_showcase', array( $this, 'render_signature_orwin_parallax_showcase' ) );

        add_shortcode( 'signature_flickr_gallery', array( $this, 'render_signature_flickr_gallery' ) );

        add_shortcode( 'signature_quartz_background_slider', array( $this, 'render_signature_quartz_background_slider' ) );

        add_shortcode( 'signature_quartz_intro_box', array( $this, 'render_signature_quartz_intro_box' ) );

        add_shortcode( 'signature_quartz_page_header', array( $this, 'render_signature_quartz_page_header' ) );

        add_shortcode( 'signature_quartz_section_header', array( $this, 'render_signature_quartz_section_header' ) );

        add_shortcode( 'signature_quartz_skillset', array( $this, 'render_signature_quartz_skillset' ) );

        add_shortcode( 'signature_quartz_team', array( $this, 'render_signature_quartz_team' ) );

        add_shortcode( 'signature_quartz_services', array( $this, 'render_signature_quartz_services' ) );

        add_shortcode( 'signature_quartz_price_table', array( $this, 'render_signature_quartz_price_table' ) );

        add_shortcode( 'signature_rein_text_ticker', array( $this, 'render_signature_rein_text_ticker' ) );

        add_shortcode( 'signature_stefan_team', array( $this, 'render_signature_stefan_team' ) );

        add_shortcode( 'signature_stefan_services', array( $this, 'render_signature_stefan_services' ) );

        add_shortcode( 'signature_stefan_counter', array( $this, 'render_signature_stefan_counter' ) );

        add_shortcode( 'signature_theo_features_slider', array( $this, 'render_signature_theo_features_slider' ) );

        add_shortcode( 'signature_theo_services', array( $this, 'render_signature_theo_services' ) );

        add_shortcode( 'signature_uno_splash_slider', array( $this, 'render_signature_uno_splash_slider' ) );

        add_shortcode( 'signature_uno_reel_slider', array( $this, 'render_signature_uno_reel_slider' ) );

        add_shortcode( 'signature_velten_featured_work', array( $this, 'render_signature_velten_featured_work' ) );

        add_shortcode( 'signature_velten_project_header', array( $this, 'render_signature_velten_project_header' ) );

        add_shortcode( 'signature_wilmar_page_header', array( $this, 'render_signature_wilmar_page_header' ) );

        add_shortcode( 'signature_wilmar_services', array( $this, 'render_signature_wilmar_services' ) );

        add_shortcode( 'signature_xaver_section_header', array( $this, 'render_signature_xaver_section_header' ) );

        add_shortcode( 'signature_xaver_services', array( $this, 'render_signature_xaver_services' ) );

        add_shortcode( 'signature_xaver_team', array( $this, 'render_signature_xaver_team' ) );

        add_shortcode( 'signature_york_counter', array( $this, 'render_signature_york_counter' ) );

        add_shortcode( 'signature_york_team', array( $this, 'render_signature_york_team' ) );

        add_shortcode( 'signature_york_services', array( $this, 'render_signature_york_services' ) );

        add_shortcode( 'signature_recent_product_parallax_showcase', array( $this, 'render_signature_recent_product_parallax_showcase' ) );

        add_shortcode( 'signature_recent_product_minimal_grid', array( $this, 'render_signature_recent_product_minimal_grid' ) );

        add_shortcode( 'signature_amor_background_slider', array( $this, 'render_signature_amor_background_slider' ) );


        // Register CSS and JS
        add_action( 'wp_enqueue_scripts', array( $this, 'loadCssAndJs' ) );
    }
 
    public function integrateWithVC() {
        // Check if Visual Composer is installed
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            // Display notice that Visual Compser is required
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }

        $signature_options = signature_get_options('signature_wp');

        $list_portfolio_groups = array();
        $list_portfolio_groups['Choose One'] = '';
        $portfolio_groups = get_categories(array('type' => 'signature-portfolio', 'taxonomy' => 'signature-portfolio-group'));
        foreach ($portfolio_groups as $group) {
          $group_id = $group->slug;
          $group_name = $group->name;
          $list_portfolio_groups[$group_name] = $group_id;
        }


        vc_map( array(
            "name" => __("Signature Section", 'vc_extend'),
            "description" => __("For any page section", 'vc_extend'),
            "base" => "signature_section",
            "class" => "",
            "controls" => "full",
            "content_element" => true,
            'is_container' => true,
            "show_settings_on_create" => false,
            "icon" => plugins_url('assets/icons/row.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Background Color', 'js_composer' ),
                  'param_name' => 'bg_color',
                  'description' => __( 'Select Background color', 'js_composer' )
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Background Image', 'js_composer' ),
                  'param_name' => 'bg_image',
                  'value' => '',
                  'description' => __( 'Select image from media library.', 'js_composer' )
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( 'Create Full-height Section', 'js_composer' ),
                  'param_name' => 'full_height',
                  'description' => __( 'If selected, the height of the section will be 100%.', 'js_composer' ),
                  'value' => array( __( 'Yes, enable', 'js_composer' ) => 'yes' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              )
            ),
            "js_view" => 'VcColumnView'
        ) );
        

        
        $signature_options = signature_get_options('signature_wp');
        
        vc_map( array(
            "name" => __("Signature Text Block", 'vc_extend'),
            "description" => __("For any block of text", 'vc_extend'),
            "base" => "signature_text_block",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/text_block.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Content", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Enter your content.", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font', 'vc_extend' ),
                  'param_name' => 'font_family',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( $signature_options['body-font']['font-family'] ) => 'font1',
                                    __( $signature_options['alter-body-font']['font-family'] ) => 'font3',
                                    __( $signature_options['heading-font']['font-family'] ) => 'font2',
                                    __( $signature_options['alter-heading-font']['font-family'] ) => 'font4',
                                    __( $signature_options['xblack-font']['font-family'] ) => 'font3xblack',
                                    __( $signature_options['black-font']['font-family'] ) => 'font3black',
                                    __( $signature_options['bold-font']['font-family'] ) => 'font3bold',
                                    __( $signature_options['light-font']['font-family'] ) => 'font3light',
                                    __( $signature_options['xlight-font']['font-family'] ) => 'font3xlight',
                                    __( $signature_options['thin-font']['font-family'] ) => 'font3thin',

                    ),
                  'description' => __( 'Select the Font', 'vc_extend' )
              ),
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Font Color', 'js_composer' ),
                  'param_name' => 'font_color',
                  'description' => __( 'Select Font color', 'js_composer' ),
                  'value' => '#121212'
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Size", 'vc_extend'),
                  "param_name" => "font_size",
                  "value" => __("14px", 'vc_extend'),
                  "description" => __("Specify the font size.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Letter Spacing", 'vc_extend'),
                  "param_name" => "letter_spacing",
                  "value" => __("0px", 'vc_extend'),
                  "description" => __("Specify the letter spacing.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Line Height", 'vc_extend'),
                  "param_name" => "line_height",
                  "value" => __("21px", 'vc_extend'),
                  "description" => __("Specify the line height (7 more than the font size).", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Weight", 'vc_extend'),
                  "param_name" => "font_wt",
                  "value" => __("300", 'vc_extend'),
                  "description" => __("Specify the font weight.", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Case', 'vc_extend' ),
                  'param_name' => 'font_case',
                  'value' => array(
                                    __( 'Normal' ) => '',
                                    __( 'Uppercase' ) => 'uppercase',
                                    __( 'Lowercase' ) => 'lowercase'
                    ),
                  'description' => __( 'Select the font case.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font Style', 'vc_extend' ),
                  'param_name' => 'font_style',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => 'normal',
                                    __( 'Italic' ) => 'italic'
                    ),
                  'description' => __( 'Select the font style.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Decoration', 'vc_extend' ),
                  'param_name' => 'txt_decor',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'None' ) => 'none',
                                    __( 'Underline' ) => 'underline',
                                    __( 'Overline' ) => 'overline',
                                    __( 'Line Through' ) => 'line-through',
                    ),
                  'description' => __( 'Select the text decoration.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'js_composer' ),
                'param_name' => 'css',
                // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'group' => __( 'Design options', 'js_composer' )
              )
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Text Ticker", 'vc_extend'),
            "description" => __("For text ticker", 'vc_extend'),
            "base" => "signature_text_ticker",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/glyphicons/glyphicons_106_text_width.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                    "type" => "textfield",
                    "heading" => __("Text Items", "js_composer"),
                    "param_name" => "txt_items",
                    "holder" => "div",
                    "value" => "word-1, word-2, word-3",
                    "description" => __("Add multiple items seperated by a << COMMA >>", "js_composer")
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font', 'vc_extend' ),
                  'param_name' => 'font_family',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( $signature_options['body-font']['font-family'] ) => 'font1',
                                    __( $signature_options['alter-body-font']['font-family'] ) => 'font3',
                                    __( $signature_options['heading-font']['font-family'] ) => 'font2',
                                    __( $signature_options['alter-heading-font']['font-family'] ) => 'font4',
                                    __( $signature_options['xblack-font']['font-family'] ) => 'font3xblack',
                                    __( $signature_options['black-font']['font-family'] ) => 'font3black',
                                    __( $signature_options['bold-font']['font-family'] ) => 'font3bold',
                                    __( $signature_options['light-font']['font-family'] ) => 'font3light',
                                    __( $signature_options['xlight-font']['font-family'] ) => 'font3xlight',
                                    __( $signature_options['thin-font']['font-family'] ) => 'font3thin',
                    ),
                  'description' => __( 'Select the Font', 'vc_extend' )
              ),
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Font Color', 'js_composer' ),
                  'param_name' => 'font_color',
                  'description' => __( 'Select Font color', 'js_composer' ),
                  'value' => '#121212'
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Size", 'vc_extend'),
                  "param_name" => "font_size",
                  "value" => __("14px", 'vc_extend'),
                  "description" => __("Specify the font size.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Weight", 'vc_extend'),
                  "param_name" => "font_weight",
                  "value" => __("300", 'vc_extend'),
                  "description" => __("Specify the font weight.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Letter Spacing", 'vc_extend'),
                  "param_name" => "letter_spacing",
                  "value" => __("0px", 'vc_extend'),
                  "description" => __("Specify the letter spacing.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Line Height", 'vc_extend'),
                  "param_name" => "line_height",
                  "value" => __("21px", 'vc_extend'),
                  "description" => __("Specify the line height (7 more than the font size).", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Case', 'vc_extend' ),
                  'param_name' => 'font_case',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => '',
                                    __( 'Uppercase' ) => 'uppercase',
                                    __( 'Lowercase' ) => 'lowercase'
                    ),
                  'description' => __( 'Select the font case.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font Style', 'vc_extend' ),
                  'param_name' => 'font_style',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => 'normal',
                                    __( 'Italic' ) => 'italic'
                    ),
                  'description' => __( 'Select the font style.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'js_composer' ),
                'param_name' => 'css',
                // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'group' => __( 'Design options', 'js_composer' )
              )
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Adler Page Header", "js_composer"),
            "base" => "signature_adler_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        
        vc_map( array(
            "name" => __("Signature Adler Section Header", "js_composer"),
            "base" => "signature_adler_section_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Adler Project Header", "js_composer"),
            "base" => "signature_adler_project_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Button", 'vc_extend'),
            "description" => __("For any boxed link", 'vc_extend'),
            "base" => "signature_button",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/button.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Button Text", 'vc_extend'),
                  "param_name" => "btn_text",
                  "value" => __("click here", 'vc_extend'),
                  "description" => __("Enter your text.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Button Link", 'vc_extend'),
                  "param_name" => "btn_link",
                  "value" => __("http://", 'vc_extend'),
                  "description" => __("Enter your link.", 'vc_extend')
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'btn_new_tab',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' )
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'btn_scroll',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'scroll link to a section?', 'js_composer' ) => 'yes' )
              ),
              array(
                    'type' => 'dropdown',
                    'heading' => __( 'Button Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color for the title', 'vc_extend' )
              ),
              
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Round Icon Button", 'vc_extend'),
            "description" => __("For any round icon link", 'vc_extend'),
            "base" => "signature_icon_round_button",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/glyphicons/glyphicons_195_circle_info.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'button_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Button Link", 'vc_extend'),
                  "param_name" => "btn_link",
                  "value" => __("http://", 'vc_extend'),
                  "description" => __("Enter your link.", 'vc_extend')
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'btn_new_tab',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' )
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'btn_scroll',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'scroll link to a section?', 'js_composer' ) => 'yes' )
              ),
              array(
                    'type' => 'dropdown',
                    'heading' => __( 'Button Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color for the title', 'vc_extend' )
              ),
              
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Portfolio", "js_composer"),
            "base" => "signature_portfolio",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/glyphicons/glyphicons_155_show_thumbnails.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Portfolio Group', 'vc_extend' ),
                    'param_name' => 'group',
                    'value' => $list_portfolio_groups,
                    'description' => __( 'Select the portfolio group', 'vc_extend' )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Layout', 'vc_extend' ),
                    'param_name' => 'layout',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Tiled', 'vc_extend' ) => 'tile',
                                      __( 'Spaced', 'vc_extend' ) => 'spaced'
                      ),
                    'description' => __( 'Select the portfolio layout.', 'vc_extend' )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Column Layout', 'vc_extend' ),
                    'param_name' => 'col_layout',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( '2 Columns', 'vc_extend' ) => '2cols',
                                      __( '3 Columns', 'vc_extend' ) => '3cols',
                                      __( 'Multi Columns', 'vc_extend' ) => '4cols'
                      ),
                    'description' => __( 'Select the portfolio column layout.<br/> It is applicable for devices with medium size displays.', 'vc_extend' )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Portfolio Style', 'vc_extend' ),
                    'param_name' => 'portfolio_style',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Adler', 'vc_extend' ) => 'adler',
                                      __( 'berend', 'vc_extend' ) => 'berend',
                                      __( 'claus', 'vc_extend' ) => 'claus',
                                      __( 'dierk', 'vc_extend' ) => 'dierk',
                                      __( 'ebert', 'vc_extend' ) => 'ebert',
                                      __( 'franz', 'vc_extend' ) => 'franz',
                                      __( 'gozzo', 'vc_extend' ) => 'gozzo',
                                      __( 'hans', 'vc_extend' ) => 'hans',
                                      __( 'igor', 'vc_extend' ) => 'igor',
                                      __( 'karl', 'vc_extend' ) => 'karl',
                                      __( 'leon', 'vc_extend' ) => 'leon',
                                      __( 'nemo', 'vc_extend' ) => 'nemo',
                                      __( 'orwin', 'vc_extend' ) => 'orwin',
                                      __( 'phil', 'vc_extend' ) => 'phil',
                                      __( 'quartz', 'vc_extend' ) => 'quartz',
                                      __( 'rein', 'vc_extend' ) => 'rein',
                                      __( 'stefan', 'vc_extend' ) => 'stefan',
                                      __( 'theo', 'vc_extend' ) => 'theo',
                                      __( 'velten', 'vc_extend' ) => 'velten',
                                      __( 'wilmar', 'vc_extend' ) => 'wilmar',
                                      __( 'xaver', 'vc_extend' ) => 'xaver',
                                      __( 'york', 'vc_extend' ) => 'york',
                                      __( 'zircon', 'vc_extend' ) => 'zircon'

                      ),
                    'description' => __( 'Select the overlay style.', 'vc_extend' )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( '', 'js_composer' ),
                    'param_name' => 'filter_display_status',
                    'description' => __( '', 'js_composer' ),
                    'value' => array( __( 'Show portfolio filter', 'js_composer' ) => 'yes' )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "customclass",
                    "description" => __("Add multiple classes seperated by a << SPACE >>", "js_composer")
                )
                
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Liner", "js_composer"),
            "base" => "signature_liner",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/liner.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Size', 'vc_extend' ),
                    'param_name' => 'size',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Large', 'vc_extend' ) => 'v-large',
                                      __( 'Big', 'vc_extend' ) => 'big',
                                      __( 'Medium', 'vc_extend' ) => 'large',
                                      __( 'Small', 'vc_extend' ) => 'small',
                                      __( 'Short', 'vc_extend' ) => 'short'
                      ),
                    'description' => __( 'Select the liner size.', 'vc_extend' )
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Liner Color', 'js_composer' ),
                    'param_name' => 'color',
                    'description' => __( 'Select liner color', 'js_composer' ),
                    'value' => '#fb472e'
                ),
                
                
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Adler Liner Text", "js_composer"),
            "base" => "signature_adler_liner_text",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/liner.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Text", 'vc_extend'),
                    "param_name" => "text",
                    "value" => __("", 'vc_extend')
                ),
                
            )
            
        ) );


        


        vc_map( array(
            "name" => __("Signature Adler Counter", "js_composer"),
            "base" => "signature_adler_counter",
            "icon" => plugins_url('assets/icons/count.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Color Theme', 'vc_extend' ),
                  'param_name' => 'color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'Dark & White', 'vc_extend' ) => 'dark-white',
                                    __( 'Dark & Highlight', 'vc_extend' ) => 'dark-highlight',
                                    __( 'White & Highlight', 'vc_extend' ) => 'white-highlight',
                    ),
                  'description' => __( 'Select the liner size.', 'vc_extend' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Counter Items', 'js_composer' ),
                  'param_name' => 'counter_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Counter One', 'js_composer' ),
                      'count' => '123',
                      'delay' => '100'
                    ),
                    array(
                      'title' => __( 'Counter One', 'js_composer' ),
                      'count' => '123',
                      'delay' => '300'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter counter item title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Count", "js_composer"),
                        "param_name" => "count",
                        "description" => __("Specify the Statistic Count", "js_composer"),
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Delay", "js_composer"),
                        "param_name" => "delay",
                        "description" => __("Specify the Statistic Count start delay in milli seconds.", "js_composer"),
                    ),
                    
                  )
                ),
                
            )
            
            
        ) );


        


        vc_map( array(
            "name" => __("Signature Adler Team", 'vc_extend'),
            "description" => __("For adler type team.", 'vc_extend'),
            "base" => "signature_adler_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
    
            )
        ) );

        

        vc_map( array(
            "name" => __("Signature Adler Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_adler_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );
        
        
        vc_map( array(
            "name" => __("Signature Image Slider", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_adler_image_slider",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/showcase_item.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
              array(
                  'type' => 'attach_images',
                  'heading' => __( 'Slide Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library. You can add multiple images.', 'js_composer' )
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Extra class name", "js_composer"),
                  "param_name" => "customclass",
                  "description" => __("Add multiple classes seperated by a << SPACE >>", "js_composer")
              )
            )
        ) );



        vc_map( array(
            "name" => __("Signature Adler Project Specification List", "js_composer"),
            "base" => "signature_adler_project_spec",
            "icon" => plugins_url('assets/glyphicons/glyphicons_114_list.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Specification List', 'js_composer' ),
                  'param_name' => 'specs',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Category', 'js_composer' ),
                      'spec' => 'Branding & Logo'
                    ),
                    array(
                      'title' => __( 'Client', 'js_composer' ),
                      'spec' => 'NewStreet Inc.'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter counter specification title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Specification", "js_composer"),
                        "param_name" => "spec",
                        "description" => __("Specify the specification", "js_composer"),
                    )
                    
                  )
                ),
                
            )
            
            
        ) );


        vc_map( array(
            "name" => __("Signature Lightbox", 'vc_extend'),
            "description" => __("Image or Video on lightbox", 'vc_extend'),
            "base" => "signature_lightbox",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/lightbox.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                    'type' => 'attach_image',
                    'heading' => __( 'Marquee Image', 'vc_extend' ),
                    'param_name' => 'image',
                    'description' => __( 'Select marquee image', 'vc_extend' )
              ),
              array(
                    'type' => 'dropdown',
                    'heading' => __( 'Marquee Image Style', 'vc_extend' ),
                    'param_name' => 'marquee_style',
                    'value' => array(
                                      __('Select One', 'signaturelang') => '',
                                      __('Normal', 'vc_extend') => 'normal',
                                      __('Fullscreen', 'vc_extend') => 'fullscreen'
                                      
                      ),
                    'description' => __( 'Select the marquee image style', 'vc_extend' )
              ),
              array(
                    'type' => 'dropdown',
                    'heading' => __( 'Lightbox Type', 'vc_extend' ),
                    'param_name' => 'type',
                    'value' => array(
                                      __('Select One', 'signaturelang') => '',
                                      __('Image', 'vc_extend') => 'image',
                                      __( 'Vimeo Video', 'vc_extend' ) => 'vimeo',
                                      __( 'Youtube Video', 'vc_extend' ) => 'youtube'
                                      
                      ),
                    'description' => __( 'Select the lightbox type', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Video URL", 'vc_extend'),
                  "param_name" => "video_url",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Specify the Image or Video URL", 'vc_extend'),
                  "dependency" => array('element'=>'type','value'=>array('vimeo', 'youtube'))
              ),
              array(
                  'type' => 'attach_images',
                  'heading' => __( 'Slide Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library. You can add multiple images.', 'js_composer' ),
                  "dependency" => array('element'=>'type','value'=>array('image'))
              ),
              
              
            )
        ) );


        vc_map( array(
            "name" => __("Signature Parallax Showcase", "js_composer"),
            "base" => "signature_parallax_showcase",
            "icon" => plugins_url('assets/glyphicons/glyphicons_319_sort.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Showcase Items', 'js_composer' ),
                  'param_name' => 'showcase_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Showcase Item 1', 'js_composer' ),
                      'bg_image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes'
                    ),
                    array(
                      'title' => __( 'Showcase Item 2', 'js_composer' ),
                      'bg_image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter showcase item title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                      'type' => 'attach_image',
                      'heading' => __( 'Background Image', 'vc_extend' ),
                      'param_name' => 'bg_image',
                      'description' => __( 'Select background image', 'vc_extend' )
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => __("External Link / URL", "js_composer"),
                      "param_name" => "link",
                      "description" => __("", "js_composer"),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'new_tab_opt',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' ),
                    )
                    
                  )
                ),
                
            )
            
            
        ) );


        vc_map( array(
            "name" => __("Signature Blog Posts", 'vc_extend'),
            "description" => __("Display the blog posts", 'vc_extend'),
            "base" => "signature_blog_posts",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/blog_posts.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Number of Items", 'vc_extend'),
                  "param_name" => "item_no",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Specify the max no.of posts to be displayed.", 'vc_extend')
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'pagination_opt',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'Show Pagination', 'js_composer' ) => 'yes' ),
              ),
              array(
                    'type' => 'dropdown',
                    'heading' => __( 'Blog Style', 'vc_extend' ),
                    'param_name' => 'blog_style',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Adler', 'vc_extend' ) => 'adler',
                                      __( 'berend', 'vc_extend' ) => 'berend',
                                      __( 'claus', 'vc_extend' ) => 'claus',
                                      __( 'dierk', 'vc_extend' ) => 'dierk',
                                      __( 'ebert', 'vc_extend' ) => 'ebert',
                                      __( 'gozzo', 'vc_extend' ) => 'gozzo',
                                      __( 'hans', 'vc_extend' ) => 'hans',
                                      __( 'igor', 'vc_extend' ) => 'igor',
                                      __( 'johan', 'vc_extend' ) => 'johan',
                                      __( 'leon', 'vc_extend' ) => 'leon',
                                      __( 'moritz', 'vc_extend' ) => 'moritz',
                                      __( 'nemo', 'vc_extend' ) => 'nemo',
                                      __( 'orwin', 'vc_extend' ) => 'orwin',
                                      __( 'quartz', 'vc_extend' ) => 'quartz',
                                      __( 'stefan', 'vc_extend' ) => 'stefan',
                                      __( 'theo', 'vc_extend' ) => 'theo',
                                      __( 'uno', 'vc_extend' ) => 'uno',
                                      __( 'velten', 'vc_extend' ) => 'velten',
                                      __( 'wilmar', 'vc_extend' ) => 'wilmar',
                                      __( 'xaver', 'vc_extend' ) => 'xaver',
                                      __( 'york', 'vc_extend' ) => 'york',
                                      __( 'zircon', 'vc_extend' ) => 'zircon'

                      ),
                    'description' => __( 'Select the blog style.', 'vc_extend' )
                ),
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
            
                
            )
        ) );
        
        vc_map( array(
            "name" => __("Signature Contact Form", "js_composer"),
            "base" => "signature_contact_form",
            "icon" => plugins_url('assets/icons/contact_form.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                      'type' => 'dropdown',
                      'heading' => __( 'Form Color Theme', 'vc_extend' ),
                      'param_name' => 'color_theme',
                      'value' => array(
                                        __('Select One', 'dexterlang') => '',
                                        __( 'Dark', 'vc_extend' ) => 'dark',
                                        __( 'White', 'vc_extend') => 'white'
                        ),
                      'description' => __( 'Select the color theme for the contact form', 'vc_extend' )
                ),
                array(
                      'type' => 'dropdown',
                      'heading' => __( 'Form Style', 'vc_extend' ),
                      'param_name' => 'style',
                      'value' => array(
                                        __('Select One', 'dexterlang') => '',
                                        __( 'Lined', 'vc_extend' ) => 'lined',
                                        __( 'Boxed', 'vc_extend') => 'boxed'
                        ),
                      'description' => __( 'Select the style for form', 'vc_extend' )
                ),
                array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
              
            )
        ) );


        vc_map( array(
            "name" => __("Signature Map", "js_composer"),
            "base" => "signature_map",
            "icon" => plugins_url('assets/icons/item.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                      'type' => 'dropdown',
                      'heading' => __( 'Map Style', 'vc_extend' ),
                      'param_name' => 'style',
                      'value' => array(
                                        __('Select One', 'dexterlang') => '',
                                        __( 'Style 1', 'vc_extend' ) => 'style1',
                                        __( 'Style 2', 'vc_extend') => 'style2',
                                        __( 'Style 3', 'vc_extend') => 'style3'
                        ),
                      'description' => __( 'Select the color theme style for map', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Lattitude", "js_composer"),
                    "param_name" => "lat",
                    "description" => __("", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Longitude", "js_composer"),
                    "param_name" => "long",
                    "description" => __("", "js_composer")
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Marker Image', 'js_composer' ),
                    'param_name' => 'marker_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( '', 'js_composer' ),
                    'param_name' => 'fullheight',
                    'description' => __( '', 'js_composer' ),
                    'value' => array( __( 'Enable full height', 'js_composer' ) => 'yes' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Map Height", "js_composer"),
                    "param_name" => "height",
                    "description" => __("", "js_composer"),
                    
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "customclass",
                    "description" => __("Add multiple classes seperated by a << SPACE >>", "js_composer")
                ),
                
            )
        ) );
        


        vc_map( array(
            "name" => __("Signature Berend Feature", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_berend_features",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/features.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the feature heading.", 'vc_extend')
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'feature_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Icon Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme for feature icon.', 'vc_extend' )
                ),
                
            )
        ) );


        vc_map( array(
            "name" => __("Signature Berend Section Header", "js_composer"),
            "base" => "signature_berend_section_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme for section heading.', 'vc_extend' )
                ),
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Berend Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_berend_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );


        vc_map( array(
            "name" => __("Signature Berend Skillset", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_berend_skillset",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/glyphicons/glyphicons_009_magic.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Skill Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the skill title.", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Skill Excellency", "js_composer"),
                    "param_name" => "percent",
                    "value" => "50",
                    "description" => __("Specify the skill excellency.", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Symbol", "js_composer"),
                    "param_name" => "symbol",
                    "value" => "%",
                    "description" => __("Specify the symbol.", "js_composer")
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );
        

        vc_map( array(
            "name" => __("Signature Berend Clients", "js_composer"),
            "base" => "signature_berend_clients",
            "icon" => plugins_url('assets/glyphicons/glyphicons_316_tree_conifer.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Clients', 'js_composer' ),
                  'param_name' => 'clients',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Client 1', 'js_composer' ),
                      'client_image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes'
                    ),
                    array(
                      'title' => __( 'Client 2', 'js_composer' ),
                      'client_image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter showcase item title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                      'type' => 'attach_image',
                      'heading' => __( 'Client Image', 'vc_extend' ),
                      'param_name' => 'client_image',
                      'description' => __( 'Select client image', 'vc_extend' )
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => __("External Link / URL", "js_composer"),
                      "param_name" => "link",
                      "description" => __("", "js_composer"),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'new_tab_opt',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' ),
                    )
                    
                  )
                ),
                
            )
            
            
        ) );


        
        vc_map( array(
            "name" => __("Signature Berend Project Header", "js_composer"),
            "base" => "signature_berend_project_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Sub-heading", 'vc_extend'),
                    "param_name" => "sub_heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Claus Fullscreen Slider", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_claus_fullscreen_slider",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/showcase_item.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
              array(
                  'type' => 'attach_images',
                  'heading' => __( 'Slide Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library. You can add multiple images.', 'js_composer' )
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Slider Heading", "js_composer"),
                  "param_name" => "heading",
                  "description" => __("specify the slider heading.", "js_composer")
              )
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Claus Page Header", "js_composer"),
            "base" => "signature_claus_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        
        vc_map( array(
            "name" => __("Signature Dierk Page Header", "js_composer"),
            "base" => "signature_dierk_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                )
                
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Dierk Split Section", "js_composer"),
            "base" => "signature_dierk_split_section",
            "show_settings_on_create" => true,
            "content_element" => true,
            "is_container" => true,
            "icon" => plugins_url('assets/glyphicons/glyphicons_154_show_big_thumbnails.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Background Color For Content Area', 'js_composer' ),
                    'param_name' => 'bg_color',
                    'description' => __( 'choose the background color for the content area in the split section.', 'js_composer' ),
                    'value' => '#FFFFFF'
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Split Layout Alignment', 'vc_extend' ),
                    'param_name' => 'align',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Content Left', 'vc_extend' ) => 'left',
                                      __( 'Content Right', 'vc_extend' ) => 'right'
                      ),
                    'description' => __( 'Select the split alignment.', 'vc_extend' )
                )
                
            ),
            "js_view" => 'VcColumnView'
        ) );

        vc_map( array(
            "name" => __("Signature Dierk Team", 'vc_extend'),
            "description" => __("For dierk type team.", 'vc_extend'),
            "base" => "signature_dierk_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'White', 'vc_extend' ) => 'white',
                                      __( 'Dark', 'vc_extend' ) => 'dark'
                      ),
                    'description' => __( 'choose the color theme for team section.', 'vc_extend' )
                )
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Dierk Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_dierk_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Ebert Split Slider", "js_composer"),
            "base" => "signature_ebert_split_slider",
            "icon" => plugins_url('assets/icons/split3.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Slide Items', 'js_composer' ),
                  'param_name' => 'slider_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Slide 1', 'js_composer' ),
                      'lft_bg_image' => '',
                      'lft_txt' => 'Left Content',
                      'lft_txt_bg_color' => '#FFFFFF',
                      'lft_txt_color' => '#121212',
                      'lft_link' => 'http://domain.tld/',
                      'lft_new_tab_opt' => 'yes',
                      'rht_bg_image' => '',
                      'rht_txt' => 'Right Content',
                      'rht_txt_bg_color' => '#121212',
                      'rht_txt_color' => '#FFFFFF',
                      'rht_link' => 'http://domain.tld/',
                      'rht_new_tab_opt' => 'yes',
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter slide title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Left Split Background Image', 'js_composer' ),
                        'param_name' => 'lft_bg_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Left Split Text', 'js_composer' ),
                      'param_name' => 'lft_txt',
                      'description' => __( 'Enter the left split text.', 'js_composer' ),
                      
                    ),
                    array(
                      'type' => 'colorpicker',
                      'heading' => __( 'Background Color For Left Split Text', 'js_composer' ),
                      'param_name' => 'lft_txt_bg_color',
                      'description' => __( 'choose the background color for the left split text.', 'js_composer' ),
                      'value' => '#FFFFFF'
                    ),
                    array(
                      'type' => 'colorpicker',
                      'heading' => __( 'Font Color For Left Split Text', 'js_composer' ),
                      'param_name' => 'lft_txt_color',
                      'description' => __( 'choose the font color for the left split text.', 'js_composer' ),
                      'value' => '#121212'
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => __("Left External Link / URL", "js_composer"),
                      "param_name" => "lft_link",
                      "description" => __("", "js_composer"),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'lft_new_tab_opt',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' ),
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Right Split Background Image', 'js_composer' ),
                        'param_name' => 'rht_bg_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Right Split Text', 'js_composer' ),
                      'param_name' => 'rht_txt',
                      'description' => __( 'Enter the right split text.', 'js_composer' ),
                      
                    ),
                    array(
                      'type' => 'colorpicker',
                      'heading' => __( 'Background Color For Right Split Text', 'js_composer' ),
                      'param_name' => 'rht_txt_bg_color',
                      'description' => __( 'choose the background color for the right split text.', 'js_composer' ),
                      'value' => '#121212'
                    ),
                    array(
                      'type' => 'colorpicker',
                      'heading' => __( 'Font Color For Right Split Text', 'js_composer' ),
                      'param_name' => 'rht_txt_color',
                      'description' => __( 'choose the font color for the right split text.', 'js_composer' ),
                      'value' => '#FFFFFF'
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => __("Right External Link / URL", "js_composer"),
                      "param_name" => "rht_link",
                      "description" => __("", "js_composer"),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'rht_new_tab_opt',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' ),
                    ),
                    
                    
                  )
                ),
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Ebert Masonry Image Gallery", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_ebert_masonry_image_gallery",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/bricks.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
              array(
                  'type' => 'attach_images',
                  'heading' => __( 'Gallery Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library. You can add multiple images.', 'js_composer' )
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Extra class name", "js_composer"),
                  "param_name" => "customclass",
                  "description" => __("Add multiple classes seperated by a << SPACE >>", "js_composer")
              )
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Ebert Project Header", "js_composer"),
            "base" => "signature_ebert_project_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Sub-heading", 'vc_extend'),
                    "param_name" => "sub_heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Franz Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_franz_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Franz Project Header", "js_composer"),
            "base" => "signature_franz_project_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Sub-heading", 'vc_extend'),
                    "param_name" => "sub_heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Carousel Wrap", "js_composer"),
            "base" => "signature_carousel_wrap",
            "as_parent" => array('only' => 'signature_carousel_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
            "content_element" => true,
            'is_container' => true,
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/carousel.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "heading" => __("No. of Items per slide in Desktop", "js_composer"),
                    "param_name" => "no_of_items_desk",
                    "description" => __("Specify the number of items per slide to be displayed in desktop.", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("No. of Items per slide in Tablet", "js_composer"),
                    "param_name" => "no_of_items_tab",
                    "description" => __("Specify the number of items per slide to be displayed in tablets (iPad).", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("No. of Items per slide in Mobile", "js_composer"),
                    "param_name" => "no_of_items_mob",
                    "description" => __("Specify the number of items per slide to be displayed in mobile.", "js_composer")
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Navigation Type', 'vc_extend' ),
                    'param_name' => 'nav_type',
                    'value' => array(
                                      __('Select One', 'signaturelang') => '',
                                      __( 'Bullet Type', 'vc_extend' ) => 'bullet-type',
                                      __( 'Directional Type', 'vc_extend' ) => 'dir-type'
                      ),
                    'description' => __( 'Choose The navigation type', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "customclass",
                    "description" => __("Add multiple classes seperated by a << SPACE >>", "js_composer")
                ),
                array(
                  'type' => 'css_editor',
                  'heading' => __( 'Css', 'js_composer' ),
                  'param_name' => 'css',
                  // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                  'group' => __( 'Design options', 'js_composer' )
                )
            ),
            "js_view" => 'VcColumnView'
        ) );


        vc_map( array(
            "name" => __("Signature Carousel Item", "js_composer"),
            "base" => "signature_carousel_item",
            "as_child" => array('only' => 'signature_carousel_wrap'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
            "content_element" => true,
            'is_container' => true,
            "show_settings_on_create" => false,
            "icon" => plugins_url('assets/icons/item.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "customclass",
                    "description" => __("Add multiple classes seperated by a << SPACE >>", "js_composer")
                )
            ),
            "js_view" => 'VcColumnView'
        ) );

  

        vc_map( array(
            "name" => __("Signature Gozzo Project Showcase", "js_composer"),
            "base" => "signature_gozzo_project_showcase",
            "icon" => plugins_url('assets/icons/project_showcase.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Showcase Items', 'js_composer' ),
                  'param_name' => 'showcase_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Showcase Item One', 'js_composer' ),
                      'caption' => 'Sub-heading',
                      'image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes'
                    ),
                    array(
                      'title' => __( 'Showcase Item Two', 'js_composer' ),
                      'caption' => 'Sub-heading',
                      'image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter showcase item title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Caption", "js_composer"),
                        "param_name" => "caption",
                        "description" => __("Specify the showcase item caption.", "js_composer"),
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Project Image', 'js_composer' ),
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => __("External Link / URL", "js_composer"),
                      "param_name" => "link",
                      "description" => __("", "js_composer"),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'new_tab_opt',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' ),
                    )
                    
                  )
                ),
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Gozzo Masonry Image Gallery", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_gozzo_masonry_image_gallery",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/bricks.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
              array(
                  'type' => 'attach_images',
                  'heading' => __( 'Gallery Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library. You can add multiple images.', 'js_composer' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Layout Type', 'vc_extend' ),
                  'param_name' => 'layout',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Tiled', 'vc_extend' ) => 'tiled',
                                    __( 'Spaced', 'vc_extend' ) => 'spaced'
                    ),
                  'description' => __( 'Choose The layout type', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Extra class name", "js_composer"),
                  "param_name" => "customclass",
                  "description" => __("Add multiple classes seperated by a << SPACE >>", "js_composer")
              )
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Gozzo Button", 'vc_extend'),
            "description" => __("For any boxed link", 'vc_extend'),
            "base" => "signature_gozzo_button",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/button.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Button Text", 'vc_extend'),
                  "param_name" => "btn_text",
                  "value" => __("click here", 'vc_extend'),
                  "description" => __("Enter your text.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Button Link", 'vc_extend'),
                  "param_name" => "btn_link",
                  "value" => __("http://", 'vc_extend'),
                  "description" => __("Enter your link.", 'vc_extend')
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'btn_new_tab',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' )
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'btn_scroll',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'scroll link to a section?', 'js_composer' ) => 'yes' )
              ),
              array(
                    'type' => 'dropdown',
                    'heading' => __( 'Button Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color for the title', 'vc_extend' )
              ),
              
            )
        ) );

        

        vc_map( array(
            "name" => __("Signature Hans Splash Slider", "js_composer"),
            "base" => "signature_hans_splash_slider",
            "icon" => plugins_url('assets/icons/splash-slider.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Slider Items', 'js_composer' ),
                  'param_name' => 'slider_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Slide One', 'js_composer' ),
                      'caption' => 'Sample caption text',
                      'image' => ''
                    ),
                    array(
                      'title' => __( 'Slide Two', 'js_composer' ),
                      'caption' => 'Sample caption text',
                      'image' => ''
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter slide title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Caption", "js_composer"),
                        "param_name" => "caption",
                        "description" => __("Specify the slide caption.", "js_composer"),
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Background Image', 'js_composer' ),
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    )
                    
                  )
                ),
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Hans Page Header", "js_composer"),
            "base" => "signature_hans_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Hans Team", 'vc_extend'),
            "description" => __("For hans type team.", 'vc_extend'),
            "base" => "signature_hans_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                )
            )
        ) );
        

        vc_map( array(
            "name" => __("Signature Hans Project Header", "js_composer"),
            "base" => "signature_hans_project_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Hans Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_hans_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Igor Page Header", "js_composer"),
            "base" => "signature_igor_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Sub-heading", 'vc_extend'),
                    "param_name" => "sub_heading",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Igor Content Slider", "js_composer"),
            "base" => "signature_igor_content_slider",
            "icon" => plugins_url('assets/icons/content-slider.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Slider Items', 'js_composer' ),
                  'param_name' => 'slider_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Slide One', 'js_composer' ),
                      'content' => 'This is a sample content.',
                    ),
                    array(
                      'title' => __( 'Slide One', 'js_composer' ),
                      'content' => 'This is a sample content.',
                    ),
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter slide title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Content", "js_composer"),
                        "param_name" => "content",
                        "description" => __("Specify the slide content.", "js_composer"),
                    )
                    
                  )
                ),
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Igor Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_igor_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Igor Team", 'vc_extend'),
            "description" => __("For igor type team.", 'vc_extend'),
            "base" => "signature_igor_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 500px X 750px.', 'js_composer' )
              ),
            )  
        ) );

        
        vc_map( array(
            "name" => __("Signature Johan Page Header", "js_composer"),
            "base" => "signature_johan_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Sub-heading", 'vc_extend'),
                    "param_name" => "sub_heading",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );

        vc_map( array(
            "name" => __("Signature Johan Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_johan_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'feature_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Icon Color', 'js_composer' ),
                    'param_name' => 'icon_color',
                    'description' => __( 'Select Icon color', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                
                
            )
        ) );

        vc_map( array(
            "name" => __("Signature Johan Team", 'vc_extend'),
            "description" => __("For johan type team.", 'vc_extend'),
            "base" => "signature_johan_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Johan Counter", "js_composer"),
            "base" => "signature_johan_counter",
            "icon" => plugins_url('assets/icons/count.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Color Theme', 'vc_extend' ),
                  'param_name' => 'color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'White', 'vc_extend' ) => 'white',
                                    __( 'Dark', 'vc_extend' ) => 'dark',
                                    __( 'Highlight', 'vc_extend' ) => 'highlight',
                    ),
                  'description' => __( 'Select the color theme for the counter.', 'vc_extend' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'js_composer' ),
                'param_name' => 'title',
                'description' => __( 'Enter counter item title.', 'js_composer' ),
                'value' => 'Title'
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Count", "js_composer"),
                  "param_name" => "count",
                  "description" => __("Specify the Statistic Count", "js_composer"),
                  'value' => '123'
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Delay", "js_composer"),
                  "param_name" => "delay",
                  "description" => __("Specify the Statistic Count start delay in milli seconds.", "js_composer"),
                  'value' => '100'
              ),
              
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Karl Text Ticker", 'vc_extend'),
            "description" => __("For karl type text ticker", 'vc_extend'),
            "base" => "signature_karl_text_ticker",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/glyphicons/glyphicons_106_text_width.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                'type' => 'param_group',
                'heading' => __( 'Text Items', 'js_composer' ),
                'param_name' => 'txt_items',
                'value' => urlencode( json_encode( array(
                  array(
                    'txt_item' => __( 'Sample Text', 'js_composer' ),
                  ),
                  array(
                    'txt_item' => __( 'Sample Text', 'js_composer' ),
                  )
                ) ) ),
                'params' => array(
                  array(
                    'type' => 'textfield',
                    'heading' => __( 'Text Item', 'js_composer' ),
                    'param_name' => 'txt_item',
                    'description' => __( 'Enter text item.', 'js_composer' ),
                    'admin_label' => true
                  )
                  
                )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font', 'vc_extend' ),
                  'param_name' => 'font_family',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( $signature_options['body-font']['font-family'] ) => 'font1',
                                    __( $signature_options['alter-body-font']['font-family'] ) => 'font3',
                                    __( $signature_options['heading-font']['font-family'] ) => 'font2',
                                    __( $signature_options['alter-heading-font']['font-family'] ) => 'font4',
                                    __( $signature_options['xblack-font']['font-family'] ) => 'font3xblack',
                                    __( $signature_options['black-font']['font-family'] ) => 'font3black',
                                    __( $signature_options['bold-font']['font-family'] ) => 'font3bold',
                                    __( $signature_options['light-font']['font-family'] ) => 'font3light',
                                    __( $signature_options['xlight-font']['font-family'] ) => 'font3xlight',
                                    __( $signature_options['thin-font']['font-family'] ) => 'font3thin',
                    ),
                  'description' => __( 'Select the Font', 'vc_extend' )
              ),
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Font Color', 'js_composer' ),
                  'param_name' => 'font_color',
                  'description' => __( 'Select Font color', 'js_composer' ),
                  'value' => '#121212'
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Size", 'vc_extend'),
                  "param_name" => "font_size",
                  "value" => __("14px", 'vc_extend'),
                  "description" => __("Specify the font size.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Weight", 'vc_extend'),
                  "param_name" => "font_weight",
                  "value" => __("300", 'vc_extend'),
                  "description" => __("Specify the font weight.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Letter Spacing", 'vc_extend'),
                  "param_name" => "letter_spacing",
                  "value" => __("0px", 'vc_extend'),
                  "description" => __("Specify the letter spacing.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Line Height", 'vc_extend'),
                  "param_name" => "line_height",
                  "value" => __("21px", 'vc_extend'),
                  "description" => __("Specify the line height (7 more than the font size).", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Case', 'vc_extend' ),
                  'param_name' => 'font_case',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => '',
                                    __( 'Uppercase' ) => 'uppercase',
                                    __( 'Lowercase' ) => 'lowercase'
                    ),
                  'description' => __( 'Select the font case.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font Style', 'vc_extend' ),
                  'param_name' => 'font_style',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => 'normal',
                                    __( 'Italic' ) => 'italic'
                    ),
                  'description' => __( 'Select the font style.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'js_composer' ),
                'param_name' => 'css',
                // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'group' => __( 'Design options', 'js_composer' )
              )
            )
        ) );
        
        vc_map( array(
            "name" => __("Signature Karl Team", 'vc_extend'),
            "description" => __("For karl type team.", 'vc_extend'),
            "base" => "signature_karl_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        vc_map( array(
            "name" => __("Signature Text Eraser", 'vc_extend'),
            "description" => __("For text animation", 'vc_extend'),
            "base" => "signature_text_eraser",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/glyphicons/glyphicons_104_text_strike.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Text Elements", 'vc_extend'),
                  "param_name" => "text_content",
                  "value" => __("Text1, Text2, Text3", 'vc_extend'),
                  "description" => __("Add multiple elements seperated by a << COMMA >>.", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font', 'vc_extend' ),
                  'param_name' => 'font_family',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( $signature_options['body-font']['font-family'] ) => 'font1',
                                    __( $signature_options['alter-body-font']['font-family'] ) => 'font3',
                                    __( $signature_options['heading-font']['font-family'] ) => 'font2',
                                    __( $signature_options['alter-heading-font']['font-family'] ) => 'font4',
                                    __( $signature_options['xblack-font']['font-family'] ) => 'font3xblack',
                                    __( $signature_options['black-font']['font-family'] ) => 'font3black',
                                    __( $signature_options['bold-font']['font-family'] ) => 'font3bold',
                                    __( $signature_options['light-font']['font-family'] ) => 'font3light',
                                    __( $signature_options['xlight-font']['font-family'] ) => 'font3xlight',
                                    __( $signature_options['thin-font']['font-family'] ) => 'font3thin',
                    ),
                  'description' => __( 'Select the Font', 'vc_extend' )
              ),
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Font Color', 'js_composer' ),
                  'param_name' => 'font_color',
                  'description' => __( 'Select Font color', 'js_composer' ),
                  'value' => '#121212'
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Size", 'vc_extend'),
                  "param_name" => "font_size",
                  "value" => __("14px", 'vc_extend'),
                  "description" => __("Specify the font size.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Weight", 'vc_extend'),
                  "param_name" => "font_weight",
                  "value" => __("300", 'vc_extend'),
                  "description" => __("Specify the font weight.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Letter Spacing", 'vc_extend'),
                  "param_name" => "letter_spacing",
                  "value" => __("0px", 'vc_extend'),
                  "description" => __("Specify the letter spacing.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Line Height", 'vc_extend'),
                  "param_name" => "line_height",
                  "value" => __("21px", 'vc_extend'),
                  "description" => __("Specify the line height (7 more than the font size).", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Case', 'vc_extend' ),
                  'param_name' => 'font_case',
                  'value' => array(
                                    __('Select One', 'dexterlang') => '',
                                    __( 'Normal' ) => '',
                                    __( 'Uppercase' ) => 'uppercase',
                                    __( 'Lowercase' ) => 'lowercase'
                    ),
                  'description' => __( 'Select the font case.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font Style', 'vc_extend' ),
                  'param_name' => 'font_style',
                  'value' => array(
                                    __('Select One', 'dexterlang') => '',
                                    __( 'Normal' ) => 'normal',
                                    __( 'Italic' ) => 'italic'
                    ),
                  'description' => __( 'Select the font style.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'js_composer' ),
                'param_name' => 'css',
                // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'group' => __( 'Design options', 'js_composer' )
              )
            )
        ) );

        vc_map( array(
            "name" => __("Signature Leon Team", 'vc_extend'),
            "description" => __("For leon type team.", 'vc_extend'),
            "base" => "signature_leon_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        vc_map( array(
            "name" => __("Signature Leon Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_leon_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'feature_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Alignment', 'vc_extend' ),
                    'param_name' => 'align',
                    'value' => array(
                                      __('Select One', 'dexterlang') => '',
                                      __( 'Left' ) => 'left',
                                      __( 'Right' ) => 'right'
                      ),
                    'description' => __( 'Select the alignment style.', 'vc_extend' )
                ),
                
            )
        ) );
  

        vc_map( array(
            "name" => __("Signature Moritz Counter", "js_composer"),
            "base" => "signature_moritz_counter",
            "icon" => plugins_url('assets/icons/count.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Color Theme', 'vc_extend' ),
                  'param_name' => 'color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'White', 'vc_extend' ) => 'white',
                                    __( 'Dark', 'vc_extend' ) => 'dark',
                                    __( 'Highlight', 'vc_extend' ) => 'highlight',
                    ),
                  'description' => __( 'Select the color theme for the counter.', 'vc_extend' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'js_composer' ),
                'param_name' => 'title',
                'holder' => 'div',
                'description' => __( 'Enter counter item title.', 'js_composer' ),
                'value' => 'Title'
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Count", "js_composer"),
                  "param_name" => "count",
                  "description" => __("Specify the Statistic Count", "js_composer"),
                  'value' => '123',
                  'holder' => 'div',
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Delay", "js_composer"),
                  "param_name" => "delay",
                  "description" => __("Specify the Statistic Count start delay in milli seconds.", "js_composer"),
                  'value' => '100'
              ),
              
                
            )
            
            
        ) );


        
        vc_map( array(
            "name" => __("Signature Moritz Team", 'vc_extend'),
            "description" => __("For moritz type team.", 'vc_extend'),
            "base" => "signature_moritz_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        vc_map( array(
            "name" => __("Signature Moritz Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_moritz_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'feature_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Icon Color Theme', 'vc_extend' ),
                    'param_name' => 'icon_color',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend' ) => 'white',
                                      __( 'Highlight', 'vc_extend' ) => 'color'
                      ),
                    'description' => __( 'Select the color for icon.', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                
                
            )
        ) );


        vc_map( array(
            "name" => __("Signature Nemo Team", 'vc_extend'),
            "description" => __("For nemo type team.", 'vc_extend'),
            "base" => "signature_nemo_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        vc_map( array(
            "name" => __("Signature Orwin Page Header", "js_composer"),
            "base" => "signature_orwin_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Sub-heading", 'vc_extend'),
                    "param_name" => "sub_heading",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Orwin Process Carousel", "js_composer"),
            "base" => "signature_orwin_process_carousel",
            "icon" => plugins_url('assets/icons/carousel.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Color Theme', 'vc_extend' ),
                  'param_name' => 'color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'White', 'vc_extend' ) => 'white',
                                    __( 'Dark', 'vc_extend' ) => 'dark',
                                    __( 'Highlight', 'vc_extend' ) => 'color',
                    ),
                  'description' => __( 'Select the color theme.', 'vc_extend' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Carousel Items', 'js_composer' ),
                  'param_name' => 'carousel_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Item One', 'js_composer' ),
                      'thin_txt' => 'Sapmle text for thin font ',
                      'bold_txt' => 'and this is sample text for bold font.'
                    ),
                    array(
                      'title' => __( 'Item Two', 'js_composer' ),
                      'thin_txt' => 'Sapmle text for thin font ',
                      'bold_txt' => 'and this is sample text for bold font.'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter carousel item title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Thin Text", "js_composer"),
                        "param_name" => "thin_txt",
                        "description" => __("Enter the thin text.", "js_composer"),
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Bold Text", "js_composer"),
                        "param_name" => "bold_txt",
                        "description" => __("Enter the bold text.", "js_composer"),
                    ),
                    
                  )
                ),
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Orwin Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_orwin_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend' ) => 'white',
                                      __( 'Highlight', 'vc_extend' ) => 'color'
                      ),
                    'description' => __( 'Select the color for text.', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                
                
            )
        ) );

        

        vc_map( array(
            "name" => __("Signature Orwin Team", 'vc_extend'),
            "description" => __("For orwin type team.", 'vc_extend'),
            "base" => "signature_orwin_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Orwin Parallax Showcase", "js_composer"),
            "base" => "signature_orwin_parallax_showcase",
            "icon" => plugins_url('assets/glyphicons/glyphicons_319_sort.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Showcase Items', 'js_composer' ),
                  'param_name' => 'showcase_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Showcase Item 1', 'js_composer' ),
                      'title_color_theme' => 'black',
                      'bg_image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes',
                      'overlay_color_theme' => 'trans-white-bg',
                    ),
                    array(
                      'title' => __( 'Showcase Item 2', 'js_composer' ),
                      'title_color_theme' => 'black',
                      'bg_image' => '',
                      'link' => 'http://domain.tld',
                      'new_tab_opt' => 'yes',
                      'overlay_color_theme' => 'trans-white-bg',
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter showcase item title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                      'type' => 'dropdown',
                      'heading' => __( 'Title Color', 'vc_extend' ),
                      'param_name' => 'title_color_theme',
                      'value' => array(
                                        __( 'Choose One', 'vc_extend' ) => '',
                                        __( 'Black', 'vc_extend' ) => 'black',
                                        __( 'Dark', 'vc_extend' ) => 'dark',
                                        __( 'White', 'vc_extend' ) => 'white',
                                        __( 'Highlight', 'vc_extend' ) => 'color'
                        ),
                      'description' => __( 'Select the color for text.', 'vc_extend' )
                    ),
                    array(
                      'type' => 'attach_image',
                      'heading' => __( 'Background Image', 'vc_extend' ),
                      'param_name' => 'bg_image',
                      'description' => __( 'Select background image', 'vc_extend' )
                    ),
                    array(
                      "type" => "textfield",
                      "heading" => __("External Link / URL", "js_composer"),
                      "param_name" => "link",
                      "description" => __("", "js_composer"),
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'new_tab_opt',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' ),
                    ),
                    array(
                      'type' => 'dropdown',
                      'heading' => __( 'Overlay Color', 'vc_extend' ),
                      'param_name' => 'overlay_color_theme',
                      'value' => array(
                                        __( 'Choose One', 'vc_extend' ) => '',
                                        __( 'Dark', 'vc_extend' ) => 'trans-dark-bg',
                                        __( 'White', 'vc_extend' ) => 'trans-white-bg',
                                        __( 'Highlight', 'vc_extend' ) => 'trans-color-bg'
                        ),
                      'description' => __( 'Select the color for the overlay.', 'vc_extend' )
                    ),
                    
                  )
                ),
                
            )
            
            
        ) );


vc_map( array(
            "name" => __("Signature Flickr Gallery", 'vc_extend'),
            "description" => __("For flickr gallery.", 'vc_extend'),
            "base" => "signature_flickr_gallery",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/flickr14.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("User ID", 'vc_extend'),
                  "param_name" => "user_id",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Flickr API Key", 'vc_extend'),
                  "param_name" => "api_key",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Secret Key", 'vc_extend'),
                  "param_name" => "secret_key",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Flickr PhotoSet ID", 'vc_extend'),
                  "param_name" => "photoset_id",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),  
            )
        ) );
        


        vc_map( array(
            "name" => __("Signature Quartz Background Slider", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_quartz_background_slider",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/showcase_item.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
              array(
                  'type' => 'attach_images',
                  'heading' => __( 'Slide Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library. You can add multiple images.', 'js_composer' )
              )
            )
        ) );


        vc_map( array(
            "name" => __("Signature Quartz Intro Box", 'vc_extend'),
            "description" => __("For Quartz type text animation", 'vc_extend'),
            "base" => "signature_quartz_intro_box",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/letters1.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Text Elements", 'vc_extend'),
                  "param_name" => "text_content",
                  "value" => __("Text1, Text2, Text3", 'vc_extend'),
                  "description" => __("Add multiple elements seperated by a << COMMA >>.", 'vc_extend')
              ),
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Font Color', 'js_composer' ),
                  'param_name' => 'font_color',
                  'description' => __( 'Select Font color', 'js_composer' ),
                  'value' => '#111111'
              ),
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Border Color', 'js_composer' ),
                  'param_name' => 'border_color',
                  'description' => __( 'Select Font color', 'js_composer' ),
                  'value' => '#111111'
              ),
              array(
                "type" => "textfield",
                "heading" => __("Box Link / URL", "js_composer"),
                "param_name" => "link",
                "description" => __("", "js_composer"),
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'new_tab',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' ),
              ),
            )
        ) );


        vc_map( array(
            "name" => __("Signature Quartz Page Header", "js_composer"),
            "base" => "signature_quartz_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Content", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Enter your content.", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font', 'vc_extend' ),
                  'param_name' => 'font_family',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( $signature_options['body-font']['font-family'] ) => 'font1',
                                    __( $signature_options['alter-body-font']['font-family'] ) => 'font3',
                                    __( $signature_options['heading-font']['font-family'] ) => 'font2',
                                    __( $signature_options['alter-heading-font']['font-family'] ) => 'font4',
                                    __( $signature_options['xblack-font']['font-family'] ) => 'font3xblack',
                                    __( $signature_options['black-font']['font-family'] ) => 'font3black',
                                    __( $signature_options['bold-font']['font-family'] ) => 'font3bold',
                                    __( $signature_options['light-font']['font-family'] ) => 'font3light',
                                    __( $signature_options['xlight-font']['font-family'] ) => 'font3xlight',
                                    __( $signature_options['thin-font']['font-family'] ) => 'font3thin',

                    ),
                  'description' => __( 'Select the Font', 'vc_extend' )
              ),
              array(
                  'type' => 'colorpicker',
                  'heading' => __( 'Font Color', 'js_composer' ),
                  'param_name' => 'font_color',
                  'description' => __( 'Select Font color', 'js_composer' ),
                  'value' => '#121212'
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Size", 'vc_extend'),
                  "param_name" => "font_size",
                  "value" => __("14px", 'vc_extend'),
                  "description" => __("Specify the font size.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Letter Spacing", 'vc_extend'),
                  "param_name" => "letter_spacing",
                  "value" => __("0px", 'vc_extend'),
                  "description" => __("Specify the letter spacing.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Line Height", 'vc_extend'),
                  "param_name" => "line_height",
                  "value" => __("21px", 'vc_extend'),
                  "description" => __("Specify the line height (7 more than the font size).", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Weight", 'vc_extend'),
                  "param_name" => "font_wt",
                  "value" => __("300", 'vc_extend'),
                  "description" => __("Specify the font weight.", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Case', 'vc_extend' ),
                  'param_name' => 'font_case',
                  'value' => array(
                                    __( 'Normal' ) => '',
                                    __( 'Uppercase' ) => 'uppercase',
                                    __( 'Lowercase' ) => 'lowercase'
                    ),
                  'description' => __( 'Select the font case.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font Style', 'vc_extend' ),
                  'param_name' => 'font_style',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => 'normal',
                                    __( 'Italic' ) => 'italic'
                    ),
                  'description' => __( 'Select the font style.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Decoration', 'vc_extend' ),
                  'param_name' => 'txt_decor',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'None' ) => 'none',
                                    __( 'Underline' ) => 'underline',
                                    __( 'Overline' ) => 'overline',
                                    __( 'Line Through' ) => 'line-through',
                    ),
                  'description' => __( 'Select the text decoration.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
              
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Quartz Section Header", "js_composer"),
            "base" => "signature_quartz_section_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Quartz Skillset", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_quartz_skillset",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/glyphicons/glyphicons_009_magic.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => __("Skill Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the skill title.", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Skill Excellency", "js_composer"),
                    "param_name" => "percent",
                    "value" => "50",
                    "description" => __("Specify the skill excellency.", "js_composer")
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Symbol", "js_composer"),
                    "param_name" => "symbol",
                    "value" => "%",
                    "description" => __("Specify the symbol.", "js_composer")
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );


        vc_map( array(
            "name" => __("Signature Quartz Team", 'vc_extend'),
            "description" => __("For quartz type team.", 'vc_extend'),
            "base" => "signature_quartz_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Quartz Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_quartz_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend' ) => 'white',
                                      __( 'Highlight', 'vc_extend' ) => 'color'
                      ),
                    'description' => __( 'Select the color for text.', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Quartz Price Table", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_quartz_price_table",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/pricetable.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend' ) => 'white',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color'
                      ),
                    'description' => __( 'Select the color for the table.', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Currency", 'vc_extend'),
                    "param_name" => "currency",
                    "value" => __("$", 'vc_extend'),
                    "description" => __("Specify the currency.", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Amount", 'vc_extend'),
                    "param_name" => "amount",
                    "value" => __("100", 'vc_extend'),
                    "description" => __("Specify the amount.", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Button Text", 'vc_extend'),
                    "param_name" => "btn_text",
                    "value" => __("buy now", 'vc_extend'),
                    "description" => __("Enter your text.", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __("Button Link", 'vc_extend'),
                    "param_name" => "btn_link",
                    "value" => __("http://", 'vc_extend'),
                    "description" => __("Enter your link.", 'vc_extend')
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( '', 'js_composer' ),
                    'param_name' => 'btn_new_tab',
                    'description' => __( '', 'js_composer' ),
                    'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Button Color Theme', 'vc_extend' ),
                    'param_name' => 'btn_color_theme',
                    'value' => array(
                                      __('Select One', 'dexterlang') => '',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend') => 'white',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color'
                      ),
                    'description' => __( 'Select the color for the button', 'vc_extend' )
                ),
                array(
                  'type' => 'param_group',
                  'heading' => __( 'Plan Features', 'js_composer' ),
                  'param_name' => 'plans',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Feature One', 'js_composer' ),
                    ),
                    array(
                      'title' => __( 'Feature Two', 'js_composer' ),
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Plan Feature', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter plan feature.', 'js_composer' ),
                      'admin_label' => true
                    ),
                  )
                ),
                
                
            )
        ) );
        

        vc_map( array(
            "name" => __("Signature Rein Text Ticker", 'vc_extend'),
            "description" => __("For rein type text ticker", 'vc_extend'),
            "base" => "signature_rein_text_ticker",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/glyphicons/glyphicons_106_text_width.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Text Items', 'js_composer' ),
                  'param_name' => 'text_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Text Item One', 'js_composer' ),
                      'font_color' => '#121212'
                    ),
                    array(
                      'title' => __( 'Text Item Two', 'js_composer' ),
                      'font_color' => '#121212'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Text Item', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter text.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                      'type' => 'colorpicker',
                      'heading' => __( 'Font Color', 'js_composer' ),
                      'param_name' => 'font_color',
                      'description' => __( 'Select Font color', 'js_composer' ),
                      'value' => '#121212'
                    ),
              
                  )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font', 'vc_extend' ),
                  'param_name' => 'font_family',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( $signature_options['body-font']['font-family'] ) => 'font1',
                                    __( $signature_options['alter-body-font']['font-family'] ) => 'font3',
                                    __( $signature_options['heading-font']['font-family'] ) => 'font2',
                                    __( $signature_options['alter-heading-font']['font-family'] ) => 'font4',
                                    __( $signature_options['xblack-font']['font-family'] ) => 'font3xblack',
                                    __( $signature_options['black-font']['font-family'] ) => 'font3black',
                                    __( $signature_options['bold-font']['font-family'] ) => 'font3bold',
                                    __( $signature_options['light-font']['font-family'] ) => 'font3light',
                                    __( $signature_options['xlight-font']['font-family'] ) => 'font3xlight',
                                    __( $signature_options['thin-font']['font-family'] ) => 'font3thin',
                    ),
                  'description' => __( 'Select the Font', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Size", 'vc_extend'),
                  "param_name" => "font_size",
                  "value" => __("14px", 'vc_extend'),
                  "description" => __("Specify the font size.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Font Weight", 'vc_extend'),
                  "param_name" => "font_weight",
                  "value" => __("300", 'vc_extend'),
                  "description" => __("Specify the font weight.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Letter Spacing", 'vc_extend'),
                  "param_name" => "letter_spacing",
                  "value" => __("0px", 'vc_extend'),
                  "description" => __("Specify the letter spacing.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Line Height", 'vc_extend'),
                  "param_name" => "line_height",
                  "value" => __("21px", 'vc_extend'),
                  "description" => __("Specify the line height (7 more than the font size).", 'vc_extend')
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Text Case', 'vc_extend' ),
                  'param_name' => 'font_case',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => '',
                                    __( 'Uppercase' ) => 'uppercase',
                                    __( 'Lowercase' ) => 'lowercase'
                    ),
                  'description' => __( 'Select the font case.', 'vc_extend' )
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Font Style', 'vc_extend' ),
                  'param_name' => 'font_style',
                  'value' => array(
                                    __('Choose One', 'signaturelang') => '',
                                    __( 'Normal' ) => 'normal',
                                    __( 'Italic' ) => 'italic'
                    ),
                  'description' => __( 'Select the font style.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
              array(
                'type' => 'css_editor',
                'heading' => __( 'Css', 'js_composer' ),
                'param_name' => 'css',
                // 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                'group' => __( 'Design options', 'js_composer' )
              )
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Stefan Team", 'vc_extend'),
            "description" => __("For orwin type team.", 'vc_extend'),
            "base" => "signature_stefan_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 300px X 300px.', 'js_composer' )
              ),
              
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Stefan Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_stefan_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend' ) => 'white',
                                      __( 'Highlight', 'vc_extend' ) => 'color'
                      ),
                    'description' => __( 'Select the color for text.', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                
                
            )
        ) );

        

        vc_map( array(
            "name" => __("Signature Stefan Counter", "js_composer"),
            "base" => "signature_stefan_counter",
            "icon" => plugins_url('assets/icons/count.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'js_composer' ),
                'param_name' => 'title',
                'description' => __( 'Enter counter item title.', 'js_composer' ),
                'value' => 'Title',
                "holder" => "div",
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Title Color Theme', 'vc_extend' ),
                  'param_name' => 'title_color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'White', 'vc_extend' ) => 'white',
                                    __( 'Dark', 'vc_extend' ) => 'dark',
                                    __( 'Highlight', 'vc_extend' ) => 'color',
                    ),
                  'description' => __( 'Select the color theme for the counter title.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Count", "js_composer"),
                  "param_name" => "count",
                  "description" => __("Specify the Statistic Count", "js_composer"),
                  'value' => '123',
                  "holder" => "div",
              ),
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Count Color Theme', 'vc_extend' ),
                  'param_name' => 'count_color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'White', 'vc_extend' ) => 'white',
                                    __( 'Dark', 'vc_extend' ) => 'dark',
                                    __( 'Highlight', 'vc_extend' ) => 'color',
                    ),
                  'description' => __( 'Select the color theme for the counter count.', 'vc_extend' )
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Delay", "js_composer"),
                  "param_name" => "delay",
                  "description" => __("Specify the Statistic Count start delay in milli seconds.", "js_composer"),
                  'value' => '100'
              ),
              
                
            )
            
            
        ) );


        vc_map( array(
            "name" => __("Signature Theo Features Slider", "js_composer"),
            "base" => "signature_theo_features_slider",
            "icon" => plugins_url('assets/icons/content-slider.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Color Theme', 'vc_extend' ),
                  'param_name' => 'color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'White', 'vc_extend' ) => 'white',
                                    __( 'Dark', 'vc_extend' ) => 'dark'
                    ),
                  'description' => __( 'Select the color theme for the features slider.', 'vc_extend' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Slider Items', 'js_composer' ),
                  'param_name' => 'slider_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Slide One', 'js_composer' ),
                      'feature_icon' => 'ion-alert',
                      'content' => 'This is a sample content.',
                    ),
                    array(
                      'title' => __( 'Slide Two', 'js_composer' ),
                      'feature_icon' => 'ion-alert',
                      'content' => 'This is a sample content.',
                    ),
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter slide title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                      'type' => 'iconpicker',
                      'heading' => __( 'Icon', 'js_composer' ),
                      'param_name' => 'feature_icon',
                      'value' => 'ion-alert', // default value to backend editor admin_label
                      'settings' => array(
                        'emptyIcon' => false, // default true, display an "EMPTY" icon?
                        'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                        'type' => 'ion_icons',
                      ),
                      'description' => __( 'Select icon from library.', 'js_composer' ),
                    ),
                    array(
                        "type" => "textarea",
                        "heading" => __("Content", "js_composer"),
                        "param_name" => "content",
                        "description" => __("Specify the slide content.", "js_composer"),
                    )
                    
                  )
                ),
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Theo Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_theo_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'vc_extend' ) => '',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend' ) => 'white',
                                      __( 'Highlight', 'vc_extend' ) => 'color'
                      ),
                    'description' => __( 'Select the color for text.', 'vc_extend' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                
                
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Uno Splash Slider", "js_composer"),
            "base" => "signature_uno_splash_slider",
            "icon" => plugins_url('assets/icons/splash-slider.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Slider Items', 'js_composer' ),
                  'param_name' => 'slider_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Slide One', 'js_composer' ),
                      'caption' => 'Sample caption text',
                      'image' => '',
                      'link' => 'http://',
                      'new_tab' => ''
                    ),
                    array(
                      'title' => __( 'Slide Two', 'js_composer' ),
                      'caption' => 'Sample caption text',
                      'image' => '',
                      'link' => 'http://',
                      'new_tab' => ''
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter slide title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Caption", "js_composer"),
                        "param_name" => "caption",
                        "description" => __("Specify the slide caption.", "js_composer"),
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Background Image', 'js_composer' ),
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Link", 'vc_extend'),
                        "param_name" => "link",
                        "value" => __("http://", 'vc_extend'),
                        "description" => __("Enter your link.", 'vc_extend')
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'new_tab',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' )
                    ),
                  )
                ),
                
            )
            
            
        ) );

        vc_map( array(
            "name" => __("Signature Uno Reel Slider", "js_composer"),
            "base" => "signature_uno_reel_slider",
            "icon" => plugins_url('assets/icons/reel-slider.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Slider Items', 'js_composer' ),
                  'param_name' => 'slider_items',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Slide One', 'js_composer' ),
                      'caption' => 'Sample caption text',
                      'image' => '',
                      'link' => 'http://',
                      'new_tab' => ''
                    ),
                    array(
                      'title' => __( 'Slide Two', 'js_composer' ),
                      'caption' => 'Sample caption text',
                      'image' => '',
                      'link' => 'http://',
                      'new_tab' => ''
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter slide title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Caption", "js_composer"),
                        "param_name" => "caption",
                        "description" => __("Specify the slide caption.", "js_composer"),
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Background Image', 'js_composer' ),
                        'param_name' => 'image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "class" => "",
                        "heading" => __("Link", 'vc_extend'),
                        "param_name" => "link",
                        "value" => __("http://", 'vc_extend'),
                        "description" => __("Enter your link.", 'vc_extend')
                    ),
                    array(
                        'type' => 'checkbox',
                        'heading' => __( '', 'js_composer' ),
                        'param_name' => 'new_tab',
                        'description' => __( '', 'js_composer' ),
                        'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' )
                    ),
                  )
                ),
                
            )
            
            
        ) );

        
        vc_map( array(
            "name" => __("Signature Velten Featured Work", "js_composer"),
            "base" => "signature_velten_featured_work",
            "icon" => plugins_url('assets/icons/featured-projects.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'js_composer' ),
                'param_name' => 'title',
                'description' => __( 'Enter slide title.', 'js_composer' ),
                "holder" => "div",
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Background Image', 'js_composer' ),
                  'param_name' => 'bg_image',
                  'value' => '',
                  'description' => __( 'Select image from media library.', 'js_composer' )
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Link", 'vc_extend'),
                  "param_name" => "link",
                  "value" => __("http://", 'vc_extend'),
                  "description" => __("Enter your link.", 'vc_extend')
              ),
              array(
                  'type' => 'checkbox',
                  'heading' => __( '', 'js_composer' ),
                  'param_name' => 'new_tab',
                  'description' => __( '', 'js_composer' ),
                  'value' => array( __( 'Open link in a new window/tab', 'js_composer' ) => 'yes' )
              ),
                
            )
            
            
        ) );
        

        vc_map( array(
            "name" => __("Signature Velten Project Header", "js_composer"),
            "base" => "signature_velten_project_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Sub-heading", 'vc_extend'),
                    "param_name" => "sub_heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );


        vc_map( array(
            "name" => __("Signature Wilmar Page Header", "js_composer"),
            "base" => "signature_wilmar_page_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    'type' => 'attach_image',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'bg_image',
                    'value' => '',
                    'description' => __( 'Select image from media library.', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Promotional Text", 'vc_extend'),
                    "param_name" => "promo_txt",
                    "value" => __("", 'vc_extend')
                )
            )
            
        ) );

        vc_map( array(
            "name" => __("Signature Wilmar Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_wilmar_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'Black', 'vc_extend' ) => 'black',
                                      __( 'Grey', 'vc_extend' ) => 'grey',
                                      __( 'Silver', 'vc_extend' ) => 'silver',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Xaver Section Header", "js_composer"),
            "base" => "signature_xaver_section_header",
            "show_settings_on_create" => true,
            "icon" => plugins_url('assets/icons/page_heading.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
            
        ) );

        vc_map( array(
            "name" => __("Signature Xaver Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_xaver_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'service_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Service Title", "js_composer"),
                    "param_name" => "title",
                    "holder" => "div",
                    "description" => __("Specify the title for the service.", "js_composer")
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color Theme', 'vc_extend' ),
                    'param_name' => 'color_theme',
                    'value' => array(
                                      __( 'Choose One', 'signaturelang') => '',
                                      __( 'Highlight Color', 'vc_extend' ) => 'color',
                                      __( 'Dark', 'vc_extend' ) => 'dark',
                                      __( 'White', 'vc_extend') => 'white'
                      ),
                    'description' => __( 'Select the color theme', 'vc_extend' )
                ),
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Xaver Team", 'vc_extend'),
            "description" => __("For xaver type team.", 'vc_extend'),
            "base" => "signature_xaver_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 500px X 500px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature York Counter", "js_composer"),
            "base" => "signature_york_counter",
            "icon" => plugins_url('assets/icons/count.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
                // add params same as with any other content element
              array(
                  'type' => 'dropdown',
                  'heading' => __( 'Color Theme', 'vc_extend' ),
                  'param_name' => 'color_theme',
                  'value' => array(
                                    __( 'Choose One', 'vc_extend' ) => '',
                                    __( 'White', 'vc_extend' ) => 'white',
                                    __( 'Dark', 'vc_extend' ) => 'dark',
                                    __( 'Highlight', 'vc_extend' ) => 'highlight',
                    ),
                  'description' => __( 'Select the color theme for the counter.', 'vc_extend' )
              ),
              array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'js_composer' ),
                'param_name' => 'title',
                'description' => __( 'Enter counter item title.', 'js_composer' ),
                'value' => 'Title',
                "holder" => "div",
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Count", "js_composer"),
                  "param_name" => "count",
                  "description" => __("Specify the Statistic Count", "js_composer"),
                  'value' => '123',
                  "holder" => "div",
              ),
              array(
                  "type" => "textfield",
                  "heading" => __("Delay", "js_composer"),
                  "param_name" => "delay",
                  "description" => __("Specify the Statistic Count start delay in milli seconds.", "js_composer"),
                  'value' => '100'
              ),
              
                
            )
            
            
        ) );

        vc_map( array(
            "name" => __("Signature York Team", 'vc_extend'),
            "description" => __("For york type team.", 'vc_extend'),
            "base" => "signature_york_team",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/team.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Name", 'vc_extend'),
                  "param_name" => "name",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Staff Designation", 'vc_extend'),
                  "param_name" => "designation",
                  "value" => __("", 'vc_extend'),
                  "description" => __("", 'vc_extend')
              ),
              array(
                  "type" => "textarea",
                  "class" => "",
                  "heading" => __("Staff Description", 'vc_extend'),
                  "param_name" => "content",
                  "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                  "description" => __("Provide the description about the staff.", 'vc_extend')
              ),
              array(
                  'type' => 'attach_image',
                  'heading' => __( 'Staff Image', 'js_composer' ),
                  'param_name' => 'staff_image',
                  'value' => '',
                  'description' => __( 'Select image from media library. Use the image of size 550px X 600px.', 'js_composer' )
              ),
              array(
                  'type' => 'param_group',
                  'heading' => __( 'Social Icons', 'js_composer' ),
                  'param_name' => 'social_icons',
                  'value' => urlencode( json_encode( array(
                    array(
                      'title' => __( 'Twitter', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://twitter.com/username'
                    ),
                    array(
                      'title' => __( 'Dribbble', 'js_composer' ),
                      'icon_image' => '',
                      'icon_url' => 'http://dribbble.com/username'
                    )
                  ) ) ),
                  'params' => array(
                    array(
                      'type' => 'textfield',
                      'heading' => __( 'Title', 'js_composer' ),
                      'param_name' => 'title',
                      'description' => __( 'Enter social icon title.', 'js_composer' ),
                      'admin_label' => true
                    ),
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'Icon Image', 'js_composer' ),
                        'param_name' => 'icon_image',
                        'value' => '',
                        'description' => __( 'Select image from media library.', 'js_composer' )
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => __("Social Icon Link", "js_composer"),
                        "param_name" => "icon_url",
                        "description" => __("", "js_composer"),
                        
                    ),
                    
                  )
                ),
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature York Services", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_york_services",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/services.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'js_composer' ),
                    'param_name' => 'feature_icon',
                    'value' => 'ion-alert', // default value to backend editor admin_label
                    'settings' => array(
                      'emptyIcon' => false, // default true, display an "EMPTY" icon?
                      'iconsPerPage' => 4000, // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
                      'type' => 'ion_icons',
                    ),
                    'description' => __( 'Select icon from library.', 'js_composer' ),
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Icon Color', 'js_composer' ),
                    'param_name' => 'icon_color',
                    'description' => __( 'Select Icon color', 'js_composer' )
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Heading", 'vc_extend'),
                    "param_name" => "heading",
                    "value" => __("Heading", 'vc_extend'),
                    "description" => __("Specify the service heading.", 'vc_extend')
                ),
                array(
                    "type" => "textarea",
                    "class" => "",
                    "heading" => __("Service Description", 'vc_extend'),
                    "param_name" => "content",
                    "value" => __("I am test text block. Click edit button to change this text.", 'vc_extend'),
                    "description" => __("Provide the description about the service.", 'vc_extend')
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Text Color', 'js_composer' ),
                    'param_name' => 'text_color',
                    'description' => __( 'Select Text color', 'js_composer' )
                ),
                
            )
        ) );

        vc_map( array(
            "name" => __("Signature Recent Products Parallax", 'vc_extend'),
            "description" => __("Display the blog posts", 'vc_extend'),
            "base" => "signature_recent_product_parallax_showcase",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/supermarket68.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Number of Items", 'vc_extend'),
                  "param_name" => "item_no",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Specify the max no.of products to be displayed.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
            
                
            )
        ) );

        vc_map( array(
            "name" => __("Signature Recent Products Minimal Grid", 'vc_extend'),
            "description" => __("Display the blog posts", 'vc_extend'),
            "base" => "signature_recent_product_minimal_grid",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/supermarket68.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            //'admin_enqueue_js' => array(plugins_url('assets/vc_extend.js', __FILE__)), // This will load js file in the VC backend editor
            //'admin_enqueue_css' => array(plugins_url('assets/vc_extend_admin.css', __FILE__)), // This will load css file in the VC backend editor
            "params" => array(
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => __("Number of Items", 'vc_extend'),
                  "param_name" => "item_no",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Specify the max no.of products to be displayed.", 'vc_extend')
              ),
              array(
                  "type" => "textfield",
                  "class" => "",
                  "heading" => __("Extra class name", 'vc_extend'),
                  "param_name" => "customclass",
                  "value" => __("", 'vc_extend'),
                  "description" => __("Add multiple classes seperated by a << SPACE >>", 'vc_extend')
              ),
            
                
            )
        ) );

        
        vc_map( array(
            "name" => __("Signature Amor Background Slider", 'vc_extend'),
            "description" => __("", 'vc_extend'),
            "base" => "signature_amor_background_slider",
            "class" => "",
            "controls" => "full",
            "icon" => plugins_url('assets/icons/showcase_item.png', __FILE__), // or css class name which you can reffer in your css file later. Example: "vc_extend_my_class"
            "category" => __('Signature Shortcodes', 'js_composer'),
            "params" => array(
              array(
                  'type' => 'attach_images',
                  'heading' => __( 'Slide Images', 'js_composer' ),
                  'param_name' => 'images',
                  'value' => '',
                  'description' => __( 'Select images from media library. You can add multiple images.', 'js_composer' )
              )
            )
        ) );

        /*
        Add your Visual Composer logic here.
        Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

        More info: http://kb.wpbakery.com/index.php?title=Vc_map
        */
    }


    

    
    
    public function render_signature_portfolio( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'layout' => '',
        'group' => '',
        'col_layout' => '',
        'filter_display_status' => '',
        'portfolio_style' => '',
        'customclass' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      $portfolio_output = '';

      if($portfolio_style == 'adler')
      {
        $portfolio_output = adler_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'berend')
      {
        $portfolio_output = berend_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'claus')
      {
        $portfolio_output = claus_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'dierk')
      {
        $portfolio_output = dierk_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }
      
      if($portfolio_style == 'ebert')
      {
        $portfolio_output = ebert_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'franz')
      {
        $portfolio_output = franz_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'gozzo')
      {
        $portfolio_output = gozzo_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'hans')
      {
        $portfolio_output = hans_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'igor')
      {
        $portfolio_output = igor_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'karl')
      {
        $portfolio_output = karl_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'leon')
      {
        $portfolio_output = leon_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'nemo')
      {
        $portfolio_output = nemo_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'quartz')
      {
        $portfolio_output = quartz_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'rein')
      {
        $portfolio_output = rein_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'stefan')
      {
        $portfolio_output = stefan_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'theo')
      {
        $portfolio_output = theo_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'velten')
      {
        $portfolio_output = velten_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'wilmar')
      {
        $portfolio_output = wilmar_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'xaver')
      {
        $portfolio_output = xaver_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'york')
      {
        $portfolio_output = york_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      if($portfolio_style == 'zircon')
      {
        $portfolio_output = zircon_portfolio($group, $layout, $col_layout, $filter_display_status, $customclass);
      }

      $output = $portfolio_output; 

      
      
     
      return $output;
    }

    

    public function render_signature_section( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_color' => '',
        'full_height' => '',
        'bg_image' => '',
        'customclass' => ''
        
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      if($full_height == 'yes')
      {
        $customclass .= ' fullheight';
      }

      $output = '<section class="signature-section '.$customclass.'" style="background: url('.esc_url($bg_img_url).'); background-color:'.$bg_color.';"><div class="container">'.do_shortcode($content).'</div></section>';
      
      return $output;
    }


    public function render_signature_text_block( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'font_color' => '#121212',
        'font_size' => '14px',
        'font_family' => '',
        'font_case' => '',
        'font_style' => '',
        'line_height' => '21px',
        'letter_spacing' => '0px',
        'font_wt' => '300',
        'txt_decor' => 'none',
        'customclass' => '',
        'css' => ''
      ), $atts ) );
      
       $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      

      
      $custom_css = '';
      if($css != '')
      {
          $custom_css = 'style="'.str_replace('{', '', substr($css,24,-1)).'"';
      }

      $style = 'style="color: '.$font_color.'; text-decoration:'.$txt_decor.'; font-style:'.$font_style.'; font-size: '.$font_size.'; font-weight: '.$font_wt.'; letter-spacing: '.$letter_spacing.'; line-height: '.$line_height.';"';

      
      $output = '<div class="signature-text-block '.$customclass.' '.$font_family.' '.$font_case.'" '.$style.' ><span '.$custom_css.'>'.$content.'</span></div>';
      return $output;
    }


    public function render_signature_text_ticker( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'font_color' => '#121212',
        'font_size' => '14px',
        'font_family' => '',
        'font_weight' => '300',
        'font_case' => '',
        'font_style' => '',
        'line_height' => '21px',
        'letter_spacing' => '0px',
        'customclass' => '',
        'txt_items' => '',
        'css' => '-'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      

      
      $custom_css = '';
      if($css != '')
      {
          $custom_css = 'style="'.str_replace('{', '', substr($css,24,-1)).'"';
      }

      $style = 'style="color: '.$font_color.'; font-style:'.$font_style.'; font-size: '.$font_size.'; font-weight: '.$font_weight.'; letter-spacing: '.$letter_spacing.'; line-height: '.$line_height.';"';

      
      $output = '<div class="signature-text-ticker '.$customclass.' '.$font_family.' '.$font_case.'" '.$style.' ><span class="text-rotator" '.$custom_css.'>'.$txt_items.'</span></div>';
      return $output;
    }


    public function render_signature_adler_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<section class="first-fold signature-adler fullheight parallax" data-stellar-background-ratio="0.5" style="background: url('.$bg_img_url.');">
                  <section class="main-heading fixed-bottom">
                      <h1 class="white font3bold">'.esc_html($heading).'</h1>
                      <h6 class="white font3light">'.esc_html($promo_txt).'</h6>
                      <div class="liner-large color-bg"></div>
                  </section>
                </section>';
      
      return $output;
    }


    public function render_signature_adler_section_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<section class="main-heading">
                    <h1 class="black font3bold">'.esc_html($heading).'</h1>
                    <h6 class="dark font3light">'.esc_html($promo_txt).'</h6>
                    <div class="liner-large color-bg"></div>
                </section>';
      
      return $output;
    }


    public function render_signature_adler_project_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<section class="project-title signature-adler">
                    <h1 class="font3bold black">'.esc_html($heading).'<span class="font3light dark">'.esc_html($promo_txt).'</span></h1>
                </section>';
      
      return $output;
    }



    public function render_signature_button( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'btn_text' => '',
        'btn_link' => '',
        'btn_new_tab' => '',
        'btn_scroll' => '',
        'color_theme' => '',
      ), $atts ) );
      
      
      
      $new_tab_opt = '';

      if($btn_new_tab == 'yes')
      {
        $new_tab_opt = 'target="_blank"';
      }

      if($btn_scroll == 'yes')
        $scroll_class = 'scroll';
      else
        $scroll_class = '';

      $output = '<a class="btn btn-signature btn-signature-adler btn-signature-'.$color_theme.' '.$scroll_class.'" href="'.$btn_link.'" '.$new_tab_opt.'>'.esc_html($btn_text).'</a>';
      return $output;
    }


    public function render_signature_icon_round_button( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'button_icon' => '',
        'btn_link' => '',
        'btn_new_tab' => '',
        'btn_scroll' => '',
        'color_theme' => '',
      ), $atts ) );
      
      
      
      $new_tab_opt = '';

      if($btn_new_tab == 'yes')
      {
        $new_tab_opt = 'target="_blank"';
      }

      if($btn_scroll == 'yes')
        $scroll_class = 'scroll';
      else
        $scroll_class = '';

      $output = '<a class="round-btn round-btn-signature btn-signature-'.$color_theme.' '.$scroll_class.'" href="'.$btn_link.'" '.$new_tab_opt.'><span class="'.$button_icon.'"></span></a>';
      return $output;
    }


    public function render_signature_adler_liner_text( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'text' => '',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<div class="adler-liner-text">
                  <div class="liner-small color-bg"></div>
                  <h6 class="grey font3bold">'.esc_html($text).'</h6>
                </div>';
      
      return $output;
    }


    public function render_signature_liner( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'size' => '',
        'color' => '#fb472e'
      ), $atts ) );
      
      $output = '<div class="signature-liner liner-'.esc_attr($size).'" style="background:'.esc_attr($color).'"></div>';
      
      return $output;
    }



    public function render_signature_adler_counter( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'counter_items',
        'color_theme' => 'dark-white'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $counter_items = vc_param_group_parse_atts( $atts['counter_items'] );
      
      $counter_items_markup = '';

      foreach ($counter_items as $counter_item) {
        $title = isset($counter_item['title']) ? $counter_item['title'] : '';
        $count = isset($counter_item['count']) ? $counter_item['count'] : '';
        $delay = isset($counter_item['delay']) ? $counter_item['delay'] : '';

        $counter_items_markup .= '<li data-delay="'.esc_attr($delay).'" class="elements-counter signature-adler"> 
                                      <div class="number font3bold black">'.esc_html($count).'</div> 
                                      <div class="subject font3">'.esc_html($title).'</div> 
                                  </li>';
      }

      $output = '<div class="stats signature-adler"><ul class="text-center elements-counter-wrap signature-adler '.esc_attr($color_theme).'">'.$counter_items_markup.'</ul></div>';
      
      return $output;
    }


    



    public function render_signature_adler_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }

      $output = '<article class="team-block signature-adler"> 
                    <img alt="" title="" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-info">
                      <h4 class="black font3bold">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay">
                        <p class="grey">'.$content.'</p>
                        <div class="liner-small color-bg"></div>
                        <div></div>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }
    


    public function render_signature_adler_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-left service-block signature-adler">
                    <span class="'.$service_icon.' '.$color_theme.'"></span>
                    <h3 class="font3bold '.$color_theme.'">'.esc_html($title).'</h3>
                    <div class="liner-small color-bg"></div>
                    <p class="'.$color_theme.'">'.$content.'</p>
                </article>';
      return $output;
    }



    public function render_signature_adler_image_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'images' => '',
        'customclass' => ''
        
      ), $atts ) );
     
      

      $slide_list = '';
      
      if($images != '')
      {
        $image_list = explode(',', $images);
        
        foreach($image_list as $image_id)
        {
          $slide_img = wp_get_attachment_image_src( $image_id , 'full');
          $slide_image_url = $slide_img[0];

          $slide_list .= '<div class="project-carousel-item fullheight text-center img-bg" style="background-image:url('.$slide_image_url.');"></div>';
          
        }
        
      }
      
      

      $output = '<section class="first-fold signature-adler fullheight">
                  <section class="project01-carousel fullheight">
                    <section class="project-carousel-wrap signature-adler fullheight">
                      <div class="project-carousel signature-adler owl-carousel owl-nav-sticky-wide">'.$slide_list.'</div>
                    </section>
                  </section>
                </section>';
      
      return $output;
    }



    public function render_signature_adler_project_spec( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'specs'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $specs = vc_param_group_parse_atts( $atts['specs'] );
      
      $specs_markup = '';

      foreach ($specs as $spec_item) {
        $title = isset($spec_item['title']) ? $spec_item['title'] : '';
        $spec = isset($spec_item['spec']) ? $spec_item['spec'] : '';
        

        $specs_markup .= '<li class="font3bold black">'.esc_html($title).': <span class="font3light dark">'.esc_html($spec).'</span></li>';
      }

      $output = '<ul class="project-spec signature-adler">'.$specs_markup.'</ul>';
      
      return $output;
    }


    public function render_signature_lightbox( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'image' => '',
        'type' => '',
        'images' => '',
        'video_url' => '',
        'marquee_style' => ''
        
      ), $atts ) );
     
      // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      $marquee_image_url = '';
      if($image != '')
      {
        $marquee_img_url = wp_get_attachment_image_src( $image , 'full');
        $marquee_image_url = $marquee_img_url[0];
      }

      $a_tag_attrs = '';
      $lightbox_img_gallery = '';
      

      //PORTFOLIO TYPE LIGHTBOX IMAGE
      if($type == 'image')
      {
          
          
          if($images == '')
          {
              $a_tag_attrs = 'class="venobox" href="'.$marquee_image_url.'"';
          }
          else
          {
              $image_list = explode(',', $images);

              $first_image = 0;
              $rand_id = rand(1000, 9999);
              foreach($image_list as $image_id)
              {
                $slide_img = wp_get_attachment_image_src( $image_id , 'full');
                $slide_image_url = $slide_img[0];

                
                if($first_image == 0)
                {
                  $a_tag_attrs = 'class="venobox signature-lightbox" data-gall="lightbox-gallery-'.$rand_id.'" href="'.$slide_image_url.'"';
                  $first_image = 1;
                }
                else
                {
                  $lightbox_img_gallery .= '<a href="'.$slide_image_url.'" class="venobox hidden" data-gall="lightbox-gallery-'.$rand_id.'"></a>';
                }
                
              }
          }
      }
      if($type == 'youtube')
      {
        
        $a_tag_attrs = 'class="venobox signature-lightbox" data-type="youtube" href="'.$video_url.'"';

      }

      //PORTFOLIO TYPE LIGHTBOX VIMEO VIDEO
      if($type == 'vimeo')
      {
        
        $a_tag_attrs = 'class="venobox signature-lightbox" data-type="vimeo" href="'.$video_url.'"';

      }

      
      if($marquee_style == 'normal')
      {
        $output = '<a '.$a_tag_attrs.'>
                      <img data-no-retina alt="lightbox" title="lightbox" class="img-responsive" src="'.$marquee_image_url.'" />
                    </a>
                    '.$lightbox_img_gallery;
      }
      else
      {
        $output = '<a '.$a_tag_attrs.'>
                    <div class="signature-lightbox-fullscreen-holder fullheight" style="background-image:url('.$marquee_image_url.');"></div>
                  </a>
                  '.$lightbox_img_gallery;
      }
      return $output;
    }



    public function render_signature_parallax_showcase( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'showcase_items' => ''
        
      ), $atts ) );
      
      $showcase_items_markup = '';
      
      $showcase_items = vc_param_group_parse_atts( $atts['showcase_items'] );


      foreach ($showcase_items as $showcase_item) {
        
        $a_tag_attrs = '';

        $link = isset($showcase_item['link']) ? $showcase_item['link'] : '';

        if(isset($showcase_item['new_tab_opt']) && $showcase_item['new_tab_opt'] == 'yes')
            $a_tag_attrs = 'href="'.esc_url($link).'" target="_blank"';
        else
          $a_tag_attrs = 'href="'.esc_url($link).'"';
        
        $bg_image_url = '';

        if(isset($showcase_item['bg_image']) && $showcase_item['bg_image'] != '')
        {
          $bg_img_url = wp_get_attachment_image_src( $showcase_item['bg_image'] , 'full');
          $bg_image_url = $bg_img_url[0];
        }

        $showcase_items_markup .= '<section class="parallax-showcase signature-adler fullheight parallax" data-stellar-background-ratio="0.5" style="background-image:url('.esc_url($bg_image_url).');">
                                    <div class="parallax-showcase-overlay fullheight">
                                      <div class="valign">
                                          <div class="project-title text-center">
                                              <a '.$a_tag_attrs.'><h1 class="font3bold white">'.esc_html($showcase_item['title']).'</h1></a>
                                          </div>
                                      </div>
                                    </div>
                                  </section>';
      }
      

      $output = '<section class="parallax-showcase-wrap signature-adler">'.$showcase_items_markup.'</section>';
      return $output;
    }


    public function render_signature_blog_posts( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'item_no' => '',
        'pagination_opt' => '',
        'blog_style' => '',
        'customclass' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      $blog_output = '';

      if($blog_style == 'adler')
      {
        $blog_output = adler_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'berend')
      {
        $blog_output = berend_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'claus')
      {
        $blog_output = claus_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'dierk')
      {
        $blog_output = dierk_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'ebert')
      {
        $blog_output = ebert_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'gozzo')
      {
        $blog_output = gozzo_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'hans')
      {
        $blog_output = hans_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'igor')
      {
        $blog_output = igor_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'johan')
      {
        $blog_output = johan_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'leon')
      {
        $blog_output = leon_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'moritz')
      {
        $blog_output = moritz_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'nemo')
      {
        $blog_output = nemo_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'orwin')
      {
        $blog_output = orwin_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'quartz')
      {
        $blog_output = quartz_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'stefan')
      {
        $blog_output = stefan_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'theo')
      {
        $blog_output = theo_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'uno')
      {
        $blog_output = uno_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'velten')
      {
        $blog_output = velten_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'wilmar')
      {
        $blog_output = wilmar_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'xaver')
      {
        $blog_output = xaver_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'york')
      {
        $blog_output = york_blog($item_no, $pagination_opt, $customclass);
      }
      elseif($blog_style == 'zircon')
      {
        $blog_output = zircon_blog($item_no, $pagination_opt, $customclass);
      }


      $output = $blog_output; 

      
      
     
      return $output;
    }


    public function render_signature_contact_form( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'color_theme' => '',
        'customclass' => '',
        'style' => 'lined'

      ), $atts ) );

      

      $signature_options = signature_get_options('signature_wp');

      wp_enqueue_script('modal-plugin');
      wp_enqueue_script('form-validation');

      $style_class = '';
      $button_class = 'btn btn-signature btn-signature-color';
      if($style == 'boxed')
      {
        $style_class = 'boxed-form';
        $button_class = 'btn btn-signature btn-signature-gozzo btn-signature-color';
      }

      $output = '<div class="signature-contact-form '.esc_attr($color_theme).'-contact-form '.esc_attr($style_class).' '.esc_attr($customclass).'">
                  <div class="contact-item ">
                    <div class="alert alert-error error color-bg" id="fname">
                      <p class="'.esc_attr($color_theme).'">'.esc_html($signature_options['name_err_msg']).'</p>
                    </div>
                    <div class="alert alert-error  error color-bg" id="fmail">
                      <p class="'.esc_attr($color_theme).'">'.esc_html($signature_options['email_err_msg']).'</p>
                    </div>
                    <div class="alert alert-error  error color-bg" id="fmsg">
                      <p class="'.esc_attr($color_theme).'">'.esc_html($signature_options['message_err_msg']).'</p>
                    </div>
                    <form name="myform" id="contactForm" action="'.plugins_url('sendmail.php' , __FILE__ ).'" enctype="multipart/form-data" method="post"> 
                      <input type="hidden" name="receiver" id="receiver" value="'.esc_attr($signature_options['contact_email']).'" />
                      <input type="hidden" id="subject" name="subject" value="'.esc_attr($signature_options['contact_email_sub']).'"/>
                      <input type="text" name="website_url" id="website_url" class="contact_web_url " value=""/>
                      <article>
                        <input type="text" placeholder="'.esc_attr($signature_options['name_placeholder']).'" id="name" name="name" size="100" class="border-form white font4light">
                      </article>
                      <article>
                        <input type="text" placeholder="'.esc_attr($signature_options['email_placeholder']).'" name="email" id="email" size="30" class="border-form white font4light">
                      </article>
                      <article>
                        <textarea placeholder="'.esc_attr($signature_options['message_placeholder']).'" name="message" cols="40" rows="5" id="msg" class="border-form white font4light"></textarea>
                        <div class="btn-wrap  text-left">
                          <button class="'.esc_attr($button_class).'" id="submit" name="submit" type="submit">'.esc_html($signature_options['submit_btn_txt']).'</button>
                        </div>
                      </article>
                    </form>
                  </div>
                </div>
                
                <button class="md-trigger launch_modal hidden-lg hidden-md hidden-sm hidden-xs" data-modal="modal-5">Launch modal</button>
                <div class="md-modal md-effect-5" id="modal-5">
                  <div class="md-content">
                    <h3>'. esc_html($signature_options['thanks_msg_header']).'</h3>
                    <div>
                      <p class="text-center">'. esc_html($signature_options['thanks_msg']).'</p>
                      <div class="clear add-top-small"></div>
                      <button class="md-close btn btn-signature btn-signature-dark">'. __('Close','odinlang').'</button>
                    </div>
                  </div>
                </div>
                <div class="md-overlay"></div>';
      return $output;
    }


    public function render_signature_map( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'style' => 'style1',
        'lat' => '',
        'long' => '',
        'marker_image' => '',
        'height' => '',
        'fullheight' => '',
        'customclass' => ''
        
        
      ), $atts ) );
      
      
      
      

      $marker_image_url = '';
      if($marker_image != '')
      {
        $marker_img_url = wp_get_attachment_image_src( $marker_image , 'full');
        $marker_image_url = $marker_img_url[0];
      }
      else
      {
        $marker_image_url = get_template_directory_uri(). '/images/map-marker.png';
      }
      
      
      $rand_id = rand(1000, 9999);

      if($style == 'style1')
        wp_enqueue_script('map-init');
      elseif($style == 'style2')
        wp_enqueue_script('map-init2');
      else
        wp_enqueue_script('map-init3');

      

      
      if($fullheight == 'yes')
      {
        $output = '<section class="signature-map-wrap '.esc_attr($customclass).'" data-containment="map-'.esc_attr($rand_id).'" data-lattitude="'.esc_attr($lat).'" data-longitude="'.esc_attr($long).'" data-marker-image="'.esc_url($marker_image_url).'" data-land-color="'.esc_attr($land_color).'" data-water-color="'.esc_attr($water_color).'">
                    <div id="map-'.esc_attr($rand_id).'" class="fullheight" ></div>
                  </section>';
      }
      else
      {
        $output = '<section class="signature-map-wrap '.esc_attr($customclass).'" data-containment="map-'.esc_attr($rand_id).'" data-lattitude="'.esc_attr($lat).'" data-longitude="'.esc_attr($long).'" data-marker-image="'.esc_url($marker_image_url).'" data-land-color="'.esc_attr($land_color).'" data-water-color="'.esc_attr($water_color).'">
                    <div id="map-'.esc_attr($rand_id).'" style="height:'.esc_attr($height).'" ></div>
                  </section>';
      }

      return $output;
    }



    public function render_signature_berend_features( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'feature_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-center feature-block signature-berend ">
                    <span class="'.esc_attr($feature_icon).' '.esc_attr($color_theme).'"></span>
                    <h3 class="font2 color">'.esc_html($heading).'</h3>
                </article>';
      return $output;
    }


    public function render_signature_berend_section_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
     

      $output = '<h3 class="signature-berend-sub-heading sub-heading"><span class="font2 '.esc_attr($color_theme).'">'.esc_html($heading).'</span></h3>';
      
      return $output;
    }


    public function render_signature_berend_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-center service-block signature-berend">
                    <span class="'.esc_attr($service_icon).' '.esc_attr($color_theme).'"></span>
                    <h3 class="font2 color">'.esc_html($title).'</h3>
                    <div class="liner-small color-bg"></div>
                    <p class="'.esc_attr($color_theme).' font1">'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_berend_skillset( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'percent' => '50',
        'symbol' => '%',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="skills signature-berend">
                    <h6 class="'.esc_attr($color_theme).'"><i class="font2">'.esc_html($title).'</i><span class="font1 '.esc_attr($color_theme).'">'.esc_html($percent.$symbol).'</span></h6>
                    <div class="progress active '.esc_attr($color_theme).'-bg">
                        <div class="progress-bar color-bg" data-skills-value="'.esc_attr($percent).'"></div>
                    </div>
                </article>';
      return $output;
    }


    public function render_signature_berend_clients( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'clients' => ''
        
      ), $atts ) );
      
      $clients_markup = '';
      
      $clients = vc_param_group_parse_atts( $atts['clients'] );


      foreach ($clients as $client) {
        
        $a_tag_attrs = '';

        $link = isset($client['link']) ? $client['link'] : '';

        if(isset($client['new_tab_opt']) && $client['new_tab_opt'] == 'yes')
            $a_tag_attrs = 'href="'.esc_url($link).'" target="_blank"';
        else
          $a_tag_attrs = 'href="'.esc_url($link).'"';
        
        $client_image_url = '';

        if(isset($client['client_image']) && $client['client_image'] != '')
        {
          $client_image_url = wp_get_attachment_image_src( $client['client_image'] , 'full');
          $client_image_url = $client_image_url[0];
        }

        $clients_markup .= '<article class="col-md-4 text-center client-logo signature-berend no-pad">
                                <div class="client-logo-inner">
                                    <a '.$a_tag_attrs.'><img src="'.esc_url($client_image_url).'" class="img-responsive" title="'.esc_attr($client['title']).'" alt="'.esc_attr($client['title']).'"></a>
                                </div>
                            </article>';
      }
      

      $output = '<div class="row signature-berend clients-wrap">'.$clients_markup.'</div>';
      return $output;
    }


    public function render_signature_berend_project_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'sub_heading' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<section class="project-title signature-berend">
                  <h3 class="font2 black">'.esc_html($sub_heading).'</h3>
                  <div class="liner-large color-bg"></div>
                  <h1 class="main-heading signature-berend font2 dark">'.esc_html($heading).'</h1>
                </section>';
      
      return $output;
    }


    public function render_signature_claus_fullscreen_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'images' => '',
        'heading' => ''
        
      ), $atts ) );
     
      

      $slide_list = '';
      $slider_images = array();

      if($images != '')
      {
        $image_list = explode(',', $images);
        
        

        foreach($image_list as $image_id)
        {
          $slide_img = wp_get_attachment_image_src( $image_id , 'full');
          $slide_image_url = $slide_img[0];
          
          
          array_push($slider_images, array(
                "src" => $slide_image_url
          ));
        }
      }
      
      
      
      wp_enqueue_script('vegas-init');
      wp_localize_script('vegas-init', 'slider_images', $slider_images);

      

      $output = '<section class="intro-01 signature-claus signature-claus-fullscreen-slider fullheight">
                  <section class="top-caption pad-top-quarter pad-bottom-quarter pad-left-quarter">
                    <h6><span class="font3bold black">'.esc_html($heading).'</span> </h6>
                  </section>
                </section>';


      
      return $output;
    }


    public function render_signature_claus_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<section class="first-fold signature-claus fullheight parallax" data-stellar-background-ratio="0.5" style="background: url('.$bg_img_url.');">
                  <section class="main-heading fixed-top signature-claus-page-heading">
                      <h1 class="black font3bold uppercase">'.esc_html($heading).'</h1>
                      <h6 class="black font3light">'.esc_html($promo_txt).'</h6>
                      <div class="liner-large color-bg"></div>
                  </section>
                </section>';
      
      return $output;
    }


    public function render_signature_dierk_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<section class="first-fold signature-dierk fullheight parallax" data-stellar-background-ratio="0.5" style="background-image: url('.$bg_img_url.');">
                  <div class="valign">
          
                    <div class="container">
                        <div class="row">
                            <article class="col-md-8 col-md-offset-2 text-center">
                                <section class="main-heading signature-dierk-page-header">
                                    <h6 class="white font2">'.esc_html($heading).'</h6>
                                    <div class="liner-large color-bg add-top-quarter"></div>
                                </section>
                            </article>
                        </div>
                    </div>

                  </div>
                </section>';
      
      return $output;
    }


    public function render_signature_dierk_split_section( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'bg_color' => '#FFFFFF',
        'align' => 'left',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      
      if($align == 'right')
      {
        $output = '<div class="row equal-height-wrap">
                      <article class="col-md-6 no-pad covered-bg equal-height dierk-split-image-section" style="background: url('.esc_url($bg_img_url).');"> 
                      </article>
                      <article class="col-md-6 equal-height dierk-split-content-section" style="background: '.esc_attr($bg_color).';"> 
                        <div class="inner-spacing">'.do_shortcode($content).'</div>
                      </article>
                  </div>';
      }
      else
      {
        $output = '<div class="row equal-height-wrap">
                      <article class="col-md-6 equal-height dierk-split-content-section" style="background: '.esc_attr($bg_color).';"> 
                        <div class="inner-spacing">'.do_shortcode($content).'</div>
                      </article>
                      <article class="col-md-6 no-pad covered-bg equal-height dierk-split-image-section" style="background: url('.esc_url($bg_img_url).');"> 
                      </article>
                  </div>';
      }
      
      return $output;
    }



    public function render_signature_dierk_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => '',
        'color_theme' => 'white'
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-dierk"> 
                    <img alt="" title="" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-info">
                      <h4 class="'.esc_attr($color_theme).' font3bold">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay '.esc_attr($color_theme).'-overlay">
                        <p class="grey">'.$content.'</p>
                        <div class="liner-small color-bg"></div>
                        <div></div>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }


    public function render_signature_dierk_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-center service-block signature-dierk">
                    <span class="'.esc_attr($service_icon).' color"></span>
                    <h3 class="font3bold '.esc_attr($color_theme).'">'.esc_html($title).'</h3>
                    <div class="liner-small color-bg"></div>
                    <p class="'.esc_attr($color_theme).'">'.$content.'</p>
                </article>';
      return $output;
    }



    public function render_signature_ebert_split_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'slider_items'
        
      ), $atts ) );
      
      $slide_items_markup = '';
      
      $slider_items = vc_param_group_parse_atts( $atts['slider_items'] );

      $slide_count = 0;

      
      foreach($slider_items as $slide_item) {
        
        $slide_count ++;

        $title = isset($slide_item['title']) ? $slide_item['title'] : '';

        $lft_bg_image_url = '';
        if(isset($slide_item['lft_bg_image']) && $slide_item['lft_bg_image'] != '')
        {
          $lft_bg_img_url = wp_get_attachment_image_src( $slide_item['lft_bg_image'] , 'full');
          $lft_bg_image_url = $lft_bg_img_url[0];
        }

        $lft_txt = isset($slide_item['lft_txt']) ? $slide_item['lft_txt'] : '';
        $lft_txt_bg_color = isset($slide_item['lft_txt_bg_color']) ? $slide_item['lft_txt_bg_color'] : '';
        $lft_txt_color = isset($slide_item['lft_txt_color']) ? $slide_item['lft_txt_color'] : '';
        $lft_link = isset($slide_item['lft_link']) ? $slide_item['lft_link'] : '';
        $lft_new_tab_opt = isset($slide_item['lft_new_tab_opt']) ? $slide_item['lft_new_tab_opt'] : '';
        $left_a_tag_attrs = '';
        if($lft_new_tab_opt == 'yes')
          $left_a_tag_attrs = 'target="_blank"';

        $rht_bg_image_url = '';
        if(isset($slide_item['rht_bg_image']) && $slide_item['rht_bg_image'] != '')
        {
          $rht_bg_img_url = wp_get_attachment_image_src( $slide_item['rht_bg_image'] , 'full');
          $rht_bg_image_url = $rht_bg_img_url[0];
        }

        $rht_txt = isset($slide_item['rht_txt']) ? $slide_item['rht_txt'] : '';
        $rht_txt_bg_color = isset($slide_item['rht_txt_bg_color']) ? $slide_item['rht_txt_bg_color'] : '';
        $rht_txt_color = isset($slide_item['rht_txt_color']) ? $slide_item['rht_txt_color'] : '';
        $rht_link = isset($slide_item['rht_link']) ? $slide_item['rht_link'] : '';
        $rht_new_tab_opt = isset($slide_item['rht_new_tab_opt']) ? $slide_item['rht_new_tab_opt'] : '';
        $right_a_tag_attrs = '';
        if($rht_new_tab_opt == 'yes')
          $right_a_tag_attrs = 'target="_blank"';

        $slide_items_markup .= '<section class="split-slide-item hidden">
                                  <div class="left-split">
                                    <div class="ms-section ms-section-left covered-bg" id="left'.esc_attr($slide_count).'" style="background:url('.esc_url($lft_bg_image_url).');">
                                      <div class="ms-static-title text-right">
                                        <a href="'.esc_url($lft_link).'" '.$left_a_tag_attrs.' class="valign">
                                          <h1>
                                            <span class="font3bold" style="background-color: '.esc_attr($lft_txt_bg_color).'; color: '.esc_attr($lft_txt_color).';">'.esc_html($lft_txt).'</span>
                                          </h1>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="right-split">
                                    <div class="ms-section ms-section-right covered-bg" id="right'.esc_attr($slide_count).'" style="background:url('.esc_url($rht_bg_image_url).');">
                                      <div class="ms-static-title text-left">
                                        <a href="'.esc_url($rht_link).'" '.$right_a_tag_attrs.' class="valign">
                                          <h1>
                                            <span class="font3bold" style="background-color: '.esc_attr($rht_txt_bg_color).'; color: '.esc_attr($rht_txt_color).';">'.esc_html($rht_txt).'</span>
                                          </h1>
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </section>';
      }
      

      wp_enqueue_script('split-scroll-init');

      $output = '<section class="signature-ebert split-slider-wrap">
                  '.$slide_items_markup.'
                  <div class="fullwidth" style="width:100vw;">
                    <div id="myContainer" class="split-home-panel fullheight">
                      <div class="ms-left">
                      </div>
                      <div class="ms-right">
                      </div>
                    </div>
                  </div>
                </section>';
      return $output;
    }


    public function render_signature_ebert_masonry_image_gallery( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'images' => '',
        'customclass' => ''
        
      ), $atts ) );
     
      

      $gallery_list = '';
      
      if($images != '')
      {
        $image_list = explode(',', $images);
        
        foreach($image_list as $image_id)
        {
          $gallery_img = wp_get_attachment_image_src( $image_id , 'full');
          $gallery_image_url = $gallery_img[0];

          $gallery_list .= '<div class="works-item signature-ebert ImageWrapper BackgroundS works-item-one-half">
                              <img data-no-retina alt="" title="" class="img-responsive" src="'.esc_url($gallery_image_url).'"/>
                            </div>';
          
        }
        
      }
      
      

      $output = '<section id="works-container" class="works-container signature-ebert works-masonry-container clearfix works-thumbnails-view">'.$gallery_list.'</section>';
      
      return $output;
    }


    public function render_signature_ebert_project_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'sub_heading' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<article class="project-title signature-ebert text-left">
                  <h3 class="font2 black">'.esc_html($sub_heading).'</h3>
                  <div class="liner-large color-bg"></div>
                  <h1 class="main-heading font2 dark">'.esc_html($heading).'</h1>
                </article>';
      
      return $output;
    }


    public function render_signature_franz_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-center service-block signature-franz">
                    <span class="'.esc_attr($service_icon).' '.esc_attr($color_theme).'"></span>
                    <h3 class="font2 color">'.esc_html($title).'</h3>
                    <div class="liner-small color-bg"></div>
                    <p class="'.esc_attr($color_theme).' font1">'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_franz_project_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'sub_heading' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $output = '<article class="project-title signature-franz text-left">
                    <h3 class="font2 black">'.esc_html($sub_heading).'</h3>
                    <div class="signature-liner liner-large color-bg"></div>
                    <h1 class="super-heading font2 dark">'.esc_html($heading).'</h1>
                </article>';
      
      return $output;
    }


    public function render_signature_hans_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-hans"> 
                    <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive team-thumb" src="'.esc_url($image_url).'"/>
                    <div class="team-info">
                      <h4 class="black font3bold">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay silver-bg">
                        <p class="dark">'.$content.'</p>
                        <div></div>
                        <ul class="team-social color-bg">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }


    public function render_signature_carousel_wrap( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'no_of_items_desk' => '',
        'no_of_items_tab' => '',
        'no_of_items_mob' => '',
        'nav_type' => '',
        'customclass' => '',
        'css' => ''

      ), $atts ) );

     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content

      

      if($nav_type == 'dir-type')
      {
        $customclass .= ' directional-type-carousel';
      }

      $custom_css = '';
      if($css != '')
      {
          $custom_css = 'style="'.str_replace('{', '', substr($css,24,-1)).'"';
      }



      $output = '<div class="signature-carousel owl-carousel owl-nav-sticky-wide '.$nav_type.' '.$customclass.'" '.$custom_css.' data-items-desk="'.$no_of_items_desk.'" data-items-tab="'.$no_of_items_tab.'" data-items-mob="'.$no_of_items_mob.'">'.do_shortcode($content).'</div>';
      return $output;
    }

    public function render_signature_carousel_item( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'customclass' => '',


      ), $atts ) );

      // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content


      $output = '<div class="item '.$customclass.'">'.do_shortcode($content).'</div>';
      return $output;
    }



    public function render_signature_gozzo_project_showcase( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'showcase_items',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $showcase_items = vc_param_group_parse_atts( $atts['showcase_items'] );
      
      $showcase_items_markup = '';

      foreach ($showcase_items as $showcase_item) {
        $title = isset($showcase_item['title']) ? $showcase_item['title'] : '';
        $caption = isset($showcase_item['caption']) ? $showcase_item['caption'] : '';
        

        $image_url = '';

        if(isset($showcase_item['image']))
        {
          $showcase_item_image = $showcase_item['image'];
          $image = wp_get_attachment_image_src( $showcase_item_image , 'full');
          $image_url = $image[0];
        }


        $a_tag_attrs = '';

        $link = isset($showcase_item['link']) ? $showcase_item['link'] : '';

        if(isset($showcase_item['new_tab_opt']) && $showcase_item['new_tab_opt'] == 'yes')
            $a_tag_attrs = 'href="'.esc_url($link).'" target="_blank"';
        else
          $a_tag_attrs = 'href="'.esc_url($link).'"';


        $showcase_items_markup .= '<div class="item">
                                    <a class="album-view" '.$a_tag_attrs.'>
                                      <img alt="" title="" src="'.esc_url($image_url).'"/>
                                      <div class="album-info">
                                        <h3 class="font3bold white">'.esc_html($title).'</h3>
                                        <h6 class="font3light white">'.esc_html($caption).'</h6>
                                      </div>
                                    </a>
                                  </div>';
      }

      $output = '<div class="intro-carousel signature-gozzo owl-carousel owl-nav-sticky-wide">'.$showcase_items_markup.'</div>';
      
      return $output;
    }


    public function render_signature_gozzo_masonry_image_gallery( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'images' => '',
        'layout' => 'spaced',
        'customclass' => ''
        
      ), $atts ) );
     
      

      $gallery_list = '';

      if($layout == 'spaced')
        $layout_class = "works-item-one-half-spaced";
      else
        $layout_class = "works-item-one-half";
      
      if($images != '')
      {
        $image_list = explode(',', $images);
        
        foreach($image_list as $image_id)
        {
          $gallery_img = wp_get_attachment_image_src( $image_id , 'full');
          $gallery_image_url = $gallery_img[0];

          $gallery_list .= '<div class="works-item signature-gozzo ImageWrapper BackgroundR '.esc_attr($layout_class).'">
                              <img data-no-retina alt="" title="" class="img-responsive" src="'.esc_url($gallery_image_url).'"/>
                            </div>';
          
        }
        
      }
      
      

      $output = '<section id="works-container" class="works-container signature-gozzo works-masonry-container clearfix works-thumbnails-view">'.$gallery_list.'</section>';
      
      return $output;
    }


    public function render_signature_gozzo_button( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'btn_text' => '',
        'btn_link' => '',
        'btn_new_tab' => '',
        'btn_scroll' => '',
        'color_theme' => '',
      ), $atts ) );
      
      
      
      $new_tab_opt = '';

      if($btn_new_tab == 'yes')
      {
        $new_tab_opt = 'target="_blank"';
      }

      if($btn_scroll == 'yes')
        $scroll_class = 'scroll';
      else
        $scroll_class = '';

      $output = '<a class="btn btn-signature btn-signature-gozzo btn-signature-'.$color_theme.' '.$scroll_class.'" href="'.$btn_link.'" '.$new_tab_opt.'>'.esc_html($btn_text).'</a>';
      return $output;
    }


    public function render_signature_hans_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-center service-block signature-hans">
                    <span class="'.esc_attr($service_icon).' color-bg dark"></span>
                    <h3 class="font3bold '.esc_attr($color_theme).'">'.esc_html($title).'</h3>
                    <div class="liner-small color-bg"></div>
                    <p class="'.esc_attr($color_theme).' font1">'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_hans_splash_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'slider_items',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $slider_items = vc_param_group_parse_atts( $atts['slider_items'] );
      
      $slider_items_markup = '';

      foreach ($slider_items as $slider_item) {
        $title = isset($slider_item['title']) ? $slider_item['title'] : '';
        $caption = isset($slider_item['caption']) ? $slider_item['caption'] : '';
        

        $image_url = '';

        if(isset($slider_item['image']))
        {
          $slider_item_image = $slider_item['image'];
          $image = wp_get_attachment_image_src( $slider_item_image , 'full');
          $image_url = $image[0];
        }


        
        $slider_items_markup .= '<div class="home-carousel-item fullheight text-center img-bg" style="background-image:url('.esc_url($image_url).')">
                                  <div class="fullheight" style="background: rgba(255,255,255,0.2);">
                                    <div class="valign">
                                      <div class="intro-caps text-center">
                                        <h3 class="black font3xblack">'.esc_html($title).'</h3>
                                        <h5><span class="black font3xlight color-bg">'.esc_html($caption).'</span></h5>
                                      </div>
                                    </div>
                                  </div>
                                </div>';
      }

      $output = '<section class="intro-carousel signature-hans fullheight">
                  <section class="home-carousel-wrap fullheight">
                    <div class="home-carousel signature-hans owl-carousel owl-nav-sticky-wide">'.$slider_items_markup.'</div>
                  </section>
                </section>';
      
      return $output;
    }

    public function render_signature_hans_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<section class="first-fold signature-hans fullheight parallax" data-stellar-background-ratio="0.5" style="background-image: url('.$bg_img_url.');">
                  <div class="fullheight trans-dark-overlay text-center">
                    <div class="valign">
                      
                        <section class="signature-hans-page-header">
                            <h1 class="white font3bold uppercase">'.esc_html($heading).'</h1>
                            <h6 class="white font3light">'.esc_html($promo_txt).'</h6>
                            <div class="liner-large color-bg"></div>
                        </section>

                    </div>

                  </div>
                </section>';
      
      return $output;
    }


    public function render_signature_hans_project_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<section class="project-title signature-adler dark-bg">
                    <h1 class="font3bold white">'.esc_html($heading).'<span class="font3light white">'.esc_html($promo_txt).'</span></h1>
                </section>';
      
      return $output;
    }

    public function render_signature_igor_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => '',
        'sub_heading' => '',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<div class="fullheight"><section class="page-fold signature-igor subtle fullheight" style="background: url('.$bg_img_url.');">  
    
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-12 text-left">
                        <article class="hero-module signature-igor fixed-bottom">
                          <h1 class="page-heading font3bold black">'.esc_html($heading).'</h1>
                          <h4 class="sub-heading-minor"><span class="font1 color">'.esc_html($sub_heading).'</span></h4>
                        </article>
                      </div>

                    </div>
                  </div>
                </div>';
      
      return $output;
    }


    public function render_signature_igor_content_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'slider_items'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $slider_items = vc_param_group_parse_atts( $atts['slider_items'] );
      
      $slider_header_markup = '<div id="bx-pager" class="text-center features-slider-triggers signature-igor font3bold">';
      $slider_index = 0;

      foreach ($slider_items as $slider_item) {
        $title = isset($slider_item['title']) ? $slider_item['title'] : '';
        $content = isset($slider_item['content']) ? $slider_item['content'] : '';
        

        $slider_header_markup .= '<a data-slide-index="'.esc_attr($slider_index).'" href="#">'.esc_html($title).'</a>';

        $slider_index++;
      }
      $slider_header_markup .= '</div>';

      
      $slider_content_markup = '<ul class="bxslider features-slider signature-igor">';
      
      foreach ($slider_items as $slider_item) {
        $content = isset($slider_item['content']) ? $slider_item['content'] : '';
        
        $slider_content_markup .= '<li>
                                    <div class="row">
                                        <article class="col-md-12 text-center">
                                          <h1 class="process-text dark font3bold">'.$content.'</h1>
                                        </article>
                                    </div>
                                  </li>';

        
      }
      $slider_content_markup .= '</ul>';

      $output = $slider_header_markup.$slider_content_markup;
      
      return $output;
    }

    public function render_signature_igor_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<div class="text-center service-icon signature-igor">
                  <i class="'.esc_attr($service_icon).' '.esc_attr($color_theme).'"></i>
                  <h4 class="font4 '.esc_attr($color_theme).'">'.esc_html($title).'</h4>
                  <p class="'.esc_attr($color_theme).'">'.$content.'</p>
                </div>';
      return $output;
    }


    public function render_signature_igor_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'staff_image' => '',
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      



      $output = '<div class="team-block signature-igor">
                  <div class="team-block-inner white-bg">
                      <img data-no-retina alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                      <h4 class="font4 color-bg white">'.esc_html($name).'</h4>
                      <p>'.$content.'</p>
                  </div>
                </div>';
      return $output;
    }


    public function render_signature_johan_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => '',
        'sub_heading' => '',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<section class="signature-johan page-header fullheight parallax" data-stellar-background-ratio="0.5" style="background: url('.$bg_img_url.');">
                  <div class="fullheight trans-dark-overlay text-center">
                    <div class="valign">
                      
                        <section class="main-heading">
                            <h1 class="white font3bold uppercase">'.esc_html($heading).'</h1>
                            <h6 class="white font3light">'.esc_html($sub_heading).'</h6>
                            <div class="liner-large color-bg"></div>
                        </section>

                    </div>

                  </div>
                </section>';
      
      return $output;
    }


    public function render_signature_johan_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'feature_icon' => '',
        'icon_color' => '#cccccc'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-center service-block signature-johan">
                    <span class="'.esc_attr($feature_icon).'" style="color: '.esc_attr($icon_color).';"></span>
                    <h3 class="font3bold black">'.esc_html($heading).'</h3>
                    <div class="liner-small color-bg"></div>
                    <p class="dark">'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_johan_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-johan"> 
                    <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-info">
                      <h4 class="black font3bold">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay">
                        <p class="grey">'.$content.'</p>
                        <div class="liner-small color-bg"></div>
                        <div></div>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }



    public function render_signature_johan_counter( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'count' => '',
        'delay' => '',
        'color_theme' => 'white'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      

      $output = '<div data-delay="'.esc_attr($delay).'" class="elements-counter signature-johan"> 
                    <div class="number font3bold '.esc_attr($color_theme).'">'.esc_html($count).'</div> 
                    <div class="subject font3 '.esc_attr($color_theme).'">'.esc_html($title).'</div> 
                </div>';
      
      return $output;
    }



    public function render_signature_karl_text_ticker( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'font_color' => '#121212',
        'font_size' => '14px',
        'font_family' => '',
        'font_weight' => '300',
        'font_case' => '',
        'font_style' => '',
        'line_height' => '21px',
        'letter_spacing' => '0px',
        'customclass' => '',
        'txt_items' => '',
        'css' => '-'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      

      $txt_items = vc_param_group_parse_atts( $txt_items );
      
      $txt_items_markup = '';
      $first_item = true;

      foreach ($txt_items as $txt_item ) {
        $txt_item = isset($txt_item['txt_item']) ? $txt_item['txt_item'] : '';
        
        if($first_item == true)
        {
          $txt_items_markup .= '<b class="is-visible">'.esc_html($txt_item).'</b>';
          $first_item = false;
        }
        else
        {
          $txt_items_markup .= '<b>'.esc_html($txt_item).'</b>';
        }

      }

      
      $custom_css = '';
      if($css != '')
      {
          $custom_css = 'style="'.str_replace('{', '', substr($css,24,-1)).'"';
      }

      $style = 'style="color: '.$font_color.'; font-style:'.$font_style.'; font-size: '.$font_size.'; font-weight: '.$font_weight.'; letter-spacing: '.$letter_spacing.'; line-height: '.$line_height.';"';

      
      $output = '<section class="cd-intro signature-karl">
                  <div class="cd-headline loading-bar '.$customclass.' '.$font_family.' '.$font_case.'" '.$style.'>
                    <span class="cd-words-wrapper" '.$custom_css.'>'.$txt_items_markup.'</span>
                  </div>
                </section>';
      return $output;
    }

    public function render_signature_karl_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-johan"> 
                    <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-info">
                      <h4 class="font3bold white">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay trans-dark-overlay">
                        <p class="grey">'.$content.'</p>
                        <div class="liner-small color-bg"></div>
                        <div></div>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }

    public function render_signature_text_eraser( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'font_color' => '',
        'font_size' => '',
        'font_family' => '',
        'font_weight' => '',
        'font_case' => '',
        'font_style' => '',
        'line_height' => '',
        'letter_spacing' => '',
        'customclass' => '',
        'text_content' => '',
        'css' => ''
      ), $atts ) );

     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);



      $custom_css = '';
      if($css != '')
      {
          $custom_css = 'style="'.str_replace('{', '', substr($css,24,-1)).'"';
      }

      $style = 'style="color: '.$font_color.'; font-style:'.$font_style.'; font-size: '.$font_size.'; font-weight: '.$font_weight.'; letter-spacing: '.$letter_spacing.'; line-height: '.$line_height.';"';

      $text_items_markup = '';

      $text_items = explode(',', $text_content);

      $first_ele = 0;
      foreach ($text_items as $text_item) {
        $first_ele ++;
        if($first_ele == 1)
          $text_items_markup .= '<b class="is-visible">'.$text_item.'</b>';
        else
          $text_items_markup .= '<b>'.$text_item.'</b>';
      }

      $output = '<div class="signature-text-block cd-headline clip '.$customclass.' '.$font_family.' '.$font_case.'" '.$style.' ><span '.$custom_css.' class="cd-words-wrapper">'.$text_items_markup.'</span></div>';
      return $output;
    }


    public function render_signature_leon_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-leon"> 
                  <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                  <div class="team-info">
                    <h4 class="black font3bold">'.esc_html($name).'</h4>
                    <div class="liner-small-large color-bg"></div>
                    <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                  </div>
                  <div class="team-overlay color-bg">
                    <div class="valign">
                      <p class="dark">'.$content.'</p>
                      <div class="liner-small-large color-bg"></div>
                      <div></div>
                      <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                  </div>
                </article>';
      return $output;
    }


    public function render_signature_leon_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'feature_icon' => '',
        'align' => 'left'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      $info_align = ($align == 'left') ? 'right' : 'left';

      $output = '<article class="text-'.esc_attr($align).' service-block signature-leon white-bg">
                    <span class="'.esc_attr($feature_icon).' black pull-'.esc_attr($align).'"></span>
                    <div class="service-info-area service-info-area-'.esc_attr($info_align).'">
                        <h3 class="font3bold black">'.esc_html($heading).'</h3>
                        <div class="liner-small-large color-bg"></div>
                        <p class="dark">'.$content.'</p>
                    </div>
                </article>';
      return $output;
    }


    public function render_signature_moritz_counter( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'count' => '123',
        'delay' => '100',
        'color_theme' => 'white'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      

      $output = '<div data-delay="'.esc_attr($delay).'" class="elements-counter signature-moritz text-center"> 
                    <div class="number font3thin '.esc_attr($color_theme).'">'.esc_html($count).'</div> 
                    <div class="subject font3 uppercase '.esc_attr($color_theme).'">'.esc_html($title).'</div> 
                </div>';
      
      return $output;
    }


    public function render_signature_moritz_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-moritz"> 
                    <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-info">
                      <h4 class="black font3bold">'.esc_html($name).'</h4>
                      <div class="liner-short color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay color-bg">
                        <p class="grey">'.$content.'</p>
                        <div class="liner-small color-bg"></div>
                        <div></div>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }


    public function render_signature_moritz_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'feature_icon' => '',
        'icon_color' => 'black'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      

      $output = '<article class="text-center service-block signature-moritz">
                    <span class="'.esc_attr($feature_icon).' '.esc_attr($icon_color).'" style="color: '.esc_attr($icon_color).'"></span>
                    <h3 class="font3bold black">'.esc_html($heading).'</h3>
                    <div class="liner-short color-bg"></div>
                    <p class="dark">'.$content.'</p>
                </article>';
      return $output;
    }



    public function render_signature_nemo_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-moritz"> 
                    <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-info text-left">
                      <h4 class="black font3bold">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay trans-white-bg text-left">
                        <p class="grey">'.$content.'</p>
                        <div class="liner-small color-bg"></div>
                        <div></div>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }

    public function render_signature_orwin_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => '',
        'sub_heading' => '',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<div class="fullheight"><section class="page-fold signature-orwin subtle fullheight" style="background: url('.$bg_img_url.');">  
    
                  <div class="container-fluid valign">
                    <div class="row">
                      <div class="col-md-12">
                        <article class="hero-module signature-orwin text-center">
                          <h1 class="page-heading font3bold white">'.esc_html($heading).'</h1>
                          <h4 class="sub-heading-minor"><span class="font3 color-bg white">'.esc_html($sub_heading).'</span></h4>
                        </article>
                      </div>

                    </div>
                  </div>
                </div>';
      
      return $output;
    }


    public function render_signature_orwin_process_carousel( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'carousel_items',
        'color_theme' => 'white'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $carousel_items = vc_param_group_parse_atts( $atts['carousel_items'] );
      
      $carousel_items_markup = '';
      $carousel_trigger_markup = '';
      $carousel_count = 0;

      foreach ($carousel_items as $carousel_item) {
        $title = isset($carousel_item['title']) ? $carousel_item['title'] : '';
        $thin_txt = isset($carousel_item['thin_txt']) ? $carousel_item['thin_txt'] : '';
        $bold_txt = isset($carousel_item['bold_txt']) ? $carousel_item['bold_txt'] : '';

        $carousel_items_markup .= '<li class="process-carousel-item">
                                    <div class="">
                                      <article class="text-center">
                                        <h1 class="process-text '.esc_attr($color_theme).' font3thin">'.esc_html($thin_txt).' <span class=" '.esc_attr($color_theme).' font3bold">'.esc_html($bold_txt).'</span></h1>
                                      </article>
                                    </div>
                                  </li>';
        if($carousel_count == 0)
          $carousel_trigger_markup .= '<a class="features-triggered" data-slide-index="'.esc_attr($carousel_count).'" href="#">'.esc_html($title).'</a>';
        else
          $carousel_trigger_markup .= '<a data-slide-index="'.esc_attr($carousel_count).'" href="#">'.esc_html($title).'</a>';

        $carousel_count++;
      }

      $output = '<div class="process-carousel signature-orwin process-carousel-'.esc_attr($color_theme).' row">
                  <div class="col-md-10 col-md-offset-1">
                    <ul class="bxslider features-slider signature-orwin">'.$carousel_items_markup.'</ul>
                    <div id="bx-pager" class="features-slider-triggers signature-orwin font3bold text-center">'.$carousel_trigger_markup.'</div>
                  </div>
                </div>';
      
      return $output;
    }



    public function render_signature_orwin_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'service_icon' => '',
        'color_theme' => 'black'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      

      $output = '<div class="service-icon signature-orwin">
                  <i class="'.esc_attr($service_icon).' color"></i>
                  <h4 class="font3bold '.esc_attr($color_theme).'">'.esc_html($heading).'</h4>
                  <p class="'.esc_attr($color_theme).'">'.$content.'</p>
                </div>';
      return $output;
    }


    public function render_signature_orwin_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'staff_image' => '',
        
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      



      $output = '<div class="team-block signature-orwin">
                  <div class="team-block-inner white-bg">
                      <img data-no-retina alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                      <h4 class="font3 color-bg white">'.esc_html($name).'</h4>
                      <p>'.$content.'</p>
                  </div>
                </div>';
      return $output;
    }



    public function render_signature_orwin_parallax_showcase( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'showcase_items' => ''
        
      ), $atts ) );
      
      $showcase_items_markup = '';
      
      $showcase_items = vc_param_group_parse_atts( $atts['showcase_items'] );


      foreach ($showcase_items as $showcase_item) {
        
        $a_tag_attrs = '';

        $link = isset($showcase_item['link']) ? $showcase_item['link'] : '';
        $title_color_theme = isset($showcase_item['title_color_theme']) ? $showcase_item['title_color_theme'] : 'black';
        $overlay_color_theme = isset($showcase_item['overlay_color_theme']) ? $showcase_item['overlay_color_theme'] : 'trans-white-bg';

        if(isset($showcase_item['new_tab_opt']) && $showcase_item['new_tab_opt'] == 'yes')
            $a_tag_attrs = 'href="'.esc_url($link).'" target="_blank"';
        else
          $a_tag_attrs = 'href="'.esc_url($link).'"';
        
        $bg_image_url = '';

        if(isset($showcase_item['bg_image']) && $showcase_item['bg_image'] != '')
        {
          $bg_img_url = wp_get_attachment_image_src( $showcase_item['bg_image'] , 'full');
          $bg_image_url = $bg_img_url[0];
        }

        $title_segments = explode(' ', $showcase_item['title']);
        $title = $title_segments[0];
        $segment_count = 0;
        foreach ($title_segments as $title_segment) {
          $segment_count++;
          if($segment_count > 1)
            $title .= ' <span class="font3thin '.esc_attr($title_color_theme).'">'.$title_segment.'</span>';
        }


        $showcase_items_markup .= '<section class="parallax-showcase signature-orwin fullheight parallax" data-stellar-background-ratio="0.5" style="background-image:url('.esc_url($bg_image_url).');">
                                    <div class="orwin-parallax-showcase-overlay '.esc_attr($overlay_color_theme).' fullheight">
                                      <div class="valign">
                                          <div class="project-title text-center">
                                              <a '.$a_tag_attrs.'><h1 class="font3bold '.esc_attr($title_color_theme).'">'.$title.'</h1></a>
                                          </div>
                                      </div>
                                    </div>
                                  </section>';
      }
      

      $output = '<section class="parallax-showcase-wrap signature-orwin">'.$showcase_items_markup.'</section>';
      return $output;
    }



    public function render_signature_flickr_gallery( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'user_id' => '',
        'api_key' => '',
        'secret_key' => '',
        'photoset_id' => ''
        
        
      ), $atts ) );
      

      wp_enqueue_script('flickr-jquery-ui');
      wp_enqueue_script('flickr-api');
      wp_enqueue_script('flickr-gallery');
      wp_enqueue_script('flickr-init');



      $output = '<div class="content"> 
                  <div class="niceGallery-preloader"></div>
                  <div class="niceGallery" id="flickr-gallery" data-user="'.esc_attr($user_id).'" data-api-key="'.esc_attr($api_key).'" data-secret-key="'.esc_attr($secret_key).'" data-photoset-id="'.esc_attr($photoset_id).'"></div>
                </div>';
      return $output;
    }


    public function render_signature_quartz_background_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'images' => ''
        
        
      ), $atts ) );
     
      

      $slide_list = '';
      
      if($images != '')
      {
        $image_list = explode(',', $images);

        $slider_images = array();
        
        foreach($image_list as $image_id)
        {
          $slide_img = wp_get_attachment_image_src( $image_id , 'full');
          $slide_image_url = $slide_img[0];
          
          array_push($slider_images, $slide_image_url);
          
        }
        
      }
      

      wp_enqueue_script('backstretch-init');
      wp_localize_script('backstretch-init', 'slider_images', $slider_images);
      

      $output = '';
      
      return $output;
    }


    public function render_signature_quartz_intro_box( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'font_color' => '#111111',
        'border_color' => '#111111',
        'text_content' => 'Text 1, Text 2, Text 3',
        'link' => '',
        'new_tab' => ''
      ), $atts ) );

     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);


      $new_tab_opt = '';

      if($new_tab == 'yes')
      {
        $new_tab_opt = 'target="_blank"';
      }

      $output = '<div class="row intro signature-quartz">
                  <article class="text-center col-md-12">
                    <a href="'.esc_url($link).'" '.$new_tab_opt.'>
                      <div class="globe text-center" style="border-color: '.esc_attr($border_color).';">
                        <div class="valign ">
                          <div>
                            <h1 class="text-rotator font4" style="color: '.esc_attr($font_color).';">
                              <span class="rotate">'.esc_html($text_content).'</span>
                            </h1>
                          </div>
                        </div>
                      </div>
                    </a>
                  </article>
                </div>';
      return $output;
    }


    public function render_signature_quartz_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'font_color' => '#121212',
        'font_size' => '14px',
        'font_family' => '',
        'font_case' => '',
        'font_style' => '',
        'line_height' => '21px',
        'letter_spacing' => '0px',
        'font_wt' => '300',
        'txt_decor' => 'none',
        'customclass' => '',
      ), $atts ) );
      
       $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      

      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $style = 'style="color: '.$font_color.'; text-decoration:'.$txt_decor.'; font-style:'.$font_style.'; font-size: '.$font_size.'; letter-spacing: '.$letter_spacing.'; line-height: '.$line_height.';"';

      
      $output = '<section class="signature-quartz fullheight quartz-page-header" style="background-image:url('.esc_url($bg_img_url).');"> 
                  <section class="filter-overlay signature-quartz fullheight">
                    <div class="valign">
                      <div class="container">
                        <div class="row">
                            <article class="hero-text-wrap text-center col-md-8 col-md-offset-2">
                              <div class="signature-text-block '.$customclass.' '.$font_family.' '.$font_case.'" '.$style.' ><span>'.$content.'</span></div>
                            </article>
                        </div>
                      </div>
                    </div>
                  </section>
                </section>';
      return $output;
    }

    public function render_signature_quartz_section_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<section class="quartz-main-heading">
                  <h2 class="quartz-sub-heading signature-quartz black font2">'.esc_html($heading).'</h2>
                  <h3 class="quartz-promo-text light-grey font4">'.esc_html($promo_txt).'</h3>
                  <div class="signature-liner liner-small-medium color-bg"></div>
                </section>';
      
      return $output;
    }

    public function render_signature_quartz_skillset( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'percent' => '50',
        'symbol' => '%',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="skills progress-container signature-quartz">
                  <h6 class="font2 '.esc_attr($color_theme).'">'.esc_html($title).'<span class="font4 color">'.esc_html($percent.$symbol).'</span></h6>
                  <div class="progress active">
                      <div class="progress-bar '.esc_attr($color_theme).'-bg" data-skills-value="'.esc_attr($percent).'"></div>
                  </div>
                </article>';
      return $output;
    }

    public function render_signature_quartz_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="text-left team-block signature-quartz no-pad">
                  <div class="team-block-inner white-bg">
                    <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                      <h4 class="font2 black">'.esc_html($name).'</h4>
                      <h6 class="font4 color">'.esc_html($designation).'</h6>
                  </div>
                      <div class="team-overlay white-bg text-center">
                        <p class="font3">'.$content.'</p>
                        <div class="team-social">
                          <ul class="team-social-inner">'.$social_icons_markup.'</ul>
                        </div>
                      </div>
                </article>';
      return $output;
    }


    public function render_signature_quartz_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'service_icon' => '',
        'color_theme' => 'black'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      

      $output = '<article class="text-left service-block signature-quartz">
                  <i class="'.esc_attr($service_icon).' color"></i>
                  <h4 class="font2 '.esc_attr($color_theme).'">'.esc_html($heading).'</h4>
                  <p>'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_quartz_price_table( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'color_theme' => 'white',
        'currency' => '$',
        'amount' => '100',
        'btn_text' => 'Buy It',
        'btn_link' => '',
        'btn_new_tab' => '',
        'btn_color_theme' => '',
        'plans' => ''             
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      

      $new_tab_opt = '';

      if($btn_new_tab == 'yes')
      {
        $new_tab_opt = 'target="_blank"';
      }

      

      $plan_features = '';

      $plans = vc_param_group_parse_atts( $plans );
      
      
      foreach ($plans as $plan ) {
        $plan_feature = isset($plan['title']) ? $plan['title'] : '';
        
        $plan_features .= $plan_feature.'<br/>';

      }
      
      

      $output = '<div class="price signature-price-table price-table-'.esc_attr($color_theme).'">
                  <h1 class="font2 '.esc_attr($color_theme).'">'.esc_html($currency).' '.esc_html($amount).'</h1>
                  <p class="price-specs '.esc_attr($color_theme).'">'.$plan_features.'</p>
                  <div><a href="'.esc_url($btn_link).'" '.$new_tab_opt.' class="btn btn-signature btn-signature-gozzo btn-signature-'.esc_attr($btn_color_theme).'">'.esc_html($btn_text).'</a></div>
                </div>';
      return $output;
    }

    public function render_signature_rein_text_ticker( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'text_items' => '',
        'font_size' => '14px',
        'font_family' => '',
        'font_weight' => '300',
        'font_case' => '',
        'font_style' => '',
        'line_height' => '21px',
        'letter_spacing' => '0px',
        'customclass' => '',
        'txt_items' => '',
        'css' => '-'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      

      $txt_elements = '';

      $text_items = vc_param_group_parse_atts( $text_items );
      
      //var_dump($text_items);
      $first_ele = true;
      foreach ($text_items as $text_item ) {
       
        $text = isset($text_item['title']) ? $text_item['title'] : '';
        $color = isset($text_item['font_color']) ? $text_item['font_color'] : '';
        
        
        if($first_ele == true)
        {
          $txt_elements .= '<b class="is-visible" style="color: '.$color.';">'.esc_html($text).'</b>';
          $first_ele = false;
        }
        else
        $txt_elements .= '<b style="color: '.$color.';">'.esc_html($text).'</b>';

      }

      
      $custom_css = '';
      if($css != '')
      {
          $custom_css = 'style="'.str_replace('{', '', substr($css,24,-1)).'"';
      }

      $style = 'style="font-style:'.$font_style.'; font-size: '.$font_size.'; font-weight: '.$font_weight.'; letter-spacing: '.$letter_spacing.'; line-height: '.$line_height.';"';

      
      $output = '<section class="cd-intro signature-rein">
                  <h3 class="cd-headline letters rotate-2 '.$customclass.' '.$font_family.' '.$font_case.'" '.$style.'>
                    <span class="cd-words-wrapper" '.$custom_css.'>'.$txt_elements.'</span>
                  </h3>
                </section>';
      return $output;
    }



    public function render_signature_stefan_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      



      $output = '<article class="team-block signature-stefan"> 
                  <img data-no-retina alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                  <div class="team-overlay color-bg">
                    <div class="team-info">
                      <h4 class="black font3bold">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="white font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <p class="white">'.$content.'</p>
                    <div class="liner-small color-bg"></div>
                    <div></div>
                  </div>
                </article>';
      return $output;
    }


    public function render_signature_stefan_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'service_icon' => '',
        'color_theme' => 'black'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      

      $output = '<article class="text-center service-block signature-stefan">
                    <span class="'.esc_attr($service_icon).' color"></span>
                    <h3 class="font3bold '.esc_attr($color_theme).'">'.esc_html($heading).'</h3>
                    <div class="liner-small color-bg"></div>
                    <p class="'.esc_attr($color_theme).'">'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_stefan_counter( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'count' => '',
        'delay' => '',
        'title_color_theme' => 'dark',
        'count_color_theme' => 'white'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      

      $output = '<div data-delay="'.esc_attr($delay).'" class="elements-counter signature-johan stefan-counter"> 
                    <div class="number font3black '.esc_attr($count_color_theme).'">'.esc_html($count).'</div> 
                    <div class="subject font3 uppercase '.esc_attr($title_color_theme).'">'.esc_html($title).'</div> 
                </div>';
      
      return $output;
    }


    public function render_signature_theo_features_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'slider_items',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $slider_items = vc_param_group_parse_atts( $atts['slider_items'] );
      
      $slider_header_markup = '<div id="bx-pager" class="text-center features-slider-triggers signature-theo font3bold">';
      $slider_index = 0;

      foreach ($slider_items as $slider_item) {
        $title = isset($slider_item['title']) ? $slider_item['title'] : '';
        $icon = isset($slider_item['feature_icon']) ? $slider_item['feature_icon'] : '';
        $content = isset($slider_item['content']) ? $slider_item['content'] : '';
        
        if($slider_index == 0)
          $slider_header_markup .= '<a class="features-triggered" data-slide-index="'.esc_attr($slider_index).'" href="#"><i class="'.esc_attr($icon).' color '.esc_attr($color_theme).'-on-active"></i></a>';
        else
          $slider_header_markup .= '<a data-slide-index="'.esc_attr($slider_index).'" href="#"><i class="'.esc_attr($icon).' color '.esc_attr($color_theme).'-on-active"></i></a>';

        $slider_index++;
      }
      $slider_header_markup .= '</div>';

      
      $slider_content_markup = '<ul class="bxslider features-slider signature-theo">';
      
      foreach ($slider_items as $slider_item) {
        $content = isset($slider_item['content']) ? $slider_item['content'] : '';
        
        $slider_content_markup .= '<li>
                                    <div class="row">
                                        <article class="col-md-12 text-center">
                                          <h1 class="process-text '.esc_attr($color_theme).' font3thin">'.$content.'</h1>
                                        </article>
                                    </div>
                                  </li>';

        
      }
      $slider_content_markup .= '</ul>';

      $output = $slider_header_markup.$slider_content_markup;
      
      return $output;
    }



    public function render_signature_theo_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'service_icon' => '',
        'color_theme' => 'black'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      
      

      $output = '<article class="text-center service-block signature-theo">
                  <div class="service-icon signature-theo">
                    <i class="'.esc_attr($service_icon).' '.esc_attr($color_theme).'"></i>
                    <h4 class="font3bold color">'.esc_html($heading).'</h4>
                    <p class="font3light '.esc_attr($color_theme).'">'.$content.'</p>
                  </div>
                </article>';
      return $output;
    }



    public function render_signature_uno_splash_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'slider_items',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $slider_items = vc_param_group_parse_atts( $atts['slider_items'] );
      
      $slider_items_markup = '';

      foreach ($slider_items as $slider_item) {
        $title = isset($slider_item['title']) ? $slider_item['title'] : '';
        $caption = isset($slider_item['caption']) ? $slider_item['caption'] : '';

        $link = isset($slider_item['link']) ? $slider_item['link'] : '';
        $new_tab = isset($slider_item['new_tab']) ? $slider_item['new_tab'] : '';

        $new_tab_opt = '';
        if($new_tab == 'yes')
        {
          $new_tab_opt = 'target="_blank"';
        }

        

        $image_url = '';

        if(isset($slider_item['image']))
        {
          $slider_item_image = $slider_item['image'];
          $image = wp_get_attachment_image_src( $slider_item_image , 'full');
          $image_url = $image[0];
        }


        
        $slider_items_markup .= '<div class="item album-cover img-bg" style="background-image:url('.esc_url($image_url).')">
                                  <a class="album-view" href="'.esc_url($link).'" '.$new_tab_opt.'>
                                    <div class="album-info">
                                      <h3 class="font3 color">'.esc_html($title).'</h3>
                                      <h6><span class="font2 white-bg dark">'.esc_html($caption).'</span></h6>
                                    </div>
                                  </a>
                                </div>';
      }

      $output = '<div class="intro-carousel signature-uno owl-carousel owl-nav-sticky-wide">'.$slider_items_markup.'</div>';
      
      return $output;
    }


    public function render_signature_uno_reel_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'slider_items',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $slider_items = vc_param_group_parse_atts( $atts['slider_items'] );
      
      $slider_items_markup = '';

      foreach ($slider_items as $slider_item) {
        $title = isset($slider_item['title']) ? $slider_item['title'] : '';
        $caption = isset($slider_item['caption']) ? $slider_item['caption'] : '';

        $link = isset($slider_item['link']) ? $slider_item['link'] : '';
        $new_tab = isset($slider_item['new_tab']) ? $slider_item['new_tab'] : '';

        $new_tab_opt = '';
        if($new_tab == 'yes')
        {
          $new_tab_opt = 'target="_blank"';
        }

        

        $image_url = '';

        if(isset($slider_item['image']))
        {
          $slider_item_image = $slider_item['image'];
          $image = wp_get_attachment_image_src( $slider_item_image , 'full');
          $image_url = $image[0];
        }


        
        $slider_items_markup .= '<div class="item halfheight discography-cover" style="background-image:url('.esc_url($image_url).')">
                                  <a class="discography-view halfheight" href="'.esc_url($link).'" '.$new_tab_opt.'>
                                    <div class="discography-info valign">
                                      <h3 class="font3 color">'.esc_html($title).'</h3>
                                      <h6><span class="font2 white-bg dark">'.esc_html($caption).'</span></h6>
                                    </div>
                                  </a>
                                </div>';
      }

      $output = '<div class="discography-carousel signature-uno owl-carousel owl-nav-sticky-wide">'.$slider_items_markup.'</div>';
      
      return $output;
    }


    public function render_signature_velten_featured_work( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'bg_image' => '',
        'link' => '',
        'new_tab' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $target = '';

      if($new_tab == 'yes')
        $target = 'target="_blank"';

      $image_url = '';
      if($bg_image != '')
      {
        $image = wp_get_attachment_image_src( $bg_image , 'full');
        $image_url = $image[0];
      }

      $output = '<section class="home-featured signature-velten img-bg" style="background-image:url('.$image_url.');">
                    <a href="'.esc_url($link).'" '.$target.'>
                      <div class="home-featured-overlay pad-top pad-bottom">
                        <div class="row">
                          <article class="col-md-8 col-md-offset-2 text-center">
                            <h1 class="font3bold white">'.esc_html($title).'</h1>
                            <div class="signature-liner liner-large color-bg"></div>
                          </article>
                        </div>
                      </div>
                    </a>
                </section>';
      
      return $output;
    }


    public function render_signature_velten_project_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'sub_heading' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      
      

      $output = '<article class="project-title signature-ebert text-center">
                  <h3 class="font2 black">'.esc_html($sub_heading).'</h3>
                  <div class="liner-large color-bg"></div>
                  <h1 class="main-heading font2 dark">'.esc_html($heading).'</h1>
                </article>';
      
      return $output;
    }

    public function render_signature_wilmar_page_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'bg_image' => '',
        'heading' => '',
        'promo_txt' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      $bg_img_url = '';
      if($bg_image != '')
      {
        $bg_image_url = wp_get_attachment_image_src( $bg_image , 'full');
        $bg_img_url = $bg_image_url[0];
      }
      
      

      $output = '<section class="first-fold signature-adler fullheight parallax" data-stellar-background-ratio="0.5" style="background: url('.$bg_img_url.');">
                  <section class="main-heading fixed-bottom">
                      <h1 class="white font3bold">'.esc_html($heading).'</h1>
                      <h6 class="white font3light wilmar-page-promo-txt">'.esc_html($promo_txt).'</h6>
                      <div class="liner-large dark-bg"></div>
                  </section>
                </section>';
      
      return $output;
    }

    public function render_signature_wilmar_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-left service-block signature-adler">
                    <span class="'.$service_icon.' '.$color_theme.'"></span>
                    <h3 class="font3bold '.$color_theme.'">'.esc_html($title).'</h3>
                    <div class="liner-small dark-bg"></div>
                    <p class="'.$color_theme.'">'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_xaver_section_header( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'color_theme' => 'white'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      $output = '<article class="text-left signature-xaver-section-header">
                  <h3 class="promo-text '.esc_attr($color_theme).' font3">'.esc_html($heading).'</h3>
                  <div class="liner-large color-bg"></div>
                </article>';
      
      return $output;
    }


    public function render_signature_xaver_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'service_icon' => '',
        'color_theme' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-left service-block signature-xaver">
                    <i class="'.$service_icon.' color"></i>
                    <h4 class="font2 '.esc_attr($color_theme).'">'.esc_html($title).'</h4>
                    <p class="'.esc_attr($color_theme).'">'.$content.'</p>
                </article>';
      return $output;
    }


    public function render_signature_xaver_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<div class="team-block signature-xaver text-center">
                  <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-overlay">
                      <div class="team-info valign">
                        <h4 class="black font3bold">'.esc_html($name).'</h4>
                        <p class="white font3bold">'.$content.'</p>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                      </div>
                      
                  </div>
                </div>';
      return $output;
    }

    public function render_signature_york_counter( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'title' => '',
        'count' => '',
        'delay' => '',
        'color_theme' => 'white'
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
     //var_dump($content);
      
      

      $output = '<div data-delay="'.esc_attr($delay).'" class="elements-counter signature-johan"> 
                    <div class="number font3bold color">'.esc_html($count).'</div> 
                    <div class="subject signature-york-counter-title font3 '.esc_attr($color_theme).'">'.esc_html($title).'</div> 
                </div>';
      
      return $output;
    }

    public function render_signature_york_team( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'name' => '',
        'designation' => '',
        'staff_image' => '',
        'social_icons' => ''
        
      ), $atts ) );
      $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $content = wp_kses($content, array(
                                    'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'img' => array(
                                        'src' => array(),
                                        'title' => array()
                                      ),

                                    ));
      $image_url = '';
      if($staff_image != '')
      {
        $image = wp_get_attachment_image_src( $staff_image , 'full');
        $image_url = $image[0];
      }

      $social_icons = vc_param_group_parse_atts( $social_icons );
      
      $social_icons_markup = '';

      foreach ($social_icons as $social_icon ) {
        $social_icon_title = isset($social_icon['title']) ? $social_icon['title'] : '';
        $social_icon_url = isset($social_icon['icon_url']) ? $social_icon['icon_url'] : '';
        

        $icon_image_url = '';

        if(isset($social_icon['icon_image']))
        {
          $social_icon_image = $social_icon['icon_image'];
          $icon_image = wp_get_attachment_image_src( $social_icon_image , 'full');
          $icon_image_url = $icon_image[0];
        }
        else{
          if($social_icon_title == 'Twitter')
            $icon_image_url = get_template_directory_uri().'/images/social/01.svg';
          if($social_icon_title == 'Dribbble')
            $icon_image_url = get_template_directory_uri().'/images/social/02.svg';
        }

        $social_icons_markup .= '<li><a href="'.esc_url($social_icon_url).'" target="_blank"><img data-no-retina alt="'.esc_attr($social_icon_title).'" title="'.esc_attr($social_icon_title).'" src="'.esc_url($icon_image_url).'"/></a></li>';

      }



      $output = '<article class="team-block signature-johan"> 
                    <img alt="'.esc_attr($name).'" title="'.esc_attr($name).'" class="img-responsive" src="'.esc_url($image_url).'"/>
                    <div class="team-info">
                      <h4 class="black font3bold">'.esc_html($name).'</h4>
                      <div class="liner-small color-bg"></div>
                      <h6 class="grey font3bold">'.esc_html($designation).'</h6>
                    </div>
                    <div class="team-overlay trans-color-bg">
                        <p class="dark">'.$content.'</p>
                        <div class="liner-small dark-bg"></div>
                        <div></div>
                        <ul class="team-social">'.$social_icons_markup.'</ul>
                    </div>
                </article>';
      return $output;
    }


    public function render_signature_york_services( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'heading' => '',
        'feature_icon' => '',
        'icon_color' => '#121212',
        'text_color' => '#121212',
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      

      $output = '<article class="text-center service-block signature-york">
                    <span class="'.esc_attr($feature_icon).'" style="color: '.esc_attr($icon_color).';"></span>
                    <h3 class="font3bold" style="color: '.esc_attr($text_color).';">'.esc_html($heading).'</h3>
                    <div class="liner-small" style="background-color:'.esc_attr($icon_color).';"></div>
                    <p style="color: '.esc_attr($text_color).';">'.$content.'</p>
                </article>';
      return $output;
    }

    public function render_signature_recent_product_parallax_showcase( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'item_no' => '4',
        'customclass' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $showcase_list = '';

      if(function_exists("is_woocommerce")){
        $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => $item_no, 'orderby' =>'date','order' => 'DESC' );
        $product_loop = new WP_Query( $args );
        while ( $product_loop->have_posts() ) : $product_loop->the_post(); global $product; 
          if (has_post_thumbnail( $product_loop->post->ID )) 
          {
            $product_image =  wp_get_attachment_image_src(get_post_thumbnail_id($product_loop->post->ID), 'full'); 
            $product_image = $product_image[0];
          }
          else
            $product_image = woocommerce_placeholder_img_src();

          

          $showcase_list .= '<section class="parallax-showcase signature-zircon fullheight parallax" style="background-image: url('.esc_url($product_image).');" data-stellar-background-ratio="0.5">
                              <div class="parallax-showcase-overlay fullheight">
                                <div class="valign">
                                    <div class="project-title text-center">
                                        <a href="'.esc_url(get_the_permalink()).'"><h1 class="font2 white">'.esc_html(get_the_title()).'</h1></a>
                                    </div>
                                      <div class="shop-item-price dark text-center">
                                        <span class="shop-item-price-old color font1">'.$product->get_price_html().'</span>
                                      </div>
                                      <div class="shop-item-info">
                                        <a href="'.esc_url(get_the_permalink()).'" class="btn btn-small btn-signature btn-signature-white"><i class="glyphicon glyphicon-list"></i> Item Details</a>
                                      </div>    
                                      <div class="shop-item-cart">
                                        <a href="'.esc_url($product->add_to_cart_url()).'" class="add_to_cart_button ajax_add_to_cart btn btn-small btn-signature btn-signature-white"><i class="glyphicon glyphicon-shopping-cart"></i> Add to cart</a>
                                      </div>            
                                </div>
                              </div>
                            </section>';
                    
        endwhile; 
        wp_reset_query();
      }

      $output = '<section class="parallax-showcase-wrap signature-zircon '.esc_attr($customclass).'">'.$showcase_list.'</section>';
      return $output;
    }

    public function render_signature_recent_product_minimal_grid( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'item_no' => '4',
        'customclass' => ''
      ), $atts ) );
      
     // $content = wpb_js_remove_wpautop($content, true); // fix unclosed/unwanted paragraph tags in $content
      $grid_list = '';

      if(function_exists("is_woocommerce")){
        $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => $item_no, 'orderby' =>'date','order' => 'DESC' );
        $product_loop = new WP_Query( $args );
        while ( $product_loop->have_posts() ) : $product_loop->the_post(); global $product; 
          if (has_post_thumbnail( $product_loop->post->ID )) 
          {
            $product_image =  wp_get_attachment_image_src(get_post_thumbnail_id($product_loop->post->ID), 'full'); 
            $product_image = $product_image[0];
          }
          else
            $product_image = woocommerce_placeholder_img_src();

          

          $grid_list .= '<div class="works-item shop-grid signature-zircon ImageWrapper works-item-one-fourth-spaced info ui web">
                          <img data-no-retina alt="'.esc_attr(get_the_title()).'" title="'.esc_attr(get_the_title()).'" class="img-responsive" src="'.esc_url($product_image).'"/>
                          <a href="'.esc_url(get_the_permalink()).'">
                              <div class="works-item-inner ImageOverlayP">
                                <p class="valign text-center"><span class="white font3">'.esc_html(get_the_title()).'</span></p>
                                <div class="shop-item-price dark text-left">
                                  <span class="shop-item-price-old color font1">'.$product->get_price_html().'</span>
                                </div>
                              </div>
                          </a>
                        </div>';
                    
        endwhile; 
        wp_reset_query();
      }

      $output = '<section id="works-container" class="works-container signature-zircon works-masonry-container clearfix white-bg works-thumbnails-view '.esc_attr($customclass).'">'.$grid_list.'</section>';
      return $output;
    }

    public function render_signature_amor_background_slider( $atts, $content = null ) {
      extract( shortcode_atts( array(
        'images' => ''
        
      ), $atts ) );
     
      

      $slide_list = '';
      $slider_images = array();

      if($images != '')
      {
        $image_list = explode(',', $images);
        
        

        foreach($image_list as $image_id)
        {
          $slide_img = wp_get_attachment_image_src( $image_id , 'full');
          $slide_image_url = $slide_img[0];
          
          
          array_push($slider_images, array(
                "src" => $slide_image_url
          ));
        }
      }
      
      
      
      wp_enqueue_script('amor-vegas-init');
      wp_localize_script('amor-vegas-init', 'slider_images', $slider_images);
  
      $output = '';

      return $output;
    }

    /*
    Load plugin css and javascript files which you may need on front end of your site
    */
    public function loadCssAndJs() {
      wp_register_style( 'vc_extend_style', plugins_url('assets/vc_extend.css', __FILE__) );
      wp_enqueue_style( 'vc_extend_style' );

      // If you need any javascript files on front end, here is how you can load them.
      //wp_enqueue_script( 'vc_extend_js', plugins_url('assets/vc_extend.js', __FILE__), array('jquery') );
    }

    /*
    Show notice if your plugin is activated but Visual Composer is not
    */
    public function showVcVersionNotice() {
        $plugin_data = get_plugin_data(__FILE__);
        echo '
        <div class="updated">
          <p>'.sprintf(__('<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend'), $plugin_data['Name']).'</p>
        </div>';
    }



}
// Finally initialize code
new VCExtendAddonClass();


if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Signature_Section extends WPBakeryShortCodesContainer {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Signature_Dierk_Split_Section extends WPBakeryShortCodesContainer {
    }
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Signature_Carousel_Wrap extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Signature_Carousel_Item extends WPBakeryShortCodesContainer {
    }
}
