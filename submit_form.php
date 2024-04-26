<?php

    function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    function validateText($text) {
        return !empty($text);
    }

    function isBlockedIP($conn, $ip_address) {
        // echo $ip_address;
        $sql = "SELECT * FROM blocked_ip WHERE blocked_ip = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ip_address);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $full_name    = htmlspecialchars($_POST['full_name']);
        $phone_number = $_POST['phone_number'];
        $email        = htmlspecialchars($_POST['email']);
        $subject      = htmlspecialchars($_POST['subject']);
        $message      = htmlspecialchars($_POST['message']);
        $ip_address;

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        if (!validateText($full_name) || !validateEmail($email) || !validateText($message)) {
            echo "Error: Invalid form data.";
            exit;
        }

        // jdbc:mysql://localhost:3306/

        $servername = "localhost";
        $port       = 3306;
        $username   = "root";
        $password   = "Inderneel_1975_@08";
        $dbname     = "phptask";

        $conn = new mysqli($servername, $username, $password, $dbname, $port);

        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        if(isBlockedIP($conn,$ip_address)){
            echo "Error: Your IP address has been blocked.";
            $conn->close();
            exit;
        }

        $dbname     = "contact_form";

        $sql = "INSERT INTO contact_form (full_name,phone_number,email,subject,message) VALUES (?,?,?,?,?)";
        
        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssss",$full_name,$phone_number,$email,$subject,$message);

        if(!($stmt->execute())){
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }

?>