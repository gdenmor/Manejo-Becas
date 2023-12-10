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
        const correo = document.getElementsByName("correo")[0];
        const domicilio = document.getElementsByName("domicilio")[0];
        const rol = this.document.getElementsByName("rol")[0];
        const nacimiento = this.document.getElementsByName("nacimiento")[0];
        const tlf = this.document.getElementsByName("tlf")[0];
        const curso = this.document.getElementsByName("curso")[0];
        const contenido_registro = this.document.getElementById("contenedor-contenido");
        const item = [];
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
        })
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
                        iframe.style.display = "block";
                        iframe.src = urlArchivo;
                        td2.appendChild(iframe);
                    } else {
                        // Ocultar el iframe si no hay archivo seleccionado
                        iframe.style.display = "none";
                        iframe.src = "";
                    }
                });
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
            file.addEventListener("change", function () {
                const archivoSeleccionado = file.files[0];

                if (archivoSeleccionado) {
                    var iframe1 = document.createElement("iframe");
                    // Obtener la URL del archivo seleccionado
                    const urlArchivo = URL.createObjectURL(archivoSeleccionado);

                    // Mostrar el iframe y establecer la URL
                    iframe1.style.display = "block";
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
        contenido_registro.insertBefore(tabla,this.document.getElementById("btn"));
        //contenido_registro.insertBefore(iframe,this.document.getElementById("btn"));

        solicitar.addEventListener("click", async function (ev) {
            ev.preventDefault();
            try {
                // Obtener convocatoria
                const responseConvocatoria = await fetch('../Manejo-Becas/APIS/apiConvocatoria.php?id=' + idConvocatoria, {
                    headers: {
                        "Content-type": "application/json"
                    }
                });
                const convocatoriaData = await responseConvocatoria.json();
                const convocatoria = new CONVOCATORIA(idConvocatoria, convocatoriaData.num_movilidades, convocatoriaData.fecha_inicio, convocatoriaData.fecha_fin, convocatoriaData.fechainicioPruebas, convocatoriaData.fechaFinPruebas, convocatoriaData.fechaListadoProvisional, convocatoriaData.fechaListadoDefinitivo, convocatoriaData.Proyecto, convocatoriaData.pais_destino, convocatoriaData.nombre);

                // Iniciar transacción
                const inicioTransaccion = await fetch("../Manejo-Becas/APIS/apiinicioTransaccion.php", {
                    method: "POST"
                });
                debugger;


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

                // Enviar solicitud de Candidato_Convocatoria
                const responseCandidatoConvocatoria = await fetch("../Manejo-Becas/APIS/apiCandidatoConvocatoria.php", {
                    method: "POST",
                    body: JSON.stringify(candidato_convocatoria)
                });
                if (responseCandidatoConvocatoria.status === 200) {
                    alert("Solicitud enviada correctamente");

                    const idData = parseInt(await responseCandidatoConvocatoria.json());
                    candidato_convocatoria.id_candidato_convocatoria = idData;

                    // Procesar archivos
                    const archivo = document.getElementsByClassName("Archivos");
                    for (let i = 0; i < archivo.length; i++) {
                        var formData = new FormData();
                        if (archivo[i].files.length > 0 && archivo[i].files[0].type == "application/pdf") {
                            formData.append("archivo", archivo[i].files[0]);
                            var baremacion = new BAREMACION(null, candidato_convocatoria, item[i], null, null);
                            formData.append("baremacion", JSON.stringify(baremacion));
                            console.log(JSON.stringify(baremacion));
                            alert(JSON.stringify(baremacion));
                            formData.append("submit", "hola");
                            fetch("../Manejo-Becas/APIS/apiBaremacion.php", {
                                method: "POST",
                                body: formData,
                            }).then(x => {
                                if (x.status == 200) {
                                    alert("Archivo subido");
                                } else {
                                    alert("Error");
                                }
                            });
                        }
                    }

                    const pdf = await fetch("../Manejo-Becas/APIS/apiCreaPDF.php", {
                        method: "POST",
                        body: JSON.stringify(candidato_convocatoria),
                        headers: {
                            "Content-type": "application/json"
                        }
                    })
                    if (pdf.status == 200) {
                        window.location.reload();
                    }
                } else if (responseCandidatoConvocatoria.status == 400) {
                    alert("Ya ha realizado una solicitud este usuario");
                }
            } catch (error) {
                console.error("Error:", error);
                alert("Error en la transacción");
            }

        })
    }
})
