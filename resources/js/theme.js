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
