<?php

include "../../connect.php"; 


$searchValue = filterRequest("search_value");

if ($searchValue != '') {
    
    $sql = "SELECT COUNT(*) AS frequency
            FROM exam
            WHERE `idnum` = :searchValue";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
        $stmt->execute();

        $data = array();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $data[] = array(
                'value' => $searchValue,
                'frequency' => $row['frequency']+1
            );
        } else {
            $data[] = array(
                'message' => '0 results'
            );
        }

        
        echo json_encode(array("status" => "success", "data" => $data ));

    } catch (PDOException $e) {
        echo 'Query failed: ' . $e->getMessage();
    }
} else {
    echo json_encode(array('message' => 'No search value provided'));
}

?>
