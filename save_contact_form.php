<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "yavuzlar"; 

$fullname = $_POST['fullname-surname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}


$sql = "INSERT INTO contact_form (fullname, email, subject, message) VALUES ('$fullname', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Mesajınız başarıyla kaydedildi!";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
