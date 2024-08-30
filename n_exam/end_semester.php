<?php

include "../connect.php";

$who_added = 0;

$stmt = $con->prepare("SELECT * FROM `n_exam` WHERE `who_added` = ?");
$stmt->execute(array($who_added));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$d = [];
$stmtNum = $con->prepare("SELECT `num` FROM `n_exam` WHERE `who_added` = ?");
$stmtNum->execute(array($who_added));
$getNum = $stmtNum->fetchAll(PDO::FETCH_ASSOC);

/////////////////////////////////////////////////

for ($i = 0; $i < sizeof($getNum); $i++) {
    $num = (float)$getNum[$i]["num"];

    $stmtPass = $con->prepare("SELECT `pass` FROM `student` WHERE `num` = ?");
    $stmtPass->execute(array($num));
    $getPass = $stmtPass->fetchAll(PDO::FETCH_ASSOC);

    if (!isset($d[$num])) {
        $d[$num] = [
            'idnum' => $num,
            'pass' => implode(',', array_column($getPass, 'pass')), // تحويل المصفوفة إلى سلسلة نصية
            'm_values' => [],
            'd_values' => [],
            'who_added_values' => []
        ];
    }
    $d[$num]['m_values'][] = $data[$i]["m"];
    $d[$num]['d_values'][] = (float)$data[$i]["dnsfy"] + (float)$data[$i]["damly"];
    $d[$num]['who_added_values'][] = $data[$i]["college_add"];
}

foreach ($d as $num => $values) {
    $idnum = $values['idnum'];
    $passw = $values['pass'];
    $m_values = $values['m_values'];
    $d_values = $values['d_values'];
    $who_added_values = $values['who_added_values'][0]; // نفترض أنه نفس القيمة لكل الإدخالات

    // بناء استعلام الإدخال
    $columns = ['idnum','pass', 'who_added'];
    $placeholders = ['?', '?','?'];
    $params = [$idnum,$passw, $who_added_values];

    for ($j = 0; $j < sizeof($m_values); $j++) {
        $columns[] = 'm' . ($j + 1);
        $placeholders[] = '?';
        $params[] = $m_values[$j];

        $columns[] = 'd' . ($j + 1);
        $placeholders[] = '?';
        $params[] = $d_values[$j];
    }

    $columns_str = implode(',', $columns);
    $placeholders_str = implode(',', $placeholders);

    $insert_stmt = $con->prepare("INSERT INTO `exam` ($columns_str) VALUES ($placeholders_str)");
    $insert_stmt->execute($params);
}


$stmtDelete = $con->prepare("DELETE  FROM `n_exam` WHERE `who_added` = ?");
$stmtDelete->execute(array($who_added));

if ($stmt->rowCount() > 0) {
    echo json_encode(array("status" => "success", "data" => $d));
} else {
    echo json_encode(array("status" => "fail"));
}

?>
