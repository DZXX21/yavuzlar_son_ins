<?php
// Oturum yönetimini başlat
session_start();

// Oturumu kapatma işlemi
session_destroy();

// Kullanıcıyı login sayfasına yönlendir
header("Location: login.html");
exit();
?>
