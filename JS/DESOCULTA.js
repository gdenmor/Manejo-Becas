window.addEventListener("load",function(){

    if (window.location.href.includes("admin")) {

    const tabla=this.document.getElementById("tabla-baremo");

    const filas=tabla.getElementsByTagName("tr");

    for (let i=0;i<filas.length;i++){
        const fila=filas[i];
        const tds=fila.getElementsByTagName("td");
        for (let j=0;j<tds.length;j++){
            if (j==0){
                var indice=j;
                var boton=tds[indice].firstElementChild;
                boton.addEventListener("change",function(){
                    if (boton.checked==true){
                        if (tds[1].textContent=="Idioma"){
                            var tabla=document.getElementById("tabla-idioma");
                            tabla.style.display="block";
                        }
                    }else if (boton.checked==false){
                        var tabla=document.getElementById("tabla-idioma");
                        tabla.style.display="none";
                    }
                })
            }
        }
    }
    }

});