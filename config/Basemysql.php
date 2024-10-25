<?php

   class Basemysql{
    //Paràmetros base de datos
    private $host='localhost';
    private $db_name='blog';
    private $username='root';
    private $password='';
    private $conn;

    //Conexiòn a la BD

   public function connect(){
      $this->conn=null;

   try {
   $this->conn=new PDO('mysql:host='.$this->host.';dbname='. $this->db_name,$this->username,$this->password);
   } catch (PDOException $e) {
      echo "Error en la conexion:".$e->getMessage();
   }


   return $this->conn;
   }



   }


?>