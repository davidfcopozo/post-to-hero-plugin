<?php
/**
 * Shortcode Class
 *
 * @package PostToHero
 * @since   1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode functionality class
 */
class PostToHeroShortcode {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_shortcode('post_to_hero', array($this, 'post_to_hero_shortcode'));
    }
    
    /**
     * Shortcode for post to hero
     */
    public function post_to_hero_shortcode($atts) {
        $atts = shortcode_atts(array(
            'category' => '',
            'button_text' => '',
            'badge_text' => 'En Vivo',
            'button_url' => '',
            'post_id' => '',    
        ), $atts);
        
        $post = null;
        
        // If post_id is specified, use that specific post
        if (!empty($atts['post_id'])) {
            $post = get_post($atts['post_id']);
            if (!$post || $post->post_status !== 'publish') {
                return '<p>' . __('El post especificado no existe o no est� publicado', 'post-to-hero') . '</p>';
            }
        }
        // Otherwise, get latest post from category if category is specified
        elseif (!empty($atts['category'])) {
            $latest_post = get_posts(array(
                'category_name' => $atts['category'],
                'numberposts' => 1
            ));
            
            if (empty($latest_post)) {
                return '<p>' . __('No se encontraron publicaciones en esta categor�a', 'post-to-hero') . '</p>';
            }
            $post = $latest_post[0];
        }
        // If neither post_id nor category is specified
        else {
            return '<p>' . __('Por favor, especifica una categor�a o un post_id', 'post-to-hero') . '</p>';
        }
        
        return $this->render_hero($post, $atts);
    }
    
    /**
     * Render the hero section
     */
    private function render_hero($post, $atts) {
        $featured_image = get_the_post_thumbnail_url($post->ID, 'full');
        $category = get_the_category($post->ID);
        $category_name = !empty($category) ? $category[0]->name : '';
        $excerpt = get_the_excerpt($post->ID); 
        $btnText = empty($atts['button_text']) ? __("Ver Entrevista", 'post-to-hero') : $atts['button_text'];
        $badgeText = !empty($atts['badge_text']) ? $atts['badge_text'] : __('En Vivo', 'post-to-hero');
        $buttonUrl = !empty($atts['button_url']) ? $atts['button_url'] : get_permalink($post->ID);
        
        ob_start(); ?>
        <section class="post-to-hero">
            <!-- Wavy Background Animation -->
            <div class="wave-container">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Background Elements -->
            <div class="hero-background">
                <div class="bg-shape bg-shape-1"></div>
                <div class="bg-shape bg-shape-2"></div>
                <div class="bg-gradient"></div>
            </div>
            
            <!-- Content Container -->
            <div class="hero-container">
                <!-- Left Content -->
                <div class="hero-content">
                    <?php if ($category_name): ?>
                    <span class="hero-category"><?php echo esc_html($category_name); ?></span>
                    <?php endif; ?>
                    
                    <h1 class="hero-title">
                        <span class="title-main"><?php echo esc_html($post->post_title); ?></span>
                    </h1>
                    
                    <!-- Added Excerpt Here -->
                    <?php if ($excerpt): ?>
                    <p class="hero-excerpt">
                        <?php echo esc_html($excerpt); ?>
                    </p>
                    <?php endif; ?>
                    
                    <a href="<?php echo esc_url($buttonUrl); ?>" class="hero-button">
                        <span><?php echo esc_html($btnText); ?></span>
                    </a>
                </div>
                
                <!-- Right Image -->
                <?php if ($featured_image): ?>
                <div class="hero-image">
                    <div class="image-container">
                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                    </div>
                </div>
                <?php endif; ?>
            </div>
            
            <!-- Copyright -->
            <div class="hero-copyright">
                <p><?php echo sprintf(__('COPYRIGHT � %s. %s ALL RIGHTS RESERVED', 'post-to-hero'), date("Y"), '<a href="https://www.davidfrancisco.me/" target="_blank">David Francisco</a>'); ?></p>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}
