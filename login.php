<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "yavuzlar";

$connection = mysqli_connect($host, $username, $password, $database);

// Bağlantı kontrolü
if (mysqli_connect_errno()) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM kullanici_tablosu WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            session_start();
            $_SESSION['username'] = $username;

           
            ob_start();
            header("Location: admin_panel.php");
            ob_end_flush();
            exit();
        } else {
            echo "Hatalı kullanıcı adı veya şifre.";
        }
    } else {
        echo "Hatalı kullanıcı adı veya şifre.";
    }
}

mysqli_close($connection);
?>
