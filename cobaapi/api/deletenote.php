<?php
  header('Content-Type: application/json');
  include_once 'conn.php';

  if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $idNote = $_GET['id'];

    mysqli_query($conn, "DELETE FROM notes WHERE id_note = '$idNote'");

    if(mysqli_affected_rows($conn) > 0) {
        $response = array("status"=>200, "message"=>"Note berhasil dihapus!");
        echo json_encode($response);
    } else {
        $response = array("status"=>"idk", "message"=>"Note gagal dihapus!");
        echo json_encode($response);
    }
  } else {
    $response = array("status"=>"405", "message"=>"Method not allowed!");
    echo json_encode($response);
  }