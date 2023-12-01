<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Processing</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pswd = $_POST["pswd"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, firstname, lastname, email, password FROM db";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $found = false;
        while ($row = mysqli_fetch_assoc($result)) {
            // Verify the password using password_verify
            if ($row["email"] == $email && $pswd == $row["password"]) {
                echo "Login Successful. " ."<br>email: ". $row["email"]."<br>password: ". $row["password"];
                exit();
            }
        }

        // Check if credentials were not found
        if (!$found) {
            echo "Invalid email or password.";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
} else {
    echo "Invalid request method.";
}
?>
</body>
</html>
