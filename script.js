document.addEventListener('DOMContentLoaded', () => {
    const dropdowns = document.querySelectorAll('nav ul li');
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('mouseenter', () => {
            dropdown.querySelector('.dropdown').style.display = 'block';
        });
        dropdown.addEventListener('mouseleave', () => {
            dropdown.querySelector('.dropdown').style.display = 'none';
        });
    });
});