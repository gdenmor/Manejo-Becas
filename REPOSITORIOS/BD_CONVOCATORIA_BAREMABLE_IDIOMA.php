<?php
//PENDIENTE
class BD_CONVOCATORIA_BAREMABLE_IDIOMA
{
    public static function FindAll()
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * from CONVOCATORIA_BAREMABLE_IDIOMA");
        $resultado->execute();

        $Convocatorias_Baremables_Idiomas = null;

        $i = 0;


        while ($tuplas = $resultado->fetch(PDO::FETCH_OBJ)) {
            $id_convocatoria_baremable_idioma = $tuplas->id_convocatoria_baremable_idioma;
            $id_convocatoria = $tuplas->id_convocatoria;
            $convocatoria = BD_CONVOCATORIA::FindByID($id_convocatoria);
            $id_idioma = $tuplas->id_idioma;
            $idioma = BD_IDIOMA::FindByID($id_idioma);
            $id_baremo = $tuplas->id_baremo;
            $baremo = BD_ITEMBAREMABLE::FindByID($id_baremo);
            $notaidioma = $tuplas->nota_idioma;
            $Convocatoria_Baremable = new CONVOCATORIA_BAREMABLE_IDIOMA($id_convocatoria_baremable_idioma, $convocatoria, $idioma, $baremo, $notaidioma);
            $Convocatorias_Baremable_Idiomas[] = $Convocatoria_Baremable;
            $i++;
        }

        return $Convocatorias_Baremables_Idiomas;
    }

    public static function FindByID($id_convocatoria_baremable_idioma)
    {
        $conexion = CONEXION::AbreConexion();
        $resultado = $conexion->prepare("SELECT * FROM CONVOCATORIA_BAREMABLE_IDIOMA WHERE id_convocatoria_baremable_idioma=:id_convocatoria_baremable_idioma");
        $resultado->bindParam(':id_convocatoria_baremable_idioma', $id_convocatoria_baremable_idioma, PDO::PARAM_INT);
        $resultado->execute();

        $Convocatoria_Baremable = null;

        if ($resultado) {
            $tuplas = $resultado->fetch(PDO::FETCH_OBJ);

            if ($tuplas) {
                $id_convocatoria_baremable_idioma = $tuplas->id_convocatoria_baremable_idioma;
                $id_convocatoria = $tuplas->id_convocatoria;
                $convocatoria = BD_CONVOCATORIA::FindByID($id_convocatoria);
                $id_idioma = $tuplas->id_idioma;
                $idioma = BD_IDIOMA::FindByID($id_idioma);
                $id_baremo = $tuplas->id_baremo;
                $baremo = BD_ITEMBAREMABLE::FindByID($id_baremo);
                $notaidioma = $tuplas->nota_idioma;
                $Convocatoria_Baremable = new CONVOCATORIA_BAREMABLE_IDIOMA($id_convocatoria_baremable_idioma, $convocatoria, $idioma, $baremo, $notaidioma);
            }
        }

        return $Convocatoria_Baremable;
    }

    public static function DeleteByID($id_convocatoria_baremable_idioma)
    {
        $conexion = CONEXION::AbreConexion();

        $resultado = $conexion->prepare("DELETE from CONVOCATORIA_BAREMABLE_IDIOMA where id_convocatoria_baremable_idioma=:id_convocatoria_baremable_idioma");
        $resultado->bindParam(":id_convocatoria_baremable_idioma", $id_convocatoria_baremable_idioma, PDO::PARAM_INT);
        $resultado->execute();
    }

    public static function UpdateByID($id_convocatoria_baremable_idioma, $objetoActualizado)
    {
        $conexion = CONEXION::AbreConexion();
        $id_convocatoria =$objetoActualizado->getConvocatoria()->getIdConvocatoria();
        $id_idioma =$objetoActualizado->getIdioma()->getIdIdioma();
        $id_baremo =$objetoActualizado->getBaremo()->getIdBaremo();
        $notaidioma =$objetoActualizado->getNota_Idioma();



        $resultado = $conexion->prepare("UPDATE CONVOCATORIA_BAREMABLE_IDIOMA set id_convocatoria_baremable_idioma=:id_convocatoria_baremable_idioma,id_convocatoria=:id_convocatoria,id_idioma=:id_idioma,id_baremo=:id_baremo,nota_idioma=:nota_idioma where id_convocatoria_baremable_idioma=:id_convocatoria_baremable_idioma");
        $resultado->bindParam(":id_convocatoria_baremable_idioma", $id_convocatoria_baremable_idioma, PDO::PARAM_INT);
        $resultado->bindParam(":id_convocatoria", $id_convocatoria, PDO::PARAM_INT);
        $resultado->bindParam(":id_idioma", $id_idioma, PDO::PARAM_INT);
        $resultado->bindParam(":id_baremo", $id_baremo, PDO::PARAM_BOOL);
        $resultado->bindParam(":nota_idioma", $notaidioma, PDO::PARAM_INT);

        $resultado->execute();
    }

    public static function Insert($objeto)
    {
        $conexion = CONEXION::AbreConexion();
        $id_convocatoria =$objeto->getIdConvocatoria()->getIdConvocatoria();
        $id_idioma =$objeto->getIdioma()->getIdIdioma();
        $id_baremo =$objeto->getIdBaremo()->getID_Item();
        $notaidioma =$objeto->getNota_Idioma();

        $resultado = $conexion->prepare("INSERT INTO CONVOCATORIA_BAREMABLES_IDIOMA (id_convocatoria,id_idioma,id_baremo,nota_idioma) values (:id_convocatoria,:id_idioma,:id_baremo,:nota_idioma)");
        $resultado->bindParam(":id_convocatoria", $id_convocatoria, PDO::PARAM_INT);
        $resultado->bindParam(":id_idioma", $id_idioma, PDO::PARAM_INT);
        $resultado->bindParam(":id_baremo", $id_baremo, PDO::PARAM_BOOL);
        $resultado->bindParam(":nota_idioma", $notaidioma, PDO::PARAM_INT);
        $resultado->execute();
    }
}
