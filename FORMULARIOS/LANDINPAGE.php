<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        header("Location: ?menu=inicio");
    }
?>
<main id="principal-div">
    <h1>GESTIÓN DE BECAS</h1>
    <h2>2023-24</h2>
    <form method="post">
        <input type="submit" value="ACCESO LOGIN" name="boton">
    </form>
</main>