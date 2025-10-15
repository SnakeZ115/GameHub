<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
        header('Location: /index.php');
    }

    // Base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    // Extraer info de la recomendacion
    $query = "SELECT * FROM recomendaciones WHERE idrecomendacion = $id";
    $resultado_recomendacion = mysqli_query($db, $query);
    $recomendacion = mysqli_fetch_assoc($resultado_recomendacion);

    // Extraer los géneros
    $query = "SELECT g.genero FROM generos_recomendaciones gr INNER JOIN generos g ON gr.generos_idgenero = g.idgenero WHERE gr.recomendaciones_idrecomendacion = $id";
    $resultado_generos = mysqli_query($db, $query);

    // Extraer las plataformas
    $query = "SELECT p.idplataforma FROM plataformas_recomendaciones pr INNER JOIN plataformas p ON pr.plataformas_idplataforma = p.idplataforma WHERE pr.recomendaciones_idrecomendacion = $id;";
    $resultado_plataformas = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | <?php echo $recomendacion['titulo_juego'] ?> </title>
    <link rel="stylesheet" href="/dist/css/app.css">
</head>

<body>

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');

    ?>

    <main class="game-details container">
        <h1> <?php echo $recomendacion['titulo_juego']; ?> </h1>
        <div class="game-content" data-rating="<?php echo $recomendacion['rating']; ?>">

            <img src="/imagenes/<?php echo $recomendacion['imagen']; ?>" alt="game image" loading="lazy">

            <div class="tags">
            <?php while($genero = mysqli_fetch_assoc($resultado_generos)) : ?>
                <span class="tag"> <?php echo $genero['genero']; ?></span>
            <?php endwhile; ?>
            </div>
            <div class="rating">
                <svg class="circle" width="100" height="100">
                    <circle class="bg" cx="50" cy="50" r="45"></circle>
                    <circle class="progress" cx="50" cy="50" r="45"></circle>
                </svg>
                <span class="number"><?php echo $recomendacion['rating']; ?></span>
            </div>
            <div class="platforms">
                <?php while($plataforma = mysqli_fetch_assoc($resultado_plataformas)) : ?>
                    <?php if($plataforma['idplataforma'] == 1) : ?>
                        <div class="platform xbox" title="Xbox">
                            <i class="bi bi-xbox"></i>
                        </div>
                    <?php elseif($plataforma['idplataforma'] == 2) : ?>
                        <div class="platform playstation" title="PlayStation">
                            <i class="bi bi-playstation"></i>
                        </div>
                    <?php elseif($plataforma['idplataforma'] == 3) :  ?>
                        <div class="platform pc" title="PC">
                            <i class="bi bi-pc-display"></i>
                        </div>
                    <?php elseif($plataforma['idplataforma'] == 4) :  ?>
                        <div class="platform switch" title="Nintendo Switch">
                            <i class="bi bi-nintendo-switch"></i>
                        </div>
                    <?php endif ?>
                <?php endwhile; ?>
            </div>
            <div class="game-text">
                <p> <?php echo $recomendacion['texto'] ?> </p>

            </div>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
</body>

</html>