<?php

///--------------------------------///
include "../connect.php";


$who_added = 0;
$college_add = filterRequest("college_add");

$stmt = $con->prepare("UPDATE `n_exam`SET `who_added`=? WHERE `college_add`= ?");

$stmt->execute(array($who_added,$college_add));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}


?>

