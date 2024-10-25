<?php include("includes/header_front.php") ?>

<?php

    $BaseDatos=New Basemysql;

    $bd=$BaseDatos->connect();

    $articulo=New Articulo($bd);

     if (isset($_GET['id'])) {
       $id=$_GET['id'];
    }

    $articulos=$articulo->leer_individual($id);

    //Instanciar los comentarios para este articulo

    $comentarios=New Comentario($bd);

    $resultado2=$comentarios->leerPorId($id);

    if (isset($_POST['enviarComentario'])) {
       //Obtener los valores

        $usuario=$_POST['usuario'];
        $comentario=$_POST['comentario'];
        $articulo=$_POST['articulo'];
        if (empty($comentario)|| $comentario==" " || empty($usuario)|| $usuario==" ") {
           $error="Alguno de los campos se encuentra vacio";
        }else {

             $comentarios=New Comentario($bd);

            if ($comentarios->crear($usuario, $comentario, $articulo)) {
            
                $mensaje="Se ha creado correctamente el comentario, esperar a que el administrador lo apruebe";

                echo("<script>location.href='".RUTA_FRONT."'</script>");
            }else {
                
                $error="No se ha podido crear el comentario, intentelo de nuevo";
            }
        }
    }
   // $resultado3=$comentarios->crear($email, $comentario, $id);

?>

    <div class="row">
       
    </div>

    <div class="container-fluid"> 
      
        <div class="row">
                
        <div class="row">
        <div class="col-sm-12">
            
        </div>  
    </div>

            <div class="col-sm-12">
                <div class="card">
                   <div class="card-header">
                        <h1><?php echo $articulos->titulo ?></h1>
                   </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid img-thumbnail" <img src="<?php echo RUTA_FRONT?>img/articulos/<?php
                             echo $articulos->imagen;?>"
                        </div>

                        <p> <?php echo $articulos->texto;?></p>

                    </div>
                </div>
            </div>
        </div>  
  
        
        <?php if(isset( $_SESSION['autententicado'])):?>
        <div class="row">        

        <div class="col-sm-6 offset-3">
        <form method="POST" action="">
            <input type="hidden" name="articulo" value="<?php echo $id;?>">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $_SESSION['email']; ?>" readonly>               
            </div>
           
            <div class="mb-3">
                <label for="comentario">Comentario</label>   
                <textarea class="form-control" name="comentario" style="height: 200px"></textarea>              
            </div>          
        
            <br />
            <button type="submit" name="enviarComentario" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Crear Nuevo Comentario</button>
            </form>
        </div>
        </div>
   <?php  endif;?>
    </div>

    <div class="row">
    <h3 class="text-center mt-5">Comentarios</h3>
         <?php
            foreach($resultado2 as $comentario) :?>
            <h4><i class="bi bi-person-circle"></i> <?php echo $comentario->nombre_usuario?></h4>
            <p><?php  echo $comentario->comentario?></p>
    <?php  endforeach; ?>
    </div>
         
    </div>
<?php include("includes/footer.php") ?>
       