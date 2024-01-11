<?php
session_start();
$user = $_SESSION['user'] ?? null;
if (is_null($user)) {
    header("Location:index.php");
    exit();
}
require "vendor/autoload.php";
use utilidades\DB;
use Dotenv\Dotenv;
$env =  Dotenv::createImmutable("./../");
$env->safeLoad();


$db = new DB();

$familias = $db->obtener_familias();

$opcion = $_POST['submit']??"";


switch($opcion){
    case "Ver Productos":
        $cod_familia = $_POST['familia'];
        var_dump($cod_familia);
        $productos = $db->get_productos($cod_familia);
        break;
    default:
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
<h1>Bienvenido <?=$user?></h1>


<form action="sitio.php" method="post">
    <select name="familia" id="">
        <?php
        foreach ($familias as $familia) {
            $cod = $familia[0];
            $nombre = $familia[1];
            $checked="";
            if ($cod== $cod_familia)
                $checked="selected";
            echo "<option $checked value='$cod'>$nombre</option>";
        }
        ?>
    </select>
    <input type="submit" value="Ver Productos" name="submit">
</form>

<?php

if (isset($productos)):?>
<table>
    <tr>
        <th>Nombre</th>
        <th>Precio</th>
    </tr>
    <?php
     foreach ($productos as $producto)
         echo <<<FIN
          <tr>
          <td>{$producto ['nombre']}</td>
          <td>{$producto ['PVP']}</td>
          <td>
            <form action="producto.php" method="post">
            <input type="submit" value="Editar" name="submit">
            <input type="hidden" name="cod" value="{$producto['cod']}">
            <input type="hidden" name="familia" value="$cod_familia">
           </form>
           </td>
          
          </tr>
FIN;

    ?>
</table>



<?php endif?>

<!--<table>-->
<!--    <tr>-->
<!--        <th>Nombre producto</th>-->
<!--    </tr>-->
<!--    --><?php
//    if (isset($producots))
//    foreach ($productos as $producto){
//        echo "<tr>";
//        echo "<td>$producto</td>";
//        echo "<td><form action='producto.php' method='POST'>
//                <input type='submit' value='Editar' name='submit'>
//
//</form></td>";
//
//        echo "</tr>";
//
//    }
//    ?>
<!--    ?>-->
<!--    <tr>-->
<!--        <td>Ordenadores</td>-->
<!--        <td><form>-->
<!--            ></td>-->
<!--    </tr>-->
<!---->
<!--</table>-->
<!---->
</body>
</html>