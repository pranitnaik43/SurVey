<?php

    $name = $_POST["name"];
    $username = $_POST["username"];
    $userpass = $_POST["password"];
    $hashpass = password_hash($userpass , PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "surveydb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (Name, username, password) VALUES (?, ?, ?)";

    if($query = $conn->prepare($sql)){
        $query->bind_param("sss", $name, $username, $hashpass);
        $query->execute();
    }else{
       var_dump($conn->error);
    }

    $query->close();
    $conn->close();

    echo '<script>
        alert("Registration Complete");
        window.location="home.php";
        </script>';

?>