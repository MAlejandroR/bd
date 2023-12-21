<?php
require "vendor/autoload.php";

use Dotenv\Dotenv;
use Utilidades\DB;



$dotenv = Dotenv::createImmutable(__DIR__."/..");
$dotenv->safeLoad();

$con = new DB();
$opcion = $_POST['submit'] ?? null;
switch ($opcion){
    case "Registrarme":
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        $msj = $con->insertar_usuario($usuario, $password);
        break;
    case "Acceder":
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        if ($con->valida_usuario($usuario, $password)===true){
            session_start();
            $_SESSION['usuario']=$usuario;
            header("Location:sitio.php");
            exit;
        }else{
            $msj ="El usuairo $usuario no existe";
        }
        break;
    defualt:
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<fieldset style="width:50%;background: antiquewhite; margin:20%">
    <legend>Datos de acceso</legend>
<form action="index.php" method="post">
    usuario <input type="text" name="usuario" id=""><br />
    password <input type="text" name="password" id=""><br />
    <input type="submit" value="Acceder" name="submit">
    <input type="submit" value="Registrarme" name="submit">
</form>
    <?=$msj ??""?>
</fieldset>
</body>
</html>
