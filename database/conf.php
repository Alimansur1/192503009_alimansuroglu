<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "donemproje";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Güvenlik için SQL Injection önlemi
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    // Kullanıcı adı ve şifreyi veritabanında kontrol et
    $stmt = $conn->prepare("SELECT * FROM kullanici WHERE username=:username AND password=:password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();


    if ($stmt->rowCount() > 0) {

        echo "Giriş başarılı. Hoş geldiniz, $username!";
    } else {

        echo "Giriş başarısız. Kullanıcı adı veya şifre hatalı!";
    }
}
catch(PDOException $e) {

    echo "Bağlantı hatası: " . $e->getMessage();
}


$conn = null;
?>
