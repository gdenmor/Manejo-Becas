window.addEventListener("load",function(){
    const idsCandidatoConvocatoria=this.document.getElementsByClassName("ids");
    const boton=this.document.getElementsByClassName("solalumno");

    for (let i=0;i<boton.length;i++){
        boton[i].addEventListener("click",function(){
            var idCandidatoConvocatoria=idsCandidatoConvocatoria[i].value;
            window.open("http://localhost/Manejo-Becas/index.php?menu=solicitudalu&idCandConv="+idCandidatoConvocatoria);
        });
    }
});