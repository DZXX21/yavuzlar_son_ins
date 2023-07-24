<?php
// Veritabanı bağlantısı için bilgiler
$servername = "localhost"; // Sunucu adı
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı şifresi
$dbname = "yavuzlar"; // Veritabanı adı

// Formdan gelen verileri alma
$fullname = $_POST['fullname-surname'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanı bağlantı hatası: " . $conn->connect_error);
}

// Verileri veritabanına ekleme
$sql = "INSERT INTO contact_form (fullname, email, subject, message) VALUES ('$fullname', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Mesajınız başarıyla kaydedildi!";
} else {
    echo "Hata: " . $sql . "<br>" . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
