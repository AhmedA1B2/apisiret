<?php

include "../connect.php" ;

$id        = filterRequest("id_st");
$name      = filterRequest("name");
$num       = filterRequest("num");
$pass      = filterRequest("pass");
$college   = filterRequest("college");
$tkss      = filterRequest("tkss");
$time      = filterRequest("time");

$stmt = $con->prepare("UPDATE `student` SET `name`= ?,`num`= ?,`pass`= ?,`college`=?,`tkss`=?,`time`=? WHERE `id_st` = ?");


$stmt -> execute(array($name, $num, $pass, $college, $tkss,$time, $id));

$count = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>
