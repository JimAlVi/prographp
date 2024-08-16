<?php  include "Views/Templates/header.php";  ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Categorías</li>
</ol>
<button class="btn btn-primary" type="button" onclick="frmCategoria();">Agregar</button>
<br/>
<br/>

<table class="table  table-striped" id="tblCategorias">
    <thead class="table-dark">
        <tr>
            <th>id</th>            
            <th>Nombre</th>             
            <th>Estado</th>              
            <th>Acciones</th>              
        </tr>
 
    </thead>
    <tbody>
    
    </tbody>
    
</table>
<div id="nueva_categoria" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">Nueva Categoria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
      <form method="post" id="frmCategoria">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                    <div class="form-group">
                        <label for="Nombre">Nombre Categoria</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Hogar">
                    </div>
                    
                    <div class="form-group">
                        <label for="Estado">Estado</label>
                        <select class="form-control" name="estado" id="estado" >
                            <option value="1">Activa</option>
                            <option value="0">Inactiva</option>
                            <option value="-1" selected="selected">Seleccionar...</option>
                        </select>
                    </div>
                    
                    </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="agregarCategoria(event);" id="btnAccion">Guardar</button>
      </div>
    </div>
  </div>
</div>

<?php  include "Views/Templates/footer.php";  ?>