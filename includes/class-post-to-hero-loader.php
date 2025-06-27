<?php
/**
 * Plugin Loader Class
 *
 * @package PostToHero
 * @since   1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Main Plugin Loader Class
 */
class PostToHeroLoader {
    
    /**
     * Plugin version
     */
    const VERSION = '1.0.0';
    
    /**
     * Plugin slug
     */
    const PLUGIN_SLUG = 'post-to-hero';
    
    /**
     * Plugin text domain
     */
    const TEXT_DOMAIN = 'post-to-hero';
    
    /**
     * The single instance of the class
     */
    protected static $_instance = null;
    
    /**
     * Admin instance
     */
    public $admin;
    
    /**
     * Public instance
     */
    public $public;
    
    /**
     * Main Instance
     * Ensures only one instance of PostToHeroLoader is loaded or can be loaded.
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }
    
    /**
     * Define plugin constants
     */
    private function define_constants() {
        define('POST_TO_HERO_VERSION', self::VERSION);
        define('POST_TO_HERO_PLUGIN_FILE', plugin_basename(__DIR__ . '/../post-hero.php'));
        define('POST_TO_HERO_PLUGIN_URL', plugin_dir_url(__DIR__ . '/../post-hero.php'));
        define('POST_TO_HERO_PLUGIN_PATH', plugin_dir_path(__DIR__ . '/../post-hero.php'));
    }
    
    /**
     * Include required files
     */
    public function includes() {
        // Include admin files
        if (is_admin()) {
            require_once POST_TO_HERO_PLUGIN_PATH . 'admin/class-post-to-hero-admin.php';
        }
        
        // Include public files
        require_once POST_TO_HERO_PLUGIN_PATH . 'public/class-post-to-hero-public.php';
        require_once POST_TO_HERO_PLUGIN_PATH . 'includes/class-post-to-hero-shortcode.php';
    }
    
    /**
     * Hook into actions and filters
     */
    private function init_hooks() {
        add_action('init', array($this, 'init'), 0);
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
        
        // Plugin activation/deactivation hooks
        register_activation_hook(POST_TO_HERO_PLUGIN_FILE, array($this, 'activate'));
        register_deactivation_hook(POST_TO_HERO_PLUGIN_FILE, array($this, 'deactivate'));
    }
    
    /**
     * Initialize the plugin
     */
    public function init() {
        // Initialize admin
        if (is_admin()) {
            $this->admin = new PostToHeroAdmin();
        }
        
        // Initialize public
        $this->public = new PostToHeroPublic();
        
        // Initialize shortcode
        new PostToHeroShortcode();
    }
    
    /**
     * Load plugin text domain
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain(
            self::TEXT_DOMAIN,
            false,
            dirname(POST_TO_HERO_PLUGIN_FILE) . '/languages'
        );
    }
    
    /**
     * Plugin activation
     */
    public function activate() {
        flush_rewrite_rules();
    }
    
    /**
     * Plugin deactivation
     */
    public function deactivate() {
        flush_rewrite_rules();
    }
    
    /**
     * Get plugin URL
     */
    public function plugin_url() {
        return POST_TO_HERO_PLUGIN_URL;
    }
    
    /**
     * Get plugin path
     */
    public function plugin_path() {
        return POST_TO_HERO_PLUGIN_PATH;
    }
}
