<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    $conn = new mysqli('localhost', 'root', '', 'test');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO db(firstname, lastname, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss",$firstname, $lastname, $email, $password);
        
        if ($stmt->execute()) {
            echo "Registration successful...";
                exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
