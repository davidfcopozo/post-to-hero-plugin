<?php
/**
 * Public Class
 *
 * @package PostToHero
 * @since   1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Public functionality class
 */
class PostToHeroPublic {
    
    /**
     * Constructor
     */
    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
    }
    
    /**
     * Enqueue CSS and JS
     */
    public function enqueue_assets() {
        // Enqueue the CSS
        wp_enqueue_style(
            'post-to-hero-css',
            POST_TO_HERO_PLUGIN_URL . 'assets/post-to-hero.css',
            array(),
            POST_TO_HERO_VERSION
        );
        
        // Add inline CSS
        $this->add_inline_css();
    }
    
    /**
     * Add inline CSS (post to hero styles)
     */
    public function add_inline_css() {
        $css = $this->get_hero_styles();
        wp_add_inline_style('post-to-hero-css', $css);
    }
    
    /**
     * Get hero styles
     */
    private function get_hero_styles() {
        return '
        /****** Estilos hero ******/
.post-to-hero {
    position: relative;
    min-height: 100vh;
    width: 100vw; 
    display: flex;
    align-items: center;
    overflow: hidden;
    font-family: "Arial", sans-serif;
    margin: 0;
    padding: 0; 
}

/* Wavy Animation Background */
.wave-container {
    position: absolute;
    left: 55%;
    bottom: -10%;
    width: 100vw;
    height: 100%;
    transition: 0.5s;
    z-index: 0;
    max-width: unset !important;
}

.wave-container span {
    content: "";
    position: absolute;
    width: 325vh;
    height: 325vh;
    bottom: 0;
    left: 50%;
    transform: translate(-50%, 75%);
}

.wave-container span:nth-child(1) {
    border-radius: 45%;
    background: rgba(45, 27, 61, 0.8);
    animation: waveRotate 8s linear infinite;
}

.wave-container span:nth-child(2) {
    border-radius: 40%;
    background: rgba(69, 183, 209, 0.4);
    animation: waveRotate 12s linear infinite reverse;
}

.wave-container span:nth-child(3) {
    border-radius: 42.5%;
    background: rgba(78, 205, 196, 0.3);
    animation: waveRotate 16s linear infinite;
}

/* Background Elements */
.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100%;
    z-index: 5;
    pointer-events: none;
}

.bg-gradient {
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw; 
    height: 100%;
    background: linear-gradient(
        135deg,
        rgba(255, 255, 255, 0.1) 0%,
        rgba(255, 255, 255, 0.05) 50%,
        transparent 100%
    );
}

.bg-shape {
    position: absolute;
    border-radius: 50%;
    opacity: 0.6;
}

