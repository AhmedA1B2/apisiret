<?php

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
//
$dn1  = (float)filterRequest("dn1");
$dn2  = (float)filterRequest("dn2");
$dn3  = (float)filterRequest("dn3");
$dn4  = (float)filterRequest("dn4");
$dn5  = (float)filterRequest("dn5");
$dn6  = (float)filterRequest("dn6");
$dn7  = (float)filterRequest("dn7");
$dn8  = (float)filterRequest("dn8");
$dn9  = (float)filterRequest("dn9");
$dn10 = (float)filterRequest("dn10");
$dn11 = (float)filterRequest("dn11");
$dn12 = (float)filterRequest("dn12");
//
$d1  = filterRequest("d1")+$dn1;
$d2  = filterRequest("d2")+$dn2;
$d3  = filterRequest("d3")+$dn3;
$d4  = filterRequest("d4")+$dn4;
$d5  = filterRequest("d5")+$dn5;
$d6  = filterRequest("d6")+$dn6;
$d7  = filterRequest("d7")+$dn7;
$d8  = filterRequest("d8")+$dn8;
$d9  = filterRequest("d9")+$dn9;
$d10 = filterRequest("d10")+$dn10;
$d11 = filterRequest("d11")+$dn11;
$d12 = filterRequest("d12")+$dn12;
//
$in_finl  = filterRequest("in_finl");
//
$id = filterRequest("id_ex");



$stmt = $con->prepare("UPDATE `exam` SET `idnum`=?,`pass` = ?,`m1`= ?,`m2`= ?,`m3`= ?,`m4`= ?,`m5`= ?,`m6`= ?,`m7`= ?,`m8`= ?,`m9`= ?,`m10`= ?,`m11`= ?,`m12`= ?,`d1`= ?,`d2`= ?,`d3`= ?,`d4`= ?,`d5`= ?,`d6`= ?,`d7`= ?,`d8`= ?,`d9`= ?,`d10`= ?,`d11`= ?,`d12`= ?,`in_finl`=? WHERE `id_ex` = ?");

$stmt->execute(array($num, $pass, $m1, $m2, $m3, $m4, $m5, $m6, $m7, $m8, $m9, $m10, $m11, $m12, $d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12,$in_finl, $id));

$count = $stmt->rowCount();

if($count > 0){
echo json_encode(array("status" => "success"));
}else{
    echo json_encode(array("status" => "fail"));
}


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

    

    $stmtTime = $con->prepare("SELECT `idnum` FROM `exam` WHERE `idnum` = ?");
    $stmtTime->execute(array($num));
    $getTime = $stmtTime->fetchAll(PDO::FETCH_ASSOC);
    $time = sizeof($getTime)+1;
    $stmtSetTime = $con->prepare("UPDATE `student` SET `time`=? WHERE `num` = ?");
    $stmtSetTime->execute(array($time,$num));
    
    //
    $stmt = $con->prepare("SELECT `time` FROM `exam` WHERE `id_ex` = ?");
    $stmt->execute(array($id));
    $ValTime = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //
    if($ValTime[0]["time"] == 0){
        
    $stmtUpTime = $con->prepare("UPDATE `exam` SET `time`=? WHERE `id_ex` = ?");

    $stmtUpTime->execute(array($time-1,$id));
    
    $UpTime = $stmtUpTime->rowCount();
    }


    echo json_encode(array("status" => "success", "moadel" => $moadel, "tq" => $tq));





?>

