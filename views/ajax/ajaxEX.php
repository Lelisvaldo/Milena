<?php
    ini_set('default_charset','UTF-8');
    include "../../conn.php";

    $cdPerfil = $_GET['cdperfil'];
    $selectTextoIndex = $pdo->prepare ('SELECT * FROM tb_texto_header_index AS h
    INNER JOIN tb_texto_servico_index AS t ON h.cd_perfil = t.cd_perfil
    INNER JOIN tb_texto_sobre_index AS s ON h.cd_perfil = s.cd_perfil
    WHERE h.cd_perfil = :cdPerfil');
    $selectTextoIndex->bindParam(':cdPerfil', $cdPerfil);
    $selectTextoIndex->execute();

    $results=$selectTextoIndex->fetchAll(PDO::FETCH_ASSOC);
    header("content-type:application/json");
    echo json_encode($results[0],JSON_UNESCAPED_UNICODE);
