function VALIDADOR(){
    this.validaDNI=function(DNI){
        var correcto=false;
        if (DNI.value!==""){
            partes = (/^(\d{8})([TRWAGMYFPDXBNJZSQVHLCKET])$/i).exec(DNI);
        
            if (partes) {
                correcto = (letras[parseInt(partes[1]) % 23] === partes[2].toUpperCase());
                correcto=true;
            }
        }

        return correcto;
    }

    this.validaNombre=function(nombre){
        if (nombre.value!=""){
            return true;
        }else{
            return false;
        }
    }
}
