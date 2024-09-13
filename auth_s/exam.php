<?php

include "../connect.php";

$pass = filterRequest("pass");
$num = filterRequest("idnum");

$stmt = $con->prepare("SELECT * FROM `exam` WHERE `pass` = ? AND `idnum` = ?");
$stmt->execute(array($pass, $num));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

$unity = [];

if ($count > 0) {
    
    for ($i = 1; $i <= 12; $i++) {
        foreach ($data as $index => $row) {
            $mf_val = $row["m$i"];
            if ($mf_val) {
                
                $code_stmt = $con->prepare("SELECT `name` FROM `code` WHERE `code` = ?");
                $code_stmt->execute(array($mf_val));
                $codeData = $code_stmt->fetch(PDO::FETCH_ASSOC);

                if ($codeData) {
                    $unity[$index][$i][] = $codeData['name'];
                } else {
                    $unity[$index][$i][] = 0; 
                }
            }
        }
    }

    foreach ($data as $index => &$row) {
        for ($s = 1; $s <= 12; $s++) {
            if (isset($unity[$index][$s])) {
                $sizeFoInUnity = sizeof($unity[$index][$s]);
                for ($i = 0; $i < $sizeFoInUnity; $i++) {
                    $row["m$s"] = $unity[$index][$s][$i];
                }
            }
        }
    }

    echo json_encode(array("status" => "success", "data" => $data)); 
} else {
    echo json_encode(array("status" => "fail"));
}

?>
