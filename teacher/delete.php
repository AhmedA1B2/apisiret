<?php

include "../connect.php" ;

$id      = filterRequest("id_te");



$stmt = $con->prepare("DELETE FROM teacher WHERE id_te = ?");

$stmt -> execute(array($id));


$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>