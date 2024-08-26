<?php

include "../connect.php" ;

$code = filterRequest("code");


$stmtMada = $con->prepare("SELECT `name` FROM `code` WHERE `code` = ?");

$stmtMada -> execute(array($code));

$getNameMada= $stmtMada->fetchAll(PDO::FETCH_ASSOC);

$count = $stmtMada->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $getNameMada ));
}else{
    echo json_encode(array("status" => "fail"));
}







 


?>