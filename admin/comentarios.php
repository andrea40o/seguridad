<?php include("../includes/header.php") ?>

<?php

    //Instanciar base de datos y la conexion

    $baseDatos= new Basemysql();

    $db=$baseDatos->connect();

    $comentarios= new Comentario($db);

   $com= $comentarios->leer();
?>

<div class="row">
    <div class="col-sm-12">
    <?php if (isset($_GET['mensaje'])) :?> 
    
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong><?php echo $_GET['mensaje']?></strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  </button>
</div>
<?php  endif; ?>
    </div>
</div>


<div class="row">
    <div class="col-sm-6">
        <h3>Lista de Comentarios</h3>
    </div>       
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
            <table id="tblContactos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Comentario</th>
                        <th>Usuario</th>
                        <th>Artículo</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>                                          
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
             
                <?php foreach ($com as $comentario): ?>
                
                
                    <tr>
                        <td><?php echo $comentario->id?></td>
                        <td><?php echo $comentario->comentario?></td>
                        <td><?php echo $comentario->nombre?></td>
                        <td><?php echo $comentario->titulo?></td>
                        <td><?php echo $comentario->estado?></td>
                        <td><?php echo $comentario->fecha_creacion?></td>              
                        <td>
                            <a href="editar_comentario.php?id=<?php echo $comentario->id ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>                            
                        </td>
                    </tr>
            <?php endforeach;?>
                </tbody>       
            </table>
    </div>
</div>
<?php include("../includes/footer.php") ?>

<script>
    $(document).ready( function () {
        $('#tblContactos').DataTable();
    });
</script>