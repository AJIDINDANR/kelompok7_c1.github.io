<?php

include 'koneksi.php'; 


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    
    $query = "DELETE FROM contact WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        
        header('Location: admin.php'); 
        exit();
    } else {
        
        echo "Error: " . mysqli_error($conn);
    }

    
    mysqli_stmt_close($stmt);
    
    mysqli_close($conn);
} else {
    
    echo "Invalid or missing id parameter.";
}
?>
