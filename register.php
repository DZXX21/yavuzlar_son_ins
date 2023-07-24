<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "yavuzlar";

$connection = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $query = "INSERT INTO kullanici_tablosu (username, password) VALUES ('$username', '$hashed_password')";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Kullanıcı başarıyla kaydedildi.";
    } else {
        echo "Kullanıcı kaydedilirken bir hata oluştu.";
    }
}


mysqli_close($connection);
?>
