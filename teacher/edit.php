<?php

include "../connect.php" ;

$id        = filterRequest("id_te");
$name      = filterRequest("name");
$emil       = filterRequest("emil");
$pass      = filterRequest("pass");

$stmt = $con->prepare("UPDATE `teacher` SET `name`= ?,`emil`= ?,`pass`= ? WHERE `id_te` = ?");


$stmt -> execute(array($name, $emil, $pass, $id));

$count = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>
