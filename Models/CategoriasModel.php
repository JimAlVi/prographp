<?php 
    class CategoriasModel extends Query{

        public function __construct(){
            parent::__construct();
        }//final contruct

       // public function getUsuario(string $usuario, string $clave){
       //     $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$clave'";
       //     $data = $this->select($sql);
       //     return $data;
       // }

       public function getCategoria(string $categoria){
            $sql = "SELECT * FROM categorias WHERE nombre='$categoria'";
             $data = $this->select($sql);
             return $data;
         }

     /*    public function getCategorias(){
            $sql = "SELECT * FROM categorias inner join categorias on productos.id_categoria = categorias.id";
            $data = $this->selectAll($sql);         
            return $data;
        }   */         
        

        public function getCategorias(){
            $sql = "SELECT * FROM categorias WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        }


     

        public function registrarCategorias($nombre, $estado){
            $sql = "INSERT INTO categorias(nombre,estado) values (?,?)";
            $datos = array( 
            $nombre,
            $estado 
            );
            $verificar = "SELECT * FROM categorias where nombre = '$nombre'";
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

        public function modificarCategoria($id, $nombre, $estado){
            $sql = "UPDATE categorias SET
            nombre = ?,
            estado = ?
            WHERE id = ?";
            $datos = array(
            $nombre,
            $estado,
            );
                $data = $this->save($sql,$datos);
                if ($data == 1) {
                    $res = "modificado";
                }else{
                    $res = "error";
                }
            
                
            
            
           return $res;
        }//Final de la Funcion Modifcar Usuario



        public function editarCategorias($id){
            $sql = "SELECT * FROM categorias where id = $id";
            $data = $this->select($sql);
            return $data;
        }


        public function eliminarCategorias($id){
            $sql = "UPDATE categorias SET
            estado = 0
            WHERE id = ?";
            $datos = array( 
            $id 
            );
                $data = $this->save($sql,$datos);
                if ($data == 1) {
                    $res = "eliminado";
                }else{
                    $res = "error";
                }
            
            
           return $res;
        }//Final de la Funcion Eliminar Usuario

    }//final class UsuariosModel

?>