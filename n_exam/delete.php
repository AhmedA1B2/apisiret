<?php

///--------------------------------///
include "../connect.php";


$who_added = 0;

$stmt = $con->prepare("UPDATE `n_exam`SET `who_added`=?");

$stmt->execute(array($who_added));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}


?>

