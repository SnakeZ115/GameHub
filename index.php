<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | Inicio </title>
    <link rel="stylesheet" href="/dist/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="home">

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <section class="hero container">
        <div class="hero-content">
            <h1>GameHub</h1>
            <p>De Gamers para Gamers. Descubre tu próximo juego favorito</p>
            <a href="#" class="button">Explorar Catálogo</a>
        </div>
    </section>

    <main>
        <section class="last-games container">
            <h2>Últimos juegos</h2>
            <div class="swiper">
                <div class="slider-wrapper">
                    <div class="last-games-content swiper-wrapper">

                        <?php 
                            $lastgames = true;
                            include 'includes/templates/card.php';
                        ?>

                    </div>
                </div>
                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </section>
    </main>
    
    <section class="blogs container">
        <h2>últimos Blogs</h2>
        <div class="container blogs-content">

            <article class="enter-blog">
                <div class="image">
                    <picture>
                        <source srcset="dist/imgs/OST.jpeg" type="image/jpeg">
                        <img src="dist/imgs/OST.jpeg" alt="blog image" loading="lazy">
                    </picture>
                </div>
                <a href="entrada-blog.php">
                    <div class="blog-text">
                        <h3>Top personal de bandas sonoras de videojuegos</h3>
                        <div class="blog-meta">
                            <p>Escrito por <span>SnakeZ115</span>. <span>10/09/2025</span> </p>
                        </div>
                        <p>En este blog presento mi top personal de soundtracks favoritos de videojuegos de distintos
                            tipos
                            de géneros</p>
                    </div>
                </a>
            </article>

            <article class="enter-blog">
                <div class="image">
                    <picture>
                        <source srcset="dist/imgs/OST.jpeg" type="image/jpeg">
                        <img src="dist/imgs/OST.jpeg" alt="blog image" loading="lazy">
                    </picture>
                </div>
                <a href="entrada-blog.php">
                    <div class="blog-text">
                        <h3>Top personal de bandas sonoras de videojuegos</h3>
                        <div class="blog-meta">
                            <p>Escrito por <span>SnakeZ115</span>. <span>10/09/2025</span> </p>
                        </div>
                        <p>En este blog presento mi top personal de soundtracks favoritos de videojuegos de distintos
                            tipos
                            de géneros</p>
                    </div>
                </a>
            </article>

            <article class="enter-blog">
                <div class="image">
                    <picture>
                        <source srcset="dist/imgs/OST.jpeg" type="image/jpeg">
                        <img src="dist/imgs/OST.jpeg" alt="blog image" loading="lazy">
                    </picture>
                </div>
                <a href="entrada-blog.php">
                    <div class="blog-text">
                        <h3>Top personal de bandas sonoras de videojuegos</h3>
                        <div class="blog-meta">
                            <p>Escrito por <span>SnakeZ115</span>. <span>10/09/2025</span> </p>
                        </div>
                        <p>En este blog presento mi top personal de soundtracks favoritos de videojuegos de distintos
                            tipos
                            de géneros</p>
                    </div>
                </a>
            </article>
        </div>
    </section>

    <?php incluirTemplate('footer'); ?>

    <script type="module" src="/dist/js/swiper.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>

</html>