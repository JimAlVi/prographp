<?php 
    class UsuariosModel extends Query{

        public function __construct(){
            parent::__construct();
        }//final contruct
   
       public function getUsuario(string $usuario){
            $sql = "SELECT * FROM usuarios WHERE usuario='$usuario'";
             $data = $this->select($sql);
             return $data;
         }

        public function getUsuarios(){
            $sql = "SELECT u.id as 'idusuario', c.id as idcaja, c.caja, r.id as idrol, r.nombre as nombrerol, u.usuario, u.nombre, u.papellido, u.sapellido, /* u.telefono, */ u.correo, u.estado
                    FROM usuarios as u
                    INNER JOIN caja as c
                    ON u.id_caja = c.id
                    INNER JOIN roles as r
                    ON u.id_rol = r.id;";
            $data = $this->selectAll($sql);         
            return $data;
        }           
        

        public function getCajas(){
            $sql = "SELECT * FROM caja WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        }

        public function getRoles(){
            $sql = "SELECT * FROM roles WHERE estado = 1";
            $data = $this->selectAll($sql);
            return $data;
        } 

        public function registrarUsuario($id_rol, $id_caja, $nombre, $papellido, $sapellido, /* $telefono, */ $correo, $usuario, $clave, $estado){
            $sql = "INSERT INTO usuarios(id_rol, id_caja, nombre, papellido, sapellido, /* telefono, */ correo, usuario, password, estado) values (?,?,?,?,?,/* ?, */?,?,?,?)";
            $datos = array($id_rol, 
            $id_caja,
            $nombre,
            $papellido,
            $sapellido,
            /* $telefono, */
            $correo,
            $usuario,
            $clave,
            $estado 
            );
            $verificar = "SELECT * FROM usuarios where usuario = '$usuario'";
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

        public function modificarUsuario($id,$id_rol, $id_caja, $nombre, $papellido, $sapellido, /* $telefono, */ $correo, $usuario, $clave, $estado){
            $sql = "UPDATE usuarios SET
            id_rol = ?,
            id_caja = ?,
            nombre = ?,
            papellido = ?,
            sapellido = ?,
           /*  telefono = ?, */
            correo = ?,
            usuario = ?,
            password = ?,
            estado = ?
            WHERE id = ?";
            $datos = array($id_rol, 
            $id_caja,
            $nombre,
            $papellido,
            $sapellido,
            /* $telefono, */
            $correo,
            $usuario,
            $clave,
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



        public function editarUser($id){
            $sql = "SELECT * FROM usuarios where id = $id";
            $data = $this->select($sql);
            return $data;
        }


        public function eliminarUsuario($id){
            $sql = "UPDATE usuarios SET
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