<?php

class Categorias extends Controller{

    public function __construct(){
        session_start();       
        
        parent::__construct();
    }

    public function index(){ //la funcion de este index es mostrar la vista en la pantalla     
        $data= $this->model->getCategorias();       
        $this->views->getView($this,"index",$data);
    }//final del index

    public function listarCategorias(){ 
        $datos= $this->model->getCategorias();
        for ($i=0; $i < count($datos); $i++){

            if ($datos[$i]['estado']==1) {
                $datos[$i]['estado'] = '<span class="badge badge-success">Habilitada</span>';
            }else{
                $datos[$i]['estado'] = '<span class="badge badge-danger">Deshabilitada</span>';
            }

            $datos[$i]['acciones'] = '<div>
                                  <a href="#" class="btn btn-warning" onclick="btnEditarCategoria('.$datos[$i]['id'].');">
                                  <span class="fa fa-pencil"></span>
                                </a>
                                <a href="#" class="btn btn-danger" onclick="btnEliminarCategoria('.$datos[$i]['id'].');">
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

    public function registrarCategoria(){        
        $nombre = $_POST["nombre"];      
        $estado = $_POST["estado"];
        $id = $_POST["id"];

         if (empty($nombre)  || $estado == -1){
            $msg = "Todos los campos son Obligatorios";        
         }else{
            if ($id == "") {              
                $data = $this->model->registrarCategoria($nombre,$estado);
                if ($data == "Ok") {
                    $msg = "Si";
                    }else if ($data=="existe") {
                        $msg = "El usuario ya Existe";
                    }else{
                        $msg = "Error al Registrar el Usuario";
                }
            }else{                
                $data = $this->model->modificarCategoria($id, $nombre, $estado);
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
        $data = $this->model->editarCategoria($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarCategoria($id);
        if ($data == "eliminado") {
            $msg = "Eliminado";
            }else {
                $msg = "Error al Eliminar el Producto";
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