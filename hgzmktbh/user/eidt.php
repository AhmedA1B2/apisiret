<?php

include "../../connect.php" ;

$id        = filterRequest("id");
$book       = filterRequest("book");

$stmt = $con->prepare("UPDATE `mktbh_hgz` SET `book` = ? WHERE `id` = ?");


$stmt -> execute(array($book,$id));

$count = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>
