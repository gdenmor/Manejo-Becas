function VALIDADOR(){
    

    
}

VALIDADOR.prototype.validaDNI=function(DNI){
    var correcto=false;
        if (DNI!==""){
            partes = (/^(\d{8})([TRWAGMYFPDXBNJZSQVHLCKET])$/i).exec(DNI);
            var letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            
            if (partes) {
                correcto = (letras[parseInt(partes[1]) % 23] === partes[2].toUpperCase());
                correcto=true;
            }
        }

        return correcto;
}

VALIDADOR.prototype.validaNombre=function(nombre){
    if (nombre!=""){
        return true;
    }else{
        return false;
    }
}

VALIDADOR.prototype.validaApellido1=function(apellido1){
    if (apellido1!=""){
        return true;
    }else{
        return false;
    }
}

VALIDADOR.prototype.validaApellido2=function(apellido2){
    if (apellido2!=""){
        return true;
    }else{
        return false;
    }
}

VALIDADOR.prototype.validaCorreo=function(correo){
    if (correo.length!==""){
        var partes=/^(.+)@gmail.com$/i;
        if (partes.test(correo)){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

VALIDADOR.prototype.validaDomicilio=function(domicilio){
    if (domicilio!=""){
        return true;
    }else{
        return false;
    }
}

VALIDADOR.prototype.validaCurso=function(curso){
    if (curso!=""){
        return true;
    }else{
        return false;
    }
}

VALIDADOR.prototype.validaTelefono=function(tlf){
    var regExp=(/^\d{9}$/i);
    if (regExp.test(tlf)){
        return true;
    }else{
        return false;
    }
}

VALIDADOR.prototype.validaRol=function(rol){
    if (rol!=="ALUMNO"){
        return false;
    }else{
        return true;
    }
}