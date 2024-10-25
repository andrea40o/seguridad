<?php

    class Articulo{
        private $conn;
        private $table="articulos";

        //Propiedades
        public $id;
        public $titulo;
        public $imagen;
        public $texto;
        public $fecha_creacion;

        //Constructor de nuestra clase

        public function __construct($db){

            $this->conn=$db;
            
        }

        //Obtener los articulos
        public function leer(){
            
            //Crear query
            $query='SELECT id,titulo, imagen,texto, fecha_creacion FROM ' . $this->table;

            //Preparar sentencia
            $stmt=$this->conn->prepare($query);

            //Ejecutar query
            $stmt->execute();

            $articulos=$stmt->fetchAll(PDO::FETCH_OBJ);
            
            return $articulos;
        }

            //Obtener articulo individual
             public function leer_individual($id){
            
            //Crear query
            $query='SELECT id,titulo, imagen,texto, fecha_creacion FROM ' . $this->table.' WHERE id= ? LIMIT 0,1';

            //Preparar sentencia
            $stmt=$this->conn->prepare($query);

            
            //Vincular parametro
            $stmt->bindParam(1,$id);

            //Ejecutar query
            $stmt->execute();

            $articulos=$stmt->fetch(PDO::FETCH_OBJ);
            
            return $articulos;
        }

            //Crear articulo
            public function crear($titulo,$NewImageName, $texto){
            
            //Crear query
            $query='INSERT INTO '.$this->table.'(titulo,imagen,texto ) VALUES (:titulo,:imagen, :texto)';

            //Preparar sentencia
            $stmt=$this->conn->prepare($query);

            
            //Vincular parametro
            $stmt->bindParam(":titulo",$titulo, PDO::PARAM_STR);
            $stmt->bindParam(":imagen",$NewImageName, PDO::PARAM_STR);
            $stmt->bindParam(":texto",$texto, PDO::PARAM_STR);

            //Ejecutar query

            if ($stmt->execute()) {
                return true;
            }

            //Si hay error
            printf("error $s\n", $stmt->error);
            $stmt->execute();
        }     
        
        
            //Actualizar articulo
            public function actualizar($id,$titulo,$NewImageName, $texto){
            
            if ($NewImageName == "") {

                //Crear query

                $query='UPDATE '.$this->table.' SET titulo = :titulo, texto= :texto WHERE id=:id';

                //Preparar la sentencia

                 $stmt=$this->conn->prepare($query);

                 //Vincular parametros 

                 $stmt->bindParam(":titulo",$titulo, PDO::PARAM_STR);
                 $stmt->bindParam(":texto",$texto, PDO::PARAM_STR);
                 $stmt->bindParam(":id",$id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            }
            }else {
               $query='UPDATE '.$this->table.' SET titulo=:titulo,imagen=:imagen,texto=:texto WHERE id=:id';
               
               //Preparar sentencia
               $stmt=$this->conn->prepare($query);

              //Vincular parametro
             $stmt->bindParam(":titulo",$titulo, PDO::PARAM_STR);
             $stmt->bindParam(":imagen",$NewImageName, PDO::PARAM_STR);
             $stmt->bindParam(":texto",$texto, PDO::PARAM_STR);
             $stmt->bindParam(":id",$id, PDO::PARAM_INT);

              if ($stmt->execute()) {
                return true;
            }
            }   

            //Ejecutar query

            

            //Si hay error
            printf("error $s\n", $stmt->error);
            $stmt->execute();
        }  


            //Borrar articulo
            public function borrar($id){
            
            //Crear query
            $query='DELETE FROM '.$this->table.' WHERE id=:id';

            //Preparar sentencia
            $stmt=$this->conn->prepare($query);

            var_dump($stmt);
            
            //Vincular parametro
            $stmt->bindParam(":id",$id, PDO::PARAM_INT);

            //Ejecutar query

            if ($stmt->execute()) {
                return true;
            }

            //Si hay error
            printf("error $s\n", $stmt->error);
            $stmt->execute();
        }  
    }

?>