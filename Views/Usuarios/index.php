<?php  include "Views/Templates/header.php";  ?>

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Usuarios</li>
</ol>
<button class="btn btn-primary" type="button" onclick="frmUsuario();">Registrar</button>
<br/>
<br/>

<table class="table  table-striped" id="tblUsuarios">
    <thead class="table-dark">
        <tr>
            <th>id</th>
            <th>Caja</th> 
            <th>Rol</th>           
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>            
            <th>Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
            
        </tr>
 
    </thead>
    <tbody>
    
    </tbody>
    
</table>
<div id="nuevo_usuario" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titulo">Nuevo Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          
        </button>
      </div>
      <div class="modal-body">
      <form method="post" id="frmusuario">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                    <div class="form-group">
                        <label for="Nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="Primer_Apellido">Primer Apellido</label>
                        <input type="text" class="form-control" name="papellido" id="papellido" placeholder="Primer Apellido">
                    </div>
                    <div class="form-group">
                        <label for="Segundo_Apellido">Segundo Apellido</label>
                        <input type="text" class="form-control" name="sapellido" id="sapellido" placeholder="Segundo Apellido">
                    </div>
                   <!--  <div class="form-group">
                        <label for="Telefono">Telefono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="8888888">
                    </div> -->
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" class="form-control" name="correo" id="correo" placeholder="ejemplo@ejemplo.com">
                        
                    </div>
                    <div class="form-group">
                        <label for="Usuario">Usuario</label>
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                    </div>
                    <div class="row">
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

                    </div>
                    <div class="form-group">
                        <label for="Caja">Caja</label>
                        <select class="form-control" name="caja" id="caja" >
                            <?php foreach ($data['cajas'] as $row) { ?>

                               <option value="<?php echo $row['id'] ?>"><?php echo $row['caja'] ?></option>
                               <?php } ?>
                               <option value="" selected="selected">Seleccionar...</option>
                        </select>
                    </div>

                  <!--<?php 
                    //echo '<pre>';
                    //print_r($data);  // Esto imprimirá el contenido de $data en la página.
                    //echo '</pre>';
                    ?> -->

                    <div class="form-group">
                        <label for="Rol">Rol</label>
                        <select class="form-control" name="rol" id="rol" >
                            <?php foreach ($data['roles'] as $row) { ?>

                               <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                               <?php } ?>
                               <option value="" selected="selected">Seleccionar...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Estado">Estado</label>
                        <select class="form-control" name="estado" id="estado" >
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                            <option value="-1" selected="selected">Seleccionar...</option>
                        </select>
                    </div>
                    
                    </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="registrarUser(event);" id="btnAccion">Guardar</button>
      </div>
    </div>
  </div>
</div>

<?php  include "Views/Templates/footer.php";  ?>