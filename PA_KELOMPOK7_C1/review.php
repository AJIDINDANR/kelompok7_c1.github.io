<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $ulasan = htmlspecialchars($_POST['ulasan']);
    $rating = intval($_POST['rating']);

    $sql = "INSERT INTO reviews (nama, ulasan, rating) VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        
        mysqli_stmt_bind_param($stmt, "ssi", $nama, $ulasan, $rating);

        
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            
            header("location: review.php?msg=Review berhasil disubmit");
            exit();
        } else {
            
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        
        mysqli_stmt_close($stmt);
    } else {
        
        echo "Error: " . mysqli_error($conn);
    }

    
    mysqli_close($conn);
}


$sqlSelectAll = "SELECT * FROM reviews ORDER BY id DESC";
$resultSelectAll = mysqli_query($conn, $sqlSelectAll);

if ($resultSelectAll) {
    echo "<h3>Semua Review:</h3>";

    while ($row = mysqli_fetch_assoc($resultSelectAll)) {
        echo "<p><strong>Nama:</strong> " . $row['nama'] . "</p>";
        echo "<p><strong>Ulasan:</strong> " . $row['ulasan'] . "</p>";
        echo "<p><strong>Rating:</strong> " . $row['rating'] . "</p>";
        echo "<hr>"; 
    }

    mysqli_free_result($resultSelectAll);
} else {
    
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Review Pelanggan Rumah Makan Padang</h2>

    <form action="review.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="ulasan">Ulasan:</label>
        <textarea id="ulasan" name="ulasan" rows="4" required></textarea>

        <label for="rating">Rating:</label>
        <select id="rating" name="rating" required>
            <option value="5">5 (Sangat Baik)</option>
            <option value="4">4 (Baik)</option>
            <option value="3">3 (Cukup)</option>
            <option value="2">2 (Buruk)</option>
            <option value="1">1 (Sangat Buruk)</option>
        </select>

        <button type="submit" name="submit">Submit Review</button>
    </form>

    

    <script src="script.js"></script>
</body>
</html>
