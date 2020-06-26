<?php

namespace GoodMagazineElements;

if (!defined('ABSPATH'))
    exit();

class GME_Widget_Loader {

    private static $instance = null;

    /**
     * Initialize integration hooks
     *
     * @return void
     */
    public function __construct() {
        spl_autoload_register([$this, 'autoload']);

        $this->includes();
        // Elementor hooks
        $this->add_actions();
    }

    function add_elementor_widget_categories() {

        $groups = array(
            'good-magazine-elements' => esc_html__('Good Magazine - Elements', GME_TEXT_DOMAIN)
        );

        foreach ($groups as $key => $value) {
            \Elementor\Plugin::$instance->elements_manager->add_category($key, ['title' => $value], 1);
        }
    }

    /**
     * we loaded module manager + admin php from here
     * @return [type] [description]
     */
    private function includes() {
        require GME_PATH . 'includes/module-manager.php';
    }

    /**
     * Autoload Classes
     *
     * @since 1.6.0
     */
    public function autoload($class) {
        if (0 !== strpos($class, __NAMESPACE__)) {
            return;
        }

        $has_class_alias = isset($this->classes_aliases[$class]);

        // Backward Compatibility: Save old class name for set an alias after the new class is loaded
        if ($has_class_alias) {
            $class_alias_name = $this->classes_aliases[$class];
            $class_to_load = $class_alias_name;
        } else {
            $class_to_load = $class;
        }

        if (!class_exists($class_to_load)) {

            $filename = strtolower(
                    preg_replace(
                            ['/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'], ['', '$1-$2', '-', DIRECTORY_SEPARATOR], $class_to_load
                    )
            );

            $filename = GME_PATH . $filename . '.php';
            if (is_readable($filename)) {
                include( $filename );
            }
        }

        if ($has_class_alias) {
            class_alias($class_alias_name, $class);
        }
    }

    /**
     * Add Actions
     *
     * @since 0.1.0
     *
     * @access private
     */
    public function add_actions() {
        add_action('elementor/init', [$this, 'add_elementor_widget_categories']);

        // Fires after Elementor controls are registered.
        add_action('elementor/controls/controls_registered', [$this, 'register_controls']);

        //FrontEnd Scripts
        add_action('elementor/frontend/before_register_scripts', [$this, 'register_frontend_scripts']);
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'enqueue_frontend_scripts']);

        //FrontEnd Styles
        add_action('elementor/frontend/before_register_styles', [$this, 'register_frontend_styles']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);

        //Editor Scripts
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

        //Editor Style
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_styles']);

        //Fires after Elementor preview styles are enqueued.
        add_action('elementor/preview/enqueue_styles', [$this, 'enqueue_preview_styles']);
    }

    /**
     * Register Controls
     * @since 1.0.0
     * @access public
     */
    public function register_controls() {
        require_once GME_PATH . 'includes/controls/groups/group-control-query.php';
        require_once GME_PATH . 'includes/controls/groups/group-control-header.php';

        // Register Group
        \Elementor\Plugin::instance()->controls_manager->add_group_control('good-magazine-elements-query', new Group_Control_Query());
        \Elementor\Plugin::instance()->controls_manager->add_group_control('good-magazine-elements-header', new Group_Control_Header());
    }

    /**
     * Register Frontend Scripts
     * @since 1.0.0
     * @access public
     */
    public function register_frontend_scripts() {
        
    }

    /**
     * Enqueue Frontend Scripts
     * @since 1.0.0
     * @access public
     */
    public function enqueue_frontend_scripts() {
        wp_enqueue_script('owl-carousel', GME_URL . 'assets/lib/owl-carousel/js/owl.carousel.min.js', array('jquery'), GME_VERSION, true);
        wp_enqueue_script('slick', GME_URL . 'assets/lib/slick/slick.min.js', array('jquery'), GME_VERSION, true);
        wp_enqueue_script('good-magazine-elements-frontend', GME_URL . 'assets/js/frontend.js', array('jquery'), GME_VERSION, true);
    }

    /**
     * Register Frontend Styles
     * @since 1.0.0
     * @access public
     */
    public function register_frontend_styles() {
        
    }

    /**
     * Enqueue Frontend Styles
     * @since 1.0.0
     * @access public
     */
    public function enqueue_frontend_styles() {
        wp_enqueue_style('themify-icons', GME_URL . 'assets/lib/themify-icons/themify-icons.css', array(), GME_VERSION);
        wp_enqueue_style('owl-carousel', GME_URL . 'assets/lib/owl-carousel/css/owl.carousel.min.css', array(), GME_VERSION);
        wp_enqueue_style('good-magazine-elements-frontend', GME_URL . 'assets/css/frontend.css', array(), GME_VERSION);
    }

    /**
     * Enqueue Editor Scripts
     * @since 1.0.0
     * @access public
     */
    public function enqueue_editor_scripts() {
        
    }

    /**
     * Enqueue Editor Styles
     * @since 1.0.0
     * @access public
     */
    public function enqueue_editor_styles() {
        wp_enqueue_style('good-magazine-elements-editor-style', GME_ASSETS_URL . 'css/editor-styles.css', array(), GME_VERSION);
    }

    /**
     * Preview Styles
     * @since 1.0.0
     * @access public
     */
    public function enqueue_preview_styles() {
        
    }

    /**
     * Creates and returns an instance of the class
     * @since 1.0.0
     * @access public
     * return object
     */
    public static function get_instance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}

if (!function_exists('gme_widget_loader')) {

    /**
     * Returns an instance of the plugin class.
     * @since  1.0.0
     * @return object
     */
    function gme_widget_loader() {
        return GME_Widget_Loader::get_instance();
    }

}
gme_widget_loader();
