<?php

include "../connect.php" ;

$name      = filterRequest("name");
$num       = filterRequest("num");
$college   = filterRequest("college");
$book       = filterRequest("book");


$stmt = $con->prepare("INSERT INTO `mktbh_hgz`( `name`, `num`,`college`,`book`) VALUES (?,?,?,?)");

$stmt -> execute(array($name,$num,$college,$book));

# $data = $stmt->fetch(PDO::FETCH_ASSOC); #

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>