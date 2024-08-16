

$('document').ready(function()
{
 document.getElementById("usuario").value = "";
 document.getElementById("clave").value = "";

    $('#tblUsuarios').DataTable({
        processing: true,
        searching: true,
        "ajax": {
            "url": base_url + "Usuarios/listar",
            "type": "POST"
        },
        "columns": [
            { "data": "idusuario" },
            { "data": "caja" },
            { "data": "nombrerol" },
            { "data": "usuario" },
            { "data": "nombre" },
            { "data": "papellido" },
            { "data": "sapellido" },
            /* { "data": "telefono" }, */
            { "data": "correo" },
            { "data": "estado" },
            { "data": "acciones" }
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });

    
});  
   

function frmLogin(e){ //funcion para validar el formulario de login
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");

    if (usuario.value == "") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    }else if(clave.value == ""){
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    }else{
        alert("ingresa");
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                alert("Antes res");
                const res = JSON.parse(this.responseText);
                alert(res);
                if (res == "ok") {
                    window.location = base_url + "Usuarios";
                }else{
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res;
                }
            }
        }//onreadystatechange
    }
}

function frmUsuario(){ //funcion para abrir el modal de registro de usuario
    document.getElementById("titulo").innerHTML = "Registrar Usuario";
    document.getElementById("btnAccion").innerHTML = "Guardar";
    document.getElementById("frmusuario").reset();
    document.getElementById("id").value = "";
    $("#nuevo_usuario").modal("show");
}

function registrarUser(e){ //funcion para registrar un usuario
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const papellido = document.getElementById("papellido");
    const sapellido = document.getElementById("sapellido");
    /* const telefono = document.getElementById("telefono"); */
    const correo = document.getElementById("correo");
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    const rol = document.getElementById("rol");
    var estado = document.getElementById("estado");
    //seleccion = estado.options[estado.selectedIndex].value;
    //alert(estado);
   

    if (nombre.value == ""  || papellido.value == ""  || sapellido.value == ""  /* ||telefono.value == ""  */ ||correo.value == ""  ||usuario.value == ""  ||clave.value == "" ||caja.value == "" ||rol.value == ""||estado == -1) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los Campos son Obligatorios",
            showConfirmButton: false,
            timer: 2000
          });
    }else if(clave.value != confirmar.value){
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Las Claves no coinciden",
            showConfirmButton: false,
            timer: 2000
          });
    }else{
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmusuario");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                //alert(res);
                if(res == "El usuario ya Existe"){
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Usuario ya existe",
                        showConfirmButton: false,
                        timer: 2000
                      });
                }else{
                    if (res == "Si") {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Usuario Registrado con Exito",
                            showConfirmButton: false,
                            timer: 2000
                          });
                          frm.reset();
                          $("#nuevo_usuario").modal("hide");
                          $('#tblUsuarios').DataTable().ajax.reload();
                    }else if (res == "Modificado") {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Usuario Modificado con Exito",
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#nuevo_usuario").modal("hide");
                            $('#tblUsuarios').DataTable().ajax.reload();
                        
                    } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: res,
                                showConfirmButton: false,
                                timer: 2000
                            });
                    }
                }
                
            }
        }//onreadystatechange
    }
}

function btnEditarUser(id){ //funcion para abrir el modal de edicion de usuario
    document.getElementById("frmusuario").reset();//limpia el formulario de la ventana modal
    document.getElementById("titulo").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Editar";

        const url = base_url + "Usuarios/editar/"+id;
        
        const http = new XMLHttpRequest();
        http.open("GET",url,true);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("papellido").value= res.papellido;
                document.getElementById("sapellido").value= res.sapellido;
                /* document.getElementById("telefono").value= res.telefono; */
                document.getElementById("correo").value= res.correo;
                document.getElementById("usuario").value= res.usuario;
                //document.getElementById("clave")= res.clave;
                document.getElementById("rol").value= res.id_rol;
                document.getElementById("caja").value= res.id_caja;
                document.getElementById("estado").value= res.estado; 
                $("#nuevo_usuario").modal("show");
              //console.log(this.responseText);
                
            }
        }//onreadystatechange    
}


