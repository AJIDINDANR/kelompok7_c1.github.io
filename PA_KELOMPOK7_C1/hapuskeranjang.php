<?php
session_start();


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
        
        if (array_key_exists($id - 1, $_SESSION['keranjang'])) {
            
            unset($_SESSION['keranjang'][$id - 1]);
            $_SESSION['keranjang'] = array_values($_SESSION['keranjang']); 

            
            header("Location: cart.php");
            exit();
        }
    }
}


header("Location: cart.php");
exit();
?>
