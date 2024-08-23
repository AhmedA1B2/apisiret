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

$data = [
"m1"=>$m1,
"m2"=>$m2,
"m3"=>$m3,
"m4"=>$m4,
"m5"=>$m5,
"m6"=>$m6,
"m7"=>$m7,
"m8"=>$m8,
"m9"=>$m9,
"m10"=>$m10,
"m11"=>$m11,
"m12"=>$m12,
"d1"=>$d1,
"d2"=>$d2,
"d3"=>$d3,
"d4"=>$d4,
"d5"=>$d5,
"d6"=>$d6,
"d7"=>$d7,
"d8"=>$d8,
"d9"=>$d9,
"d10"=>$d10,
"d11"=>$d11,
"d12"=>$d12,
];

$mf = [];
    for ($i = 1; $i <= 12; $i++) {
        $mf[$i] = $data["m$i"];
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
        $moadel = 0;
    }
    
    $moadel = number_format($moadel, 2); 


$stmt = $con->prepare("INSERT INTO `exam`( `idnum`,`pass`,`m1`,`m2`,`m3`,`m4`,`m5`,`m6`,`m7`,`m8`,`m9`,`m10`,`m11`,`m12`,`d1`,`d2`,`d3`,`d4`,`d5`,`d6`,`d7`,`d8`,`d9`,`d10`,`d11`,`d12`,`time`,`who_added`,`mof`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$stmt->execute(array($num, $pass, $m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12, $d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12, $time, $who_added, $moadel));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "fail"));
}

$num = filterRequest("idnum");
$fm = 100;


    $stmt = $con->prepare("SELECT * FROM `exam` WHERE `idnum` = ?");
    $stmt->execute(array($num));
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$data) {
        throw new Exception("لم يتم العثور على بيانات للرقم: $num");
    }

    $mf = [];
    $d = [];
    $unity = [];

    
    foreach ($data as $row) {
        for ($i = 1; $i <= 12; $i++) {
            $mf[$i][] = $row["m$i"];
            $d[$i][] = (float)$row["d$i"];
        }
    }

    
    for ($i = 1; $i <= 12; $i++) {
        $unity[$i] = [];
        foreach ($mf[$i] as $mf_val) {
            $code_stmt = $con->prepare("SELECT `num` FROM `code` WHERE `code` = ?");
            $code_stmt->execute(array($mf_val));
            $codeData = $code_stmt->fetch(PDO::FETCH_ASSOC);

            if ($codeData) {
                $unity[$i][] = (float)$codeData['num'];
            } else {
                $unity[$i][] = 0;
            }
        }
    }

    
    $mg1 = 0;
    $mg2 = 0;
    for ($i = 1; $i <= 12; $i++) {
        foreach ($d[$i] as $key => $d_val) {
            $mg1 += $d_val * $unity[$i][$key];
            $mg2 += $fm * $unity[$i][$key];
        }
    }

    
    if ($mg2 != 0) {
        $moadel = ($mg1 / $mg2) * $fm;
    } else {
        $moadel = 0;
    }

    
    $moadel = number_format($moadel, 2); 
    $tq = "";
    if($moadel >= 85) {
        $tq = "ممتاز";
    } elseif($moadel >= 75) {
        $tq = "جيد جدا";
    } elseif($moadel >= 65) {
        $tq = "جيد";
    } elseif($moadel >= 50) {
        $tq = "مقبول";
    } else {
        $tq = "ضعيف";
    }

    
    $stmt = $con->prepare("UPDATE `student` SET `mo`=?, `tq`=? WHERE `num` = ?");
    $stmt->execute(array($moadel, $tq, $num));

    echo json_encode(array("status" => "success", "moadel" => $moadel, "tq" => $tq));


    //time

    $stmt = $con->prepare("UPDATE `student` SET `time`=? WHERE `num` = ?");
    $stmt->execute(array($time+1,$num));


?>

