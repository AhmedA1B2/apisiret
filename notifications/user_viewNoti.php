<?php

include "../connect.php" ;

$topic = filterRequest("topic");

$stmt = $con->prepare("SELECT * FROM `notifications` WHERE `topic` = ?");

$stmt -> execute(array($topic));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>