/* Container */
.hero-container {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

/* Left Content */
.hero-content {
    padding-right: 2rem;
}

.hero-category {
    display: none;
    font-size: 0.875rem;
    font-weight: 600;
    color: #8b5a8c;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
    opacity: 0.8;
}

.hero-title {
    margin: 0 0 2rem 0; 
    line-height: 1.2;
}

.title-main {
    display: block;
    font-size: clamp(3.5rem, 4.5vw, 5.5rem) !important;
    font-weight: 700; 
    color: #2d1b3d;
    margin-bottom: 0.25rem;
    letter-spacing: -0.01em;
    line-height: 1.1; 
}

.hero-excerpt {
    font-size: clamp(1rem, 1.25vw, 1.25rem);
    line-height: 1.7;
    color: #4a4458;
    margin: 0 0 2rem 0;
    max-width: 90%;
    font-weight: 400;
    letter-spacing: 0.01em;
    opacity: 0.9;
    text-shadow: 1px 1px 1px rgba(255,255,255,0.3);
}

.hero-button {
    display: inline-flex;
    align-items: center;
    background: var(--ast-global-color-0, #2d1b3d);
    color: #ffffff;
    padding: 14px 30px;
    text-decoration: none;
    font-family: "Mulish", sans-serif;
    font-weight: 700;
    font-size: 0.9375rem;
    line-height: 1em;
    letter-spacing: 0.1em;
    text-transform: capitalize;
    border: 2px solid var(--ast-global-color-0, #2d1b3d);
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.hero-button::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.hero-button:hover::before {
    left: 100%;
}

.hero-button:hover {
    background: #3d2b4d;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(45, 27, 61, 0.3);
}

/* Right Image */
.hero-image {
    position: relative;
    height: 100vh;
    max-height: 600px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.image-container {
    position: relative;
    width: 100%;
    height: 80%;
    border-radius: 50% 50% 20% 50%;
    overflow: hidden;
    padding: 3px;
    background: linear-gradient(145deg, #f0c4d8, #6369D1);
}

.image-container::before {
    content: "";
    position: absolute;
    top: -50%;
    right: -20%;
    width: 115%;
    height: 150%;
    border-radius: 50%;
    z-index: -1;
    filter: blur(20px);
}

.hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50% 50% 20% 50%;
    filter: contrast(1.1) saturate(1.1);
}

/* Copyright */
.hero-copyright {
    display: none;
    position: absolute;
    bottom: 2rem;
    left: 2rem;
    z-index: 3;
}

.hero-copyright p {
    font-size: 0.75rem;
    color: rgba(45, 27, 61, 0.6);
    font-weight: 400;
    letter-spacing: 0.05em;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-container {
        grid-template-columns: 1fr;
        gap: 0;
        padding: 0;
        min-height: 100vh;
        position: relative;
    }
    
    .hero-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 4;
        padding: 2rem;
        background: linear-gradient(
            to top,
            rgba(0, 0, 0, 0.8) 0%,
            rgba(0, 0, 0, 0.6) 50%,
            rgba(0, 0, 0, 0.3) 80%,
            transparent 100%
        );
        color: white;
        border-radius: 0;
    }
    
    .hero-content .hero-category {
        color: #f0c4d8;
        opacity: 1;
    }
    
    .hero-content .title-main {
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
	
	.hero-excerpt {
        color: rgba(255,255,255,0.9);
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        max-width: 100%;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
    }
    
    .hero-content .hero-button {
        background: rgba(255, 255, 255, 0.9);
        color: #2d1b3d;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
    }
    
    .hero-content .hero-button:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }
    
    .hero-image {
        position: relative;
        width: 100%;
        height: 100vh;
        order: 1;
    }
    
    .image-container {
        width: 100%;
        height: 100%;
        border-radius: 0;
        padding: 0;
        background: none;
    }
    
    .image-container::before {
        display: none;
    }
    
    .hero-image img {
        border-radius: 0;
        filter: contrast(1.1) saturate(1.2);
        object-position: center top;
    }
    
    .hero-copyright {
        position: absolute;
        top: 2rem;
        right: 2rem;
        z-index: 4;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        backdrop-filter: blur(10px);
    }
    
    .hero-copyright p {
        color: rgba(255, 255, 255, 0.8);
    }
}

@media (max-width: 768px) {
    .post-to-hero {
        min-height: 100vh;
    }
    
    .hero-content {
        padding: 1.5rem;
    }
    
    .hero-category {
        font-size: 0.8rem;
        margin-bottom: 1rem;
    }
    
    .hero-title {
        margin-bottom: 1.25rem;
    }
    
    .title-main {
        font-size: clamp(1.5rem, 4vw, 2.2rem) !important;
        line-height: 1.1;
    }
	
	.hero-excerpt {
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 1.25rem;
    }
       
    .hero-button {
        padding: 1rem 2rem;
        font-size: 0.8rem;
        border-radius: 25px;
    }
    
    .hero-copyright {
        top: 1.5rem;
        right: 1.5rem;
        padding: 0.4rem 0.8rem;
    }
    
    .hero-copyright p {
        font-size: 0.65rem;
    }
}

@media (max-width: 480px) {
    .hero-content {
        padding: 1.25rem;
    }
    
    .hero-category {
        font-size: 0.75rem;
        margin-bottom: 0.75rem;
    }
    
    .hero-title {
        margin-bottom: 1rem;
    }
    
    .title-main {
        font-size: clamp(1.3rem, 5vw, 1.8rem) !important; 
        line-height: 1.1;
    }
	
	.hero-excerpt {
        font-size: 0.9375rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }
    
    .hero-button {
        padding: 0.875rem 1.5rem;
        font-size: 0.75rem;
        border-radius: 20px;
        width: 100%;
        text-align: center;
        justify-content: center;
    }
    
    .hero-copyright {
        top: 1rem;
        right: 1rem;
        padding: 0.3rem 0.6rem;
    }
    
    .hero-copyright p {
        font-size: 0.6rem;
    }
}

/* Mobile Overlay Animation */
@media (max-width: 1024px) {
    .hero-content {
        animation: slideUpFade 0.8s ease-out;
    }
	
    .hero-excerpt {
        animation: fadeIn 1s ease-out 0.3s both;
    }
    
    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 0.9;
            transform: translateY(0);
        }
    }
}

/* Dynamic Gradient Animations */
@keyframes waveRotate {
    0% {
        transform: translate(-50%, 75%) rotate(0deg);
    }
    100% {
        transform: translate(-50%, 75%) rotate(360deg);
    }
}
        ';
    }
}
