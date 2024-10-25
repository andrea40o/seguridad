<?php

    class Usuario{
    
    private $conn;
    private $table="usuarios";
    
    //Propiedades

    public $id;
    public $nombre;
    public $email;
    public $password;
    public $fecha_creacion;
    public $rol_id;

    //Constructor de la clase

    public function __construct($db){

       $this->conn=$db; 
    }

    //Obtener los comentarios

    public function leer(){

        $query=' SELECT u.id AS usuario_id, u.nombre AS usuario_nombre, u.email as usuario_email, u.fecha_creacion AS usuario_fecha_creacion, r.nombre AS rol FROM '.$this->table.' u INNER JOIN roles r on r.id=u.rol_id';

        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);

        //ejecutar query

        $stmt->execute();

        $usuarios=$stmt->fetchAll(PDO::FETCH_OBJ);

        return $usuarios;

    }

        public function leer_individual($id){

        $query=' SELECT u.id AS usuario_id, u.nombre AS usuario_nombre, u.email as usuario_email, u.fecha_creacion AS usuario_fecha_creacion, r.nombre AS rol FROM '.$this->table.' u INNER JOIN roles r on r.id=u.rol_id WHERE u.id=:id';

    
        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);
        
        //Vincular Parametro

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);

        //ejecutar query

        $stmt->execute();

        $usuarios=$stmt->fetch(PDO::FETCH_OBJ);

        return $usuarios;

    }


        public function actualizar($id,$rol){

        $query=' UPDATE  '.$this->table.' SET rol_id=:rol WHERE id=:id';

    
        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);
        
        //Vincular Parametro

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':rol',$rol,PDO::PARAM_INT);

        //ejecutar query

        if ( $stmt->execute()) {
            return true;
        }
       
        printf("error $s" , $stmt->error);

    }
       public function borrar($id){

        $query=' DELETE FROM '.$this->table.' WHERE id=:id';

        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);

        //Vincular Parametro

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);

        //ejecutar query

        if( $stmt->execute()){
            return true;

        };

        //Si hay error

        printf("error $s\n", $stmt->error);
       
    }

        public function registrar($nombre, $email,$password){

        $query=' INSERT INTO '.$this->table.' (nombre, email, password, rol_id) VALUES (:nombre, :email, :password, 2)';
        
          $passwordEncriptado=md5($password);

        //Encriptar el password

        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);

        

        //Vincular Parametro

        $stmt->bindParam(':nombre',$nombre,PDO::PARAM_STR);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);    
        $stmt->bindParam(':password',$passwordEncriptado,PDO::PARAM_STR);
        //ejecutar query

        if( $stmt->execute()){
            return true;

        };

        //Si hay error

        printf("error $s\n", $stmt->error);
       
    }

    public function validar_email($email){

        $query=' SELECT * FROM usuarios where email=:email';

        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':email',$email, PDO::PARAM_STR);

        $resultado=$stmt->execute();
        $registroEmail=$stmt->fetch(PDO::FETCH_ASSOC);

        if ($registroEmail) {
            return false;
        }else {
            return true;
        }
    }

        public function acceder($email, $password){

        $query=' SELECT * FROM '.$this->table. ' where email=:email AND password=:password';

        var_dump($query);
        $passwordEncriptada=md5($password);

        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':email',$email, PDO::PARAM_STR);
        $stmt->bindParam(':password',$passwordEncriptada, PDO::PARAM_STR);

        $resultado=$stmt->execute();

        $ExisteUsuario=$stmt->fetch(PDO::FETCH_ASSOC);

        if ($ExisteUsuario) {
            $rol_id = $ExisteUsuario['rol_id'];
            $_SESSION['rol_id'] = $rol_id;
            return true;
        }else {
            return false;
        }
    }
    }


?>