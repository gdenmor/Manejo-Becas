function CONVOCATORIA(id_convocatoria,num_movilidades,fecha_inicio,fecha_fin,fechainicioPruebas,fechafinPruebas,fechaListadoProvisional,
    fechaListadoDefinitivo,proyecto,pais_destino,nombre)
{
    this.id_convocatoria=id_convocatoria;
    this.num_movilidades=num_movilidades;
    this.fecha_inicio=new Date(fecha_inicio);
    this.fecha_fin=new Date(fecha_fin);
    var diff = Math.ceil((this.fecha_fin - this.fecha_inicio) / (1000 * 60 * 60 * 24));
    if (diff>90){
        this.tipo="LARGA";
    }else{
        this.tipo="CORTA";
    }
    this.fechainicioPruebas=new Date(fechainicioPruebas);
    this.fechafinPruebas=new Date(fechafinPruebas);
    this.fechaListadoProvisional=new Date(fechaListadoProvisional);
    this.fechaListadoDefinitivo=new Date(fechaListadoDefinitivo);
    this.proyecto=proyecto;
    this.pais_destino=pais_destino;
    this.nombre=nombre;
}