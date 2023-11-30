function CONVOCATORIA(id_convocatoria,num_movilidades,fecha_inicio,fecha_fin,fechainicioPruebas,fechafinPruebas,fechaListadoProvisional,
    fechaListadoDefinitivo,proyecto,pais_destino)
{
    this.id_convocatoria=id_convocatoria;
    this.num_movilidades=num_movilidades;
    this.fecha_inicio=new Date(fecha_inicio);
    this.fecha_fin=new Date(fecha_fin);
    const inicio = Date.UTC(fecha_inicio.getFullYear(), fecha_inicio.getMonth(), fecha_inicio.getDate());
    const fin = Date.UTC(fecha_fin.getFullYear(), fecha_fin.getMonth(), fecha_fin.getDate());
    var diff=fin-inicio;
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
}