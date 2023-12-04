function CANDIDATO(DNI,fecha_nacimiento,tutor_legal,apellido1,apellido2,nombre,contrasena,curso,tlf,correo,domicilio,rol){
    this.DNI=DNI;
    this.fecha_nacimiento=fecha_nacimiento;
    this.tutor_legal=tutor_legal;
    this.apellido1=apellido1;
    this.apellido2=apellido2;
    this.nombre=nombre;
    this.contrasena=contrasena;
    this.curso=curso;
    this.tlf=tlf;
    this.correo=correo;
    this.domicilio=domicilio;
    this.rol=rol;
}

CANDIDATO.prototype.esMayorDeEdad=function(){
    const fechaNac = new Date(fechaNacimiento);
    const fechaActual = new Date();

    // Calculamos la diferencia en años
    const edadEnAnios = fechaActual.getFullYear() - fechaNac.getFullYear();

    // Verificamos si la fecha de nacimiento ya ha ocurrido este año
    const nacimientoEsteAnio = new Date(fechaActual.getFullYear(), fechaNac.getMonth(), fechaNac.getDate());
    if (fechaActual < nacimientoEsteAnio) {
        // Si no ha ocurrido aún, restamos un año
        return edadEnAnios - 1 >= 18;
    }

    return edadEnAnios >= 18;
}