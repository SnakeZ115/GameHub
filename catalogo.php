<?php 
    require 'includes/config/database.php';
    $db = conectarDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | Catálogo</title>
    <link rel="stylesheet" href="/dist/css/app.css">
</head>

<body>

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <main class="catalog-page container">
        <aside class="filters">
            <?php 
                include 'includes/templates/filters.php';
            ?>
        </aside>

        <h1>Cátalogo de Juegos</h1>
        <p>Explora nuestra selección de juegos recomendados.</p>

        <section class="games-list">

            <?php 
                $lastgames = false;
                include 'includes/templates/card.php';
            ?>

        </section>

    </main>

    <?php incluirTemplate('footer'); ?>
    
</body>

</html>