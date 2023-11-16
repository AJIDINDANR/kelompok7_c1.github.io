<?php
include "koneksi.php";

$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['na']);
    $no_telp = htmlspecialchars($_POST['no_telp']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);

    $sql = "INSERT INTO `contact`(`nama`, `no_telp`, `email`, `pesan`) 
            VALUES ('$nama', '$no_telp', '$email', '$pesan')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $success_message = "Pesan terkirim! Terima kasih atas feedback Anda.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <h2>Contact Us</h2>
    <form action="contact.php" method="post" onsubmit="return showPopup()">
        <table>
            <tr>
                <td><label for="na">Nama:</label></td>
                <td><input type="text" id="na" name="na" required></td>
            </tr>
            <tr>
                <td><label for="no_telp">No. Telp:</label></td>
                <td><input type="tel" id="no_telp" name="no_telp" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="pesan">Pesan Kritik:</label></td>
                <td><textarea id="pesan" name="pesan" rows="4" required></textarea></td>
            </tr>
        </table>
        <button type="submit" name="submit">Kirim Pesan</button>
    </form>

    <div class="back-to-menu">
        <a href="index.php">Kembali ke Menu</a>
    </div>

    <script>
        function showPopup() {
            alert("Pesan anda telah terkirim. Terima kasih telah memberikan kritik.");
            return true; 
        }
    </script>
</body>
</html>
