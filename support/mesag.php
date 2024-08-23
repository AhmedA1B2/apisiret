<?php

include "../connect.php" ;

$name  = filterRequest("name");
$num   = filterRequest("num");
$mesag = filterRequest("mesag");



$stmt = $con->prepare("INSERT INTO `support`( `name`, `num`,`mesag`) VALUES (?,?,?)");

$stmt -> execute(array($name,$num,$mesag));


$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>