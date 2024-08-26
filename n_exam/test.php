<?php

include "../connect.php" ;

$id = 364;

$stmt = $con->prepare("SELECT `time` FROM `exam` WHERE `id_ex` = ?");
    $stmt->execute(array($id));
    $ValTime = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //
    echo json_encode($ValTime[0]["time"]);
    if($ValTime[0]["time"] == 0){
        echo json_encode(array("true"));
    }
  // if($ValTime == 0){
  //     
  // $stmtUpTime = $con->prepare("UPDATE `exam` SET `time`=? WHERE `id_ex` = ?");

  // $stmtUpTime->execute(array($time-1,$id));
  // 
  // $UpTime = $stmtUpTime->rowCount();
  // }


    ?>