<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/baremacion.css">
</head>
<body>
<div>
    <div>
        <table>
            <thead>
                <th>DNI</th>
                <th>NOMBRE</th>
                <th>APELLIDO 1</th>
                <th>APELLIDO 2</th>
                <th>ACCEDER A BAREMOS</th>
            </thead>
            <tbody>
                <?php
                    require_once "../HELPERS/AUTOLOAD.php";
                    $baremacion=BD_BAREMACION::FindAll();
                    for ($i=0;$i<count($baremacion);$i++){
                        echo "<tr>";
                        echo '<td>'.$baremacion[$i]->getCandidatoConvocatoria()->getDNI().'</td>';
                        echo '<td>'.$baremacion[$i]->getCandidatoConvocatoria()->getNombre().'</td>';
                        echo '<td>'.$baremacion[$i]->getCandidatoConvocatoria()->getApellido1().'</td>';
                        echo '<td>'.$baremacion[$i]->getCandidatoConvocatoria()->getApellido2().'</td>';
                        echo '<td><input type="button" value="ACCEDER"></td>';
                        echo "</tr>";
                        /*echo '<div class="baremos">';
                        echo '<label>'.$baremacion[$i]->getCandidatoConvocatoria()->getDNI().'</label>';
                        echo '<input type="text">';
                        echo '<iframe class="pdf" src="'.$baremacion[$i]->getURL().'"></iframe>';
                        echo '</div>';
                        echo '<br>';*/
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
