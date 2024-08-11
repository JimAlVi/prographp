

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
            { "data": "telefono" },
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
    
   

function frmLogin(e){ 
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

function frmUsuario(){ 
    document.getElementById("titulo").innerHTML = "Registrar Usuario";
    document.getElementById("btnAccion").innerHTML = "Guardar";
    document.getElementById("frmusuario").reset();
    document.getElementById("id").value = "";
    $("#nuevo_usuario").modal("show");
}

function registrarUser(e){
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const papellido = document.getElementById("papellido");
    const sapellido = document.getElementById("sapellido");
    const telefono = document.getElementById("telefono");
    const correo = document.getElementById("correo");
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    const caja = document.getElementById("caja");
    const rol = document.getElementById("rol");
    var estado = document.getElementById("estado");
    //seleccion = estado.options[estado.selectedIndex].value;
    //alert(estado);
   

    if (nombre.value == ""  || papellido.value == ""  || sapellido.value == ""  ||telefono.value == ""  ||correo.value == ""  ||usuario.value == ""  ||clave.value == "" ||caja.value == "" ||rol.value == ""||estado == -1) {
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

function btnEditarUser(id){
    document.getElementById("frmusuario").reset();
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
                document.getElementById("telefono").value= res.telefono;
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


function btnEliminarUser(id){
   
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