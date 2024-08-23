<?php

include "../connect.php" ;

$pass = filterRequest("pass");
$num = filterRequest("emil");

$stmt = $con->prepare("SELECT * FROM `teacher` WHERE `pass` = ? AND `emil` = ?");

$stmt -> execute(array($pass,$num));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>