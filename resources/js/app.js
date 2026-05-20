import '../css/components/animations.css';

import HeroScene from './three/HeroScene.js';
import ThemeManager from './theme.js';
import ScrollAnimations from './scroll-animations.js';

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Three.js hero scene
    const heroCanvas = document.getElementById('hero-canvas');
    if (heroCanvas) {
        new HeroScene('hero-canvas');
    }
    
    // Initialize theme manager
    new ThemeManager();
    
    // Initialize scroll animations
    new ScrollAnimations();
});
