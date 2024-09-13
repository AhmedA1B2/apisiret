<?php

include "../connect.php" ;

$title   = filterRequest("title");
$messag  = filterRequest("messag");
$topic   = filterRequest("topic");
$college_add   = filterRequest("college_add");
$end_sem = 1;



$stmt = $con->prepare("INSERT INTO `notifications`( `title`, `messag`, `topic`,`end_sem`,`college_add`) VALUES (?,?,?,?,?)");

$stmt -> execute(array($title,$messag,$topic,$end_sem,$college_add));

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>