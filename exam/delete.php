<?php

include "../connect.php" ;

$id= filterRequest("id_ex");



$stmt = $con->prepare("DELETE FROM `exam` WHERE `id_ex` = ?");

$stmt -> execute(array($id));


$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>