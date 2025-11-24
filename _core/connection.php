<?php 
function db()
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = "pgsql:host=localhost;port=5432;dbname=devweb_project;";
        $user = "devweb_project";
        $pass = "admin";

        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }

    return $pdo;
}
