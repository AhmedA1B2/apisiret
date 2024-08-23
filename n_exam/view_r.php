<?php

include "../connect.php" ;

$college_add = filterRequest("college_add");
$who_added   = 0;


$stmt = $con->prepare("SELECT * FROM `n_exam` WHERE `college_add` = ? And `who_added` = ?");

$stmt -> execute(array($college_add,$who_added));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success", "data" => $data ));
}else{
    echo json_encode(array("status" => "fail"));
}






 


?>