<?php
// MySQL bağlantı bilgilerinizi burada ayarlayın
$host = "localhost";
$username = "root";
$password = "";
$database = "yavuzlar";

// Bağlantı oluşturma
$connection = mysqli_connect($host, $username, $password, $database);

// Bağlantı kontrolü
if (mysqli_connect_errno()) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// Formdan gelen verileri alınması
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcıyı veritabanında arama
    $query = "SELECT * FROM kullanici_tablosu WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        // Şifre doğrulama
        if (password_verify($password, $user['password'])) {
            // Şifre doğru, kullanıcı oturumunu başlat
            session_start();
            $_SESSION['username'] = $username;

            // Yönlendirme
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

// Bağlantıyı kapatma
mysqli_close($connection);
?>
