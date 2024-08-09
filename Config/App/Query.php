<?php 

class Query extends Conexion{
    private $pdo, $con, $sql, $datos;

    public function __construct(){
        $this->pdo = new Conexion();
        $this->con = $this->pdo->conect();
    }//final construct

    public function select(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }//final select

    public function selectAll(string $sql){
        $this->sql = $sql;
        $result = $this->con->prepare($this->sql);
        $result->execute();
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }//final select

    public function save(string $sql, array $datos){
        $this->sql = $sql;
        $this->datos = $datos;
        $insert = $this->con->prepare($this->sql);
        $data = $insert->execute($this->datos);
        if ($data) {
            $res = 1;
        } else{
            $res = 0;
        }
        return $res;
    }//Registrar Datos
    

}//Final del Class


?>