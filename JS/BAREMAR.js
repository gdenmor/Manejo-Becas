window.addEventListener("load",function(){
    if (window.location.href.includes("baremo")) {
    const enlaces=this.document.getElementsByClassName("acceder");
    debugger;
    var tbody=this.document.getElementsByTagName("tr");

    for (let i=1;i<tbody.length;i++){
        var tds=tbody[i].getElementsByTagName("td");
        var boton=tds[3].firstElementChild;
        boton.addEventListener("click",function(){
            var id_convocatoria=tds[0].textContent;
            window.location.href="http://localhost/Manejo-Becas/index.php?menu=versolicitudes&idConvocatoria="+id_convocatoria;
        });
    }
}

});