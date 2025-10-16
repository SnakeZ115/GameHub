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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                // Eliminar la imagen asociada
                $extraer_img = "SELECT imagen FROM recomendaciones WHERE idrecomendacion = $id";
                $res = mysqli_query($db, $extraer_img); 
                $img = mysqli_fetch_assoc($res);

                unlink('../imagenes/' . $img['imagen']);

                // Eliminar generos asociados
                $eliminar_generos = "DELETE FROM generos_recomendaciones WHERE recomendaciones_idrecomendacion = $id";
                $resultado_eliminar_generos = mysqli_query($db, $eliminar_generos);

                // Eliminar plataformas asociadas
                $eliminar_plataformas = "DELETE FROM plataformas_recomendaciones WHERE recomendaciones_idrecomendacion = $id";
                $resultado_eliminar_plataformas = mysqli_query($db, $eliminar_plataformas);

                // Eliminar recomendacion
                $eliminar_recomendacion = "DELETE FROM recomendaciones WHERE idrecomendacion = $id";
                $resultado_eliminar_recomendacion = mysqli_query($db, $eliminar_recomendacion);

                if($resultado_eliminar_recomendacion && $resultado_eliminar_generos && $resultado_eliminar_plataformas) {
                    header('location: /admin?resultado=3');
                }
            }
        }


        // Escribir query
        $query = "SELECT idrecomendacion, titulo_juego, rating, imagen FROM recomendaciones";

        // Consultar BD
        $resultado_recomendaciones = mysqli_query($db, $query);
    ?> 
    
    <main class="container">
        <h1>Administrador de GameHub</h1>
        <?php if( intval($resultado) === 1) : ?>
            <p class="alerta exito">Recomendación creada correctamente</p>
        <?php elseif( intval($resultado) === 2 ) : ?>
            <p class="alerta exito">Recomendación modificada correctamente</p>
                <?php elseif( intval($resultado) === 3 ) : ?>
            <p class="alerta exito">Recomendación eliminada correctamente</p>
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
                            <a href="admin/juegos/actualizar.php?id=<?php echo $recomendacion['idrecomendacion'] ?>" class="button">Modificar</a>
                            <form method="POST" style="width: 100%;">
                                <input type="hidden" name="id" value="<?php echo $recomendacion['idrecomendacion'] ?>">
                                <input type="submit" class="button" value="Eliminar">
                            </form>
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