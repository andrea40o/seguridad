<?php include '../config/config.php'?>
<?php include '../config/Basemysql.php'?>
<?php include '../helpers/helper_formatos.php'?>
<?php include '../models/Articulo.php'?>
<?php include '../models/Comentario.php'?>
<?php include '../models/Usuario.php'?>
<?php
session_start();
//Si no existe la sesion lo devolvemos

    // Verificar si $_SESSION['rol'] está definido
  /*  if (isset($_SESSION['rol_id'])) {
        $rol_id = $_SESSION['rol_id'];
        echo '<p>Tu rol en el sistema es: ' . $rol_id . '</p>';
    } else {
        echo '<p>No se ha definido un rol para el usuario.</p>';
    }*/


if (!$_SESSION['autententicado'] ) {
    header("Location: ../acceder.php");
}else {
    if (isset($_SESSION['rol_id'])) {
        switch ($_SESSION['rol_id']) {
           /* case '1':
                header('location:'.RUTA_ADMIN);
                break;*/
            case '2':
                header('location:'.RUTA_FRONT);
                break;
            
            default:
                break;
        }
    }
}

?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/bootstrap-icons-1.2.1/font/bootstrap-icons.css">

    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">    

    <link rel="stylesheet" href="../css/estilos.css">

    <title>Blog PHP 8</title>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo RUTA_FRONT; ?>">Blog PHP 8</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
                <?php if (isset($_SESSION['autententicado']) && $_SESSION['rol_id'] == 1): ?>
             

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administración
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                            <a class="dropdown-item" href="<?php echo RUTA_ADMIN; ?>articulos.php">Artículos</a>
                            </li>
                            <li>
                            <a class="dropdown-item" href="<?php echo RUTA_ADMIN; ?>comentarios.php">Comentarios</a>
                            </li>                        
                        </ul>
                    </li>

                    

                    <li class="nav-item">
                            <a class="nav-link" href="<?php echo RUTA_ADMIN; ?>usuarios.php">Usuarios</a>
                      </li>  
                           <?php endif;?>  
                </ul>

                  <ul class="navbar-nav mb-2 mb-lg-0">      
                                   
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo RUTA_FRONT; ?>">Inicio</a>
                        </li> 
                   <?php if(!isset( $_SESSION['autententicado'])):?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_FRONT; ?>registro.php">Registrarse</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_FRONT; ?>acceder.php">Acceder</a>
                            </li>
                      <?php endif;?>   

                             <?php if(isset( $_SESSION['autententicado'])):?>
                          <li class="nav-item">
                              <p class="text-white mt-2"><i class="bi bi-person-circle"></i><?php echo $_SESSION['email']?> </p>
                          </li>
                    
                          <li class="nav-item">
                                <a class="nav-link" href="<?php echo RUTA_FRONT; ?>salir.php">Salir</a>
                            </li>  
                         <?php endif;?>               
                    </ul>   
                      
            </div>
        </div>
    </nav>  

    <div class="container mt-5 caja">
       