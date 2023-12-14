<?php
    require_once "HELPERS/AUTOLOAD.php";
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
        $logout=isset($_POST['logout']);
        if ($logout){
            SESSION::Cerrar_Sesion();
        }
    }
?>
<?php
    require_once "HELPERS/AUTOLOAD.php";

    SESSION::CreaSesion();

    if (SESSION::estaLogueado('USER')){ 
        $usuario =SESSION::leer_session('USER');
        $rol = $usuario->getRol();
        if ($usuario!=null){
        if($rol == "ALUMNO"){
            ?>
            <header id="header">
                <nav>
                    <ul>
                        <form method="post">
                            <li><a><?php echo $usuario->getNombre()?></a></li>
                            <li class="active"><a>BIENVENID@</a</li>
                            <li><a href="?menu=alumno&DNI=<?php echo $usuario->getDNI()?>">CONVOCATORIAS DISPONIBLES</a></li>
                            <li><a href="?menu=veralumno">VER SOLICITUDES</a></li>
                            <li><a><input class="cierra-sesion" type="submit" value="CERRAR SESIÓN" name="logout"></a></li>
                        </form>
                    </ul>
                </nav>
            </header>
            <?php
        }else if ($rol=="ADMINISTRADOR"){
            ?>
            <header id="header">
                <nav>
                    <ul>
                        <form method="post">
                            <li><a><?php echo $usuario->getNombre()?></a></li>
                            <li class="active"><a>BIENVENID@</a</li>
                            <li><a href="?menu=admin">CREAR CONVOCATORIA</a></li>
                            <li><a href="?menu=actualiza">ACTUALIZAR CONVOCATORIA</a></li>
                            <li><a href="?menu=mostrarConvocatorias">MOSTRAR Y BORRAR CONVOCATORIA</a></li>
                            <li><a href="?menu=baremo">EVALUAR SOLICITUDES</a></li>
                            <li><a><input class="cierra-sesion" type="submit" value="CERRAR SESIÓN" name="logout"></a></li>
                        </form>
                    </ul>
                </nav>
            </header>
            <?php
        }else{

        }
    }else{
        SESSION::Cerrar_Sesion();
    }
    }else{
        ?>
            <header id="header">
                <nav>
                    <ul>
                        <li class="active"><a>BIENVENID@</a</li>
                        <li><a href="?menu=inicio">LOGIN</a></li>
                    </ul>
                </nav>
            </header>
            <?php
    }
        
    

?>