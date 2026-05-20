// Theme toggle functionality

class ThemeManager {
    constructor() {
        this.storageKey = 'theme-preference';
        this.darkClass = 'dark';
        this.lightClass = 'light';
        
        this.init();
    }
    
    init() {
        // Get saved preference or default to dark
        const savedTheme = localStorage.getItem(this.storageKey);
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme) {
            this.setTheme(savedTheme);
        } else {
            this.setTheme('dark');
        }
        
        this.setupListeners();
    }
    
    setTheme(theme) {
        const html = document.documentElement;
        
        if (theme === 'dark') {
            html.classList.add(this.darkClass);
            html.classList.remove(this.lightClass);
        } else {
            html.classList.add(this.lightClass);
            html.classList.remove(this.darkClass);
        }
        
        localStorage.setItem(this.storageKey, theme);
        this.updateToggleIcon(theme);
    }
    
    toggle() {
        const html = document.documentElement;
        const isDark = html.classList.contains(this.darkClass);
        
        if (isDark) {
            this.setTheme('light');
        } else {
            this.setTheme('dark');
        }
    }
    
    updateToggleIcon(theme) {
        const sunIcon = document.getElementById('theme-sun');
        const moonIcon = document.getElementById('theme-moon');
        
        if (!sunIcon || !moonIcon) return;
        
        if (theme === 'dark') {
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }
    }
    
    setupListeners() {
        const toggleBtn = document.getElementById('theme-toggle');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.toggle());
        }
        
        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem(this.storageKey)) {
                this.setTheme(e.matches ? 'dark' : 'light');
            }
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.themeManager = new ThemeManager();
});

export default ThemeManager;
