// import './bootstrap';

document.documentElement.classList.add('no-transition');

// Check for saved theme preference or use system preference
const darkModeMediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
const savedTheme = localStorage.getItem('darkMode');

// Apply the right theme
if (savedTheme === 'dark' || (!savedTheme && darkModeMediaQuery.matches)) {
  document.documentElement.classList.add('dark');
} else {
  document.documentElement.classList.remove('dark');
}

// Remove the no-transition class after a short delay
window.addEventListener('load', () => {
  setTimeout(() => {
    document.documentElement.classList.remove('no-transition');
  }, 100);
});


// Initialize any toggle functionality
const menuToggle = document.getElementById("menuToggle");
    if (menuToggle) {
        menuToggle.addEventListener("click", function() {
            let sidebar = document.getElementById("sidebar");
            let overlay = document.getElementById("sidebarOverlay");
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        });
    }