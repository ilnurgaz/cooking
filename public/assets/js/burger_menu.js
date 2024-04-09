document.addEventListener("DOMContentLoaded", (event) => {
    const burgerBtn = document.getElementById('burgerBtn');
    const navbar = document.getElementById('navbar');

    burgerBtn.addEventListener('click', toggleNavbar);

    function toggleNavbar() {
        navbar.classList.toggle('active'); 
    }

    document.addEventListener('click', (event) => {
        if (!navbar.contains(event.target) && event.target !== burgerBtn) {
            navbar.classList.remove('active');
        }
    });
});