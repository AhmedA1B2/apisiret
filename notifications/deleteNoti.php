<?php

include "../connect.php";


$end_sem = 0;
$college_add = filterRequest("college_add");

$stmt = $con->prepare("UPDATE `notifications`SET `end_sem`=? WHERE `college_add`= ?");

$stmt->execute(array($end_sem,$college_add));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}


?>

