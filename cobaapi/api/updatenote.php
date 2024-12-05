<?php
    header('Content-Type: application/json');
    include_once 'conn.php';
    setlocale(LC_ALL, 'id-ID');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $idNote = $_POST['id'];
        $note = $_POST["note"];
        $date = date('Y-m-d');
        
        mysqli_query($conn, "UPDATE notes SET note = '$note', date = '$date' WHERE id_note = '$idNote'");

        if(mysqli_affected_rows($conn) === 1) {
            $response = array("status"=>"200", "message"=>"Note berhasil diupdate!");
            echo json_encode($response);
        } else if(mysqli_affected_rows($conn) > 1) {
            $response = array("status"=>"idk", "message"=>"Yo bro you update entire data!!!");
            echo json_encode($response);
        } else {
            $response = array("status"=>"424", "message"=>mysqli_error($conn));
            echo json_encode($response);
        }
    } else {
        $response = array("status"=>"405", "message"=>"Method not allowed!");
        echo json_encode($response);
    }