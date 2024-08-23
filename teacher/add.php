<?php

include "../connect.php" ;

$name      = filterRequest("name");
$emil       = filterRequest("emil");
$pass      = filterRequest("pass");
$college   = filterRequest("college");
$who_added = filterRequest("who_added");



$stmt = $con->prepare("INSERT INTO `teacher`( `name`, `emil`, `pass`,`college`,`who_added`) VALUES (?,?,?,?,?)");

$stmt -> execute(array($name,$emil,$pass,$college,$who_added));

# $data = $stmt->fetch(PDO::FETCH_ASSOC); #

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}









?>