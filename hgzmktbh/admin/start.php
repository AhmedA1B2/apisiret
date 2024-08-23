<?php

include "../../connect.php" ;


$name    = filterRequest("name");
$num     = filterRequest("num");
$college = filterRequest("college");
$book    = filterRequest("book");
$date    = filterRequest("date");
$id_add    = filterRequest("id_add");
$id      = filterRequest("id");



///////////////////[Delete]/////////////////////////
if($id != ""){

$stmt = $con->prepare("DELETE FROM `mktbh_hgz` WHERE `id` = ?");

$stmt -> execute(array($id));


$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}
/////////////////////[  .  ]////////////////////////////
/////////////////////[ /|\ ]////////////////////////////
/////////////////////[  |  ]////////////////////////////
/////////////////////[  |  ]////////////////////////////
}

elseif($name != ""){
    $stmt = $con->prepare(" INSERT INTO `starthgz`( `name`, `num`,`college`,`book`,`date`,`id_add`) VALUES (?,?,?,?,?,?)");


$stmt -> execute(array($name,$num,$college,$book,$date,$id_add));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

}else{
    echo json_encode(array("status" => "fail"));
}







 


?>