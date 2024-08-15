<?php 
    class ProductosModel extends Query{

        public function __construct(){
            parent::__construct();
        }//final contruct

       // public function getUsuario(string $usuario, string $clave){
       //     $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$clave'";
       //     $data = $this->select($sql);
       //     return $data;
       // }

       public function getProducto(string $producto){
            $sql = "SELECT * FROM productos WHERE nombre='$producto'";
             $data = $this->select($sql);
             return $data;
         }

        public function getProductos(){
            $sql = "SELECT p.id, cat.id as idcategoria, cat.nombre as nombrecategoria, p.nombre, p.descripcion, p.cantidad, p.precio, p.estado FROM productos as p inner join categorias as cat on p.id_categoria = cat.id";            
            $data = $this->selectAll($sql);         
            return $data;
        }           
        

        public function getCategorias(){
            $sql = "SELECT * FROM categorias WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        } 


     

        public function registrarProducto($id_categoria, $nombre, $descripcion, $cantidad, $precio,$estado){
            $sql = "INSERT INTO productos(id_categoria, nombre, descripcion, cantidad, precio, estado) values (?,?,?,?,?,?)";
            $datos = array( 
            $id_categoria,
            $nombre,
            $descripcion,
            $cantidad,
            $precio,
            $estado 
            );
            $verificar = "SELECT * FROM productos where id = 'id'";
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

        public function modificarProducto($id, $id_categoria, $nombre, $descripcion, $cantidad, $precio,$estado){
            $sql = "UPDATE productos SET
            id_categoria = ?,
            nombre = ?,
            descripcion = ?,
            cantidad = ?,
            precio = ?,
            estado = ?
            WHERE id = ?";
            $datos = array(            
            $id_categoria,
            $nombre,
            $descripcion,
            $cantidad,
            $precio,
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



        public function editarProducto($id){
            $sql = "SELECT * FROM productos where id = $id";
            $data = $this->select($sql);
            return $data;
        }


        public function eliminarProducto($id){
            $sql = /* "UPDATE productos SET
            estado = 0
            WHERE id = ?" */"DELETE FROM productos WHERE id = ?";
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