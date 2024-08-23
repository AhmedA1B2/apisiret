<?php

include "../connect.php" ;

$num = filterRequest("num");


$stmt = $con->prepare("SELECT * FROM `n_exam` WHERE `num` = ?");

$stmt -> execute(array($num));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>