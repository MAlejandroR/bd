<?php
namespace utilidades;

class DB{

 private \mysqli $con;


    public function __construct()
    {
        $user = $_ENV['USER_'];
        $password = $_ENV['PASSWORD'];
        $database = $_ENV['DATABASE'];
        $host = $_ENV['HOST'];
        $port = $_ENV['PORT_MYSQL'];
        try {
            $this->con = new \mysqli($host, $user, $password, $database, $port);
        }catch (\mysqli_sql_exception $error ){
            die ("Error contectando ".$error->getMessage());
        }
    }


    public function insertar_datos(string|null $user, string $password):bool{

        $sentencia =<<<FIN
            insert into usuarios (nombre, password)
            values ('$user', '$password')
FIN;
        try {
            $rtdo = $this->con->query($sentencia);
        }catch(\mysqli_sql_exception $e){
            echo $e->getMessage();
            return false;
        }
        return $rtdo;
    }

    public function validar_usuario($user, $password):bool{
        $sentencia =<<<FIN
            select * from usuarios
            where nombre = '$user' AND password= '$password'
FIN;
        try {
            $rtdo = $this->con->query($sentencia);
            var_dump($rtdo);
        }catch(\mysqli_sql_exception $e){
            echo $e->getMessage();
            return false;
        }
        if ($rtdo->num_rows>0)
            return true;
        else
            return false;
    }

}