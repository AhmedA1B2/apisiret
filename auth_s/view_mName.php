<?php

include "../connect.php" ;

$code = filterRequest("code");


$stmt = $con->prepare("SELECT `name` FROM `code` WHERE `code` = ?");

$stmt -> execute(array($code));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>