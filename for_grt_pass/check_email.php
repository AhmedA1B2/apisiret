<?php

include "../connect.php" ;

 
  $email = filterRequest("email");
  $verfiyCode = rand(10000 , 99999);

  $stmt = $con->prepare("SELECT * FROM `admin` WHERE email = ? "); 

  $stmt->execute(array($email )) ;
  $count = $stmt->rowCount() ; 

  result($count);

  if ($count > 0) {
    $data = array("verfiyCode"=>$verfiyCode);
    updateData("admin" ,$data, "email = '$email'" , false);
    sendEmail($email,"Verfiy Code Ecommerce","Verfiy Code $verfiyCode");

  }else {

    echo json_encode(array("status" => "fail")) ; 

  }























?>