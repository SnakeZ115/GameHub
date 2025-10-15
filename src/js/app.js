const navbarToggle = document.querySelector('.navbar-toggle');
const navbarMenu = document.querySelector('.navbar-menu');

navbarToggle.addEventListener('click', () => {
    navbarToggle.classList.toggle('active');
    navbarMenu.classList.toggle('active');
    const body = document.querySelector('body');
    body.classList.toggle('overflow-hidden');
});

function getCards() {
    const cards = document.querySelectorAll(".game");
    if (cards.length != 0) {
        cards.forEach(card => {
            const rating = card.dataset.rating;
            if (rating) {
                setRating(rating, card);
            }
        });        
    } else {
        const game_content = document.querySelector(".game-content");
        setRating(game_content.dataset.rating, game_content);
    }

}

getCards();


function setRating(percent, card) {
    const circle = card.querySelector(".progress");
    const number = card.querySelector(".number");
    const radius = 45;
    const circumference = 2 * Math.PI * radius;

    const offset = circumference - (percent / 100) * circumference;

    circle.style.strokeDasharray = circumference;
    circle.style.strokeDashoffset = offset;

    number.textContent = percent;
}

/** Filters */
const checkboxes = document.querySelectorAll('.checkbox');
const gameList = document.querySelector('.games-list');
const search = document.querySelector('.search');

async function filtros() {

    // Seleccionamos los generos y las plataformas seleccionadas y las guardamos en un array
    const generosSeleccionados = [...document.querySelectorAll('input[name=genre]:checked')].map(checkbox => checkbox.value);
    const plataformasSeleccionadas = [...document.querySelectorAll('input[name=platform]:checked')].map(checkbox => checkbox.value);
    const busqueda = search.value;

    // Creamos un formdata para enviar los valores al backend y renderizar los resultados
    const formData = new FormData();
    formData.append('generos', JSON.stringify(generosSeleccionados));
    formData.append('plataformas', JSON.stringify(plataformasSeleccionadas));
    formData.append('busqueda', busqueda)

    // Hacemos una peticion FETCH para los filtros
    let resultado = await fetch('includes/filtrar.php', {method: 'POST', body: formData});
    let cards = await resultado.text();
    
    gameList.innerHTML = cards;
    getCards();

}

checkboxes.forEach(checkbox => checkbox.addEventListener('change', filtros));
search.addEventListener('input', filtros);
