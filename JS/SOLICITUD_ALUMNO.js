window.addEventListener("load",function(){
    if (this.window.location.href.includes("solicitud")){
        var params=new URLSearchParams(this.window.location.search);
        var idConvocatoria=params.get("idConvocatoria");
        var solicitudes=this.document.getElementById("solicitudes");
        const filas=solicitudes.getElementsByTagName("tr");
        for (let i=0;i<filas.length;i++){
            var tds=filas[i].getElementsByTagName("td");
            for (let j=0;j<tds.length;j++){
                if (j==4){
                    var boton=tds[j].firstElementChild;
                    boton.addEventListener("click",function(){
                        var id=tds[0].textContent;
                        window.location.href="http://localhost/Manejo-Becas/index.php?menu=versolicitud&idSolicitud="+id;
                    });
                }
            }

        }
    }
});