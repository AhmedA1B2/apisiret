<?php

include "../connect.php" ;

$name      = filterRequest("name");
$num       = filterRequest("num");
$code      = filterRequest("code");
$who_added = filterRequest("who_added");



$stmt = $con->prepare("INSERT INTO `code`( `name`, `num`, `code`,who_added) VALUES (?,?,?,?)");

$stmt -> execute(array($name,$num,$code,$who_added));

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>