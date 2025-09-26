const navbarToggle = document.querySelector('.navbar-toggle');
const navbarMenu = document.querySelector('.navbar-menu');

navbarToggle.addEventListener('click', () => {
    navbarToggle.classList.toggle('active');
    navbarMenu.classList.toggle('active');
    const body = document.querySelector('body');
    body.classList.toggle('overflow-hidden');
});

function setRating(percent) {
    const circle = document.querySelector(".progress");
    const number = document.querySelector(".number");
    const radius = 45;
    const circumference = 2 * Math.PI * radius;

    const offset = circumference - (percent / 100) * circumference;

    circle.style.strokeDasharray = circumference;
    circle.style.strokeDashoffset = offset;

    number.textContent = percent;
}

setRating(97);