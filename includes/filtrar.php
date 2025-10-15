<?php 
    require __DIR__ . '/config/database.php';
    $db = conectarDB();

    $generos = json_decode($_POST['generos']) ?? [];
    $plataformas = json_decode($_POST['plataformas']) ?? [];
    $busqueda = $_POST['busqueda'] ?? '';

    $query = "SELECT DISTINCT r.* FROM recomendaciones r 
              LEFT JOIN generos_recomendaciones gr ON gr.recomendaciones_idrecomendacion = r.idrecomendacion 
              LEFT JOIN plataformas_recomendaciones pr ON pr.recomendaciones_idrecomendacion = r.idrecomendacion WHERE 1=1";

    if($generos) {
        $lista_generos = implode(',', array_map('intval', $generos));
        $query .= " AND generos_idgenero IN($lista_generos)";
    }

    if($plataformas) {
        $lista_plataformas = implode(',', array_map('intval', $plataformas));
        $query .= " AND plataformas_idplataforma IN($lista_plataformas)";
    }

    if($busqueda) {
        $query .= " AND titulo_juego LIKE '%" . mysqli_real_escape_string($db, $busqueda) . "%'";
    }

    $resultado = mysqli_query($db, $query);

    $lista_recomendaciones = $resultado;

    include __DIR__ . '/templates/card.php';
?>