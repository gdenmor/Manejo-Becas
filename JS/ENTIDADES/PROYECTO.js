function PROYECTO(codigo_proyecto,nombre,fecha_inicio,fecha_fin){
    this.codigo_proyecto=codigo_proyecto;
    this.nombre=nombre;
    this.fecha_inicio=new Date(fecha_inicio);
    this.fecha_fin=new Date(fecha_fin);
}