<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/teams.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new teams($db);

    $stmt = $items->getTeam();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $teamArr = array();
        $teamArr["body"] = array();
        $teamArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "win" => $win,
                "loss" => $loss,
                "tie" => $tie,
                "date_entered" => $date_entered
            );

            array_push($teamArr["body"], $e);
        }
        echo json_encode($teamArr);
    }


    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>