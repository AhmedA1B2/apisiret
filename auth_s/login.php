<?php 
 
  include "../connect.php" ; 
 
  $num = filterRequest("num");
  $pass  = filterRequest("pass");

  $stmt = $con->prepare("SELECT * FROM `student` WHERE `num` = ? AND `pass` = ? "); 

  $stmt->execute(array($num , $pass));

  $data = $stmt->fetch(PDO::FETCH_ASSOC); 

  $count = $stmt->rowCount() ; 

  if ($count > 0) {

    echo json_encode(array("status" => "success" , "data" => $data)); 

  }else {

    echo json_encode(array("status" => "fail")); 

  }
