<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class db_images_code extends ET_Builder_Module {

  public $vb_support = 'on';

  public $folder_name;
  public $fields_defaults;
  public $text_shadow;
  public $margin_padding;
  public $_additional_fields_options;

  protected $module_credits = array(
    'module_uri' => DE_DB_PRODUCT_URL,
    'author'     => DE_DB_AUTHOR,
    'author_uri' => DE_DB_URL,
  );

  function init() {
    $this->name       = esc_html__( 'PP Gallery - Product Page', 'divi-bodyshop-woocommerce' );
    $this->slug = 'et_pb_db_images';
    $this->folder_name = 'divi_bodycommerce';

    $this->fields_defaults = array(
      'use_icon'                  => array( 'off' ),
      'icon_color'                => array( '#2ea3f2', 'add_default_setting' ),
      'icon_color_next'           => array( '#2ea3f2', 'add_default_setting' ),
      'auto'                      => array( 'off' ),
      'auto_speed'                => array( '7000' ),
      'disable_lightbox' 	        => array( 'off' ),
      'disable_lightbox_sliders' 	=> array( 'on' ),
      'disable_zoom_sliders' 	    => array( 'on' ),
      'gallery_style' 	          => array( 'default' ),
    );

    $this->settings_modal_toggles = array(
      'general' => array(
        'toggles'  => array(
          'gallery'      => esc_html__( 'Gallery', 'divi-bodyshop-woocommerce' ),
          'elements'      => esc_html__( 'Elements', 'divi-bodyshop-woocommerce' ),
          'slider_settings'    => array(
            'title' => esc_html__( 'Slider Options', 'divi-machine'),
            'tabbed_subtoggles' => true,
            'sub_toggles'       => array(
              'general'     => array(
                'name' => esc_html__( 'General', 'divi-machine')
              ),
              'arrows_dots'     => array(
                'name' => esc_html__( 'Arrows/Dots', 'divi-machine')
              )
            )
          ),
          'slider_thumb_settings'  => esc_html__( 'Slider Thumbnail Options', 'divi-bodyshop-woocommerce' ),
          'main_content' => esc_html__( 'Images', 'divi-bodyshop-woocommerce' ),
          'elements'     => esc_html__( 'Elements', 'divi-bodyshop-woocommerce' ),
        ),
      ),
      'advanced' => array(
        'toggles' => array(
          'layout'  => esc_html__( 'Layout', 'divi-bodyshop-woocommerce' ),
          'overlay' => esc_html__( 'Overlay', 'divi-bodyshop-woocommerce' ),
          'custom_slider' => esc_html__( 'Slider', 'divi-bodyshop-woocommerce' ),
          'arrows_adv' => esc_html__( 'Arrows', 'divi-bodyshop-woocommerce' ),
          'dots_adv' => esc_html__( 'Dots', 'divi-bodyshop-woocommerce' ),
          'text'    => array(
            'title'    => esc_html__( 'Text', 'divi-bodyshop-woocommerce' ),
            'priority' => 49,
          ),
        ),
      ),
      'custom_css' => array(
        'toggles' => array(
          'animation' => array(
            'title'    => esc_html__( 'Animation', 'divi-bodyshop-woocommerce' ),
            'priority' => 90,
          ),
        ),
      ),
    );

    $this->main_css_element = '%%order_class%%';
    $this->advanced_fields = array(
      'fonts' => array(
        'caption' => array(
          'label'    => esc_html__( 'Caption', 'divi-bodyshop-woocommerce' ),
          'use_all_caps' => true,
          'css'      => array(
            'main' => "{$this->main_css_element} .mfp-title, {$this->main_css_element} .et_pb_gallery_caption",
          ),
          'font_size' => array(
            'default' => '14px',
          ),
          'line_height' => array(
            'default' => '1.7em',
          ),
        ),
        'title'   => array(
          'label'    => esc_html__( 'Title', 'divi-bodyshop-woocommerce' ),
          'css'      => array(
            'main' => "{$this->main_css_element} .et_pb_gallery_item h3",
          ),
          'font_size' => array(
            'default' => '18px',
          ),
          'line_height' => array(
            'default' => '1em',
          ),
        ),
        'image_title'   => array(
          'label'    => esc_html__( 'Image Name', 'divi-bodyshop-woocommerce' ),
          'css'      => array(
            'main' => "{$this->main_css_element} .thumb-title",
          ),
          'font_size' => array(
            'default' => '18px',
          ),
          'line_height' => array(
            'default' => '1em',
          ),
        ),
      ),
      'borders'               => array(
        'default' => array(
          'css' => array(
            'main' => array(
              'border_radii'  => "{$this->main_css_element}",
              'border_styles' => "{$this->main_css_element}",
            ),
          ),
        ),
        'image' => array(
          'css' => array(
            'main' => array(
              'border_radii'  => "{$this->main_css_element} .woocommerce-product-gallery .flex-viewport,{$this->main_css_element} .flex-control-thumbs li,{$this->main_css_element} .slick-slide img",
              'border_styles' => "{$this->main_css_element} .woocommerce-product-gallery .flex-viewport, {$this->main_css_element} .flex-control-thumbs li,{$this->main_css_element} .slick-slide img",
              'important' => 'all',
            )
          ),
          'label_prefix'    => esc_html__( 'Images', 'divi-bodyshop-woocommerce' ),
        ),
      ),
      'box_shadow' => array(
        'default' => array(),
        'image' => array(
          'css' => array(
            'main'  => "{$this->main_css_element} .woocommerce-product-gallery .flex-viewport, {$this->main_css_element} .flex-control-thumbs li",
            'important' => 'all',
            'overlay' => 'inset',
          ),
          'label'    => esc_html__( 'Images', 'divi-bodyshop-woocommerce' ),
        ),
      ),
      'custom_margin_padding' => array(
        'css' => array(
          'important' => 'all',
        ),
      ),
    );

    $this->custom_css_fields = array(
      'gallery_item' => array(
        'label'    => esc_html__( 'Gallery Item', 'divi-bodyshop-woocommerce' ),
        'selector' => '.et_pb_gallery_item',
      ),
      'overlay' => array(
        'label'    => esc_html__( 'Overlay', 'divi-bodyshop-woocommerce' ),
        'selector' => '.et_overlay',
      ),
      'overlay_icon' => array(
        'label'    => esc_html__( 'Overlay Icon', 'divi-bodyshop-woocommerce' ),
        'selector' => '.et_overlay:before',
      ),
      'gallery_item_title' => array(
        'label'    => esc_html__( 'Gallery Item Title', 'divi-bodyshop-woocommerce' ),
        'selector' => '.et_pb_gallery_title',
      ),
      'gallery_item_caption' => array(
        'label'    => esc_html__( 'Gallery Item Caption', 'divi-bodyshop-woocommerce' ),
        'selector' => '.et_pb_gallery_caption',
      ),
      'gallery_pagination' => array(
        'label'    => esc_html__( 'Gallery Pagination', 'divi-bodyshop-woocommerce' ),
        'selector' => '.et_pb_gallery_pagination',
      ),
      'gallery_pagination_active' => array(
        'label'    => esc_html__( 'Pagination Active Page', 'divi-bodyshop-woocommerce' ),
        'selector' => '.et_pb_gallery_pagination a.active',
      ),
    );

    $this->help_videos = array(
      array(
        'id'   => esc_html__( 'n2karNiwJ3A', 'divi-bodyshop-woocommerce' ), // YouTube video ID
        'name' => esc_html__( 'BodyCommcerce Product Page Template Guide', 'divi-bodyshop-woocommerce' ),
      ),
    );
  }

  function get_fields() {
    $fields = array(
      'gallery_style' => array(
        'label'           => __( 'Gallery Style', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'basic_option',
        'computed_affects' => array(
          '__getprogallery',
        ),
        'options'           => array(
          'default' => esc_html__( 'Default', 'divi-bodyshop-woocommerce' ),
          'single'  => esc_html__( 'Single Slider', 'divi-bodyshop-woocommerce' ),
          'horizontal'  => esc_html__( 'Horizontal Slider', 'divi-bodyshop-woocommerce' ),
          'vertical'  => esc_html__( 'Vertical Slider', 'divi-bodyshop-woocommerce' ),
          'expandable'  => esc_html__( 'Expandable', 'divi-bodyshop-woocommerce' ),
          'stacked'  => esc_html__( 'Stacked', 'divi-bodyshop-woocommerce' )
        ),
        'toggle_slug'         => 'gallery',
        'description'       => __( 'Choose the gallery style you wish to use.', 'divi-bodyshop-woocommerce' ),
        'affects' => array(
          'slider_margin_top',
          'slider_margin_right'
        )
      ),
      'disable_featured' => array(
        'label' => esc_html__( 'Disable Featured Image', 'divi-bodyshop-woocommerce' ),
        'description' => esc_html__( 'Enabling this option will disable the lightbox slider for the images', 'divi-bodyshop-woocommerce' ),
        'type' => 'yes_no_button',
        'options_category' => 'configuration',
        'options' => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'default' => 'off',
        'toggle_slug' => 'elements',
        'show_if_not'     => array('gallery_style' => array('default'))
      ),
      'disable_lightbox_sliders' => array(
        'label' => esc_html__( 'Disable Lightbox', 'divi-bodyshop-woocommerce' ),
        'description' => esc_html__( 'Enabling this option will disable the lightbox slider for the images', 'divi-bodyshop-woocommerce' ),
        'type' => 'yes_no_button',
        'options_category' => 'configuration',
        'options' => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'toggle_slug' => 'elements',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'disable_zoom_sliders' => array(
        'label' => esc_html__( 'Disable Image Zoom', 'divi-bodyshop-woocommerce' ),
        'description' => esc_html__( 'Enabling this option will disable the image zoom for the images', 'divi-bodyshop-woocommerce' ),
        'type' => 'yes_no_button',
        'options_category' => 'configuration',
        'options' => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'toggle_slug' => 'elements',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'enable_image_title_sliders' => array(
        'label' => esc_html__( 'Enable Name Title', 'divi-bodyshop-woocommerce' ),
        'description' => esc_html__( 'Enabling this option will add the image name below the image', 'divi-bodyshop-woocommerce' ),
        'type' => 'yes_no_button',
        'options_category' => 'configuration',
        'default' => 'off',
        'options' => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'toggle_slug' => 'elements',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'disable_lightbox' => array(
        'label' => esc_html__( 'Disable Lightbox', 'divi-bodyshop-woocommerce' ),
        'description' => esc_html__( 'Enabling this option will hide the magnifying glass over the image.', 'divi-bodyshop-woocommerce' ),
        'type' => 'yes_no_button',
        'options_category' => 'configuration',
        'options' => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'toggle_slug' => 'elements',
        'show_if'     => array('gallery_style' => 'default')
      ),
      // Slider Settings 
      // General
      'main_image_size' => array(
        'label'           => esc_html__( 'Main Image Size', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'default' => esc_html__( 'Default', 'divi-bodyshop-woocommerce' ),
          'full-size'  => esc_html__( 'Full Size', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'default',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'general',
        'description'       => esc_html__( 'Choose the size of image you want to serve, if you are having issues with them looking blury, enable full size.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'infinite' => array(
        'label'           => esc_html__( 'Enable Infinite Loop', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'affects' => array(
          'auto'
        ),
        'default'           => 'on',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'general',
        'description'       => esc_html__( 'If you want the loop to look like it is infinite (they will be cloned) - enable this. If you want to disable it so there is a start and an end depending on how many are in the loop, disable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'auto' => array(
        'label'           => esc_html__( 'Automatic Animation', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => esc_html__( 'Off', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'On', 'divi-bodyshop-woocommerce' ),
        ),
        'affects' => array(
          'auto_speed',
        ),
        'depends_show_if' => 'on',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'general',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked')),
        'description'       => esc_html__( 'If you would like the slider to slide automatically, without the visitor having to click the next button, enable this option and then adjust the rotation speed below if desired.', 'divi-bodyshop-woocommerce' ),
      ),
      'auto_speed' => array(
        'label'           => esc_html__( 'Automatic Animation Speed (in ms)', 'divi-bodyshop-woocommerce' ),
        'type'            => 'text',
        'option_category' => 'configuration',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'      => 'general',
        'default'         => '7000',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked')),
        'show_if'         => array('auto' => 'on'),
        'description'     => esc_html__( "Here you can designate how fast the slider fades between each slide, if 'Automatic Animation' option is enabled above. The higher the number the longer the pause between each rotation.", 'divi-bodyshop-woocommerce' ),
      ),
      'enable_fade' => array(
        'label'           => esc_html__( 'Enable Fade', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => esc_html__( 'Off', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'On', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'on',
        'affects' => array(
          'css_ease',
        ),
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'general',
        'description'       => esc_html__( 'If you do not want to enable image fade, enable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'css_ease' => array(
        'label'           => esc_html__( 'CSS Ease', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'linear' => esc_html__( 'Linear', 'divi-bodyshop-woocommerce' ),
          'ease'  => esc_html__( 'Ease', 'divi-bodyshop-woocommerce' ),
          'ease-in'  => esc_html__( 'Ease In', 'divi-bodyshop-woocommerce' ),
          'ease-out'  => esc_html__( 'Ease Out', 'divi-bodyshop-woocommerce' ),
          'ease-in-out'  => esc_html__( 'Ease In Out', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'linear',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'general',
        'description'       => esc_html__( 'If you want to add an image fade transition, enable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'main_image_height' => array(
        'label'           => __( 'Adaptive image height', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => __( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => __( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'default' => 'on',
        'toggle_slug'         => 'slider_settings',
        'sub_toggle'    => 'general',
        'description'       => __( 'The main image gets set a certain height - set to "yes" to be auto for this not to be a set height.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      // Arrows & Dots 
      'enable_arrows' => array(
        'label'           => esc_html__( 'Show Arrows', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'false' => esc_html__( 'Disable', 'divi-bodyshop-woocommerce' ),
          'true'  => esc_html__( 'Enable', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'true',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'arrows_dots',
        'description'       => esc_html__( 'If you do not want the arrows, disable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'arrow_location' => array(
        'label'           => esc_html__( 'Slider Arrow Postion on Desktop', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'thumbnails' => esc_html__( 'Thumbnails', 'divi-bodyshop-woocommerce' ),
          'main'  => esc_html__( 'Main Image', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'thumbnails',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'arrows_dots',
        'description'       => esc_html__( 'If you are using the vertical or horizontal slider, choose where you want the arrows to be.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked', 'simple'))
      ),
      'use_icon' => array(
        'label'           => esc_html__( 'Custom Arrows Icon?', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'    => 'arrows_dots',
        'description' => esc_html__( 'Customise the custom gallery slider icons here.', 'divi-bodyshop-woocommerce' ),
        'default_on_front'=> 'off',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'font_icon' => array(
        'label'               => esc_html__( 'Previous Icon', 'divi-bodyshop-woocommerce' ),
        'type'                => 'select_icon',
        'option_category'     => 'configuration',
        'class'               => array( 'et-pb-font-icon' ),
        'description'         => esc_html__( 'Choose the previous icon', 'divi-bodyshop-woocommerce' ),
        'toggle_slug'         => 'slider_settings',
        'sub_toggle'          => 'arrows_dots',
        'show_if_not'         => array('gallery_style' => array('default', 'expandable', 'stacked')),
        'show_if'             => array('use_icon' => 'on')
      ),
      'font_icon_next' => array(
        'label'               => esc_html__( 'Next Icon', 'divi-bodyshop-woocommerce' ),
        'type'                => 'select_icon',
        'option_category'     => 'configuration',
        'class'               => array( 'et-pb-font-icon' ),
        'toggle_slug'         => 'slider_settings',
        'sub_toggle'          => 'arrows_dots',
        'description'         => esc_html__( 'Choose the next icon.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'         => array('gallery_style' => array('default', 'expandable', 'stacked')),
        'show_if'             => array('use_icon' => 'on')
      ),
      'enable_dots' => array(
        'label'           => esc_html__( 'Show Dots', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'false' => esc_html__( 'Disable', 'divi-bodyshop-woocommerce' ),
          'true'  => esc_html__( 'Enable', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         => 'true',
        'toggle_slug'     => 'slider_settings',
        'sub_toggle'      => 'arrows_dots',
        'description'     => esc_html__( 'If you do not want the dots, disable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      // Slider Design Settings 
      'slider_margin_top'   => array(
        'label'             => esc_html__( 'Slider Top Space', 'divi-bodyshop-woocommerce' ),
        'type'              => 'range',
        'option_category'   => 'configuration',
        'tab_slug'          => 'advanced',
        'toggle_slug'       => 'custom_slider',
        'description'       => esc_html__( 'Choose how far from the top you want the icon', 'divi-bodyshop-woocommerce' ),
        'default'           => '0px',
        'default_unit'      => 'px',
        'default_on_front'  => '',
        'range_settings'    => array(
          'min'  => '0',
          'max'  => '500',
          'step' => '1',
        ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'slider_margin_right' => array(
        'label'           => esc_html__( 'Slider Right Space', 'divi-bodyshop-woocommerce' ),
        'type'            => 'range',
        'option_category' => 'configuration',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'custom_slider',
        'description'       => esc_html__( 'Choose how far from the top you want the icon', 'divi-bodyshop-woocommerce' ),
        'default'         => '0px',
        'default_unit'    => 'px',
        'default_on_front'=> '',
        'range_settings' => array(
          'min'  => '0',
          'max'  => '500',
          'step' => '1',
        ),
        'depends_show_if' => 'vertical',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      // Slider Arrow/Dots Design Settings
      'icon_color' => array(
        'default'           => '#2ea3f2',
        'label'             => esc_html__( 'Previous Icon Color', 'divi-bodyshop-woocommerce' ),
        'type'              => 'color-alpha',
        'option_category'     => 'configuration',
        'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'divi-bodyshop-woocommerce' ),
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'arrows_adv',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'icon_font_size' => array(
        'label'           => esc_html__( 'Previous Icon Font Size', 'divi-bodyshop-woocommerce' ),
        'type'            => 'range',
        'option_category' => 'configuration',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'arrows_adv',
        'default'         => '56px',
        'default_unit'    => 'px',
        'default_on_front'=> '',
        'range_settings' => array(
          'min'  => '1',
          'max'  => '120',
          'step' => '1',
        ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'icon_font_top' => array(
        'label'           => esc_html__( 'Previous Icon Top', 'divi-bodyshop-woocommerce' ),
        'type'            => 'range',
        'option_category' => 'configuration',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'arrows_adv',
        'description'       => esc_html__( 'Choose how far from the top you want the icon', 'divi-bodyshop-woocommerce' ),
        'default'         => '0px',
        'default_unit'    => 'px',
        'default_on_front'=> '',
        'range_settings' => array(
          'min'  => '0',
          'max'  => '500',
          'step' => '1',
        ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'icon_color_next' => array(
        'default'           => '#2ea3f2',
        'label'             => esc_html__( 'Next Icon Color', 'divi-bodyshop-woocommerce' ),
        'type'              => 'color-alpha',
        'option_category'     => 'configuration',
        'description'       => esc_html__( 'Here you can define a custom color for your icon.', 'divi-bodyshop-woocommerce' ),
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'arrows_adv',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'icon_font_size_next' => array(
        'label'           => esc_html__( 'Next Icon Font Size', 'divi-bodyshop-woocommerce' ),
        'type'            => 'range',
        'option_category' => 'configuration',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'arrows_adv',
        'default'         => '56px',
        'default_unit'    => 'px',
        'default_on_front'=> '',
        'range_settings' => array(
          'min'  => '1',
          'max'  => '120',
          'step' => '1',
        ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'icon_font_top_next' => array(
        'label'           => esc_html__( 'Next Icon Top', 'divi-bodyshop-woocommerce' ),
        'type'            => 'range',
        'option_category' => 'configuration',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'arrows_adv',
        'description'       => esc_html__( 'Choose how far from the top you want the icon', 'divi-bodyshop-woocommerce' ),
        'default'         => '0px',
        'default_unit'    => 'px',
        'default_on_front'=> '',
        'range_settings' => array(
          'min'  => '0',
          'max'  => '500',
          'step' => '1',
        ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      // setting to adjust position of the dots from the top
      'dots_position_bottom' => array(
        'label'           => esc_html__( 'Dots Position from Bottom', 'divi-bodyshop-woocommerce' ),
        'type'            => 'range',
        'option_category' => 'configuration',
        'default'         => '-25',
        'default_unit'    => 'px',
        'default_on_front'=> '-25',
        'range_settings'  => array(
          'min'  => '-500',
          'max'  => '500',
          'step' => '1',
        ),
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'dots_adv',
        'description'       => esc_html__( 'Adjust the position of the dots from the top.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'dots_color' => array(
        'label'           => esc_html__( 'Custom navigation dots size', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'dots_adv',
        'affects'         => array(
          'active_color',
          'deactive_color',
          'dots_size',
        ),
        'description' => esc_html__( 'Customise the custom gallery slider icons here.', 'divi-bodyshop-woocommerce' ),
        'default_on_front'=> 'off',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'active_color' => array(
        'default'           => '#000000',
        'label'             => esc_html__( 'Active dot color', 'divi-bodyshop-woocommerce' ),
        'type'              => 'color-alpha',
        'option_category'     => 'configuration',
        'description'       => esc_html__( 'Change the color of the active dot.', 'divi-bodyshop-woocommerce' ),
        'depends_show_if'   => 'on',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'dots_adv',
      ),
      'deactive_color' => array(
        'default'           => '#ececec',
        'label'             => esc_html__( 'Deactive dot color', 'divi-bodyshop-woocommerce' ),
        'type'              => 'color-alpha',
        'option_category'     => 'configuration',
        'description'       => esc_html__( 'Change the color of the deactive dot.', 'divi-bodyshop-woocommerce' ),
        'depends_show_if'   => 'on',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'dots_adv',
      ),
      'dots_size' => array(
        'label'           => esc_html__( 'Dot size', 'divi-bodyshop-woocommerce' ),
        'type'            => 'range',
        'option_category' => 'configuration',
        'tab_slug'         => 'advanced',
        'toggle_slug'     => 'dots_adv',
        'default'         => '20px',
        'default_unit'    => 'px',
        'default_on_front'=> '',
        'range_settings' => array(
          'min'  => '1',
          'max'  => '120',
          'step' => '1',
        ),
        'depends_show_if' => 'on',
      ),
      //       'custom_image' => array(
      //         'label'           => esc_html__( 'Custom Image shown/slide', 'divi-bodyshop-woocommerce' ),
      //         'type'            => 'yes_no_button',
      //         'option_category' => 'configuration',
      //         'options'         => array(
      //           'off' => esc_html__( 'No', 'divi-bodyshop-woocommerce' ),
      //           'on'  => esc_html__( 'Yes', 'divi-bodyshop-woocommerce' ),
      //         ),
      //         'toggle_slug'     => 'slider_settings',
      //         'affects'         => array(
      //           'posts_number_desktop',
      // 'posts_number_desktop_slide',
      // 'posts_number_tablet',
      // 'posts_number_slide_tablet',
      // 'posts_number_tablet_land',
      // 'posts_number_slide_tablet_land',
      // 'posts_number_mobile',
      // 'posts_number_slide_mobile',
      //         ),
      //         'description' => esc_html__( 'Change the number of images shown and the number of them that slide.', 'divi-bodyshop-woocommerce' ),
      //         'default_on_front'=> 'off',
      //       ),
      //
      //       'posts_number_desktop' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Desktop Images Number in view', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      //             'posts_number_desktop_slide' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Desktop Images Number to Slide', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      //             'posts_number_tablet' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Tablet Portrait Images Number in view', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      //             'posts_number_slide_tablet' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Tablet Portrait Images Number to Slide', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      //             'posts_number_tablet_land' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Tablet Landscape Images Number in view', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      //             'posts_number_slide_tablet_land' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Tablet Landscape Images Number to Slide', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      //             'posts_number_mobile' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Mobile Images Number in view', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      //             'posts_number_slide_mobile' => array(
      //               'default'           => 1,
      //               'label'             => esc_html__( 'Mobile Images Number to Slide', 'divi-bodyshop-woocommerce' ),
      //               'type'              => 'text',
      //               'option_category'   => 'configuration',
      //               'description'       => esc_html__( 'Define the number of images that should be displayed per page.', 'divi-bodyshop-woocommerce' ),
      //               'toggle_slug'       => 'slider_settings',
      //             ),
      'hide_thumbnails' => array(
        'label'           => __( 'Hide Thumbnails?', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => __( 'No', 'divi-bodyshop-woocommerce' ),
          'on'  => __( 'Yes', 'divi-bodyshop-woocommerce' ),
        ),
        'toggle_slug' => 'slider_thumb_settings',
        'show_if'     => array('gallery_style' => array('default', 'expandable', 'stacked')),
        'description'       => __( 'If you would like to hide the thumbnails then select Yes', 'divi-bodyshop-woocommerce' ),
      ),
      'enable_thumb_mobile' => array(
        'label'           => esc_html__( 'Enable on Mobile?', 'divi-bodyshop-woocommerce' ),
        'type'            => 'yes_no_button',
        'option_category' => 'configuration',
        'options'         => array(
          'off' => esc_html__( 'Off', 'divi-bodyshop-woocommerce' ),
          'on'  => esc_html__( 'On', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'off',
        'toggle_slug'     => 'slider_thumb_settings',
        'description'       => esc_html__( 'If you want to enable the thumbnails on mobile, enable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'thumb_image_size' => array(
        'label'           => esc_html__( 'Thumbnail Image Size', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'default' => esc_html__( 'Default', 'divi-bodyshop-woocommerce' ),
          'full-size'  => esc_html__( 'Full Size', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'default',
        'toggle_slug'     => 'slider_thumb_settings',
        'description'       => esc_html__( 'Choose the size of image you want to serve for your thumbnails, if you are having issues with them looking blury, enable full size.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'thumb_slides_show' => array(
        'default'           => 1,
        'label'             => esc_html__( 'Slides to show', 'divi-bodyshop-woocommerce' ),
        'type'              => 'text',
        'option_category'   => 'configuration',
        'default'         	=> '3',
        'description'       => esc_html__( 'Define the number of thumbnails you want to show in one go.', 'divi-bodyshop-woocommerce' ),
        'toggle_slug'       => 'slider_thumb_settings',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'thumb_slides_scroll' => array(
        'default'           => 1,
        'label'             => esc_html__( 'Slides to scroll', 'divi-bodyshop-woocommerce' ),
        'type'              => 'text',
        'option_category'   => 'configuration',
        'default'         	=> '1',
        'description'       => esc_html__( 'Define how many you want to scroll.', 'divi-bodyshop-woocommerce' ),
        'toggle_slug'       => 'slider_thumb_settings',
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'center_mode' => array(
        'label'           => esc_html__( 'Center Thumbnails', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'false' => esc_html__( 'Disable', 'divi-bodyshop-woocommerce' ),
          'true'  => esc_html__( 'Enable', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'true',
        'toggle_slug'     => 'slider_thumb_settings',
        'description'       => esc_html__( 'If you want to center the thumnails, enable this. Disable if you want the thumbnails to fit edge to edge.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ), 
      'enable_arrow_mob' => array(
        'label'           => esc_html__( 'Show Arrows', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'false' => esc_html__( 'Disable', 'divi-bodyshop-woocommerce' ),
          'true'  => esc_html__( 'Enable', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'true',
        'toggle_slug'     => 'slider_thumb_settings',
        'description'       => esc_html__( 'If you do not want the arrows, disable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'enable_dots_mob' => array(
        'label'           => esc_html__( 'Show Dots', 'divi-bodyshop-woocommerce' ),
        'type'            => 'select',
        'option_category' => 'configuration',
        'options'         => array(
          'false' => esc_html__( 'Disable', 'divi-bodyshop-woocommerce' ),
          'true'  => esc_html__( 'Enable', 'divi-bodyshop-woocommerce' ),
        ),
        'default'         	=> 'false',
        'toggle_slug'     => 'slider_thumb_settings',
        'description'       => esc_html__( 'If you do not want the dots, disable this.', 'divi-bodyshop-woocommerce' ),
        'show_if_not'     => array('gallery_style' => array('default', 'expandable', 'stacked'))
      ),
      'admin_label' => array(
        'label'       => __( 'Admin Label', 'divi-bodyshop-woocommerce' ),
        'type'        => 'text',
        'toggle_slug'     => 'main_content',
        'description' => __( 'This will change the label of the module in the builder for easy identification.', 'divi-bodyshop-woocommerce' ),
      ),
      '__getprogallery' => array(
        'type' => 'computed',
        'computed_callback' => array( 'db_images_code', 'get_pro_gallery' ),
        'computed_depends_on' => array(
          'gallery_style'
        ),
      ),
    );
    
    return $fields;
  }

  public static function get_pro_gallery( $args = array(), $conditional_tags = array(), $current_page = array() ){
    if (!is_admin()) {
      return;
    }
    ob_start();

    echo "Only VB";

    /* $args = array(
      'post_type' => 'product',
      'post_status' => 'publish',
      'posts_per_page' => '3',
      'orderby' => 'ID',
      'order' => 'ASC',
    );

    $loop = new WP_Query( $args );

    $first = true;
    while ( $loop->have_posts() ) : $loop->the_post();

      if ( $first )  {
        // do_action( 'woocommerce_before_single_product_summary' );
        $first = false;
      } else {

      }
    endwhile; 
    wp_reset_query(); // Remember to reset */

    $data = ob_get_clean();
    return $data;
  }

  function render( $attrs, $content, $render_slug ) {

    if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
      return;
    }

    $hide_thumbnails          = $this->props['hide_thumbnails'];
    $gallery_style            = $this->props['gallery_style'];
    $disable_featured         = !empty($this->props['disable_featured'])?$this->props['disable_featured']:'off';
    $disable_lightbox         = $this->props['disable_lightbox'];
    $disable_lightbox_sliders     = $this->props['disable_lightbox_sliders'];
    $disable_zoom_sliders     = $this->props['disable_zoom_sliders'];

    $use_icon                = $this->props['use_icon'];
    $font_icon               = $this->props['font_icon'];
    $font_icon_next          = $this->props['font_icon_next'];
    $icon_color              = $this->props['icon_color'];
    $icon_font_size          = $this->props['icon_font_size'];
    $icon_color_next         = $this->props['icon_color_next'];
    $icon_font_size_next     = $this->props['icon_font_size_next'];
    $icon_top                = $this->props['icon_font_top'];
    $icon_top_next           = $this->props['icon_font_top_next'];
    $slider_margin_top        = $this->props['slider_margin_top'];
    $slider_margin_right      = $this->props['slider_margin_right'];

    $enable_image_title_sliders           = $this->props['enable_image_title_sliders'];
    $num = mt_rand(100000,999999);

    $css_class                = $render_slug . "_" . $num;
    $infinite                 = $this->props['infinite'];
    $auto                     = $this->props['auto'];
    $auto_speed               = $this->props['auto_speed'];
    $thumb_slides_show        = $this->props['thumb_slides_show'];
    $thumb_slides_scroll      = $this->props['thumb_slides_scroll'];
    $main_image_height        = $this->props['main_image_height'];

    $enable_arrows            = $this->props['enable_arrows'];
    $arrow_location           = $this->props['arrow_location'];

    $enable_arrow_mob         = $this->props['enable_arrow_mob'] ?: "true";
    $enable_dots_mob          = $this->props['enable_dots_mob'] ?: "false";

    // if enable_arrows is false, then set both to false
    if ($enable_arrows == "false") {
      $arrow_location_main = "false";
      $arrow_location_thumb = "false";
    } else {
      if ($arrow_location == "main") {
        $arrow_location_main = "true";
        $arrow_location_thumb = "false";
      } else {
        $arrow_location_main = "false";
        $arrow_location_thumb = "true";
      }
    }

    $enable_dots          = $this->props['enable_dots'];
    $enable_fade          = $this->props['enable_fade'];
    $css_ease             = $this->props['css_ease'];
    $center_mode          = $this->props['center_mode'];


    $active_color         = $this->props['active_color'];
    $deactive_color       = $this->props['deactive_color'];
    $dots_size            = $this->props['dots_size'];

    $dots_position_bottom          = $this->props['dots_position_bottom'];
    $main_image_size         = $this->props['main_image_size'];
    $thumb_image_size         = $this->props['thumb_image_size'];
    $enable_thumb_mobile         = $this->props['enable_thumb_mobile'];

    // Module classnames
    $this->add_classname(
      array(
        'clearfix',
        $this->get_text_orientation_classname(),
      )
    );

    if ($enable_fade == "on") {
      $enable_fade = "true";
    } else {
      $enable_fade = "false";
    }
    
    $main_image_height_dis = "";

    if ($main_image_height == "on") {
      $this->add_classname( 'adaptive_height' );
    } else {
      if ($gallery_style !== "vertical"){
        $main_image_height_dis = ".slick-list {height: 100%!important;};";
        $this->add_classname( 'slide_same_height' ); 
      }
    }

    global $db_woo_li_image_size, $db_woo_li_thumbnail_size, $db_woo_li_thumbnail_cols;
    global $product, $woocommerce, $post;

    if ( !$product ){
      return;
    }

    if ( $font_icon != "" ) {
      $font_icon_arr = explode('||', $font_icon);
      $font_icon_font_family = ( !empty( $font_icon_arr[1] ) && $font_icon_arr[1] == 'fa' )?'FontAwesome':'ETmodules';
      $font_icon_font_weight = ( !empty( $font_icon_arr[2] ))?$font_icon_arr[2]:'400';
      $font_icon_dis = preg_replace( '/(&amp;#x)|;/', '', et_pb_process_font_icon( $font_icon ) );
      $font_icon_dis = preg_replace( '/(&#x)|;/', '', $font_icon_dis );
    } else {
      $font_icon_font_family = 'ETmodules';
      $font_icon_font_weight = '400';
    }

    if ( $font_icon_next != "" ) {
      $next_icon_arr = explode('||', $font_icon_next);
      $next_icon_font_family = ( !empty( $next_icon_arr[1] ) && $next_icon_arr[1] == 'fa' )?'FontAwesome':'ETmodules';
      $next_icon_font_weight = ( !empty( $next_icon_arr[2] ))?$next_icon_arr[2]:'400';
      $font_icon_next_dis = preg_replace( '/(&amp;#x)|;/', '', et_pb_process_font_icon( $font_icon_next ) );
      $font_icon_next_dis = preg_replace( '/(&#x)|;/', '', $font_icon_next_dis );
    } else {
      $next_icon_font_family = 'ETmodules';
      $next_icon_font_weight = '400';
    }

    $db_woo_li_thumbnail_cols_css = 'inherit';

    if ($hide_thumbnails == 'on') {
      remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
      $db_woo_li_thumbnail_cols_css = '';
    } else {

    }

    if( $infinite == 'on' && 'on' === $auto ) {
      $autoslide = "autoplay: true,";
      $autoislidespeed = "autoplaySpeed: ".$auto_speed.",";
    }
    else {
      $autoslide = "autoplay: false,";
      $autoislidespeed = "autoplaySpeed: 7000,";
    }

    $infinite_setting = ( 'on' === $infinite )?"true":"false";

    if( $disable_lightbox == 'on' ){

      ET_Builder_Element::set_style( $render_slug, array(
        'selector'    => '%%order_class%% .woocommerce-product-gallery__trigger',
        'declaration' => 'display:none !important;',
      ) );
    }

    if( $enable_image_title_sliders == 'on' ){
      ET_Builder_Element::set_style( $render_slug, array(
        'selector'    => '%%order_class%% .thumb-title',
        'declaration' => 'display:block !important;',
      ) );
    }

    if ($enable_thumb_mobile == "off") {
      ET_Builder_Element::set_style( $render_slug, array(
        'selector'    => '%%order_class%% .bc-horizontal-slider-nav,%%order_class%% .bc-vertical-slider-nav',
        'declaration' => 'display:none !important;',
        'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
      ) );
    }

    if ( $gallery_style == "horizontal" ) {
      ET_Builder_Element::set_style( $render_slug, array(
        'selector'    => '%%order_class%% .bc-horizontal-slider-nav',
        'declaration' => 'margin-top:' . $slider_margin_top . ' !important;',
      ) );
    }

    if ( $gallery_style == "vertical" ) {
      ET_Builder_Element::set_style( $render_slug, array(
        'selector'    => '%%order_class%% .bc-vertical-slider-nav',
        'declaration' => 'padding-right:' . $slider_margin_right . ' !important;',
      ) );
    }

    if ( $gallery_style == "vertical" ) {
      $this->add_classname( 'bc-vertical-slider' );
    }

    //////////////////////////////////////////////////////////////////////
    
    ob_start();
    if ($use_icon == "on") {

      if ( $font_icon != "" ) {
        $content_prev =  sprintf('<style>.et_pb_db_images .slick-prev::before {content:"\%1s" !important;font-size:%2s;color:%3s;top:%4s;font-family:%5$s!important;font-weight:%6$s;}</style>',$font_icon_dis, $icon_font_size, $icon_color, $icon_top, $font_icon_font_family, $font_icon_font_weight);    
      } else {
        $content_prev =  sprintf('<style>.et_pb_db_images .slick-prev::before {font-size:%1s;color:%2s;top:%3s;font-family:%4$s!important;font-weight:%5$s;}</style>', $icon_font_size, $icon_color, $icon_top, $font_icon_font_family, $font_icon_font_weight);
      }

      if ( $font_icon_next != "" ) {
        $content_next =  sprintf('<style>.et_pb_db_images .slick-next::before {content:"\%1s" !important;font-size:%2s;color:%3s;top:%4s;font-family:%5$s!important;font-weight:%6$s;}</style>',$font_icon_next_dis, $icon_font_size_next, $icon_color_next, $icon_top_next, $next_icon_font_family, $next_icon_font_weight );    
      } else {
        $content_next =  sprintf('<style>.et_pb_db_images .slick-next::before {font-size:%1s;color:%2s;top:%3s;font-family:%4$s!important;font-weight:%5$s;}</style>', $icon_font_size_next, $icon_color_next, $icon_top_next, $next_icon_font_family, $next_icon_font_weight );
      }

      echo $content_prev;
      echo $content_next;
    }

    echo '<style>'.$main_image_height_dis.'body .slick-dots li button {background: '. $deactive_color .' !important;width: '. $dots_size .';height: '. $dots_size .';}body .slick-dots li.slick-active button {background: '. $active_color .' !important;}.woocommerce #content div.product div.images, .woocommerce div.product div.images, .woocommerce-page #content div.product div.images, .woocommerce-page div.product div.images { width: 100% !important; }.woocommerce div.product div.images .woocommerce-main-image img { width: inherit !important; }' . ($db_woo_li_thumbnail_cols && $db_woo_li_thumbnail_cols_css ? '.woocommerce #content div.product div.thumbnails a, .woocommerce div.product div.thumbnails a, .woocommerce-page #content div.product div.thumbnails a, .woocommerce-page div.product div.thumbnails a, .woocommerce div.product div.images .woocommerce-product-gallery__image:nth-child(n+2) { width: ' . $db_woo_li_thumbnail_cols_css . ' !important; }':'') . '</style>';

    // if gallery_style does not equal default, expandable or stacked 
    // add the css for dots from the top - $dots_position_bottom
    if ($gallery_style != "default" && $gallery_style != "expandable" && $gallery_style != "stacked") {
      // set_style for dots from the top
      ET_Builder_Element::set_style( $render_slug, array(
        'selector'    => '%%order_class%% .slick-dots',
        'declaration' => 'bottom: ' . $dots_position_bottom . ' !important;',
      ) );
    }

    if ($gallery_style == "default"){
      if ( is_product() ) {
        wc_get_template( 'single-product/sale-flash.php' );
        wc_get_template( 'single-product/product-image.php' );
      } else {
        wc_get_template( 'loop/sale-flash.php' );
        wc_get_template( 'single-product/product-image.php' );
      }
    } else if ($gallery_style == "horizontal" || $gallery_style == "single"){

      $attachment_ids = $product->get_gallery_image_ids();
      $rtl_slick = 'rtl: false';
      $rtl_atr = '';

      if (is_rtl()) {
        $enable_fade = 'false';
        $rtl_slick = 'rtl: true';
        $rtl_atr = 'dir="rtl"';

        ET_Builder_Element::set_style( $render_slug, array(
          'selector'    => '%%order_class%% .bc-simple-slider',
          'declaration' => 'direction: ltr;',
        ) );

        ET_Builder_Element::set_style( $render_slug, array(
          'selector'    => '%%order_class%% .bc-simple-slider+.bc-horizontal-slider-nav',
          'declaration' => 'display: none !important;',
        ) );    

        ET_Builder_Element::set_style( $render_slug, array(
          'selector'    => '%%order_class%% .slick-prev',
          'declaration' => 'left: 0;',
        ) );                                         
      }

      // if on product single page - wc_get_template( 'single-product/sale-flash.php' ), else loop flash
      if ( is_product() ) {
        wc_get_template( 'single-product/sale-flash.php' );
      } else {
        wc_get_template( 'loop/sale-flash.php' );
      }
      

      $this->add_classname( 'bc-custom-slider' );
      wp_enqueue_script( 'bodycommerce-product-gallery', plugins_url() . '/divi-bodycommerce/js/product-gallery.min.js', array('jquery'), DE_DB_WOO_VERSION, true );

      $make_slider = false;
      if ( ( $disable_featured == 'on' && count($attachment_ids) > 0 ) || ( $disable_featured != 'on' && has_post_thumbnail() ) ) {
        $make_slider = true;
      }

      if ( $make_slider ) {

        if ( $disable_featured == 'off' ) {
          $post_thumbnail_id = $product->get_image_id();

          if ($main_image_size == "default") {
            $image         = wp_get_attachment_image($post_thumbnail_id, 'shop_single', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
          } else {
            $image         = wp_get_attachment_image($post_thumbnail_id, 'full', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
          }
        } else {
          // get first image from $attachment_ids
          $post_thumbnail_id = $attachment_ids[0];
          if ($main_image_size == "default") {
            $image         = wp_get_attachment_image($post_thumbnail_id, 'shop_single', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
          } else {
            $image         = wp_get_attachment_image($post_thumbnail_id, 'full', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
          }
        }

        $wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
          'debodycommerce',
          'debodycommerce--' . (has_post_thumbnail() ? 'with-images' : 'without-images'),
          'images',
        ));
    ?>
    <div class="<?php echo $css_class ?>">
    <?php 
        if ($disable_zoom_sliders == "off") {
          $css_mag= "magnify";
        } else {
          $css_mag = "";
        }
        
        if ($disable_lightbox_sliders == "off") {
          $css_lightbox = "venobox ".$css_mag."";
    ?>
      <span href="#" class="woocommerce-product-gallery__trigger"></span>
    <?php
        } else {
          $css_lightbox = "no-venobox ".$css_mag."";
        }
        
        if ($gallery_style == "horizontal") { 
    ?>
      <div <?php echo $rtl_atr ?> class="bc-horizontal-slider-for <?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>">
    <?php 
        } else if ($gallery_style == "single") { 
    ?>
      <div class="bc-simple-slider <?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>">
    <?php 
        }

        $lightbox_src = wc_get_product_attachment_props($post_thumbnail_id);
        $title = get_post($post_thumbnail_id)->post_title;
        $featured_img_url = wp_get_attachment_image_src($post_thumbnail_id, 'full');
    ?>
        <div class="woocommerce-product-gallery__image single-product-main-image">
          <a class="<?php echo $css_lightbox;?>"  title="<?php echo $lightbox_src['title'];?>" data-gall="debodycommerce-lightbox" href="<?php echo $lightbox_src['url'];?>">
    <?php
        if( isset($featured_img_url[0]) ){
          echo '<div class="large" style="background-image: url('. $featured_img_url[0] .');background-repeat:no-repeat"></div>';
        }

        echo $image;
        
        if ($disable_zoom_sliders == "off") { 
    ?>
        <img src="<?php echo $featured_img_url[0] ?>" class="imagezoom">
    <?php
        }
    ?>
          </a>
          <p class="thumb-title" style="padding-bottom: 30px;display:none;"><?php echo esc_html ($title); ?></p>
        </div>
    <?php

        if ($attachment_ids) {
          foreach ($attachment_ids as $attachment_id) {
            if ( $attachment_id == $post_thumbnail_id ) {
              continue;
            }

            if ($main_image_size == "default") {
              $thumbnail_image     = wp_get_attachment_image($attachment_id, 'shop_single');
            } else {
              $thumbnail_image     = wp_get_attachment_image($attachment_id, 'full');
            }

            $lightbox_src = wc_get_product_attachment_props($attachment_id);
            $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
            $attachment_title = get_the_title($attachment_id);
    ?>
        <div class="bodycommerce-slider-cont">
          <a class="<?php echo $css_lightbox;?>" data-gall="debodycommerce-lightbox" title="<?php echo $lightbox_src['title'];?>" href="<?php echo $lightbox_src['url'];?>">
    <?php
            if( isset($full_size_image[0]) ){
              echo  '<div class="large" style="background-image: url('. $full_size_image[0] .');background-repeat:no-repeat"></div>';
            }
            echo  $thumbnail_image;
    ?>
    <?php 
            if ($disable_zoom_sliders == "off") { 
    ?>
            <img src="<?php echo $full_size_image[0] ?>" class="imagezoom">
    <?php
            }
    ?>
          </a>
          <p class="thumb-title" style="padding-bottom: 30px;display:none;"><?php echo esc_html ($attachment_title); ?></p>
        </div>
    <?php
          }
        }
    ?>
      </div>
    <?php
        $gallery_thumbnail = wc_get_image_size('gallery_thumbnail');

        if ( $make_slider ) { 
    ?>
      <div <?php echo $rtl_atr ?> class="bc-horizontal-slider-nav">
    <?php
          if ($thumb_image_size == "default") {
            $image         = wp_get_attachment_image($post_thumbnail_id, 'shop_thumbnail',true);
          } else {
            $image         = wp_get_attachment_image($post_thumbnail_id, 'full',true);
          }
    ?>
        <div><?php echo $image;?></div>
    <?php
          foreach ( $attachment_ids as $attachment_id ) {
            if ( $attachment_id == $post_thumbnail_id ) {
              continue;
            }
            if ($thumb_image_size == "default") {
              $thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));
              $thumbnail_image     = wp_get_attachment_image($attachment_id, $thumbnail_size);
            } else {
              $thumbnail_image     = wp_get_attachment_image($attachment_id, 'full',true);
            }
    ?>
        <div><?php echo $thumbnail_image;?></div>
    <?php
          } 
    ?>
      </div>
    <?php 
        } 
    ?>
    </div>
    <?php
      }
                                   
      if ($gallery_style == "horizontal") { 
    ?>
      <script>
        jQuery(document).ready(function( $ ) {
          $(".no-venobox").click(function( event ) {
            event.preventDefault();
          });

          $('.<?php echo $css_class ?> .bc-horizontal-slider-for').slick({
            adaptiveHeight: <?php echo ($main_image_height =='on')? 'true' : 'false'; ?>,
    <?php 
          echo $autoslide; 
          echo $autoislidespeed;
    ?>
            slidesToShow: 1,
            slidesToScroll: 1,
            <?php echo $rtl_slick ?>,
            fade: <?php echo $enable_fade ?>,
            cssEase: '<?php echo $css_ease ?>',
            asNavFor: '.<?php echo $css_class ?> .bc-horizontal-slider-nav',
            draggable: true,
            arrows: <?php echo $arrow_location_main ?>,
            centerMode: true,
            responsive: [{
              breakpoint: 980,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: <?php echo $infinite_setting;?> ,
    <?php 
        if ($enable_thumb_mobile == "off") { 
    ?>
                arrows: <?php echo $enable_arrow_mob ?>,
                dots:  <?php echo $enable_dots_mob ?>,
    <?php 
        } 
    ?>
              }
            }]
          });

          $('.<?php echo $css_class ?> .bc-horizontal-slider-nav').slick({
            slidesToShow: <?php echo $thumb_slides_show ?>,
            infinite: <?php echo $infinite_setting;?>,
            asNavFor: '.<?php echo $css_class ?> .bc-horizontal-slider-for',
            slidesToScroll:  <?php echo $thumb_slides_scroll ?>,
            dots:  <?php echo $enable_dots ?>,
            <?php echo $rtl_slick ?>,
            centerMode: <?php echo $center_mode ?>,
            arrows: <?php echo $arrow_location_thumb ?>,
            focusOnSelect: true,
            draggable: true,
          });
        });
      </script>
    <?php 
      } else if ($gallery_style == "single") { 
    ?>
      <script>
        jQuery(document).ready(function( $ ) {$(".no-venobox").click(function( event ) {event.preventDefault();});$('.<?php echo $css_class ?> .bc-simple-slider').slick({adaptiveHeight: <?php echo ($main_image_height =='on')? 'true' : 'false'; ?>,<?php echo $autoslide;echo $autoislidespeed;?>slidesToShow: 1,slidesToScroll: 1,fade: <?php echo $enable_fade ?>,cssEase: '<?php echo $css_ease ?>',asNavFor: '.<?php echo $css_class ?> .bc-horizontal-slider-nav',draggable: true,arrows: <?php echo $enable_arrows ?>,dots:  <?php echo $enable_dots ?>,responsive: [{breakpoint: 980,settings: {slidesToShow: 1,slidesToScroll: 1,infinite: <?php echo $infinite_setting;?>,arrows: <?php echo $enable_arrows ?>,dots:  <?php echo $enable_dots ?>,asNavFor: null}}]});$('.<?php echo $css_class ?> .bc-horizontal-slider-nav').slick({dots: false,slidesToShow: <?php echo $thumb_slides_show ?>,infinite: <?php echo $infinite_setting;?> ,slidesToScroll:  <?php echo $thumb_slides_scroll ?>,asNavFor: '.<?php echo $css_class ?> .bc-simple-slider',dots:  false,centerMode: <?php echo $center_mode ?>,focusOnSelect: true,draggable: true,});});
      </script>
    <?php 
      }
    } else if ($gallery_style == "vertical"){
      $rtl_slick = 'rtl: false';
      $rtl_atr = '';
      if (is_rtl()) {
        $enable_fade = 'false';
        $rtl_slick = 'rtl: true';
        $rtl_atr = 'dir="rtl"';

        ET_Builder_Element::set_style( $render_slug, array(
          'selector'    => '%%order_class%% .slick-prev',
          'declaration' => 'left: 0;',
        ));
      }
      
      if ( is_product() ) {
        wc_get_template( 'single-product/sale-flash.php' );
      } else {
        wc_get_template( 'loop/sale-flash.php' );
      }
      $this->add_classname( 'bc-custom-slider' );
      wp_enqueue_script( 'bodycommerce-product-gallery', plugins_url() . '/divi-bodycommerce/js/product-gallery.min.js', array('jquery'), DE_DB_WOO_VERSION, true );

      global $post, $woocommerce, $product;
      $attachment_ids = $product->get_gallery_image_ids();

      $make_slider = false;
      if ( ( $disable_featured == 'on' && count($attachment_ids) > 0 ) || ( $disable_featured != 'on' && has_post_thumbnail() ) ) {
        $make_slider = true;
      }

      if ( $disable_featured == 'off' ) {
        $post_thumbnail_id = $product->get_image_id();

        if ($main_image_size == "default") {
          $image         = wp_get_attachment_image($post_thumbnail_id, 'shop_single', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
        } else {
          $image         = wp_get_attachment_image($post_thumbnail_id, 'full', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
        }
      } else {
        // get first image from $attachment_ids
        $post_thumbnail_id = $attachment_ids[0];
        if ($main_image_size == "default") {
          $image         = wp_get_attachment_image($post_thumbnail_id, 'shop_single', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
        } else {
          $image         = wp_get_attachment_image($post_thumbnail_id, 'full', true,array( "class" => "attachment-shop_single size-shop_single wp-post-image first-gallery-image" ));
        }
      }

      if ( $make_slider ) {
        $lightbox_src = wc_get_product_attachment_props($post_thumbnail_id);

        $wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
          'debodycommerce',
          'debodycommerce--' . (has_post_thumbnail() ? 'with-images' : 'without-images'),
          'images',
        ));
    ?>
    <div class="<?php echo $css_class ?>">
    <?php 
        if ($disable_zoom_sliders == "off") {
          $css_mag= "magnify";
        } else {
          $css_mag = "";
        }

        if ($disable_lightbox_sliders == "off") {
          $css_lightbox = "venobox ".$css_mag."";
    ?>
      <span href="#" class="woocommerce-product-gallery__trigger"></span>
    <?php
        } else {
          $css_lightbox = "no-venobox ".$css_mag."";
        }
    ?>
      <div class="bc-vertical-wrapper">
        <div <?php echo $rtl_atr ?> class="bc-vertical-slider-for <?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>" style="height: 400px;">
    <?php
        $title = get_post($post_thumbnail_id)->post_title;
        $featured_img_url = wp_get_attachment_image_src($post_thumbnail_id, 'full');

    ?>
          <div class="woocommerce-product-gallery__image single-product-main-image">
            <a class="<?php echo $css_lightbox;?>"  title="<?php echo $lightbox_src['title'];?>" data-gall="debodycommerce-lightbox" href="<?php echo $lightbox_src['url'];?>">
    <?php
        if( isset($featured_img_url[0]) ){
          echo  '<div class="large" style="background-image: url('. $featured_img_url[0] .');background-repeat:no-repeat"></div>';
        }
        echo $image;
        
        if ($disable_zoom_sliders == "off") { 
    ?>
              <img src="<?php echo $featured_img_url[0] ?>" class="imagezoom">
    <?php
        }
    ?>
            </a>
            <p class="thumb-title" style="padding-bottom: 30px;display:none;"><?php echo esc_html ($title); ?></p>
          </div>
    <?php
        
        if ($attachment_ids) {
          foreach ($attachment_ids as $attachment_id) {
            if ( $attachment_id == $post_thumbnail_id ) {
              continue;
            }
            if ($main_image_size == "default") {
              $thumbnail_image     = wp_get_attachment_image($attachment_id, 'shop_single');
            } else {
              $thumbnail_image     = wp_get_attachment_image($attachment_id, 'full');
            }

            $lightbox_src = wc_get_product_attachment_props($attachment_id);
            $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
            $attachment_title = get_the_title($attachment_id);
            // fw_print($thumbnail_src);
    ?>
          <div class="bodycommerce-slider-cont">
            <a class="<?php echo $css_lightbox;?>" data-gall="debodycommerce-lightbox" title="<?php echo $lightbox_src['title'];?>" href="<?php echo $lightbox_src['url'];?>">
    <?php
            if( isset($full_size_image[0]) ){
    ?>
              <div class="large" style="background-image: url(<?php echo $full_size_image[0];?>);background-repeat:no-repeat"></div>
    <?php
            }
            echo  $thumbnail_image;
            
            if ($disable_zoom_sliders == "off") { 
    ?>
              <img src="<?php echo $full_size_image[0] ?>" class="imagezoom">
    <?php
            }
    ?>
            </a>
            <p class="thumb-title" style="padding-bottom: 30px;display:none;"><?php echo esc_html ($attachment_title); ?></p>
          </div>
    <?php
          }
        }
    ?>
        </div>
    <?php
        $gallery_thumbnail = wc_get_image_size('gallery_thumbnail');

        if ( $make_slider ) {
    ?>
        <div <?php echo $rtl_atr ?> class="bc-vertical-slider-nav">
    <?php
          if ($thumb_image_size == "default") {
            $image = wp_get_attachment_image($post_thumbnail_id, 'shop_thumbnail',true);
          } else {
            $image = wp_get_attachment_image($post_thumbnail_id, 'full',true, ["class" => "attachment-shop_thumbnail size-shop_thumbnail"]);
          }
    ?>
          <div><?php echo $image;?></div>
    <?php 
	        foreach ( $attachment_ids as $attachment_id ) {
            if ( $attachment_id == $post_thumbnail_id ) {
              continue;
            }
            if ($thumb_image_size == "default") {
              $thumbnail_size    = apply_filters('woocommerce_gallery_thumbnail_size', array($gallery_thumbnail['width'], $gallery_thumbnail['height']));
              $thumbnail_image     = wp_get_attachment_image($attachment_id, $thumbnail_size);
            } else {
              $thumbnail_image     = wp_get_attachment_image($attachment_id, 'full',true);
            }
    ?>
          <div><?php echo $thumbnail_image;?></div>
    <?php
	        } 
    ?>
        </div>
    <?php 
        }
    ?>
      </div>
    </div>
    <?php
      }
    ?>
    <style>@media only screen and (max-width: 980px) {
    body .bc-vertical-slider-for .slick-next:before,
    body .bc-vertical-slider-for .slick-prev:before {
        transform: rotate(-90deg);
        bottom: auto !important;
    }
    body .bc-vertical-slider-for .slick-prev {
        height: 50% !important;
        width: 50% !important;
        left: 0 !important;
        top: 50% !important;
        transform: translate(0,-50%) !important;
    }
    body .bc-vertical-slider-for .slick-next {
        height: 50% !important;
        width: 50% !important;
        left: auto !important;
        transform: translate(0,-50%) !important;
        top: 50% !important;
        right: 0 !important;
    }
}
.bc-vertical-slider-for {
    height: auto !important;
}
</style>
    <script>
    jQuery(document).ready(function( $ ) {
      $(".no-venobox").click(function( event ) {
        event.preventDefault();
      });
      $('.<?php echo $css_class ?> .bc-vertical-slider-for').slick({
    <?php 
        echo $autoslide; 
        echo $autoislidespeed;
    ?>
        slidesToShow: 1,
        slidesToScroll: 1,
    <?php echo $rtl_slick ?>,
        fade: <?php echo $enable_fade ?>,
        cssEase: '<?php echo $css_ease ?>',
        asNavFor: '.<?php echo $css_class ?> .bc-vertical-slider-nav',
        draggable: true,
        arrows: <?php echo $arrow_location_main ?>,
        responsive: [{
          breakpoint: 980,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: <?php echo $infinite_setting;?> ,
        <?php if ($enable_thumb_mobile == "off") { ?>
            arrows: <?php echo $enable_arrow_mob ?>,
            dots:  <?php echo $enable_dots_mob ?>,
        <?php } ?>
          }
        }]
      });
      $('.<?php echo $css_class ?> .bc-vertical-slider-nav').slick({
        slidesToShow: <?php echo $thumb_slides_show ?>,
        infinite: <?php echo $infinite_setting;?>,
        slidesToScroll:  <?php echo $thumb_slides_scroll ?>,
        asNavFor: '.<?php echo $css_class ?> .bc-vertical-slider-for',
        dots:  <?php echo $enable_dots ?>,
    <?php echo $rtl_slick ?>,
        centerMode: <?php echo $center_mode ?>,
        arrows: <?php echo $arrow_location_thumb ?>,
        focusOnSelect: true,
        vertical: true,
        draggable: true,
      });
      $('.single-product-main-image a').attr('data-o_srcset', $('.single-product-main-image img').attr('srcset'));
      $('.<?php echo $css_class ?> .bc-vertical-slider-nav .slick-slide').eq(0).click(function(){$('.single-product-main-image img').attr('src', $('.single-product-main-image a').attr('data-o_href'));$('.single-product-main-image img').attr('srcset', $('.single-product-main-image a').attr('data-o_srcset'));});
      var image_height = $(".<?php echo $css_class ?> .bc-vertical-slider-for.slick-initialized.slick-slider .slick-slide img").height();$( ".<?php echo $css_class ?> .bc-vertical-slider-nav" ).attr('style',  'height:' + image_height + "px !important;");$( ".<?php echo $css_class ?> .slick-slide img" ).click(function() {setTimeout(function(){var image_height = $(".<?php echo $css_class ?> .bc-vertical-slider-for.slick-initialized.slick-slider .slick-slide.slick-current.slick-active img").height();$( ".<?php echo $css_class ?> .bc-vertical-slider-nav" ).attr('style',  'height:' + image_height + "px !important;");}, 200);});
      $( window ).resize(function() {var image_height = $(".<?php echo $css_class ?> .bc-vertical-slider-for.slick-initialized.slick-slider .slick-slide.slick-current.slick-active img").height();$( ".<?php echo $css_class ?> .bc-vertical-slider-nav" ).attr('style',  'height:' + image_height + "px !important;");});});

    </script>
    <?php
    } else if($gallery_style == 'stacked'){
      $this->add_classname( 'bc-stacked-gallery' );
      if($disable_featured == 'off'){
        if ( has_post_thumbnail( $product->id ) ) {
          $image_links[0] = get_post_thumbnail_id( $product->id );
          $gallery_array = wp_get_attachment_image_src($image_links[0], 'full' );
          $gallery = $gallery_array[0];
          echo "<img src='$gallery' />";
        }
      }
      $image_links = $product->get_gallery_attachment_ids();
      if(count($image_links) > 0){
        foreach( $image_links as $attachment_id ) {
          $image_link = wp_get_attachment_url( $attachment_id );
          echo "<img src='{$image_link}' />";
        }
      }
    } else if ($gallery_style == "expandable"){

      wp_enqueue_script( 'bodycommerce-product-gallery', plugins_url() . '/divi-bodycommerce/js/product-gallery.min.js', array('jquery'), DE_DB_WOO_VERSION, true );
      // if ($overlay_icon == ""){
      //
      // }
      // else {
      //   echo esc_attr( et_pb_process_font_icon( $overlay_icon ) );
      //   $output = sprintf( '.bc-expandable-slider .et_overlay:before {content:"\%s";}', esc_attr( et_pb_process_font_icon( $overlay_icon ) ) );
      // echo '<style>
      // '.$output.'
      // </style>';
      // }
    ?>
    <section class="bc-expandable-single-item">
      <div class="bc-expandable-slider-wrapper">
        <ul class="bc-expandable-slider">
    <?php
      global $post, $woocommerce, $product;

      $attachment_ids = $product->get_gallery_image_ids();

      $make_slider = false;
      if ( ( $disable_featured == 'on' && count($attachment_ids) > 0 ) || ( $disable_featured != 'on' && has_post_thumbnail() ) ) {
        $make_slider = true;
      }

      if ( $make_slider ) {
        if ( $disable_featured == 'off' ) {
          $featured_img_url = get_the_post_thumbnail_url($post->ID, 'full');
          $thumb_id = get_post_thumbnail_id(get_the_ID());
          $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
    ?>
          <li class="selected"><img src="<?php echo $featured_img_url;?>" alt="<?php echo $alt; ?>"><span class="et_overlay"></span></li>
    <?php
        }
        
        if ( $attachment_ids && has_post_thumbnail() ) {
          $selected = 'selected';
          foreach ( $attachment_ids as $attachment_id ) {
            if ( $disable_featured == 'off' ) {
              $selected = '';
            }
            $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
            $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    ?>
          <li class="<?php echo $selected;?>"><img src="<?php echo $full_size_image[0]; ?>" alt="<?php echo $alt_text; ?>"><span class="et_overlay"></span></li>
    <?php
            if ( $disable_featured == 'on' && $selected == 'selected' ) {
              $selected = '';
            }
          }
        }
      }
    ?>
        </ul> <!-- bc-expandable-slider -->
        <ul class="bc-expandable-slider-navigation">
          <li><a href="#0" class="bc-expandable-prev inactive">Next</a></li>
          <li><a href="#0" class="bc-expandable-next">Prev</a></li>
        </ul> <!-- bc-expandable-slider-navigation -->
        <a href="#0" class="bc-expandable-close">Close</a>
      </div> <!-- bc-expandable-slider-wrapper -->
    </section> <!-- bc-expandable-single-item -->
    <?php
    } else {
      do_action( 'woocommerce_before_single_product_summary' );
      echo "</div>";
    }

    $data = ob_get_clean();
    //////////////////////////////////////////////////////////////////////

    return $data;
  }
}

new db_images_code;

?>
