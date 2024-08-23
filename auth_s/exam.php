<?php

include "../connect.php" ;


$pass = filterRequest("pass");
$num = filterRequest("idnum");



$stmt = $con->prepare("SELECT * FROM `exam` WHERE `pass` = ? AND `idnum` = ?");

$stmt -> execute(array($pass,$num));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>