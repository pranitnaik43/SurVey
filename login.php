<?php
    session_start();

    $username = $_POST["username"];
    $userpass = $_POST["password"];
    $hashpass = password_hash($userpass , PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "surveydb");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * from users where username=?";
    
    if($query = $conn->prepare($sql)){
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();
        $row = $result->fetch_assoc();

        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["Name"] = $row["Name"];
        $_SESSION["username"] = $row["username"];

        // echo $_SESSION["user_id"] . " " . $_SESSION["Name"] . " " . $_SESSION["username"];

    }else{
       var_dump($conn->error);
    }

    $query->close();
    $conn->close();

    echo '<script>
        alert("Successfully Logged in!!!");
        window.location="home.php";
        </script>';

?>