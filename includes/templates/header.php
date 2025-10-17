<?php 

    if(!isset($_SESSION)) {
        session_start();        
    }
    $auth = $_SESSION['login'] ?? false; 
?>
<header class="header">
        <nav class="navbar">
            <div class="navbar-container">
                <a href="index.php" class="navbar-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-device-gamepad-2">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M12 5h3.5a5 5 0 0 1 0 10h-5.5l-4.015 4.227a2.3 2.3 0 0 1 -3.923 -2.035l1.634 -8.173a5 5 0 0 1 4.904 -4.019h3.4z" />
                        <path d="M14 15l4.07 4.284a2.3 2.3 0 0 0 3.925 -2.023l-1.6 -8.232" />
                        <path d="M8 9v2" />
                        <path d="M7 10h2" />
                        <path d="M14 10h2" />
                    </svg>
                    <span>GameHub</span>
                </a>
                <button type="button" class="navbar-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
                <ul class="navbar-menu">
                    <li><a href="nosotros.php">Nosotros</a></li>
                    <li><a href="catalogo.php">Catálogo</a></li>
                    <li><a href="blog.php">Blog</a></li>
                    <li><a href="contacto.php">Contacto</a></li>
                    <?php if($auth) : ?>
                        <li><a href="cerrar-sesion.php">Cerrar sesión</a></li>
                    <?php else : ?>
                        <li><a href="login.php">Iniciar sesión</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </nav>
    </header>