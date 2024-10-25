<?php include("includes/header_front.php") ?>
<?php

    $BaseDatos=New Basemysql();

    $bd=$BaseDatos->connect();

    $users=New Usuario($bd);

    if (isset($_POST['acceder'])) {
       
        //Obtener las variables

        $users=New Usuario($bd);
        $email=$_POST['email'];
        $password=$_POST['password'];

        if (empty($email)|| $email==''|| empty($password)|| $password=='') {
           $error="Alguno de los campos se esta mandando vacio";
        }else {
            if ($users->acceder($email,$password)) {
               $_SESSION['autententicado']=true;
               $_SESSION['email']=$email;
            // Obtener el valor de $_SESSION['rol_id']
              $rol_id = $_SESSION['rol_id'];
            
               echo ("<script>location.href='".RUTA_FRONT."'</script>");
            }else {
                $error="Error, No ha podido acceder, intentelo de nuevo";
            }
        }
    }

?>

    <div class="row">
<div class="col-sm-12">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong><?php echo $error?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
        <?php  endif; ?>
    </div> 
    </div>
    <div class="container-fluid">
        <h1 class="text-center">Acceso de Usuarios</h1>
        <div class="row">
            <div class="col-sm-6 offset-3">
                <div class="card">
                   <div class="card-header">
                        Ingresa tus datos para acceder
                   </div>
                    <div class="card-body">
                    <form method="POST" action="">

                   

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Ingresa el email">               
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Ingresa el password">               
                    </div>

                    <br />
                    <button type="submit" name="acceder" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Acceder</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>  
         
    </div>
<?php include("includes/footer.php") ?>
       