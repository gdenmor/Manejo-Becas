window.addEventListener("load", function () {
    const solicitar = this.document.getElementsByName("solicita")[0];
    var parametros = new URLSearchParams(this.window.location.search);
    var dni = parametros.get("dni");
    var idConvocatoria = parametros.get("idConvocatoria");

    var candidato = null;


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
    const contenido_registro = this.document.getElementById("contenido-registro");
    const item = [];
    var i = 0;

    fetch("../Manejo-Becas/APIS/apiCandidato.php?dni=" + dni, {
        headers: {
            "Content-type": "application/json"
        },
        method: "GET"
    })
        .then(x => x.json())
        .then(y => {
            var candidato = new CANDIDATO(y.DNI, y.fecha_nacimiento, y.tutor_legal, y.apellido1, y.apellido2, y.nombre, y.contraseña, y.tlf, y.curso, y.correo, y.domicilio, y.rol);
            DNI.value = candidato.DNI;
            nombre.value = candidato.nombre;
            apellido1.value = candidato.apellido1;
            apellido2.value = candidato.apellido2;
            contraseña.value = candidato.contrasena;
            correo.value = candidato.correo;
            domicilio.value = candidato.domicilio;
            rol.value = candidato.rol;
        });

    this.fetch("../Manejo-Becas/APIS/apiConvocatoriaBaremable.php?convocatoria=" + idConvocatoria, {
        headers: {
            "Content-type": "application/json"
        }
    })
        .then(x => x.json())
        .then(y => {
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

            y.forEach(element => {
                var fila = this.document.createElement("tr");
                var td = this.document.createElement("td");
                td.innerHTML = element.baremo.nombre;
                var td2 = this.document.createElement("td");
                if (element.aportaalumno == true && element.baremo) {
                    var file = this.document.createElement("input");
                    file.setAttribute("type", "file");
                    file.classList.add("Archivos");
                    td2.appendChild(file);
                }
                fila.appendChild(td);
                fila.appendChild(td2);
                tbody.appendChild(fila);
                item[i] = new ITEM_BAREMABLE(element.baremo.id_item, element.baremo.nombre);
                i++;
            });
            tabla.appendChild(tbody);
            contenido_registro.appendChild(tabla);
        });

    solicitar.addEventListener("click", function (ev) {
        ev.preventDefault();
        var convocatoria = null;
        fetch("../Manejo-Becas/APIS/apiConvocatoria.php?id=" + idConvocatoria, {
            headers: {
                "Content-type": "application/json"
            }
        })
        .then(x => x.json())
            .then(y => {
                debugger;
                convocatoria = new CONVOCATORIA(idConvocatoria, y.num_movilidades, y.fecha_inicio, y.fecha_fin, y.fechainicioPruebas, y.fechaFinPruebas, y.fechaListadoProvisional, y.fechaListadoDefinitivo, y.Proyecto, y.pais_destino,y.nombre);
                console.log(convocatoria);
                candidato = new CANDIDATO(DNI.value, nacimiento.value, "", apellido1.value, apellido2.value, nombre.value, contraseña.value, tlf.value, curso.value, correo.value, domicilio.value, rol.value);
                var candidato_convocatoria = new CANDIDATO_CONVOCATORIA(null, convocatoria, candidato.DNI, candidato.fecha_nacimiento, candidato.tutor_legal, candidato.apellido1, candidato.apellido2,
                candidato.nombre, candidato.contrasena, candidato.curso, candidato.tlf, candidato.correo, candidato.domicilio, candidato.rol);
                const archivo = document.getElementsByClassName("Archivos");
                for (let i = 0; i < archivo.length; i++) {
                    var formData = new FormData();
                    console.log(archivo[i].files[0]);
                    if (archivo[i].files.length > 0 && archivo[i].files[0].type == "application/pdf") {
                        formData.append("archivo", archivo[i].files[0]);
                        baremacion = new BAREMACION(null, candidato_convocatoria, item[i], null, null);
                        formData.append("baremacion", JSON.stringify(baremacion));
                        console.log(JSON.stringify(baremacion));
                        formData.append("submit", "hola");
                        fetch("../Manejo-Becas/APIS/apiBaremacion.php", {
                            method: "POST",
                            body: formData,
                        })
                    }
                }
                fetch("../Manejo-Becas/APIS/apiCandidatoConvocatoria.php",{
                    method: "POST",
                    body: JSON.stringify(candidato_convocatoria),
                    headers:{
                        "Content-type": "application/json"
                    }
                })
            });


    })
})
