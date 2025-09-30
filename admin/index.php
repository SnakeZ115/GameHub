<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub</title>
    <link rel="stylesheet" href="/dist/css/app.css">
</head>
<body>
    <?php
        require '../includes/funciones.php';
        incluirTemplate('header');
    ?> 
    
    <main class="container">
        <h1>Administrador de GameHub</h1>
        <a href="/admin/juegos/crear.php" class="button">Crear Recomendacion</a>
    </main>

    <?php incluirTemplate('footer'); ?>
</body>
</html>