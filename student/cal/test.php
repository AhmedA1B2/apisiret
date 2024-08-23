
<!-- ============== 2024/6/4 =============== -->

<?php

///--------------------------------///
include "../connect.php";

$num = filterRequest("idnum");
$pass = filterRequest("pass");
$m1 = filterRequest("m1");
$m2 = filterRequest("m2");
$m3 = filterRequest("m3");
$m4 = filterRequest("m4");
$m5 = filterRequest("m5");
$m6 = filterRequest("m6");
$m7 = filterRequest("m7");
$m8 = filterRequest("m8");
$m9 = filterRequest("m9");
$m10 = filterRequest("m10");
$m11 = filterRequest("m11");
$m12 = filterRequest("m12");

$d1 = filterRequest("d1");
$d2 = filterRequest("d2");
$d3 = filterRequest("d3");
$d4 = filterRequest("d4");
$d5 = filterRequest("d5");
$d6 = filterRequest("d6");
$d7 = filterRequest("d7");
$d8 = filterRequest("d8");
$d9 = filterRequest("d9");
$d10 = filterRequest("d10");
$d11 = filterRequest("d11");
$d12 = filterRequest("d12");
$time = filterRequest("time");
$who_added = filterRequest("who_added");

$fm = 100;

$exam = $con->prepare("SELECT * FROM `exam` WHERE `idnum` = ?");
$exam->execute(array($num));

$data = $exam->fetch(PDO::FETCH_ASSOC);
$cou = $exam->rowCount();

if ($cou > 0) {
    $mf = [];
    for ($i = 1; $i <= 12; $i++) {
        $mf[$i] = (float)$data["m$i"];
    }

    $unity = [];

    for ($i = 1; $i <= 12; $i++) {
        $code_stmt = $con->prepare("SELECT `num` FROM `code` WHERE `code` = ?");
        $code_stmt->execute(array($mf[$i]));
        $codeData = $code_stmt->fetch(PDO::FETCH_ASSOC);

        if ($code_stmt->rowCount() > 0) {
            $unity[$i] = (float)$codeData['num'];
        } else {
            $unity[$i] = 0;
        }
    }

    $d = [];
    for ($i = 1; $i <= 12; $i++) {
        $d[$i] = (float)$data["d$i"];
    }

    $mg1 = 0;
    $mg2 = 0;
    for ($i = 1; $i <= 12; $i++) {
        $mg1 += $d[$i] * $unity[$i];
        $mg2 += $fm * $unity[$i];
    }

    if ($mg2 != 0) {
        $moadel = ($mg1 / $mg2) * $fm;
    } else {
        $moadel = 1.1;
    }
} else {
    $moadel = 1.2;
}

$stmt = $con->prepare("INSERT INTO `exam`( `idnum`,`pass`,`m1`,`m2`,`m3`,`m4`,`m5`,`m6`,`m7`,`m8`,`m9`,`m10`,`m11`,`m12`,`d1`,`d2`,`d3`,`d4`,`d5`,`d6`,`d7`,`d8`,`d9`,`d10`,`d11`,`d12`,`time`,`who_added`,`mof`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$stmt->execute(array($num, $pass, $m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12, $d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12, $time, $who_added, $moadel));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}






?>


<?php
/*

include "../connect.php" ;

$num = filterRequest("idnum");
$pass= filterRequest("pass");
$m1  = filterRequest("m1");
$m2  = filterRequest("m2");
$m3  = filterRequest("m3");
$m4  = filterRequest("m4");
$m5  = filterRequest("m5");
$m6  = filterRequest("m6");
$m7  = filterRequest("m7");
$m8  = filterRequest("m8");
$m9  = filterRequest("m9");
$m10  = filterRequest("m10");
$m11  = filterRequest("m11");
$m12  = filterRequest("m12");

$d1  = filterRequest("d1");
$d2  = filterRequest("d2");
$d3  = filterRequest("d3");
$d4  = filterRequest("d4");
$d5  = filterRequest("d5");
$d6  = filterRequest("d6");
$d7  = filterRequest("d7");
$d8  = filterRequest("d8");
$d9  = filterRequest("d9");
$d10 = filterRequest("d10");
$d11 = filterRequest("d11");
$d12 = filterRequest("d12");
$time = filterRequest("time");
$who_added = filterRequest("who_added");



$stmt = $con->prepare("INSERT INTO `exam`( `idnum`,`pass`,`m1`,`m2`,`m3`,`m4`,`m5`,`m6`,`m7`,`m8`,`m9`,`m10`,`m11`,`m12`,`d1`,`d2`,`d3`,`d4`,`d5`,`d6`,`d7`,`d8`,`d9`,`d10`,`d11`,`d12`,`time`,`who_added`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");


$stmt->execute(array($num, $pass, $m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12, $d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12, $time, $who_added));

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}



*/
?>



<!-- ====================================== -->

<?php

include "../../connect.php"; 


$fm = 100;
$num = filterRequest("num");


$exam = $con->prepare("SELECT * FROM `exam`  WHERE `num` = ?");


$exam->execute(array($num));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();


if ($count>0) {

    $m1 =  $count['m1'];
    $m2  = $count['m2'];
    $m3  = $count['m3'];
    $m4  = $count['m4'];
    $m5  = $count['m5'];
    $m6  = $count['m6'];
    $m7  = $count['m7'];
    $m8  = $count['m8'];
    $m9  = $count['m9'];
    $m10 = $count['m10'];
    $m11 = $count['m11'];
    $m12 = $count['m12'];

$code1 = $con->prepare("SELECT * FROM `code`  WHERE `m1` = ?");

$code1->execute(array($m1));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$result1 = $stmt->rowCount();

$unity1 = $result1['code'];


$code2 = $con->prepare("SELECT * FROM `code`  WHERE `m2` = ?");

$code2->execute(array($m2));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$result2 = $stmt->rowCount();

$unity2 = $result2['code'];























    
   $d1  = $count['d1'];
   $d2  = $count['d2'];
   $d3  = $count['d3'];
   $d4  = $count['d4'];
   $d5  = $count['d5'];
   $d6  = $count['d6'];
   $d7  = $count['d7'];
   $d8  = $count['d8'];
   $d9  = $count['d9'];
   $d10 = $count['d10'];
   $d11 = $count['d11'];
   $d12 = $count['d12'];




} else {
    
    $columnValue = null;
}












?>

