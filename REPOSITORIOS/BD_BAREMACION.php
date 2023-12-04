<?php
    class BD_BAREMACION{
        public static function FindAll()
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * from BAREMACION");
        $resultado->execute();

        $Baremaciones = null;

        $i = 0;


        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $id_baremacion = $tuplas->id_convocatoria_baremable_idioma;
            $id_candidato_convocatoria = $tuplas->id_candidato_convocatoria;
            $id_item = $tuplas->id_item;
            $item = BD_ITEMBAREMABLE::FindByID($id_item);
            $nota = $tuplas->nota;
            $url=$tuplas->url;
            $Baremacion = new BAREMACION($id_baremacion,$id_candidato_convocatoria,$item,$nota,$url);
            $Baremaciones[] = $Baremacion;
            $i++;
        }

        return $Baremaciones;
    }

    public static function FindByID($id_baremacion)
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * FROM BAREMACION WHERE id_baremacion=:id_baremacion");
        $resultado->bindParam(':id_baremacion', $id_baremacion, PDO::PARAM_INT);
        $resultado->execute();

        $Baremacion = null;

        if ($resultado) {
            $tuplas = $resultado->fetch(PDO::FETCH_OBJ);

            if ($tuplas) {
                $id_candidato_convocatoria = $tuplas->id_convocatoria;
                $id_item = $tuplas->id_item;
                $item = BD_ITEMBAREMABLE::FindByID($id_item);
                $nota = $tuplas->nota;
                $url=$tuplas->url;
                $Baremacion = new BAREMACION($id_baremacion,$id_candidato_convocatoria,$item,$nota,$url);
            }
        }

        return $Baremacion;
    }

    public static function DeleteByID($id_baremacion)
    {
        $conexion = CONEXION::AbreConexion();

        $resultado = $conexion->prepare("DELETE from BAREMACION where id_baremacion=:id_baremacion");
        $resultado->bindParam(":id_baremacion", $id_baremacion, PDO::PARAM_INT);
        $resultado->execute();
    }

    public static function UpdateByID($id_baremacion, $objetoActualizado)
    {
        $conexion = CONEXION::AbreConexion();
        $id_convocatoria = $objetoActualizado->getConvocatoria()->getIdConvocatoria();
        $id_item = $objetoActualizado->getItem()->getID_Item();
        $nota = $objetoActualizado->getNota();
        $url=$objetoActualizado->getURL();



        $resultado = $conexion->prepare("UPDATE BAREMACION set id_candidato_convocatoria=:id_candidato_convocatoria,id_item=:id_item,nota=:nota,url=:url where id_baremacion=:id_baremacion");
        $resultado->bindParam(":id_baremacion", $id_baremacion, PDO::PARAM_INT);
        $resultado->bindParam(":id_convocatoria", $id_convocatoria, PDO::PARAM_INT);
        $resultado->bindParam(":id_item", $id_item, PDO::PARAM_INT);
        $resultado->bindParam(":nota", $nota, PDO::PARAM_INT);
        $resultado->bindParam(":url", $url, PDO::PARAM_STR);


        $resultado->execute();
    }

    public static function Insert($objeto)
    {
        $conexion = CONEXION::AbreConexion();
        $id_item = $objeto->getItem()->getID_Item();
        $nota = $objeto->getNota();
        $url = $objeto->getURL();
        $id_candidato_convocatoria = $objeto->getCandidatoConvocatoria()->getID_Candidatos_Convocatoria();

        $resultado = $conexion->prepare("INSERT INTO BAREMACION(id_candidato_convocatoria, id_item, nota, url) VALUES (:id_candidato_convocatoria, :id_item, :nota, :url)");
        $resultado->bindParam(":id_candidato_convocatoria", $id_candidato_convocatoria, PDO::PARAM_INT);
        $resultado->bindParam(":id_item", $id_item, PDO::PARAM_INT);
        $resultado->bindParam(":nota", $nota, PDO::PARAM_INT);
        $resultado->bindParam(":url", $url, PDO::PARAM_STR);
        $resultado->execute();
    }
    }
?>