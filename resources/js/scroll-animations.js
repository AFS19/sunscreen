// Scroll-triggered animations using Intersection Observer

class ScrollAnimations {
    constructor() {
        this.observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.1
        };
        
        this.init();
    }
    
    init() {
        // Create observer
        this.observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    // Optionally unobserve after animation
                    // this.observer.unobserve(entry.target);
                }
            });
        }, this.observerOptions);
        
        // Observe all animated elements
        this.observeElements();
    }
    
    observeElements() {
        const selectors = [
            '.animate-on-scroll',
            '.animate-stagger',
            '.animate-scale'
        ];
        
        selectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(el => {
                this.observer.observe(el);
            });
        });
    }
    
    // Refresh observer (call after dynamic content loads)
    refresh() {
        this.observeElements();
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.scrollAnimations = new ScrollAnimations();
});

export default ScrollAnimations;
