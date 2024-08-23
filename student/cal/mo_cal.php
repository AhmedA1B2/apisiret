<?php

include "../../connect.php"; 

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



?>
