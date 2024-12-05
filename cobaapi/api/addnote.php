<?php
    header('Content-Type: application/json');
    include_once 'conn.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $date = date('Y-m-d');
        $note = mysqli_real_escape_string($conn, $_POST['note']);
        $idUser = $_POST['session_key'];
    
        $result = mysqli_query($conn, "INSERT INTO notes VALUES (null, '$idUser', '$note', '$date')");

        if($result) {
            $response = array("status"=>200, "message"=>"Note berhasil ditambahkan!");
            echo json_encode($response);
        } else {
            $response = array("status"=>"idk", "message"=>"Note gagal ditambahkan!");
            echo json_encode($response);
        }
    } else {
        $response = array("status"=>405, "message"=>"Method not allowed!");
        echo json_encode($response);
    }
