<?php

    class Comentario{
    
    private $conn;
    private $table="comentarios";
    
    //Propiedades

    public $id;
    public $comentario;
    public $usuario_id;
    public $articulo_id;
    public $estado;
    public $fecha_creacion;
    public $nombre;
    public $titulo;
    public $texto;

    //Constructor de la clase

    public function __construct($db){

       $this->conn=$db; 
    }

    //Obtener los comentarios

    public function leer(){

        $query=' SELECT c.id, c.comentario, c.fecha_creacion, c.estado,u.nombre, a.titulo FROM '.$this->table.'  c INNER JOIN usuarios u on u.id=c.usuario_id INNER JOIN articulos a on a.id=c.articulo_id';

        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);

        //ejecutar query

        $stmt->execute();

        $comentarios=$stmt->fetchAll(PDO::FETCH_OBJ);

        return $comentarios;

    }

    
    public function leer_individual($id){

        $query=' SELECT c.id, c.comentario, c.fecha_creacion, c.estado,u.nombre, a.titulo, a.texto FROM '.$this->table.'  c INNER JOIN usuarios u on u.id=c.usuario_id INNER JOIN articulos a on a.id=c.articulo_id WHERE c.id=?';

        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);

        //Vincular Parametro

        $stmt->bindParam(1,$id,PDO::PARAM_INT);

        //ejecutar query

        $stmt->execute();

        $comentarios=$stmt->fetch(PDO::FETCH_OBJ);

        return $comentarios;

    }

        public function actualizar($id, $estado){

        $query=' UPDATE '.$this->table.' SET estado=:estado WHERE id=:id';

        //Preparar la sentencia
        $stmt=$this->conn->prepare($query);

        //Vincular Parametro

        $stmt->bindParam(':id',$id,PDO::PARAM_INT);
        $stmt->bindParam(':estado',$estado,PDO::PARAM_BOOL);

        //ejecutar query

        if( $stmt->execute()){
            return true;

        };

        //Si hay error

        printf("error $s\n", $stmt->error);
       
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

    //Obtener comentarios por id de articulo

        public function leerPorId($articulo_id){

        $query=' SELECT c.id as id_comentario, c.comentario as comentario, c.estado as estado, c.fecha_creacion as fecha, c.usuario_id, u.email as nombre_usuario FROM '.$this->table.' c INNER JOIN usuarios u ON u.id=c.usuario_id where c.articulo_id=:articulo_id && c.estado=1';

        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':articulo_id',$articulo_id, PDO::PARAM_INT);

        $resultado=$stmt->execute();
        $comentarios=$stmt->fetchAll(PDO::FETCH_OBJ);

        return $comentarios;
    }

    //Crear un nuevo Comentario

    public function crear($email, $comentario, $idArticulo){

        //Obtener el id del usuario usando el email

        $query=' SELECT * FROM usuarios where email=:email';

        $stmt=$this->conn->prepare($query);

        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        $usuario=$stmt->fetch(PDO::FETCH_OBJ);

        $idUsuario=$usuario->id;

        //Crear query para la insercion del comentario

        $query2='INSERT INTO '.$this->table.' (comentario, usuario_id, articulo_id, estado)values(:comentario, :usuario_id, :articulo_id, 0)';
        
          var_dump($query2);
        $stmt=$this->conn->prepare($query2);

        $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
        $stmt->bindParam(':usuario_id', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':articulo_id', $idArticulo, PDO::PARAM_INT);
      
        if ($stmt->execute()) {
           return true;
        }

        //Si hay error

        printf("error $s", $stmt->error);
        return false;
    }

    }


?>