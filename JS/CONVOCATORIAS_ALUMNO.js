window.addEventListener("load",function(){
    if (window.location.href.includes("alumno")) {
    const enlaces=this.document.getElementsByClassName("enlaces");

    for (let i=0;i<enlaces.length;i++){
        enlaces[i].addEventListener("click",function(){
            debugger;
            var dni=document.getElementById("dni").value;
            var id=document.getElementsByClassName("id")[i].value;
            window.location.href="http://localhost/Manejo-Becas/index.php?menu=solicitud&dni="+dni+"&idConvocatoria="+id;
        })
    }
}

});