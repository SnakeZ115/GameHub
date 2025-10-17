<?php
    require 'includes/config/database.php';
    $db = conectarDB();

    // Autenticar usuario

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if(!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }

        if(!$password) {
            $errores[] = "El password es obligatorio";
        }

        if(empty($errores)) { // En caso de que no haya errores

            // Revisar si existe o no
            $query = "SELECT * FROM usuarios WHERE email = '$email'";
            $resultado = mysqli_query($db, $query);
            
            if($resultado->num_rows) { // en caso de que hay resultados
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);
                
                // verificar la password
                $auth = password_verify($password, $usuario['password']);
                var_dump($auth);

                if($auth) {
                    // Contraseña correcta
                    session_start(); // Siempre iniciar la sesion   

                    // Llenar el arreglo de las sesion
                    $_SESSION['usuario'] = $usuario['usuario'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');
            }
                else {
                    $errores[] = "Contraseña incorrecta";
                }
            }
            else {
                $errores[] = "El usuario no existe";
            }

        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameHub | Login</title>
    <link rel="stylesheet" href="/dist/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    
    <?php
        require 'includes/funciones.php';
        incluirTemplate('header');
    ?>

    <main class="container">
        <h1>Iniciar Sesión</h1>
        <?php foreach($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach ?>
        <form action="" class="form" method="POST">
            <div class="form-field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email">
            </div>
            <div class="form-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Tu password">
            </div>
            <input type="submit" value="Iniciar Sesión" class="button">
        </form>
    </main>


    <?php incluirTemplate('footer'); ?>

</body>
</html>