<?php

///--------------------------------///
include "../connect.php";

$num = filterRequest("idnum");
$m = filterRequest("m");
$dnsfy = filterRequest("dnsfy");
$damly = filterRequest("damly");
$id = filterRequest("id");

$stmt = $con->prepare("UPDATE `n_exam`SET `num`=?,`m`=?,`dnsfy`=?,`damly`=? WHERE `id` = ?");

$stmt->execute(array($num,$m, $dnsfy,$damly,$id));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}


?>

