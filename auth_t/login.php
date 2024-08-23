<?php 
 
  include "../connect.php" ; 
 
  $emil = filterRequest("emil");
  $pass  = filterRequest("pass");

  $stmt = $con->prepare("SELECT * FROM `teacher` WHERE `emil` = ? AND `pass` = ? "); 

  $stmt->execute(array($emil , $pass));

  $data = $stmt->fetch(PDO::FETCH_ASSOC); 

  $count = $stmt->rowCount() ; 

  if ($count > 0) {

    echo json_encode(array("status" => "success" , "data" => $data)); 

  }else {

    echo json_encode(array("status" => "fail")); 

  }
