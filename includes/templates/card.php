<?php 

    if($lastgames) {
        $query = "SELECT * FROM recomendaciones ORDER BY fecha_publicacion DESC LIMIT 5";
        $resultado = mysqli_query($db, $query);
        
    }
    else {
        $query =  "SELECT * FROM recomendaciones";
        $resultado = mysqli_query($db, $query);
    }
?>

<?php while($recomendacion = mysqli_fetch_assoc($resultado)) : ?>
<div class="game <?php if($lastgames) echo 'swiper-slide'?>" data-rating="<?php echo $recomendacion['rating']; ?>">

    <img src="/imagenes/<?php echo $recomendacion['imagen']; ?>" alt="game image" loading="lazy">

    <div class="game-content">
        <h3> <?php echo $recomendacion['titulo_juego']; ?> </h3>
        <div class="tags">
            <?php 
                $id = $recomendacion['idrecomendacion'];
                $query_generos = "SELECT g.genero FROM generos_recomendaciones gr INNER JOIN generos g ON gr.generos_idgenero = g.idgenero WHERE gr.recomendaciones_idrecomendacion = $id";
                $resultado_generos = mysqli_query($db, $query_generos);
            ?>
            <?php while($genero = mysqli_fetch_assoc($resultado_generos)) : ?>
                <span class="tag"> <?php echo $genero['genero']; ?></span>
            <?php endwhile; ?>
        </div>
        <div class="rating">
            <svg class="circle" width="100" height="100">
                <circle class="bg" cx="50" cy="50" r="45"></circle>
                <circle class="progress" cx="50" cy="50" r="45"></circle>
            </svg>
            <span class="number"> <?php echo $recomendacion['rating']; ?> </span>
        </div>
            <?php 
                $id = $recomendacion['idrecomendacion'];
                $query_plataformas = "SELECT p.idplataforma FROM plataformas_recomendaciones pr INNER JOIN plataformas p ON pr.plataformas_idplataforma = p.idplataforma WHERE pr.recomendaciones_idrecomendacion = $id;";
                $resultado_plataformas = mysqli_query($db, $query_plataformas);
            ?>
        <div class="platforms">
            <?php while($plataforma = mysqli_fetch_assoc($resultado_plataformas)) : ?>
                <?php if($plataforma['idplataforma'] == 1) : ?>
                    <div class="platform xbox" title="Xbox">
                        <i class="bi bi-xbox"></i>
                    </div>
                <?php elseif($plataforma['idplataforma'] == 2) : ?>
                    <div class="platform playstation" title="PlayStation">
                        <i class="bi bi-playstation"></i>
                    </div>
                <?php elseif($plataforma['idplataforma'] == 3) :  ?>
                    <div class="platform pc" title="PC">
                        <i class="bi bi-pc-display"></i>
                    </div>
                <?php elseif($plataforma['idplataforma'] == 4) :  ?>
                    <div class="platform switch" title="Nintendo Switch">
                        <i class="bi bi-nintendo-switch"></i>
                    </div>
                <?php endif ?>
            <?php endwhile; ?>
        </div>
        <a href="entrada-juego.php" class="button">Ver recomendación</a>
    </div>
</div>
<?php endwhile; ?>