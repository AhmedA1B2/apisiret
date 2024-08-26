<?php

include "../connect.php";

$num = filterRequest("idnum");
$m = filterRequest("madaname");
$dnsfy = filterRequest("dnsfy");
$damly = filterRequest("damly");
$who_added = filterRequest("who_added");
$college_add = filterRequest("college_add");

$stmt = $con->prepare("INSERT INTO `n_exam`( `num`,`m`,`dnsfy`,`damly`,`who_added`,`college_add`) VALUES (?,?,?,?,?,?)");

$stmt->execute(array($num,$m, $dnsfy,$damly,$who_added,$college_add));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}


?>

