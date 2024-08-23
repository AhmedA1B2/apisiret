<?php 
 
  include "../connect.php" ; 
 
  $email = filterRequest("email");

  $pass  = filterRequest("pass");

  $stmt = $con->prepare("SELECT * FROM `admin` WHERE `pass` = ? AND email = ? "); 

  $stmt->execute(array( $pass , $email )) ;

  $data = $stmt->fetch(PDO::FETCH_ASSOC) ; 

  $count = $stmt->rowCount() ; 

  if ($count > 0) {

    echo json_encode(array("status" => "success" , "data" => $data)) ; 

  }else {

    echo json_encode(array("status" => "fail")) ; 

  }
