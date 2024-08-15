<?php  include "Views/Templates/header.php";  ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Productos</li>
</ol>
<button class="btn btn-primary" type="button" onclick="frmProducto();">Agregar</button>
<br/>
<br/>

<table class="table  table-striped" id="tblProductos">
    <thead class="table-dark">
        <tr>
            <th>id</th>
            <th>Categoria</th>
            <th>Nombre</th> 
            <th>Descripcion</th>           
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Estado</th>  
            <th>Acciones</th>
        </tr>
 
    </thead>
    <tbody>
    
    </tbody>
    
</table>
<div id="nuevo_producto" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">Nuevo Producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
      <form method="post" id="frmProducto">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                    <div class="form-group">
                        <label for="Nombre">Nombre Producto</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Pantalon">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Jeans azul talla 36">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input type="text" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad">
                    </div>
                   <!--  <div class="form-group">
                        <label for="Telefono">Telefono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="8888888">
                    </div> -->
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="email" class="form-control" name="precio" id="precio" placeholder="¢15000">                        
                    </div>
                    
                 <!--   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Contrasena">Contrasena</label>
                                <input type="password" class="form-control" name="clave" id="clave" placeholder="Contrasena">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Confirmar">Confirmar Contrasena</label>
                                <input type="password" class="form-control" name="confirmar" id="confirmar" placeholder="Contrasena">
                            </div>
                        </div> 

                    </div> -->
                    <div class="form-group">
                        <label for="Categoria">Categoría</label>
                        <select class="form-control" name="categoria" id="categoria" >
                            <?php foreach ($data['categoria'] as $row) { ?>

                               <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                               <?php } ?>
                               <option value="" selected="selected">Seleccionar...</option>
                        </select>
                    </div>

                 <!--  <?php 
                    //echo '<pre>';
                    //print_r($data['categoria']);  // Esto imprimirá el contenido de $data en la página.
                    //print_r($data['productos']);  // Esto imprimirá el contenido de $data en la página.
                    //echo '</pre>';
                    ?>  -->                   

                    <div class="form-group">
                        <label for="Estado">Estado</label>
                        <select class="form-control" name="estado" id="estado" >
                            <option value="1">En Stock</option>
                            <option value="0">Agotado</option>
                            <option value="-1" selected="selected">Seleccionar...</option>
                        </select>
                    </div>
                    
                    </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="agregarProducto(event);" id="btnAccion">Guardar</button>
      </div>
    </div>
  </div>
</div>

<?php  include "Views/Templates/footer.php";  ?>