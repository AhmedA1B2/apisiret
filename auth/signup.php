<?php 
 
 include "../connect.php" ; 

  $college  = filterRequest("college");
  $email     = filterRequest("email");
  $pass  = filterRequest("pass");

  $stmt = $con->prepare("INSERT INTO `admin`(`college`, `email`, `pass`) VALUES (?  , ? , ?)") ; 

  $stmt->execute(array($college , $email , $pass)) ;

  $count = $stmt->rowCount() ; 

  if ($count > 0) {
    echo json_encode(array("status" => "success")) ; 
  }else {
    echo json_encode(array("status" => "fail")) ; 
  }
