<?php
    header('Content-Type: application/json');
    include_once 'conn.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(!isset($_GET['session_key'])) {
            $response = array("status"=>404, "message"=>"not found!");
            echo json_encode($response);
            return;
        }
        $idUser = $_GET["session_key"];
        $results = mysqli_query($conn, "SELECT * FROM notes WHERE id_user = '$idUser' ORDER BY id_note DESC");


        $notes = [];
        if(mysqli_fetch_assoc($results)) {
            foreach ( $results as $result) {
                array_push($notes, $result);
            };
        };
        
        if($notes > 0) {
            $response = array("status"=>200, "message"=>"Notes berhasil difetch!", "notes"=>$notes);
            echo json_encode($response);
        } else {
            $response = array("status"=>404, "message"=>"Anda tidak memiliki notes!");
            echo json_encode($response);
        }
    } else {
        $response = array("status"=>"405", "message"=>"Method not allowed!");
        echo json_encode($response);
    }