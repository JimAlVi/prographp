<?php

class Usuarios extends Controller{

    public function __construct(){
        session_start();
        //if (empty($_SESSION['activo'])) {
          //  header("location: ".base_url);
        //}
        
        parent::__construct();
    }

    public function index(){ //la funcion de este index es mostrar la vista en la pantalla       
        $data['cajas'] = $this->model->getCajas();
        $data['roles'] = $this->model->getRoles();
        $this->views->getView($this,"index",$data);
    }//final del index

    public function listar(){ 
        $datos= $this->model->getUsuarios();
        for ($i=0; $i < count($datos); $i++){

            if ($datos[$i]['estado']==1) {
                $datos[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
            }else{
                $datos[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
            }

            $datos[$i]['acciones'] = '<div>
                                  <a href="#" class="btn btn-warning" onclick="btnEditarUser('.$datos[$i]['idusuario'].');">
                                  <span class="fa fa-pencil"></span>
                                </a>
                                <a href="#" class="btn btn-danger" onclick="btnEliminarUser('.$datos[$i]['idusuario'].');">
                                  <span class="fa fa-remove"></span>
                                </div>';
        }
      
        $response = array(
            "data" => $datos
        );

        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        //echo $filtro;
        die();
    }

    public function validar(){
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $msg = "Los campos estan vacios";
        }else{
            $usuario = $_POST['usuario'];
            $clave = $_POST['clave'];
            

            $data = $this->model->getUsuario($usuario);
            if ($data){
                $estado = password_verify($clave, $data['password']);
                if ($estado == true) {
                    $_SESSION['id_usuario'] = $data['id'];
                    $_SESSION['usuario'] = $data['usuario'];
                    $_SESSION['nombre'] = $data['nombre']." ".$data['papellido']." ".$data['sapellido'];
                    //$_SESSION['id_rol'] = $data['id_rol'];
                    $_SESSION['activo'] = true;
                    $msg = "ok";
                }else{
                    $msg = "Usuario o contrasena incorrecta";
                }
                
            }else{
                $msg = "Usuario no existe";
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar(){
         $nombre = $_POST["nombre"];
         $papellido = $_POST["papellido"];
         $sapellido = $_POST["sapellido"];
         /* $telefono = $_POST["telefono"]; */
         $correo = $_POST["correo"];
         $usuario = $_POST["usuario"];
         $clave = $_POST["clave"];
         $confirmar = $_POST["confirmar"];         
         $caja = $_POST["caja"];
         $rol = $_POST["rol"];
         $estado = $_POST["estado"];
         $id = $_POST["id"];
         if (empty($nombre)  || empty($papellido)  || empty($sapellido)  /* || empty($telefono)   */|| empty($correo)  || empty($usuario)  || empty($clave) || empty($caja) || empty($rol) || $estado == -1){
            $msg = "Todos los campos son Obligatorios";
         }else if($clave != $confirmar){
            $msg = "Las contrasenas no coinciden";
         }else{
            if ($id == "") {
                $opciones = [
                    'cost' => 4,
                ];
                 $pass = password_hash($clave, PASSWORD_BCRYPT, $opciones);  
                  
                
                $data = $this->model->registrarUsuario($rol, $caja, $nombre, $papellido, $sapellido, /* $telefono, */ $correo, $usuario, $pass, $estado);
                if ($data == "Ok") {
                    $msg = "Si";
                    }else if ($data=="existe") {
                        $msg = "El usuario ya Existe";
                    }else{
                        $msg = "Error al Registrar el Usuario";
                }
            }else{
                $opciones = [
                    'cost' => 4,
                ];
                 $pass = password_hash($clave, PASSWORD_BCRYPT, $opciones);
                $data = $this->model->modificarUsuario($id,$rol, $caja, $nombre, $papellido, $sapellido, /* $telefono, */ $correo, $usuario, $pass, $estado);
                if ($data == "modificado") {
                    $msg = "Modificado";
                    }else {
                        $msg = "Error al Modificar el Usuario";
                }

            }
         }
         echo json_encode($msg, JSON_UNESCAPED_UNICODE);
         die();
    }

    public function editar($id){
        $data = $this->model->editarUser($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarUsuario($id);
        if ($data == "eliminado") {
            $msg = "Eliminado";
            }else {
                $msg = "Error al Eliminar el Usuario";
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
   
    public function salir(){
        session_destroy();
        header("location: ".base_url);
    }

}//final del class

?>