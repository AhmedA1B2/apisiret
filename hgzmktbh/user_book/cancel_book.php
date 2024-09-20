<?php

include "../../connect.php" ;

$mhgoz   = 0;
$book =  filterRequest("book");

$stmt = $con->prepare("UPDATE `books`SET `mhgoz`=? WHERE `id`=?");
$stmt -> execute(array($mhgoz,$book));

$id = filterRequest("id");

$stmt = $con->prepare("DELETE FROM `mktbh_hgz` WHERE `id` = ?");

$stmt -> execute(array($id));


$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>