<?php

class Productos extends Controller{

    public function __construct(){
        session_start();
        
        
        parent::__construct();
    }

    public function index(){ //la funcion de este index es mostrar la vista en la pantalla       
        $data['productos'] = $this->model->getProductos(); 
        $data['categoria'] = $this->model->getCategorias();       
        $this->views->getView($this,"index",$data);
    }//final del index

    public function listarProductos(){ 
        $datos= $this->model->getProductos();
        for ($i=0; $i < count($datos); $i++){

            if ($datos[$i]['estado']==1) {
                $datos[$i]['estado'] = '<span class="badge badge-success">Stock</span>';
            }else{
                $datos[$i]['estado'] = '<span class="badge badge-danger">Agotado</span>';
            }

            $datos[$i]['acciones'] = '<div>
                                  <a href="#" class="btn btn-warning" onclick="btnEditarProducto('.$datos[$i]['id'].');">
                                  <span class="fa fa-pencil"></span>
                                </a>
                                <a href="#" class="btn btn-danger" onclick="btnEliminarProducto('.$datos[$i]['id'].');">
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

    public function registrarProducto(){
        $id_categoria = $_POST["categoria"];
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];
        $estado = $_POST["estado"];
        $id = $_POST["id"];

         if (empty($id_categoria)  || empty($nombre)  || empty($descripcion) || empty($cantidad)  || empty($precio) || $estado == -1){
            $msg = "Todos los campos son Obligatorios";        
         }else{
            if ($id == "") {              
                $data = $this->model->registrarProducto($id_categoria, $nombre, $descripcion, $cantidad, $precio,$estado);
                if ($data == "Ok") {
                    $msg = "Si";
                    }else if ($data=="existe") {
                        $msg = "El usuario ya Existe";
                    }else{
                        $msg = "Error al Registrar el Usuario";
                }
            }else{                
                $data = $this->model->modificarProducto($id, $id_categoria, $nombre, $descripcion, $cantidad, $precio,$estado);
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
        $data = $this->model->editarProducto($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function eliminar($id){
        $data = $this->model->eliminarProducto($id);
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