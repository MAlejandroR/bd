<?php

namespace utilidades;

class DB
{

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
        } catch (\mysqli_sql_exception $error) {
            die ("Error contectando " . $error->getMessage());
        }
    }


    public function insertar_datos(string|null $user, string $password): bool
    {


        $password = password_hash($password, PASSWORD_BCRYPT);
        $sentencia = <<<FIN
            insert into usuarios (nombre, password)
            values (?, ?)
FIN;
        try {
            $stmt = $this->con->stmt_init();
            $stmt->prepare($sentencia);
            $stmt->bind_param("ss", $user, $password);
            $stmt->execute();
            $stmt->store_result();
        } catch (\mysqli_sql_exception $e) {
            echo $e->getMessage();
            return false;
        }
        return $stmt->affected_rows == 1 ? true : false;
    }

    public function validar_usuario($user, $password): bool
    {
        $sentencia = <<<FIN
            select password from usuarios
            where nombre = ? 
FIN;
        try {
            $stmt = $this->con->stmt_init();
            $stmt->prepare($sentencia);
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($pass_database);
            $stmt->fetch();
            return password_verify($password, $pass_database);
        } catch (\mysqli_sql_exception $e) {
            $msj=$e->getMessage();
            error_log($msj, 1, "errores.log");
            return false;
        }

    }

    public function obtener_familias()
    {
        $sentencia = "select * from  familia";
        $rtdo = $this->con->query($sentencia);

        return $rtdo->fetch_all();
    }

    public function get_productos(string $familia):array{
        $sentencia =<<<FIN
                select cod, nombre_corto, PVP
                from producto
                where familia = ?
FIN;
        $productos=[];
        try {
            $stmt = $this->con->stmt_init();
            $stmt->prepare($sentencia);
            $stmt->bind_param("s", $familia);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($cod, $nom, $pvp);
            while ($stmt->fetch()){
                $productos[]=["cod"=>$cod,"nombre"=> $nom,"PVP"=> $pvp];
            }
        } catch (\mysqli_sql_exception $e) {
            $msj=$e->getMessage();
            error_log($msj, 1, "errores.log");
        }
        finally {
            return $productos;
        }





    }


}