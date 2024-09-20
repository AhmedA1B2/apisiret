<?php

include "../../connect.php" ;

$title        = filterRequest("title");
$description  = filterRequest("description");
$category     = filterRequest("category");
$pdf          = filterRequest("pdf");
$mhgoz        = 0;



$stmt = $con->prepare("INSERT INTO `books`( `title`, `description`,`category`, `pdf`,`mhgoz`) VALUES (?,?,?,?,?)");

$stmt -> execute(array($title,$description,$category,$pdf,$mhgoz));

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>