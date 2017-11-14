<?php
    // Informações para conexão
    $host = '192.168.88.220';
    $usuario = 'sa';
    $senha = '123';
    $banco = 'u869855761_bdibl';
    $dsn = "mysql:host={$host};port=3306;dbname={$banco}";

    try
    {
        // Conectando
        $pdo = new PDO($dsn, $usuario, $senha);
    }
    catch (PDOException $e)
    {
        // Se ocorrer algum erro na conexão
        die($e->getMessage());
}