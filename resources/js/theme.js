/**
 * Dark / Light theme toggle – persists in localStorage
 */
const STORAGE_KEY = 'ae-theme';

function getStoredTheme() {
    return localStorage.getItem(STORAGE_KEY) || 'light';
}

function setStoredTheme(theme) {
    localStorage.setItem(STORAGE_KEY, theme);
}

function applyTheme(theme) {
    const root = document.documentElement;
    if (theme === 'dark') {
        root.classList.add('dark');
    } else {
        root.classList.remove('dark');
    }
    setStoredTheme(theme);
    updateToggleIcons(theme);
}

function updateToggleIcons(theme) {
    const sun = document.getElementById('theme-icon-sun');
    const moon = document.getElementById('theme-icon-moon');
    if (!sun || !moon) return;
    if (theme === 'dark') {
        sun.classList.remove('hidden');
        moon.classList.add('hidden');
    } else {
        sun.classList.add('hidden');
        moon.classList.remove('hidden');
    }
    const tooltip = document.getElementById('theme-tooltip-text');
    if (tooltip) tooltip.textContent = theme === 'dark' ? 'Light Mode' : 'Dark Mode';
}

function toggleTheme() {
    const current = getStoredTheme();
    const next = current === 'dark' ? 'light' : 'dark';
    applyTheme(next);
}

function initTheme() {
    const theme = getStoredTheme();
    applyTheme(theme);
}

document.addEventListener('DOMContentLoaded', initTheme);
window.toggleTheme = toggleTheme;

/**
 * Language panel toggle
 */
function toggleLangPanel() {
    const panel = document.getElementById('lang-panel');
    if (!panel) return;

    if (panel.classList.contains('hidden')) {
        panel.classList.remove('hidden');
        panel.classList.add('panel-entering');
        requestAnimationFrame(() => {
            panel.classList.remove('panel-entering');
            panel.classList.add('panel-open');
        });
    } else {
        panel.classList.remove('panel-open');
        panel.classList.add('panel-entering');
        setTimeout(() => {
            panel.classList.add('hidden');
            panel.classList.remove('panel-entering');
        }, 180);
    }
}

document.addEventListener('click', (e) => {
    const panel = document.getElementById('lang-panel');
    const langButton = e.target.closest('[onclick*="toggleLangPanel"]');
    if (!langButton && panel && !panel.classList.contains('hidden')) {
        if (!e.target.closest('#lang-panel')) {
            toggleLangPanel();
        }
    }
});

// Language switch with forced reload
document.addEventListener('DOMContentLoaded', () => {
    const langLinks = document.querySelectorAll('#lang-list a');
    langLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const url = link.href;
            
            // Show loading indicator
            const panel = document.getElementById('lang-panel');
            if (panel) {
                panel.style.opacity = '0.5';
                panel.style.pointerEvents = 'none';
            }
            
            // Use fetch to change language, then force full page reload
            fetch(url, {
                method: 'GET',
                cache: 'no-cache',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            }).then(() => {
                // Force a hard reload to clear all caches
                window.location.reload(true);
            }).catch(() => {
                // Fallback: direct navigation with cache busting
                window.location.href = url + (url.includes('?') ? '&' : '?') + '_t=' + Date.now();
            });
        });
    });
});

window.toggleLangPanel = toggleLangPanel;
