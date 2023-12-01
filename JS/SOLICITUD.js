window.addEventListener("load",function(){
    const solicitar=this.document.getElementsByName("solicita")[0];
    var parametros=new URLSearchParams(this.window.location.search);
    var dni=parametros.get("dni");

    solicitar.addEventListener("click",function(ev){
        ev.preventDefault();

        //con esta variable sabremos cuantos errores se han producido en el formulario
        const num_errores=0;

        //creamos un objeto validador que es una clase que hemos creado nosotros
        var validador=new VALIDADOR();

        //sacamos los datos introducidos
        const DNI=document.getElementsByName("DNI")[0];
        const nombre=document.getElementsByName("nombre")[0];
        const apellido1=document.getElementsByName("apellido1")[0];
        const apellido2=document.getElementsByName("apellido2")[0];
        const contraseña=document.getElementsByName("contraseña")[0];
        const correo=document.getElementsByName("correo")[0];
        const domicilio=document.getElementsByName("domicilio")[0];

        fetch("../APIS/apiCandidato.php?dni="+dni,{
            headers:{
                "Content-type": "application/json"
            },
            method: "GET"
        })
        .then(x=>x.json())
        .then(y=>{
            
        })
    });

});

