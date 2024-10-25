<?php include("includes/header_front.php") ?>

<?php

    $BaseDatos=New Basemysql;

    $bd=$BaseDatos->connect();

    $articulo=New Articulo($bd);

    $articulos=$articulo->leer();


?>
    <div class="container-fluid">
        <h1 class="text-center">Artículos</h1>
        <div class="row">
            <?php foreach ($articulos as $art):?>
            <div class="col-sm-4">
                <div class="card">
                    <img src="<?php echo RUTA_FRONT?>img/articulos/<?php
                    echo $art->imagen;?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $art->titulo;?></h5>
                        <p><strong><?php echo formatearFecha( $art->fecha_creacion);?></strong></p>
                        <p class="card-text"><?php echo textoCorto($art->texto);?></p>
                        <a href="detalle.php?id=<?php echo $art->id?>" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
      <?php  endforeach?>
        </div>            
    </div>
<?php include("includes/footer.php") ?>
       