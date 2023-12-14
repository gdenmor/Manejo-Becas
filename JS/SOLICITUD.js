window.addEventListener("load", async function () {
    if (window.location.href.includes("solicitud")) {
        const solicitar = this.document.getElementsByName("solicita")[0];
        var parametros = new URLSearchParams(this.window.location.search);
        var dni = parametros.get("dni");
        var idConvocatoria = parametros.get("idConvocatoria");

        //sacamos los datos introducidos
        const DNI = document.getElementsByName("DNI")[0];
        const nombre = document.getElementsByName("nombre")[0];
        const apellido1 = document.getElementsByName("apellido1")[0];
        const apellido2 = document.getElementsByName("apellido2")[0];
        const contraseña = document.getElementsByName("contraseña")[0];
        contraseña.style.disabled=true;
        const correo = document.getElementsByName("correo")[0];
        const domicilio = document.getElementsByName("domicilio")[0];
        const rol = this.document.getElementsByName("rol")[0];
        const nacimiento = this.document.getElementsByName("nacimiento")[0];
        const tlf = this.document.getElementsByName("tlf")[0];
        const curso = this.document.getElementsByName("curso")[0];
        const contenido_registro = this.document.getElementById("contenedor-contenido");
        const item = [];
        debugger;
        var errorDNI=document.getElementById("errorDNI");
        errorDNI.firstElementChild.innerHTML="";
        var errorNombre=document.getElementById("errorNombre");
        errorNombre.firstElementChild.innerHTML="";
        var errorApellido1=document.getElementById("errorApellido1");
        var errorContraseña=document.getElementById("errorContraseña");
        var errorCorreo=document.getElementById("errorCorreo");
        var errorDomicilio=document.getElementById("errorDomicilio");
        var errorCurso=document.getElementById("errorCurso");
        var errorTlf=document.getElementById("errorTlf");



        
        var i = 0;

        const fetchcandidato = await fetch("../Manejo-Becas/APIS/apiCandidato.php?dni=" + dni, {
            headers: {
                "Content-type": "application/json"
            },
            method: "GET"
        })

        const jsonCandidato = await fetchcandidato.json();
        const candidato = new CANDIDATO(jsonCandidato.DNI, jsonCandidato.fecha_nacimiento, jsonCandidato.tutor_legal, jsonCandidato.apellido1, jsonCandidato.apellido2, jsonCandidato.nombre, jsonCandidato.contraseña, jsonCandidato.curso, jsonCandidato.tlf, jsonCandidato.correo, jsonCandidato.domicilio, jsonCandidato.rol);
        const cursoApi = await this.fetch("../Manejo-Becas/APIS/apiDestinatarioConvocatoria.php?id="+candidato.curso, {
            headers: {
                "Content-type": "application/json"
            }
        });
        const JSONcurso = await cursoApi.json();
        DNI.value = candidato.DNI;
        nombre.value = candidato.nombre;
        apellido1.value = candidato.apellido1;
        apellido2.value = candidato.apellido2;
        contraseña.value = candidato.contrasena;
        correo.value = candidato.correo;
        domicilio.value = candidato.domicilio;
        rol.value = candidato.rol;
        curso.value = JSONcurso.destinatario.codigo_grupo;

        const apiConvocatoriaBaremable = await fetch("../Manejo-Becas/APIS/apiConvocatoriaBaremable.php?convocatoria=" + idConvocatoria, {
            headers: {
                "Content-type": "application/json"
            }
        });
        const jsonConvocatoriaBaremable = await apiConvocatoriaBaremable.json();
        
        const apiConvocatoriaBaremableIdioma = await fetch("../Manejo-Becas/APIS/apiConvocatoriaBaremableIdioma.php?id=" + idConvocatoria, {
            headers: {
                "Content-type": "application/json"
            }
        })
        const jsonConvocatoriaBaremableIdioma = await apiConvocatoriaBaremableIdioma.json();
        var tabla = this.document.createElement("table");
        var tbody = this.document.createElement("tbody");
        var thead = this.document.createElement("thead");
        var tr = this.document.createElement("tr");
        var th = this.document.createElement("th");
        th.innerHTML = "Baremo";
        var th2 = this.document.createElement("th");
        th2.innerHTML = "Aporta Alumno";
        tr.appendChild(th);
        tr.appendChild(th2);
        thead.appendChild(tr);
        tabla.appendChild(thead);

        jsonConvocatoriaBaremable.forEach(element => {
            var fila = this.document.createElement("tr");
            var td = this.document.createElement("td");
            td.innerHTML = element.baremo.nombre;
            var td2 = this.document.createElement("td");
            if (element.aportaalumno == true && element.baremo) {
                var file = this.document.createElement("input");
                file.setAttribute("type", "file");
                file.classList.add("Archivos");
                td2.appendChild(file);
                file.addEventListener("change", function () {
                    const archivoSeleccionado = file.files[0];

                    if (archivoSeleccionado) {
                        var iframe = document.createElement("iframe");
                        // Obtener la URL del archivo seleccionado
                        const urlArchivo = URL.createObjectURL(archivoSeleccionado);

                        // Mostrar el iframe y establecer la URL
                        iframe.style.display = "flex";
                        iframe.src = urlArchivo;
                        td2.appendChild(iframe);
                    } else {
                        // Ocultar el iframe si no hay archivo seleccionado
                        iframe.style.display = "none";
                        iframe.src = "";
                    }
                });
                td2.style.display="flex";
            }
            fila.appendChild(td);
            fila.appendChild(td2);
            tbody.appendChild(fila);
            item[i] = new ITEM_BAREMABLE(element.baremo.id_item, element.baremo.nombre);
            i++;
        });
            var tr=this.document.createElement("tr");
            var td=this.document.createElement("td");
            var td1=this.document.createElement("td");
            td.innerHTML=jsonConvocatoriaBaremableIdioma[0].id_baremo.nombre;
            var file=this.document.createElement("input");
            file.setAttribute("type","file");
            file.classList.add("Archivos");
            td1.appendChild(file);
            td1.style.display="flex"
            file.addEventListener("change", function () {
                const archivoSeleccionado = file.files[0];

                if (archivoSeleccionado) {
                    var iframe1 = document.createElement("iframe");
                    // Obtener la URL del archivo seleccionado
                    const urlArchivo = URL.createObjectURL(archivoSeleccionado);

                    // Mostrar el iframe y establecer la URL
                    iframe1.style.display = "flex";
                    iframe1.src = urlArchivo;
                    td1.appendChild(iframe1);
                } else {
                    // Ocultar el iframe si no hay archivo seleccionado
                    iframe1.style.display = "none";
                    iframe1.src = "";
                }
            });
            tr.appendChild(td);
            tr.appendChild(td1);
            tbody.appendChild(tr);
        tabla.appendChild(tbody);
        contenido_registro.appendChild(tabla);
        item[item.length]=jsonConvocatoriaBaremableIdioma[0].id_baremo;
        tabla.style.marginTop="5%";

        solicitar.addEventListener("click", async function (ev) {
            ev.preventDefault();
            try {
                var validador=new VALIDADOR();
                var num_errores=0;
                if (validador.validaDNI(DNI.value)){
                    errorDNI.firstElementChild.innerHTML="";
                }else{
                    num_errores++;
                    errorDNI.firstElementChild.innerHTML="El DNI no es válido";
                    errorDNI.firstElementChild.style.color="red";
                    errorDNI.firstElementChild.style.marginLeft="30%";
                }

                if (validador.validaNombre(nombre.value)==true){
                    errorNombre.firstElementChild.innerHTML="El nombre no es válido";
                }else{
                    num_errores++;
                    errorNombre.firstElementChild.innerHTML="El nombre no es válido";
                    errorNombre.firstElementChild.style.color="red";
                    errorNombre.firstElementChild.style.marginLeft="30%";
                }

                if (validador.validaApellido1(apellido1.value)==true){
                    errorApellido1.firstElementChild.innerHTML="";
                }else{
                    num_errores++;
                    errorApellido1.firstElementChild.innerHTML="El apellido no es válido";
                    errorApellido1.firstElementChild.style.color="red";
                    errorApellido1.firstElementChild.style.marginLeft="30%";
                }

                if (validador.validaCorreo(correo.value)){
                    errorCorreo.firstElementChild.innerHTML="";
                }else{
                    num_errores++;
                    errorCorreo.firstElementChild.innerHTML="El correo no es válido";
                    errorCorreo.firstElementChild.style.color="red";
                    errorCorreo.firstElementChild.style.marginLeft="30%";
                }

                if (validador.validaDomicilio(domicilio.value)){
                    errorDomicilio.firstElementChild.innerHTML="";
                }else{
                    num_errores++;
                    errorDomicilio.firstElementChild.innerHTML="El domicilio no es válido";
                    errorDomicilio.firstElementChild.style.color="red";
                    errorDomicilio.firstElementChild.style.marginLeft="30%";
                }

                if (validador.validaCurso(curso.value)){
                    errorCurso.firstElementChild.innerHTML="";
                }else{
                    num_errores++;
                    errorCurso.firstElementChild.innerHTML="El curso no es válido";
                    errorCurso.firstElementChild.style.color="red";
                    errorCurso.firstElementChild.style.marginLeft="30%";
                }

                if (validador.validaTelefono(tlf.value)){
                    errorTlf.firstElementChild.innerHTML="";
                }else{
                    num_errores++;
                    errorTlf.firstElementChild.innerHTML="El teléfono no es válido";
                    errorTlf.firstElementChild.style.color="red";
                    errorTlf.firstElementChild.style.marginLeft="18%";
                }

                if (validador.validaRol(rol.value)){
                    errorRol.firstElementChild.innerHTML="";
                }else{
                    num_errores++;
                    errorRol.firstElementChild.innerHTML="El rol no es válido";
                    errorRol.firstElementChild.style.color="red";
                    errorRol.firstElementChild.style.marginLeft="30%";
                }

                
                
                if (num_errores==0){
                    const responseConvocatoria = await fetch('../Manejo-Becas/APIS/apiConvocatoria.php?id=' + idConvocatoria, {
                        headers: {
                            "Content-type": "application/json"
                        }
                    });
                    const convocatoriaData = await responseConvocatoria.json();
                    const convocatoria = new CONVOCATORIA(idConvocatoria, convocatoriaData.num_movilidades, convocatoriaData.fecha_inicio, convocatoriaData.fecha_fin, convocatoriaData.fechainicioPruebas, convocatoriaData.fechaFinPruebas, convocatoriaData.fechaListadoProvisional, convocatoriaData.fechaListadoDefinitivo, convocatoriaData.Proyecto, convocatoriaData.pais_destino, convocatoriaData.nombre);
    
    
    
                    const candidato_convocatoria = new CANDIDATO_CONVOCATORIA(
                        null,
                        convocatoria,
                        DNI.value,
                        candidato.fecha_nacimiento,
                        candidato.tutor_legal,
                        apellido1.value,
                        apellido2.value,
                        nombre.value,
                        contraseña.value,
                        JSONcurso.destinatario,
                        tlf.value,
                        correo.value,
                        domicilio.value,
                        rol.value
                    );

                    const baremacionData = [];
                    const archivos = document.getElementsByClassName("Archivos");
                    for (let i = 0; i < archivos.length; i++) {
                        var baremacionItem = {
                            item: item[i],
                            nota: null, // Debes obtener la nota de alguna manera, por ejemplo, de un input
                            url: null // También debes obtener la URL
                        };
                        baremacionData.push(baremacionItem);
                    }

                    var formData=new FormData();
                    formData.append("json",JSON.stringify({candidato_convocatoria: candidato_convocatoria,
                        baremacion: baremacionData}));
    
                        for (let i = 0; i < baremacionData.length; i++) {
                            const archivoSeleccionado = archivos[i].files[0];
                            if (archivoSeleccionado) {
                                formData.append("archivo[]", archivoSeleccionado);
                            }
                        }
                    // Enviar solicitud de Candidato_Convocatoria
                    const responseCandidatoConvocatoria = await fetch("../Manejo-Becas/APIS/apiCandidatoConvocatoria.php", {
                        method: "POST",
                        body: formData
                    });
                    if (responseCandidatoConvocatoria.status === 200) {
                        window.location.href="http://localhost/Manejo-Becas/index.php?menu=alumno";
                    }
                }
                
            } catch (error) {
                alert("Ha ocurrido un error inesperado. Inténtelo de nuevo");
                window.location.reload();
            }

        })
    }
})
