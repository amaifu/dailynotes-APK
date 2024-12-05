<?php
    header('Content-Type: application/json');
    require_once '../api/conn.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
        if(isset($_POST['username']) && isset($_POST['password'])) {
    
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
    
            $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

            if(mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if(password_verify($password, $user['password'])) {

                    $userId = $user["id_user"];
                    $response = array("status"=>200, "message"=>"Login success!" ,"session_key"=>$userId);
                    echo json_encode($response);

                } else {
                    $response = array("status"=>"idk", "message"=>"Login failed!");
                    echo json_encode($response);
                }
            } else {
                $response = array("status"=>404, "message"=>"Account not found!");
                echo json_encode($response);
            }
        }
    }