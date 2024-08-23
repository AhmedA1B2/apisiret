<?php

include "../../connect.php" ;

$book    = filterRequest("book");
$why_cancel    = filterRequest("why_cancel");
$id_add    = filterRequest("id_add");
$id      = filterRequest("id");


///////////////////////////DELETE////////////////////////////
//??;;;;;;;;;;;;;;;;;;;;;;;;;|;;;;;;;;;;;;;;;;;;;;;;;;;;;??//

if($id != ""){

    $stmt = $con->prepare("DELETE FROM `mktbh_hgz` WHERE `id` = ?");
    
    $stmt -> execute(array($id));
    
    
    $count = $stmt->rowCount();
    
    if($count > 0){
    echo json_encode(array("status" => "success"));
    }else{
        echo json_encode(array("status" => "fail"));
    }
    }
    
////////////////////////////[  .  ]////////////////////////////
    
    elseif($book != ""){
        $stmt = $con->prepare(" INSERT INTO `cancel`(`book`,`why_cancel`,`id_add`) VALUES (?,?,?)");
    
    
    $stmt -> execute(array($book,$why_cancel,$id_add));
    
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $count = $stmt->rowCount();
    
    if($count > 0){
    echo json_encode(array("status" => "success"));
    }else{
        echo json_encode(array("status" => "fail"));
    }
    
    }else{
        echo json_encode(array("status" => "fail"));
    }
    
    
    
    
    
    
    
     
    
    
?>