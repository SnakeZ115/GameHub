<?php 
    $query_generos = "SELECT * FROM generos";
    $resultado_generos = mysqli_query($db, $query_generos);

    $query_plataformas = "SELECT * FROM plataformas";
    $resultado_plataformas = mysqli_query($db, $query_plataformas);
?>

<fieldset>
    <legend>Géneros</legend>
    <?php while($genero = mysqli_fetch_assoc($resultado_generos)) : ?>
        <label><input type="checkbox" name="genre" value="<?php echo $genero['idgenero']; ?>" class="checkbox"><?php echo $genero['genero']; ?></label>
    <?php endwhile; ?>
</fieldset>
<fieldset>
    <legend>Plataformas</legend>
    <?php while($plataforma = mysqli_fetch_assoc($resultado_plataformas)) : ?>
        <label><input type="checkbox" name="genre" value="<?php echo $plataforma['idplataforma']; ?>" class="checkbox"><?php echo $plataforma['plataforma']; ?></label>
    <?php endwhile; ?>
</fieldset>