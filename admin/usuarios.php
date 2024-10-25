<?php include("../includes/header.php") ?>

<?php

 $BaseDatos= new Basemysql();

 $bd=$BaseDatos->connect();

 $usuarios= new Usuario($bd);

 $user=$usuarios->leer();



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
        <h3>Lista de Usuarios</h3>
    </div>     
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
            <table id="tblUsuarios" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de Creación</th>                       
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
               <?php
                    foreach($user as $usuarios) :

                    ?>
                    <tr>
                        <td><?php echo $usuarios->usuario_id?></td>
                        <td><?php echo $usuarios->usuario_nombre?></td>
                        <td><?php echo $usuarios->usuario_email?></td>
                        <td><?php echo $usuarios->rol?></td>
                         <td><?php echo $usuarios->usuario_fecha_creacion?></td>
                        <td>
                            <a href="editar_usuario.php?id=<?php echo $usuarios->usuario_id?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>                                            
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
        $('#tblUsuarios').DataTable();
    });
</script>