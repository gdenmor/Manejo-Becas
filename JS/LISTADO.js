window.addEventListener("load",function(){
    const idsConvocatoria=this.document.getElementsByClassName("id");
    const botonp=this.document.getElementsByClassName("p");
    const botonf=this.document.getElementsByClassName("f");

    for (let i=0;i<botonp.length;i++){
        botonp[i].addEventListener("click",function(){
            var idCandidatoConvocatoria=idsConvocatoria[i].value;
            window.open("http://localhost/Manejo-Becas/index.php?menu=verlisp&idConv="+idCandidatoConvocatoria);
        });
    }

    for (let i=0;i<botonf.length;i++){
        botonf[i].addEventListener("click",function(){
            var idCandidatoConvocatoria=idsConvocatoria[i].value;
            window.open("http://localhost/Manejo-Becas/index.php?menu=verlisf&idConv="+idCandidatoConvocatoria);
        });
    }
});