import 'aos/dist/aos.css';
import AOS from 'aos';
AOS.init({ duration: 700, once: true });


const themeButtons = document.querySelectorAll('[data-theme-toggle]');
const htmlElement = document.documentElement;
const savedTheme = localStorage.getItem('theme') || 'light';
if (savedTheme === 'dark') htmlElement.classList.add('dark');

themeButtons.forEach(btn => {
  const darkLabel = btn.dataset.themeDark;
  const lightLabel = btn.dataset.themeLight;

  btn.textContent = htmlElement.classList.contains('dark') ? lightLabel : darkLabel;

  btn.addEventListener('click', () => {
    const isDark = htmlElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    btn.textContent = isDark ? lightLabel : darkLabel;
  });

});
window.addEventListener('DOMContentLoaded', () => {
  window.dispatchEvent(new Event('resize'));
});

