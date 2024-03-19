<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "donemproje";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanına bağlantı hatası: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['sendCode'])) {
        $username = $_POST['username'];

        $query = "SELECT * FROM kullanici WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($username_found) {
           
            $reset_code = uniqid(); 
           
        }
    }

    // Şifre değiştirme işlemi
    if (isset($_POST['resetPassword'])) {
        $reset_code = $_POST['reset_code'];
        $new_password = $_POST['new_password'];

        // Veritabanında şifre sıfırlama kodunu kontrol etme işlemi
        // Şifre sıfırlama kodu doğru ise kullanıcının şifresini güncelleme işlemi yapılacak
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Sıfırlama</title>
</head>
<body>
    <?php if (isset($reset_code)): ?>
        <!-- Şifre sıfırlama kodunu girmek için form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="reset_code" value="<?php echo $reset_code; ?>">
            <label for="new_password">Yeni Şifre:</label>
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit" name="resetPassword">Şifreyi Değiştir</button>
        </form>
    <?php else: ?>
        <!-- Kullanıcı adını kontrol etmek için form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Mail adresi:</label>
            <input type="text" id="username" name="username" placeholder="Kullanıcı adınızı giriniz" required>
            <button type="submit" name="sendCode">Kontrol et</button>
        </form>
    <?php endif; ?>
</body>
</html>
