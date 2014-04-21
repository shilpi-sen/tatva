<?php
/**
 * tatva Theme Customizer
 *
 * @package tatva
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function tatva_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}

add_action('customize_register', 'tatva_customize_register', 12);

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function tatva_customize_preview_js() {
    wp_enqueue_script('tatva_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20130508', true);
}

add_action('customize_preview_init', 'tatva_customize_preview_js');

function tatva_customizer($wp_customize) {

    class tatva_customize_textarea_control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>

            <?php
        }

    }

    // Add new section for theme layout and color schemes
    $wp_customize->add_section('tatva_theme_layout_settings', array(
        'title' => __('Layout & Color Scheme', 'tatva'),
        'priority' => 30,
    ));

    // Add setting for theme layout
    $wp_customize->add_setting('tatva_theme_layout', array(
        'default' => 'full-width',
    ));

    $wp_customize->add_control('tatva_theme_layout', array(
        'label' => 'Theme Layout',
        'section' => 'tatva_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'full-width' => __('Full Width', 'tatva'),
            'boxed' => __('Boxed', 'tatva'),
        ),
    ));

    // Add new setting for color schemes
    $wp_customize->add_setting('tatva_color_scheme', array(
        'default' => 'red',
    ));

    $wp_customize->add_control('tatva_color_scheme', array(
        'label' => 'Color schemes',
        'section' => 'tatva_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'blue' => __('Blue', 'tatva'),
            'red' => __('Red', 'tatva'),
            'green' => __('Green', 'tatva'),
            'gray' => __('Gray', 'tatva'),
            'purple' => __('Purple', 'tatva'),
            'orange' => __('Orange', 'tatva'),
            'brown' => __('Brown', 'tatva'),
            'pink' => __('Pink', 'tatva'),
        ),
    ));

	//Add featured products on front page
    if (class_exists('Easy_Digital_Downloads')) {
        $wp_customize->add_section('tatva_edd_options', array(
            'title' => __('Easy Digital Downloads', 'tatva'),
            'description' => __('All other EDD options are under Dashboard => Downloads.', 'tatva'),
            'priority' => 70,
        ));

        // enable featured products on front page?
        $wp_customize->add_setting('tatva_edd_front_featured_products', array('default' => 0));
        $wp_customize->add_control('tatva_edd_front_featured_products', array(
            'label' => __('Show featured products on Front Page', 'tatva'),
            'section' => 'tatva_edd_options',
            'priority' => 10,
            'type' => 'checkbox',
        ));

        // store front/archive item count
        $wp_customize->add_setting('tatva_store_front_featured_count', array('default' => 6));
        $wp_customize->add_control('tatva_store_front_featured_count', array(
            'label' => __('Number of Featured Products', 'tatva'),
            'section' => 'tatva_edd_options',
            'settings' => 'tatva_store_front_featured_count',
            'priority' => 20,
        ));

        // store front/downloads archive headline
        $wp_customize->add_setting('tatva_edd_store_archives_title', array('default' => null));
        $wp_customize->add_control('tatva_edd_store_archives_title', array(
            'label' => __('Store/Download Archives Main Title', 'tatva'),
            'section' => 'tatva_edd_options',
            'settings' => 'tatva_edd_store_archives_title',
            'priority' => 30,
        ));
        // store front/downloads archive description
        $wp_customize->add_setting('tatva_edd_store_archives_description', array('default' => null));
        $wp_customize->add_control(new tatva_customize_textarea_control($wp_customize, 'tatva_edd_store_archives_description', array(
            'label' => __('Store/Download Archives Description', 'tatva'),
            'section' => 'tatva_edd_options',
            'settings' => 'tatva_edd_store_archives_description',
            'priority' => 40,
        )));
        // read more link
        $wp_customize->add_setting('tatva_product_view_details', array('default' => __('View Details', 'tatva')));
        $wp_customize->add_control('tatva_product_view_details', array(
            'label' => __('Store Link', 'tatva'),
            'section' => 'tatva_edd_options',
            'settings' => 'tatva_product_view_details',
            'priority' => 50,
        ));
        // store front/archive item count
        $wp_customize->add_setting('tatva_store_front_count', array('default' => 9));
        $wp_customize->add_control('tatva_store_front_count', array(
            'label' => __('Store Item Count', 'tatva'),
            'section' => 'tatva_edd_options',
            'settings' => 'tatva_store_front_count',
            'priority' => 60,
        ));
    }


    // Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('tatva_front_page_post_options', array(
        'title' => __('Front Page Featured Posts', 'tatva'),
        'description' => __('Settings for displaying featured posts on Front Page', 'tatva'),
        'priority' => 60,
    ));
    // enable featured posts on front page?
    $wp_customize->add_setting('tatva_front_featured_posts_check', array('default' => 0));
    $wp_customize->add_control('tatva_front_featured_posts_check', array(
        'label' => __('Show featured posts on Front Page', 'tatva'),
        'section' => 'tatva_front_page_post_options',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    // Front featured posts section headline
    $wp_customize->add_setting('tatva_front_featured_posts_title', array('default' => __('Latest Posts', 'tatva')));
    $wp_customize->add_control('tatva_front_featured_posts_title', array(
        'label' => __('Featured Section Title', 'tatva'),
        'section' => 'tatva_front_page_post_options',
        'settings' => 'tatva_front_featured_posts_title',
        'priority' => 10,
    ));

    // select number of posts for featured posts on front page
    $wp_customize->add_setting('tatva_front_featured_posts_count', array('default' => 3));
    $wp_customize->add_control('tatva_front_featured_posts_count', array(
        'label' => __('Number of posts to display', 'tatva'),
        'section' => 'tatva_front_page_post_options',
        'settings' => 'tatva_front_featured_posts_count',
        'priority' => 20,
    ));


    // featured post read more link
    $wp_customize->add_setting('tatva_front_featured_link_text', array('default' => __('Read more', 'tatva')));
    $wp_customize->add_control('tatva_front_featured_link_text', array(
        'label' => __('Posts Read More Link Text', 'tatva'),
        'section' => 'tatva_front_page_post_options',
        'settings' => 'tatva_front_featured_link_text',
        'priority' => 30,
    ));

    // Add footer text section
    $wp_customize->add_section('tatva_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 70,
    ));

    $wp_customize->add_setting('tatva_footer_footer_text', array(
        'default' => '',
    ));
    $wp_customize->add_control(new tatva_customize_textarea_control($wp_customize, 'tatva_footer_footer_text', array(
        'section' => 'tatva_footer', // id of section to which the setting belongs
        'settings' => 'tatva_footer_footer_text',
    )));

    
    // Add custom CSS section
    $wp_customize->add_section('tatva_custom_css', array(
        'title' => 'Custom CSS', // The title of section
        'priority' => 80,
    ));
    
    $wp_customize->add_setting('tatva_custom_css');
    
    $wp_customize->add_control(new tatva_customize_textarea_control($wp_customize, 'tatva_custom_css', array(
        'section' => 'tatva_custom_css', // id of section to which the setting belongs
        'settings' => 'tatva_custom_css', 
    )));
    
    //remove default customizer sections
    $wp_customize->remove_section('background_image'); 
    $wp_customize->remove_section('colors');
}

add_action('customize_register', 'tatva_customizer', 11);

function tatva_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true) {
    $return = '';
    $mod = get_theme_mod($mod_name);
    if (!empty($mod)) {
        $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
        );
        if ($echo) {
            echo $return;
        }
    }
    return $return;
}

function tatva_header_output() {
    ?>
    <!--Customizer CSS--> 
    <style type="text/css">
    <?php tatva_generate_css('#site-name', 'color', 'title_textcolor', ''); ?>
    <?php tatva_generate_css('.sidebarwidget a', 'color', 'link_textcolor', ''); ?>
    <?php tatva_generate_css('.site-logo', 'display', 'name', 'none'); ?>
    <?php echo esc_attr(get_theme_mod('tatva_custom_css')); ?>
    </style> 
    <!--/Customizer CSS-->
    <?php
}

// Output custom CSS to live site
add_action('wp_head', 'tatva_header_output');
