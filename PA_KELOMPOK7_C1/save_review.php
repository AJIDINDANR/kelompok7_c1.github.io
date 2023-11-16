<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO reviews (nama, ulasan, rating) VALUES ('$name', '$comment', $rating)";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); 
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
