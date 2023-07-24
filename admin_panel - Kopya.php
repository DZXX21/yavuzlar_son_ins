<?php
// Oturum yönetimini başlatsss
session_start();

// Kullanıcı girişini kontrol et
if (!isset($_SESSION['username'])) {
    // Kullanıcı giriş yapmamışsa, login sayfasına yönlendir
    header("Location: login.php");
    exit();
}

// Kullanıcı adını al
$username = $_SESSION['username'];

// Veritabanı bağlantı bilgileri
$host = "localhost";
$db_username = "root";
$db_password = "";
$database = "yavuzlar";

// Veritabanı bağlantısını oluştur
$connection = mysqli_connect($host, $db_username, $db_password, $database);

// Bağlantı kontrolü
if (mysqli_connect_errno()) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

// "contact_form" tablosundan bilgileri al
$contact_query = "SELECT * FROM contact_form";
$contact_result = mysqli_query($connection, $contact_query);

// "kullanici_tablosu" tablosundan bilgileri al
$kullanici_query = "SELECT * FROM kullanici_tablosu";
$kullanici_result = mysqli_query($connection, $kullanici_query);

// Veritabanı bağlantısını kapat
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Hoş Geldiniz, <?php echo $username; ?>!</h1>
    <p>Bu sayfa sadece yöneticilere özeldir.</p>

    <!-- "contact_form" tablosundan çekilen bilgileri gösterme -->
    <h2>Contact Form Bilgileri</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($contact_result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['fullname'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['subject'] . "</td>";
            echo "<td>" . $row['message'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <!-- "kullanici_tablosu" tablosundan çekilen bilgileri gösterme -->
    <h2>Kullanıcı Tablosu Bilgileri</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($kullanici_result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <form action="logout.php" method="post">
        <input type="submit" value="Çıkış Yap">
    </form>

</body>
</html>
