<?php

include "../connect.php" ;

$id        = filterRequest("id");
$name      = filterRequest("name");
$num       = filterRequest("num");
$code      = filterRequest("code");

$stmt = $con->prepare("UPDATE `code` SET `name`= ?,`num`= ?,`code`= ? WHERE `id` = ?");


$stmt -> execute(array($name, $num, $code, $id));

$count = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>