function btnEliminarUser(id){ //funcion para eliminar un usuario
   
        const url = base_url + "Usuarios/eliminar/"+id;
        
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                //console.log(this.responseText);
                if(res == "Eliminado"){
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Usuario se ha Desactivado",
                        showConfirmButton: false,
                        timer: 2000
                      });
                      $('#tblUsuarios').DataTable().ajax.reload();
                }else{
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Usuario no se a desactivado",
                        showConfirmButton: false,
                        timer: 2000
                      });     
                
            }

              //console.log(this.responseText);
                
            }
        }//onreadystatechange

    
}

/* --------------------------PRODUCTOS-------------------------------------------------- */
$('document').ready(function()
{
 /* document.getElementById("usuario").value = "";
 document.getElementById("clave").value = ""; */

    $('#tblProductos').DataTable({
        processing: true,
        searching: true,
        "ajax": {
            "url": base_url + "Productos/listarProductos",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "nombrecategoria" },
            { "data": "nombre" },
            { "data": "descripcion" },
            { "data": "cantidad" },
            { "data": "precio" },
            { "data": "estado" },   
            { "data": "acciones" },   
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });

    
});

function frmProducto(){ //funcion para abrir el modal de registro de producto
    document.getElementById("titulo").innerHTML = "Agregar Producto";
    document.getElementById("btnAccion").innerHTML = "Guardar";
    document.getElementById("frmProducto").reset();
    document.getElementById("id").value = "";
    $("#nuevo_producto").modal("show");//cambiar por el modal de productos
}

function agregarProducto(e){ //funcion para agregar un producto nuevo
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const descripcion = document.getElementById("descripcion");
    const cantidad = document.getElementById("cantidad"); 
    const precio = document.getElementById("precio");
    const categoria = document.getElementById("categoria");  
    var estado = document.getElementById("estado");
    //seleccion = estado.options[estado.selectedIndex].value;
    //alert(estado);
   

    if (nombre.value == ""  || descripcion.value == ""  || cantidad.value == "" ||precio.value == ""  ||categoria.value == "" ||estado == -1) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los Campos son Obligatorios",
            showConfirmButton: false,
            timer: 2000
          });    
    }else{
        const url = base_url + "Productos/registrarProducto";
        const frm = document.getElementById("frmProducto");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log("Respuesta del servidor:", this.responseText);
                let res;
                try {
                    res = JSON.parse(this.responseText);
                } catch (e) {
                    res = this.responseText; // Si no es un JSON, usar la respuesta como string
                }
           
                if(res == "El usuario ya Existe"){
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Usuario ya existe",
                        showConfirmButton: false,
                        timer: 2000
                      });
                }else{
                    if (res == "Si") {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Usuario Registrado con Exito",
                            showConfirmButton: false,
                            timer: 2000
                          });
                          frm.reset();
                          $("#nuevo_producto").modal("hide");
                          $('#tblProductos').DataTable().ajax.reload();
                    }else if (res == "Modificado") {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Producto Modificado con Exito",
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#nuevo_producto").modal("hide");
                            $('#tblProductos').DataTable().ajax.reload();
                        
                    } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: res,
                                showConfirmButton: false,
                                timer: 2000
                            });
                    }
                }
                
            }
        }//onreadystatechange
    }
}
function btnEditarProducto(id){ //funcion para abrir el modal de edicion de producto
    document.getElementById("frmProducto").reset();
    document.getElementById("titulo").innerHTML = "Editar Producto";
    document.getElementById("btnAccion").innerHTML = "Editar";

        const url = base_url + "Productos/editar/"+id;
        
        const http = new XMLHttpRequest();
        http.open("GET",url,true);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("nombre").value = res.nombre;
                document.getElementById("descripcion").value= res.descripcion;
                document.getElementById("cantidad").value= res.cantidad;              
                document.getElementById("precio").value= res.precio;
                document.getElementById("categoria").value= res.id_categoria
                document.getElementById("estado").value= res.estado; 
                $("#nuevo_producto").modal("show");
              //console.log(this.responseText);
                
            }
        }//onreadystatechange    
}

