<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | Entrada Juego</title>
    <link rel="stylesheet" href="/dist/css/app.css">
</head>

<body>

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <main class="game-details container">
        <h1>Persona 5 Royal</h1>
        <div class="game-content">
            <div class="image">
                <picture>
                    <source srcset="dist/imgs/p5r.jpeg" type="image/jpeg">
                    <img src="dist/imgs/p5r.jpeg" alt="game image" loading="lazy">
                </picture>
            </div>
            <div class="tags">
                <span class="tag">JRPG</span>
                <span class="tag">Turn-Based</span>
                <span class="tag">Anime</span>
            </div>
            <div class="rating">
                <svg class="circle" width="100" height="100">
                    <circle class="bg" cx="50" cy="50" r="45"></circle>
                    <circle class="progress" cx="50" cy="50" r="45"></circle>
                </svg>
                <span class="number">85</span>
            </div>
            <div class="platforms">
                <div class="platform xbox" title="Xbox">
                    <i class="bi bi-xbox"></i>
                </div>
                <div class="platform playstation" title="PlayStation">
                    <i class="bi bi-playstation"></i>
                </div>
                <div class="platform switch" title="Nintendo Switch">
                    <i class="bi bi-nintendo-switch"></i>
                </div>
                <div class="platform pc" title="PC">
                    <i class="bi bi-pc-display"></i>
                </div>
            </div>
            <div class="game-text">
                <p>
                    Persona 5 Royal no es solo un JRPG, es una experiencia única que mezcla historia, estilo y
                    jugabilidad de una forma que pocos juegos logran. Desde el primer momento, atrapa con su estética
                    visual espectacular, llena de detalles y personalidad; cada menú, animación y transición rebosa
                    estilo propio.
                </p>

                <p>
                    La historia es profunda y emocionante: sigues a los Ladrones Fantasma mientras desafían la
                    corrupción y luchan por cambiar corazones, explorando temas sociales actuales de una manera madura y
                    envolvente. Los personajes están tan bien escritos que es imposible no encariñarse con ellos, y cada
                    relación que construyes se siente significativa.
                </p>

                <p>
                    En cuanto a jugabilidad, combina lo mejor de un JRPG por turnos con mecánicas sociales: pasar el día
                    entre el colegio, actividades, amistades y las mazmorras “Palacios”. La versión Royal expande aún
                    más la experiencia con nuevos personajes, mecánicas, una historia extra y muchísimas horas de
                    contenido adicional, haciendo que sea la versión definitiva.
                </p>

                <p>
                    Recomendar Persona 5 Royal es fácil: si buscas un juego con historia impactante, personajes
                    memorables, banda sonora increíble y un estilo inconfundible, este es uno de esos títulos que no se
                    olvidan.
                </p>

            </div>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
</body>

</html>