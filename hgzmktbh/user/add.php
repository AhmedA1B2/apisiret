<?php

include "../../connect.php" ;

$name      = filterRequest("name");
$num       = filterRequest("num");
$college   = filterRequest("college");
$book       = filterRequest("book");
$date    = filterRequest("date");
$id_add       = filterRequest("id_add");


$stmt = $con->prepare("INSERT INTO `mktbh_hgz`( `name`, `num`,`college`,`book`,id_add,`date`) VALUES (?,?,?,?,?,?)");

$stmt -> execute(array($name,$num,$college,$book,$id_add,$date));

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>