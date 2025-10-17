<?php 
    require '../../includes/funciones.php';
    $auth = estaAutenticado();

    if(!$auth) {
        header('Location: /');
    }

?>

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

    // validacion de id en la url, para evitar valores extraños
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /admin'); // Redireccionar en caso de que no haya id
    }
    
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

    // Obtener datos de la recomendacion
    $consulta_recomendacion = "SELECT * FROM recomendaciones WHERE idrecomendacion = $id ";
    $resultado_recomendacion = mysqli_query($db, $consulta_recomendacion); 
    $recomendacion = mysqli_fetch_assoc($resultado_recomendacion);

    // Obtener generos de la recomendacion
    $consulta_generos_recomendacion = "SELECT generos_idgenero FROM generos_recomendaciones WHERE recomendaciones_idrecomendacion = $id";
    $resultado_generos_recomendacion = mysqli_query($db, $consulta_generos_recomendacion);
    $generos_antiguos = [];

    // Obtener plataformas de la recomendacion
    $consulta_plataformas_recomendacion = "SELECT plataformas_idplataforma FROM plataformas_recomendaciones WHERE recomendaciones_idrecomendacion = $id";
    $resultado_plataformas_recomendacion = mysqli_query($db, $consulta_plataformas_recomendacion);


    // Arreglo de errores
    $errores = [];
    
    $titulo = $recomendacion['titulo_juego'];
    $calificacion = $recomendacion['rating'];
    while($row = mysqli_fetch_assoc($resultado_generos_recomendacion)) {
        $generos[] = $row['generos_idgenero'];
        $generos_antiguos[] = $row['generos_idgenero'];
    }
    while($row = mysqli_fetch_assoc($resultado_plataformas_recomendacion)) {
        $plataformas[] = $row['plataformas_idplataforma'];
        $plataformas_antiguas[] = $row['plataformas_idplataforma'];
    }
    $imagen_recomendacion = $recomendacion['imagen'];
    $texto_recomendacion = $recomendacion['texto'];
    $id_recomendacion = $recomendacion['idrecomendacion'];

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
        $texto_recomendacion = mysqli_real_escape_string($db, $_POST['recomendacion']);

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

        // if(!$imagen['name'] || $imagen['error']) {
        //      $errores[] = "Debes insertar una imagen";
        // }

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

            // // Subida de archivos
            // 1. Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) { // si no existe la carpeta de imagenes
                 mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

            if($imagen['name']) { // si el usuario subio una nueva imagen
                // Eliminar la imagen previa
                unlink($carpetaImagenes . $imagen_recomendacion); // Eliminar un archivo

                // 2. Generar un nombre unico a la imagen
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; // Generar un hash

                // 3. Subir la imagen a la carpeta
                move_uploaded_file($imagen["tmp_name"], $carpetaImagenes . $nombreImagen);                
            } 
            else { // en caso de que no se suba una imagen
                $nombreImagen = $imagen_recomendacion;
            }

            $query = "UPDATE recomendaciones SET titulo_juego = '$titulo', rating = $calificacion, texto = '$texto_recomendacion', imagen = '$nombreImagen' WHERE idrecomendacion = $id";

            $resultado = mysqli_query($db, $query);


            if ($resultado) {

                /** CODIGO PARA LOS GENEROS */

                // Si los generos seleccionados son mayores o iguales a los antiguos, quiere decir que se agregaron o se modificaron generos
                if(count($generos) >= count($generos_antiguos)) {
                    for ($i=0; $i < count($generos); $i++) { 
                        if(!array_key_exists($i, $generos_antiguos)) {
                            // se agregaron nuevos
                            $query = "INSERT INTO generos_recomendaciones VALUES ($id_recomendacion, $generos[$i])";
                            mysqli_query($db, $query);
                        }
                        else if($generos[$i] !== $generos_antiguos[$i]) {
                            // se modificaron
                            $query = "UPDATE generos_recomendaciones SET generos_idgenero = $generos[$i] WHERE generos_idgenero = $generos_antiguos[$i] AND recomendaciones_idrecomendacion = $id_recomendacion";
                            mysqli_query($db, $query);
                        }
                    }
                } 
                else { // Hay menos generos de los que habia
                    $diferencias = array_diff($generos_antiguos, $generos);
                    if($diferencias == $generos_antiguos) {
                        // Se eliminan todos los generos antiguos y se agregan los nuevos
                        $eliminar_generos = "DELETE FROM generos_recomendaciones WHERE recomendaciones_idrecomendacion = $id_recomendacion";
                        mysqli_query($db, $eliminar_generos);                 
                        
                        foreach($generos as $genero) {
                            $agregar_genero = "INSERT INTO generos_recomendaciones VALUES ($id_recomendacion, $genero)";
                            mysqli_query($db, $agregar_genero);
                        }

                    }
                    else {
                        // eliminar los diferentes y agregar los que quedan
                        foreach($diferencias as $genero_eliminar) {
                            $eliminar_generos = "DELETE FROM generos_recomendaciones WHERE generos_idgenero = $genero_eliminar AND recomendaciones_idrecomendacion = $id_recomendacion";
                            mysqli_query($db, $eliminar_generos);
                        }
                        $nuevos = array_diff($generos, $generos_antiguos);
                        foreach($nuevos as $nuevo_genero) {
                            $agregar_genero = "INSERT INTO generos_recomendaciones VALUES ($id_recomendacion, $nuevo_genero)";
                            mysqli_query($db, $agregar_genero);
                        }
                    }
                }

                /** CODIGO PARA LOS GENEROS */

                /** CODIGO PARA LAS PLATAFORMAS */

                // Si las plataformas seleccionadas son más o iguales que las antiguas, quiere decir que se agregaron o se modificaron plataformas
                if(count($plataformas) >= count($plataformas_antiguas)) {
                    for ($i=0; $i < count($plataformas); $i++) { 
                        if(!array_key_exists($i, $plataformas_antiguas)) {
                            // se agregaron nuevas
                            $query = "INSERT INTO plataformas_recomendaciones VALUES ($id_recomendacion, $plataformas[$i])";
                            mysqli_query($db, $query);
                        }
                        else if($plataformas[$i] !== $plataformas_antiguas[$i]) {
                            // se modificaron
                            $query = "UPDATE plataformas_recomendaciones SET plataformas_idplataforma = $plataformas[$i] WHERE plataformas_idplataforma = $plataformas_antiguas[$i] AND recomendaciones_idrecomendacion = $id_recomendacion";
                            mysqli_query($db, $query);
                        }
                    }
                } 
                else { //  En este caso, las plataformas seleccionadas son menos que las antiguas, por lo que quiere decir que se eliminaron
                    $diferencias = array_diff($plataformas_antiguas, $plataformas);
                    if($diferencias == $plataformas_antiguas) {
                        // Se eliminan las plataformas antiguas y se agregan las nuevas
                        $eliminar_plataformas = "DELETE FROM plataformas_recomendaciones WHERE recomendaciones_idrecomendacion = $id_recomendacion";
                        mysqli_query($db, $eliminar_plataformas);                 
                        
                        foreach($plataformas as $plataforma) {
                            $agregar_plataforma = "INSERT INTO plataformas_recomendaciones VALUES ($id_recomendacion, $plataforma)";
                            mysqli_query($db, $agregar_plataforma);
                        }

                    }
                    else {
                        // Se eliminan las que no tienen en comun y se agregan las demas seleccionadas
                        foreach($diferencias as $plataforma_eliminar) {
                            $eliminar_plataformas = "DELETE FROM plataformas_recomendaciones WHERE plataformas_idplataforma = $plataforma_eliminar AND recomendaciones_idrecomendacion = $id_recomendacion";
                            mysqli_query($db, $eliminar_plataformas);
                        }
                        $nuevos = array_diff($plataformas, $plataformas_antiguas);
                        foreach($nuevos as $nueva_plataforma) {
                            $agregar_plataforma = "INSERT INTO plataformas_recomendaciones VALUES ($id_recomendacion, $nuevo_genero)";
                            mysqli_query($db, $agregar_plataforma);
                        }
                    }
                }
                /** CODIGO PARA LAS PLATAFORMAS */


                // Redireccionar al usuario. Solo funciona si no hay nada de código HTML antes
                header("Location: /admin?resultado=2");
            }      

        }

    }
    ?>

    <main class="container">
        <h1>Actualizar Recomendación</h1>
        
        <a href="/admin" class="button">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error ?>                
            </div>
            
        <?php endforeach ?>

        <form method="POST" class="form" enctype="multipart/form-data">
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
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
                <img src="/imagenes/<?php echo $imagen_recomendacion ?>" alt="imagen juego" class="imagen-small">
            </div>
            <div class="form-field">
                <label for="recomendacion">Texto de recomendación</label>
                <textarea id="recomendacion" name="recomendacion" placeholder="Escribe tu recomendación aquí..." required><?php echo $texto_recomendacion ?></textarea>
            </div>
            <button type="submit" class="button">Actualizar Recomendación</button>
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>
</body>

</html>