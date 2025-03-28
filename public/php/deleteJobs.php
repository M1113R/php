<?php
    try{
        $conn = new PDO("sqlite:database.sqlite");

        if ($_REQUEST['ID'] != NULL) {

            $ID = json_decode($_REQUEST['ID'], true);
            
            $conn->exec("DELETE FROM JOBS WHERE ID = '{$ID}';");

            $response = array("success" => true);
            echo json_encode($response);
        }
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
?>