<?php

include "../connect.php" ;

$topic = filterRequest("topic");
$college_add = filterRequest("college_add");


$stmt = $con->prepare("SELECT * FROM `notifications` WHERE `topic` = ? && `college_add`=?");

$stmt -> execute(array($topic,$college_add));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>