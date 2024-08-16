<?php 
    class CategoriasModel extends Query{

        public function __construct(){
            parent::__construct();
        }//final contruct
       

       public function getCategoria(string $nombre){
            $sql = "SELECT * FROM categorias WHERE nombre='$nombre'";
             $data = $this->select($sql);
             return $data;
         }

        public function getCategorias(){
            $sql = "SELECT * FROM categorias";            
            $data = $this->selectAll($sql);         
            return $data;
        }           
          
        public function registrarCategoria($nombre,$estado){
            $sql = "INSERT INTO categorias(nombre,estado) values (?,?)";
            $datos = array( 
            $nombre,
            $estado 
            );
            $verificar = "SELECT * FROM categorias where id = 'id'";
            $existe = $this->select($verificar);
            if (empty($existe)) {
                $data = $this->save($sql,$datos);
                if ($data == 1) {
                    $res = "Ok";
                }else{
                    $res = "error";
                }
            }else{
                $res = "existe";
            }
            
           return $res;
        }//Final de la Funcion Registrar Usuario

        public function modificarCategoria($id,$nombre,$estado){
            $sql = "UPDATE categorias SET
            nombre = ?,
            estado = ?
            WHERE id = ?";
            $datos = array(            
            $nombre,
            $estado,
            $id
            );
                $data = $this->save($sql,$datos);
                if ($data == 1) {
                    $res = "modificado";
                }else{
                    $res = "error";
                }
            
                
            
            
           return $res;
        }//Final de la Funcion Modifcar Usuario



        public function editarCategoria($id){
            $sql = "SELECT * FROM categorias where id = $id";
            $data = $this->select($sql);
            return $data;
        }


        public function eliminarCategoria($id){
            $sql = "DELETE FROM categorias WHERE id = ?";
            $datos = array( 
            $id 
            );
                $data = $this->delete($sql,$datos);
                if ($data == 1) {
                    $res = "eliminado";
                }else{
                    $res = "error";
                }
            
            
           return $res;
        }//Final de la Funcion Eliminar Usuario

    }//final class UsuariosModel

?>