<?php

include "../../connect.php" ;


$name    = filterRequest("name");
$num     = filterRequest("num");
$college = filterRequest("college");
$book    = filterRequest("book");
$date    = filterRequest("date");
$id      = filterRequest("id");



///////////////////[Delete]/////////////////////////
if($id != ""){

$stmt = $con->prepare("DELETE FROM `starthgz` WHERE `id` = ?");

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
    $stmt = $con->prepare(" INSERT INTO `endhgz`( `name`, `num`,`college`,`book`,`date`) VALUES (?,?,?,?,?)");


$stmt -> execute(array($name,$num,$college,$book,$date));

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