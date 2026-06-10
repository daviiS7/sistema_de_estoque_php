<?php

class Database
{
    public static function conectar()
    {
        $host = "localhost";
        $dbname = "dw_sistema";
        $user = "root";
        $pass = "";

        try {
            $pdo = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8",
                $user,
                $pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}

