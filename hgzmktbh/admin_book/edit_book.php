<?php

include "../../connect.php" ;

$title   = filterRequest("title");
$description  = filterRequest("description");
$category     = filterRequest("category");
$pdf   = filterRequest("pdf");
$id =  filterRequest("id");

$stmt = $con->prepare("UPDATE `books`SET `title`=?, `description`=?,`category`=? ,`pdf`=? WHERE `id`=?");

$stmt -> execute(array($title,$description,$category,$pdf,$id));

$count = $stmt->rowCount();

if($count > 0){
    echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}

?>
