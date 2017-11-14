<?php
include('../conn.php');

//for total count data
    $limit = 5;
    $countSql = $pdo->prepare ("SELECT cd_usuario FROM tb_usuario");
    $countSql->execute();
    $total_records = $countSql->rowCount();
    $results = $countSql->fetch(PDO::FETCH_ASSOC);
    $total_pages = ceil($total_records / $limit);


//for first time load data
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
    $selectResult = $pdo->prepare ("SELECT cd_usuario,ic_status,nm_usuario,nm_email,ic_administrador  FROM tb_usuario ORDER BY nm_usuario ASC LIMIT :inicio,:limite");
    $selectResult->bindParam(':inicio', $start_from, PDO::PARAM_INT);
    $selectResult->bindParam(':limite', $limit, PDO::PARAM_INT);
    $selectResult->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" charset="utf8" src="../js/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="dist/simplePagination.css" />
    <script src="dist/jquery.simplePagination.js"></script>
    <title></title>
    <script>
    </script>
</head>
<body>
    <div class="container" style="padding-top:20px;">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>status</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody id="target-content">
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
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php if(!empty($total_pages)):for($i=1; $i<=$total_pages; $i++):
                            if($i == 1):?>
                            <li class='active'  id="<?php echo $i;?>"><a href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
                            <?php else:?>
                            <li id="<?php echo $i;?>"><a href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
                        <?php endif;?>
                <?php endfor;endif;?>
            </ul>
        </nav>
    </div>
</body>
<script type="text/javascript">
$(document).ready(function(){
$('.pagination').pagination({
        items: <?php echo $total_records;?>,
        itemsOnPage: <?php echo $limit;?>,
        cssStyle: 'light-theme',
		currentPage : 1,
		onPageClick : function(pageNumber) {
			jQuery("#target-content").load("pagination.php?page=" + pageNumber);
		}
    });
});
</script>