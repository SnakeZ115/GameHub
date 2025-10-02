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
        // Incluir template
        require '../includes/funciones.php';
        incluirTemplate('header');

        // Mensaje condicional
        $resultado = $_GET["resultado"] ?? null;

        // Importar conexion
        require '../includes/config/database.php';
        $db = conectarDB();

        // Escribir query
        $query = "SELECT idrecomendacion, titulo_juego, rating, imagen FROM recomendaciones";

        // Consultar BD
        $resultado_recomendaciones = mysqli_query($db, $query);
    ?> 
    
    <main class="container">
        <h1>Administrador de GameHub</h1>
        <?php if( intval($resultado) === 1) : ?>
            <p class="alerta exito">Recomendación creada correctamente</p>
        <?php endif ?>
        <a href="/admin/juegos/crear.php" class="button">Crear Recomendacion</a>

        <table class="recomendaciones">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo del juego</th>
                    <th>Rating</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($recomendacion = mysqli_fetch_assoc($resultado_recomendaciones)) : ?>
                    <tr>
                        <td> <?php echo $recomendacion['idrecomendacion']; ?> </td>
                        <td> <?php echo $recomendacion['titulo_juego']; ?> </td>
                        <td> <?php echo $recomendacion['rating']; ?>  </td>
                        <td><img src="/imagenes/<?php echo $recomendacion['imagen'] ?>" alt="imagen juego" class="imagen-tabla"></td>
                        <td class="acciones">
                            <a href="#" class="button">Modificar</a>
                            <a href="#" class="button">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </main>

    <?php 
    incluirTemplate('footer'); 
    mysqli_close($db); // Cerrar la conexion, es opcional ya que PHP detecta que ya no se está haciendo nada y la cierra en automatico
    ?>
</body>
</html>