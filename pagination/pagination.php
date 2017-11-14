<?php
include('../conn.php');

$limit = 5;

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  

    $selectResult = $pdo->prepare ("SELECT cd_usuario,ic_status,nm_usuario,nm_email,ic_administrador  FROM tb_usuario ORDER BY nm_usuario ASC LIMIT :inicio,:limite");
    $selectResult->bindParam(':inicio', $start_from, PDO::PARAM_INT);
    $selectResult->bindParam(':limite', $limit, PDO::PARAM_INT);
    $selectResult->execute();

?>

<?php  
while ($row = $selectResult->fetch(PDO::FETCH_ASSOC)) {
?>  
            <tr>  
                <td><?php echo $row["nm_usuario"]; ?></td>  
                <td><?php echo $row["nm_email"]; ?></td>  
                <td><?php echo $row["ic_status"]; ?></td>
                <td><?php echo $row["ic_administrador"]; ?></td>
            </tr>  
<?php  
};  
?>
