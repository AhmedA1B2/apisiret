<?php

include "../../connect.php" ;

$mhgoz   = 1;
$id =  filterRequest("id");

$stmt = $con->prepare("UPDATE `books`SET `mhgoz`=? WHERE `id`=?");

$stmt -> execute(array($mhgoz,$id));


$name    = filterRequest("name");
$num     = filterRequest("num");
$college = filterRequest("college");
$book    = $id;
$date    = filterRequest("date");
$id_add  = filterRequest("id_add");


$stmt = $con->prepare("INSERT INTO `mktbh_hgz`( `name`, `num`,`college`,`book`,id_add,`date`) VALUES (?,?,?,?,?,?)");

$stmt -> execute(array($name,$num,$college,$book,$id_add,$date));

$count = $stmt->rowCount();



if($count > 0){
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>
