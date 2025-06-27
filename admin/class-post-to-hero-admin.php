<?php
/**
 * Admin Class
 *
 * @package PostToHero
 * @since   1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin functionality class
 */
class PostToHeroAdmin {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_filter('plugin_action_links_' . POST_TO_HERO_PLUGIN_FILE, array($this, 'add_plugin_action_links'));
    }
    
    /**
     * Add admin menu
     */
    public function add_admin_menu() {
        add_options_page(
            __('Post to Hero Settings', 'post-to-hero'),
            __('Post to Hero', 'post-to-hero'),
            'manage_options',
            'post-to-hero-settings',
            array($this, 'admin_page')
        );
    }
    
    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('post_to_hero_settings', 'post_to_hero_options');
    }
    
    /**
     * Add Settings link to plugin action links
     *
     * @param array $links The existing plugin action links.
     * @return array Modified plugin action links.
     */
    public function add_plugin_action_links($links) {
        $settings_link = '<a href="' . admin_url('admin.php?page=post-to-hero-settings') . '">' . __('Settings', 'post-to-hero') . '</a>';
        array_unshift($links, $settings_link);
        return $links;
    }
    
    /**
     * Get translated text based on WordPress locale
     */
    private function get_text($key) {
        $locale = get_locale();
        
        $translations = array(
            'es_ES' => array(
                'settings_title' => 'Configuraci�n de Post to Hero',
                'how_to_use' => 'C�mo Usar',
                'shortcode_label' => 'Shortcode:',
                'shortcode_desc' => 'Usa este shortcode en cualquier p�gina o entrada:',
                'shortcode_params' => 'Par�metros del Shortcode:',
                'category_param' => 'Nombre de categor�a para obtener la �ltima entrada (opcional si se especifica post_id)',
                'post_id_param' => 'ID espec�fico de entrada para destacar (opcional, tiene prioridad sobre category)',
                'button_text_param' => 'Texto del bot�n (por defecto: "Ver Entrevista")',
                'button_url_param' => 'URL del bot�n (por defecto: enlace permanente de la entrada)',
                'badge_text_param' => 'Texto de la etiqueta (por defecto: "En Vivo")',
                'examples_title' => 'Ejemplos:',
                'example_category' => 'Usando categor�a (�ltima entrada):',
                'example_post_id' => 'Usando ID de entrada espec�fico:',
                'example_custom_url' => 'Usando entrada espec�fica con URL personalizada:',
                'css_classes' => 'Clases CSS Disponibles:',
                'css_desc' => 'Puedes personalizar la apariencia usando estas clases CSS:',
                'main_container' => 'Contenedor principal',
                'category_badge' => 'Etiqueta de categor�a',
                'main_title' => 'T�tulo principal',
                'subtitle' => 'Subt�tulo/nombre',
                'description' => 'Texto de descripci�n',
                'cta_button' => 'Bot�n CTA',
                'live_badge' => 'Etiqueta en vivo/estado'
            ),
            'en_US' => array(
                'settings_title' => 'Post to Hero Settings',
                'how_to_use' => 'How to Use',
                'shortcode_label' => 'Shortcode:',
                'shortcode_desc' => 'Use this shortcode in any page or post:',
                'shortcode_params' => 'Shortcode Parameters:',
                'category_param' => 'Category name to get the latest post from (optional if post_id is specified)',
                'post_id_param' => 'Specific post ID to feature (optional, takes priority over category)',
                'button_text_param' => 'Button text (default: "Ver Entrevista")',
                'button_url_param' => 'Button URL (default: post permalink)',
                'badge_text_param' => 'Badge text (default: "En Vivo")',
                'examples_title' => 'Examples:',
                'example_category' => 'Using category (latest post):',
                'example_post_id' => 'Using specific post ID:',
                'example_custom_url' => 'Using specific post with custom button URL:',
                'css_classes' => 'CSS Classes Available:',
                'css_desc' => 'You can customize the appearance by targeting these CSS classes:',
                'main_container' => 'Main container',
                'category_badge' => 'Category badge',
                'main_title' => 'Main title',
                'subtitle' => 'Subtitle/name',
                'description' => 'Description text',
                'cta_button' => 'CTA button',
                'live_badge' => 'Live/status badge'
            ),
            'fr_FR' => array(
                'settings_title' => 'Param�tres de Post to Hero',
                'how_to_use' => 'Comment Utiliser',
                'shortcode_label' => 'Shortcode:',
                'shortcode_desc' => 'Utilisez ce shortcode dans n\'importe quelle page ou article:',
                'shortcode_params' => 'Param�tres du Shortcode:',
                'category_param' => 'Nom de cat�gorie pour obtenir le dernier article (optionnel si post_id est sp�cifi�)',
                'post_id_param' => 'ID d\'article sp�cifique � mettre en avant (optionnel, priorit� sur category)',
                'button_text_param' => 'Texte du bouton (par d�faut: "Ver Entrevista")',
                'button_url_param' => 'URL du bouton (par d�faut: permalien de l\'article)',
                'badge_text_param' => 'Texte du badge (par d�faut: "En Vivo")',
                'examples_title' => 'Exemples:',
                'example_category' => 'Utilisant la cat�gorie (dernier article):',
                'example_post_id' => 'Utilisant un ID d\'article sp�cifique:',
                'example_custom_url' => 'Utilisant un article sp�cifique avec URL personnalis�e:',
                'css_classes' => 'Classes CSS Disponibles:',
                'css_desc' => 'Vous pouvez personnaliser l\'apparence en ciblant ces classes CSS:',
                'main_container' => 'Conteneur principal',
                'category_badge' => 'Badge de cat�gorie',
                'main_title' => 'Titre principal',
                'subtitle' => 'Sous-titre/nom',
                'description' => 'Texte de description',
                'cta_button' => 'Bouton CTA',
                'live_badge' => 'Badge en direct/statut'
            )
        );
        
        // Default to Spanish if locale not found
        $current_locale = isset($translations[$locale]) ? $locale : 'es_ES';
        
        return isset($translations[$current_locale][$key]) ? $translations[$current_locale][$key] : $key;
    }
    
    /**
     * Admin page
     */
    public function admin_page() {
        ?>
        <div class="wrap">
            <h1><?php echo esc_html($this->get_text('settings_title')); ?></h1>
            
            <div style="background: white; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h2><?php echo esc_html($this->get_text('how_to_use')); ?></h2>
                <p><strong><?php echo esc_html($this->get_text('shortcode_label')); ?></strong> <?php echo esc_html($this->get_text('shortcode_desc')); ?></p>
                <code>[post_to_hero]</code>
                
                <h3><?php echo esc_html($this->get_text('shortcode_params')); ?></h3>
                <ul>
                    <li><code>category</code> - <?php echo esc_html($this->get_text('category_param')); ?></li>
                    <li><code>post_id</code> - <?php echo esc_html($this->get_text('post_id_param')); ?></li>
                    <li><code>button_text</code> - <?php echo esc_html($this->get_text('button_text_param')); ?></li>
                    <li><code>button_url</code> - <?php echo esc_html($this->get_text('button_url_param')); ?></li>
                    <li><code>badge_text</code> - <?php echo esc_html($this->get_text('badge_text_param')); ?></li>
                </ul>
                
                <h3><?php echo esc_html($this->get_text('examples_title')); ?></h3>
                <p><strong><?php echo esc_html($this->get_text('example_category')); ?></strong></p>
                <code>[post_to_hero category="entrevistas" button_text="Ver Ahora"]</code>
                
                <p><strong><?php echo esc_html($this->get_text('example_post_id')); ?></strong></p>
                <code>[post_to_hero post_id="123" button_text="Ver Entrevista"]</code>
                
                <p><strong><?php echo esc_html($this->get_text('example_custom_url')); ?></strong></p>
                <code>[post_to_hero post_id="123" button_text="Ver Ahora" button_url="/custom-page"]</code>
                
                <h3><?php echo esc_html($this->get_text('css_classes')); ?></h3>
                <p><?php echo esc_html($this->get_text('css_desc')); ?></p>
                <ul>
                    <li><code>.post-to-hero</code> - <?php echo esc_html($this->get_text('main_container')); ?></li>
                    <li><code>.hero-category</code> - <?php echo esc_html($this->get_text('category_badge')); ?></li>
                    <li><code>.title-main</code> - <?php echo esc_html($this->get_text('main_title')); ?></li>
                    <li><code>.hero-subtitle</code> - <?php echo esc_html($this->get_text('subtitle')); ?></li>
                    <li><code>.hero-description</code> - <?php echo esc_html($this->get_text('description')); ?></li>
                    <li><code>.hero-button</code> - <?php echo esc_html($this->get_text('cta_button')); ?></li>
                    <li><code>.interview-badge</code> - <?php echo esc_html($this->get_text('live_badge')); ?></li>
                </ul>
            </div>
        </div>
        <?php
    }
}
