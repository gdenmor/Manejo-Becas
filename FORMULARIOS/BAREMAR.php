<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
    <div>
        <?php
            require_once "../HELPERS/AUTOLOAD.php";
            $baremacion=BD_BAREMACION::FindAll();
            for ($i=0;$i<count($baremacion);$i++){
                echo '<label>'.$baremacion[$i]->getCandidatoConvocatoria().'</label>';
                echo '<input type="text">';
                echo '<iframe src="'.$baremacion[$i]->getURL().'"></iframe>';
                echo '<br>';
            }
        ?>
    </div>
</div>
</body>
</html>
