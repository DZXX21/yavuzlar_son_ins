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
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            margin-top: 30px;
            color: #333;
        }

        p {
            text-align: center;
            color: #555;
        }

        table {
            margin: 30px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        form {
            text-align: center;
            margin-top: 30px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 3px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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
