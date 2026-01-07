/**
 * Language Switcher for Arabic/English
 * Handles RTL/LTR switching with localStorage persistence
 */

(function() {
    'use strict';

    // Default language
    const DEFAULT_LANG = 'en';
    
    // Language configuration
    const LANGUAGES = {
        en: {
            code: 'EN',
            dir: 'ltr',
            name: 'English'
        },
        ar: {
            code: 'AR',
            dir: 'rtl',
            name: 'العربية'
        }
    };

    /**
     * Get current language from localStorage or default
     */
    function getCurrentLanguage() {
        const savedLang = localStorage.getItem('site_language');
        return (savedLang && LANGUAGES[savedLang]) ? savedLang : DEFAULT_LANG;
    }

    /**
     * Set language and apply changes
     */
    function setLanguage(lang) {
        if (!LANGUAGES[lang]) {
            console.error('Invalid language:', lang);
            return;
        }

        // Save to localStorage
        localStorage.setItem('site_language', lang);

        // Apply language changes
        applyLanguage(lang);

        // Update switcher button
        updateSwitcherButton(lang);
    }

    /**
     * Apply language to document
     */
    function applyLanguage(lang) {
        const langConfig = LANGUAGES[lang];
        const html = document.documentElement;
        const body = document.body;

        // Set HTML lang attribute
        html.setAttribute('lang', lang);

        // Set body dir attribute
        body.setAttribute('dir', langConfig.dir);

        // Add/remove RTL class for additional styling if needed
        if (langConfig.dir === 'rtl') {
            body.classList.add('rtl');
            body.classList.remove('ltr');
        } else {
            body.classList.add('ltr');
            body.classList.remove('rtl');
        }
    }

    /**
     * Update language switcher button text
     */
    function updateSwitcherButton(lang) {
        const langConfig = LANGUAGES[lang];
        const buttons = document.querySelectorAll('.language-switcher .btn, .language-switcher button');
        
        buttons.forEach(button => {
            const icon = button.querySelector('i');
            const text = button.querySelector('.lang-text');
            
            if (text) {
                text.textContent = langConfig.code;
            } else {
                // If no span exists, update button content while preserving icon
                if (icon) {
                    button.innerHTML = '';
                    button.appendChild(icon.cloneNode(true));
                    const textNode = document.createElement('span');
                    textNode.className = 'lang-text ms-1';
                    textNode.textContent = langConfig.code;
                    button.appendChild(textNode);
                }
            }
        });
    }

    /**
     * Toggle between languages
     */
    function toggleLanguage() {
        const currentLang = getCurrentLanguage();
        const newLang = currentLang === 'en' ? 'ar' : 'en';
        setLanguage(newLang);
    }

    /**
     * Initialize language switcher
     */
    function initLanguageSwitcher() {
        // Apply saved language on page load
        const currentLang = getCurrentLanguage();
        applyLanguage(currentLang);
        updateSwitcherButton(currentLang);

        // Add click event listeners to language switcher buttons
        const buttons = document.querySelectorAll('.language-switcher .btn, .language-switcher button');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                toggleLanguage();
            });
        });

        // Add keyboard accessibility
        buttons.forEach(button => {
            button.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleLanguage();
                }
            });
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLanguageSwitcher);
    } else {
        initLanguageSwitcher();
    }

    // Expose toggle function globally for inline onclick if needed
    window.toggleLanguage = toggleLanguage;

})();