function btnEliminarProducto(id){ //funcion para eliminar un producto
   
    const url = base_url + "Productos/eliminar/"+id;
    
    const http = new XMLHttpRequest();
    http.open("POST",url,true);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            //console.log(this.responseText);
            if(res == "Eliminado"){
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Producto se ha eliminado",
                    showConfirmButton: false,
                    timer: 2000
                  });
                  $('#tblProductos').DataTable().ajax.reload();
            }else{
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Producto no se a eliminado",
                    showConfirmButton: false,
                    timer: 2000
                  });
            
        }

          //console.log(this.responseText);
            
        }
    }//onreadystatechange


}

/*--------------------------CATEGORIAS-------------------------------------------------- */

$('document').ready(function()
{

    $('#tblCategorias').DataTable({
        processing: true,
        searching: true,
        "ajax": {
            "url": base_url + "Categorias/listarCategorias",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },        
            { "data": "nombre" },          
            { "data": "estado" },   
            { "data": "acciones" },   
        ],
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });

    
});

function frmCategoria(){ //funcion para abrir el modal de registro de categoria
    document.getElementById("titulo").innerHTML = "Agregar Categoria";
    document.getElementById("btnAccion").innerHTML = "Guardar";
    document.getElementById("frmCategoria").reset();
    document.getElementById("id").value = "";
    $("#nueva_categoria").modal("show");//cambiar por el modal de categorias
}

function agregarCategoria(e){ //funcion para agregar una categoria nueva
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    var estado = document.getElementById("estado");   

    if (nombre.value == ""  ||estado == -1) {
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Todos los Campos son Obligatorios",
            showConfirmButton: false,
            timer: 2000
          });    
    }else{
        const url = base_url + "Categorias/registrarCategoria";
        const frm = document.getElementById("frmCategoria");
        const http = new XMLHttpRequest();
        http.open("POST",url,true);
        http.send(new FormData(frm));
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log("Respuesta del servidor:", this.responseText);
                let res;
                try {
                    res = JSON.parse(this.responseText);
                } catch (e) {
                    res = this.responseText; // Si no es un JSON, usar la respuesta como string
                }              
                if(res == "El usuario ya Existe"){
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Usuario ya existe",
                        showConfirmButton: false,
                        timer: 2000
                      });
                }else{
                    if (res == "Si") {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Usuario Registrado con Exito",
                            showConfirmButton: false,
                            timer: 2000
                          });
                          frm.reset();
                          $("#nueva_categoria").modal("hide");
                          $('#tblCategorias').DataTable().ajax.reload();
                    }else if (res == "Modificado") {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Producto Modificado con Exito",
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#nueva_categoria").modal("hide");
                            $('#tblCategorias').DataTable().ajax.reload();
                        
                    } else {
                            Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: res,
                                showConfirmButton: false,
                                timer: 2000
                            });
                    }
                }
                
            }
        }//onreadystatechange
    }
}
function btnEditarCategoria(id){ //funcion para abrir el modal de edicion de categoria
    document.getElementById("frmCategoria").reset();
    document.getElementById("titulo").innerHTML = "Editar Categoria";
    document.getElementById("btnAccion").innerHTML = "Editar";

        const url = base_url + "Categorias/editar/"+id;
        
        const http = new XMLHttpRequest();
        http.open("GET",url,true);
        http.send();
        http.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                const res = JSON.parse(this.responseText);
                document.getElementById("id").value = res.id;
                document.getElementById("nombre").value = res.nombre;                
                document.getElementById("estado").value= res.estado; 
                $("#nueva_categoria").modal("show");
              //console.log(this.responseText);
                
            }
        }//onreadystatechange    
}

function btnEliminarCategoria(id){ //funcion para eliminar una categoria
   
    const url = base_url + "Categorias/eliminar/"+id;
    
    const http = new XMLHttpRequest();
    http.open("POST",url,true);
    http.send();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            const res = JSON.parse(this.responseText);
            //console.log(this.responseText);
            if(res == "Eliminado"){
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Producto se ha eliminado",
                    showConfirmButton: false,
                    timer: 2000
                  });
                  $('#tblCategorias').DataTable().ajax.reload();
            }else{
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Producto no se a eliminado",
                    showConfirmButton: false,
                    timer: 2000
                  });
            
        }

          //console.log(this.responseText);
            
        }
    }//onreadystatechange


}