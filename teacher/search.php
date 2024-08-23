<?php

include "../connect.php" ;

$search = filterRequest("search");

$stmt = $con->prepare("SELECT * FROM `teacher` WHERE `emil` = ? OR `name` = ?");

$stmt -> execute(array($search,$search));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}



?>