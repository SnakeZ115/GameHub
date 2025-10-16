<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | Sobre nosotros</title>
    <link rel="stylesheet" href="/dist/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="about-us-page">

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <main class="about-us">
        <div class="about-us-content container">
            <h1>Sobre GameHub</h1>
            <div class="about-us-info">
                <div class="about-us-image">
                    <img src="dist/imgs/about-us.jpg" alt="Sobre GameHub" />
                </div>
                <div class="about-us-text">
                    <p>En GameHub creemos que las mejores recomendaciones no vienen de la prensa, sino de los propios
                        jugadores. Por eso, nuestro blog está hecho de gamers para gamers.</p>

                    <p>Aquí encontrarás opiniones honestas, reseñas y recomendaciones de videojuegos escritas por
                        personas que juegan, disfrutan y viven el gaming día a día. No somos críticos de escritorio,
                        somos parte de la comunidad.</p>

                    <p> Nuestro objetivo es ayudarte a descubrir tu próximo título favorito con la mirada de un gamer
                        más, alguien que entiende lo que significa pasar horas en una partida épica, completar un logro
                        imposible o emocionarse con un nuevo lanzamiento.</p>

                    <p>En GameHub compartimos experiencias reales, sin filtros, para que cada recomendación se sienta
                        como la de un amigo gamer de confianza.</p>
                </div>
            </div>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>