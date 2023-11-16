<?php
include "koneksi.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM nasipadang WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: admin.php?msg=Record deleted successfully");
        exit();
    } else {
        echo "Failed: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid ID!";
}
?>
