<?php
    header('Content-Type: application/json');
    require_once '../api/conn.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
            
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $email = htmlspecialchars($_POST['email']);
    
            $result = mysqli_query($conn, "INSERT INTO users VALUES (null, '$username', '$password', '$email')");

            if($result) {
                $response = array("status"=>200, "message"=>"Register berhasil!");
                echo json_encode($response);
            } else {
                $response = array("status"=>424, "message"=>mysqli_error($conn));
                echo json_encode($response);
            }  

            
        }
    }