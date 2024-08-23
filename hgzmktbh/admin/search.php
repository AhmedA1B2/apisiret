<?php

include "../../connect.php" ;

$search = filterRequest("search");

$stmt = $con->prepare("SELECT * FROM `starthgz` WHERE `book` Like ?");


$stmt -> execute(array("%" . $search . "%"));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}



?>