<?php

include "../connect.php" ;

$id      = filterRequest("id_st");



$stmt = $con->prepare("DELETE FROM student WHERE id_st = ?");

$stmt -> execute(array($id));


$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>