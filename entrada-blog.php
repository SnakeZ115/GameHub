<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dist/css/app.css">
    <title>GameHub | Entrada Blog</title>
</head>

<body>

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <main class="blog-entry container">
        <h1>Top personal de bandas sonoras de videojuegos</h1>
        <div class="blog-content">
            <div class="image">
                <picture>
                    <source srcset="dist/imgs/OST.jpeg" type="image/jpeg">
                    <img src="dist/imgs/OST.jpeg" alt="blog image" loading="lazy">
                </picture>
                <div class="blog-meta">
                    <p>Escrito por <span>SnakeZ115</span>. <span>10/09/2025</span> </p>
                </div>
                <div class="blog-text">
                    <p>En este blog presento mi top personal de soundtracks favoritos de videojuegos de distintos tipos
                        de géneros</p>
                    <p>Desde la épica música orquestal de "Final Fantasy" hasta los inolvidables temas de "The Legend of
                        Zelda", cada soundtrack tiene su propio encanto y magia.</p>
                    <p>1. Outer Wilds</p>
                    <p>El soundtrack de Outer Wilds es una obra maestra que va mucho más allá de acompañar al juego: se
                        convierte en parte esencial de la experiencia. Cada pieza está compuesta con una sencillez
                        aparente —banjo, guitarra, percusiones suaves—, pero transmite una profundidad emocional enorme.
                        La música no solo ambienta, sino que guía la exploración, marca el paso del tiempo y se funde
                        con los descubrimientos, generando esa mezcla de asombro, melancolía y misterio que define al
                        juego.

                        Es impresionante cómo un tema tan cálido y familiar como el principal logra transformarse en
                        distintos matices a lo largo de la aventura, acompañando desde los momentos más tranquilos hasta
                        los más existenciales. El OST de Outer Wilds es uno de esos pocos que puedes escuchar fuera del
                        juego y aún sentir que viajas por el cosmos, recordando cada planeta y cada emoción vivida.</p>

                </div>
            </div>
    </main>

    <?php incluirTemplate('footer'); ?>
</body>

</html>