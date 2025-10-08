<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub</title>
    <link rel="stylesheet" href="/dist/css/app.css">
</head>

<body class="create-game">
    <?php
    require '../../includes/funciones.php';
    incluirTemplate('header');

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Consultar para obtener los géneros
    $consulta_generos = "SELECT * FROM generos";
    $mostrar_generos = mysqli_query($db, $consulta_generos);

    // Consultar para obtener las plataformas
    $consulta_plataformas = "SELECT * FROM plataformas";
    $mostrar_plataformas = mysqli_query($db, $consulta_plataformas);

    // Arreglo de errores
    $errores = [];
    
    $titulo = '';
    $calificacion = '';
    $generos = [];
    $plataformas = [];
    // $imagen = $_POST['imagen'];
    $recomendacion = '';

    // Ejecutar el código después de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST); // superglobal que contiene toda la información que el usuario envía
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES); // $_FILES para leer archivos
        // echo "</pre>";

        $titulo = mysqli_real_escape_string($db, $_POST['title']); // En caso de que alguien inyecte SQL, lo desabilita y lo guarda de forma que no es ejecutable
        $calificacion = mysqli_real_escape_string($db, $_POST['rating']);
        $generos = $_POST['genres'] ?? [];
        $plataformas = $_POST['platforms'] ?? [];
        $recomendacion = mysqli_real_escape_string($db, $_POST['recomendacion']);

        // Asignar FILES a una variable
        $imagen = $_FILES['imagen'];

        // Validacion de formulario, checar si los valores están vacios
        if(!$titulo) {
            $errores[] = "Debes agregar un titulo";  // El arreglo[] =, agrega automaticamente el valor al final del arreglo
        }

        if(!$calificacion) {
            $errores[] = "Debes agregar una calificacion del 1 al 100";
        }

        if(!$generos) {
            $errores[] = "Debes seleccionar al menos 1 género";
        }

        if(!$plataformas) {
            $errores[] = "Debes seleccionar al menos 1 plataforma";
        }

        if(!$imagen['name'] || $imagen['error']) {
             $errores[] = "Debes insertar una imagen";
        }

        // Validar tamaño de la imagen
        $medida = 1000 * 1000; // bytes a kilobytes

        if($imagen['size'] > $medida) {
            $errores[] = " La imagen es muy pesada";
        }

        if(!$recomendacion) {
            $errores[] = "Debes escribir el texto de la recomendacion";
        }

        // Revisar que el arreglo de errores esté vacío para poder ejecutar el codigo SQL
        if(empty($errores)) {

            // Subida de archivos

            // 1. Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) { // si no existe la carpeta de imagenes
                mkdir($carpetaImagenes);
            }

            // 2. Generar un nombre unico a la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; // Generar un hash

            // 3. Subir la imagen a la carpeta
            move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);

            $query = "INSERT INTO recomendaciones VALUES (DEFAULT, '$titulo', $calificacion, '$recomendacion', '$nombreImagen', current_date(), 1)";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {

                // Asociar generos y plataformas a la recomendacion, una vez creada la recomendacion
                $ultimo_id_recomendacion = mysqli_insert_id($db);

                foreach ($generos as $key => $id) {

                    $insertar_generos = "INSERT INTO generos_recomendaciones VALUES ($ultimo_id_recomendacion, $id)";
                    $resultado_generos = mysqli_query($db, $insertar_generos);
                }

                foreach ($plataformas as $key => $id) {
                    
                    $insertar_plataformas = "INSERT INTO plataformas_recomendaciones VALUES ($ultimo_id_recomendacion, $id)";
                    $resultado_plataformas = mysqli_query($db, $insertar_plataformas);
                }

                // Redireccionar al usuario. Solo funciona si no hay nada de código HTML antes
                header("Location: /admin?resultado=1");
            }      

        }

    }
    ?>

    <main class="container">
        <h1>Crear Recomendación</h1>
        
        <a href="/admin" class="button">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>                
            </div>
            
        <?php endforeach ?>

        <form action="/admin/juegos/crear.php" method="POST" class="form" enctype="multipart/form-data">
            <div class="form-field">
                <label for="title">Título del Juego</label>
                <input type="text" id="title" name="title" placeholder="Título del juego" value="<?php echo $titulo ?>" required>
            </div>
            <div class="form-field">
                <label for="rating">Calificación</label>
                <input type="number" id="rating" name="rating" min="1" max="100" placeholder="Calificación del juego (1-100)" value="<?php echo $calificacion ?>" required>
            </div>
            <div class="form-field">
                <label for="genre">Género</label>
                <div class="checkboxes">
                    <?php while($row = mysqli_fetch_assoc($mostrar_generos)) : ?>
                        <label><input type="checkbox" <?php foreach($generos as $genero) { // Revisar que checkboxes estaban seleccionadas al presionar enviar y que hayan faltado datos
                            if($genero === $row['idgenero']) {
                                echo "checked"; 
                            }
                        } ?> class="checkbox" name="genres[]" value="<?php echo $row['idgenero']; ?>"> <?php echo $row['genero']; ?> </label>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="form-field"> 
                <label for="platforms">Plataformas</label>
                <div class="checkboxes">
                    <?php while($row = mysqli_fetch_assoc($mostrar_plataformas)) : ?>
                        <label><input type="checkbox" <?php foreach($plataformas as $plataforma) {
                            if($plataforma === $row['idplataforma']) {
                                echo "checked";
                            }
                        } ?> class="checkbox" name="platforms[]" value="<?php echo $row['idplataforma'] ?>"> <?php echo $row['plataforma'] ?> </label>
                    <?php endwhile; ?>
                </div>
            </div>
            <div class="form-field">
                <label for="imagen">Imagen del juego</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png" required>
            </div>
            <div class="form-field">
                <label for="recomendacion">Texto de recomendación</label>
                <textarea id="recomendacion" name="recomendacion" placeholder="Escribe tu recomendación aquí..." required><?php echo $recomendacion ?></textarea>
            </div>
            <button type="submit" class="button">Crear Recomendación</button>
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>
</body>

</html>