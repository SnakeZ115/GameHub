<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | Contacto </title>
    <link rel="stylesheet" href="/dist/css/app.css">
</head>

<body class="contact">

    <?php 
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <main class="container">
        <h1>Contacto</h1>
        <p>Ponte en contacto con nosotros. Recomendaciones y sugerencias son bienvenidas.</p>
        <div class="form-container">
            <picture>
                <source srcset="dist/imgs/hero-bg-img.jpg" type="image/jpeg">
                <img src="dist/imgs/hero-bg-img.jpg" alt="form image" loading="lazy">
            </picture>
            <form class="form" action="">
                <div class="form-field">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre" required>
                </div>
                <div class="form-field">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Tu correo electrónico" required>
                </div>
                <div class="form-field">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" placeholder="Tu mensaje" required></textarea>
                </div>
                <button type="submit" class="button">Enviar</button>
            </form>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>
</body>

</html>