<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'bradford';
    try
    {
        $PDO = new PDO("mysql:host=".$host."; "."dbname=".$dbname, $user, $pass);
    }
    catch(PDOException $e)
    {
        die($e->getMessage());
    }
?>