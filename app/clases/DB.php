<?php

namespace Utilidades;

class DB
{
    private \mysqli $con;

    public function __construct()
    {
        $host = $_ENV['HOST'];
        $user = $_ENV['USER_'];
        $password = $_ENV['PASSWORD'];
        $database = $_ENV['DATABASE'];;
        $port = $_ENV['PORT_MYSQL'];

        try {
            $con = new \mysqli($host, $user, $password, $database, $port);
        } catch (\mysqli_sql_exception $e) {
            die("Error contectando " . $e->getMessage());
        }
        $this->con = $con;


    }

    public function insertar_usuario(string|null $nombre, string|null $password): string
    {

        $sentencia = <<<FIN
          insert into USUARIOS
          (nombre, password) values ('$nombre', '$password')
FIN;
        try {
            $rtdo = $this->con->query($sentencia);
            if ($this->con->affected_rows > 0)
                return "El usuario $nombre se ha insertado";
            else
                return "No se ha podido insertar  $nombre ";

        } catch (\mysqli_sql_exception $e) {
            return "Error : " . $e->getMessage();
        }
    }

    public function valida_usuario($nombre, $password)
    {
        $sentencia = <<<FIN
select * 
from USUARIOS
where nombre = '$nombre' and password= '$password'
FIN;

        try {
            $rtdo = $this->con->query($sentencia);
            if ($rtdo->num_rows > 0)
                return true;
            else
                return false;

        } catch (\mysqli_sql_exception $e) {
            var_dump($e);
            exit;
            return "Error : " . $e->getMessage();
        }
    }


}