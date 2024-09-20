<?php

include "../connect.php" ;

$college_add = filterRequest("college_add");

$stmt = $con->prepare("SELECT * FROM `notifications` WHERE `college_add` = ?");

$stmt -> execute(array($college_add));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>