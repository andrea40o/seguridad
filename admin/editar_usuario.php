<?php include("../includes/header.php") ?>

<?php

$BaseDatos=New Basemysql();

$bd=$BaseDatos->connect();

$users=New Usuario($bd);

if (isset($_GET['id'])) {
    $id=$_GET['id'];
}
$user=$users->leer_individual($id);

//Se va a actualizar el rol

if (isset($_POST["editarUsuario"])) {
    //Obtenemos los valores

    $id=$_POST['id'];
    $rol=$_POST['rol'];

    if (empty($rol) || $rol==""||empty($id) || $id=="") {
       $error="Error, algunos campos están vacios";
    }else {
        if($users->actualizar($id, $rol)){
        $mensaje="Usuario actualizado correctamente";
        header("Location:usuarios.php?mensaje=".urlencode($mensaje));
        exit();
        }else {
            $error="Error, no se pudo actualizar el usuario";
        }
    }

}

if (isset($_POST['borrarUsuario'])) {

    $id=$_POST['id'];
    //Instanciamos el objeto usuario
    $users=New Usuario($bd);

    if (empty($id)|| $id=="") {

        $error="Algunos campos estan vacios";
    }else{
        if ($users->borrar($id)) {
            $mensaje="Se ha eliminado correctamente";
            header("Location:usuarios.php?mensaje=".urlencode($mensaje));
            exit();
        }else {
            $error="No se ha podido eliminar el usuario";
        }

    }
}

?>

    <div class="row">
        <div class="col-sm-6">
            <h3>Editar Usuario</h3>
        </div>            
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="">

            <input type="hidden" name="id" value="<?php echo $user->usuario_id?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre" value="<?php  echo $user->usuario_nombre ?>" readonly>              
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Ingresa el email" value="<?php  echo $user->usuario_email ?>" readonly>               
            </div>
            <div class="mb-3">
            <label for="rol" class="form-label">Rol:</label>
            <select class="form-select" aria-label="Default select example" name="rol">
                <option value="">--Selecciona un rol--</option>
                <option value="1" <?php if ($user->rol=="Administrador") {
                    echo "selected";
                }  ?>>Administrador</option>  
                <option value="2" <?php if ($user->rol=="Registrado") {
                    echo "selected";
                }?>>Registrado</option>
                             
            </select>             
            </div>          
        
            <br />
            <button type="submit" name="editarUsuario" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Usuario</button>

            <button type="submit" name="borrarUsuario" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Usuario</button>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       