<?php
include 'koneksi.php';

session_start();

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

$orderPlaced = false;

function calculateTotal() {
    $total = 0;

    if (!empty($_SESSION['keranjang']) && is_array($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $pesanan) {
            $harga = $pesanan['harga'] ?? 0;
            $quantity = $pesanan['quantity'] ?? 0;
            $total += $harga * $quantity;
        }
    }

    return $total;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_order'])) {
    $insertQuery = "INSERT INTO shopping_cart (nama, harga, quantity, no_telp, alamat, pesanan, foto) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertQuery);

    foreach ($_SESSION['keranjang'] as $pesanan) {
        $nama = $pesanan['nama'] ?? '';
        $harga = $pesanan['harga'] ?? '';
        $quantity = $pesanan['quantity'] ?? '';
        $no_telp = isset($_POST['no_telp']) ? mysqli_real_escape_string($conn, $_POST['no_telp']) : '';
        $alamat = isset($_POST['alamat']) ? mysqli_real_escape_string($conn, $_POST['alamat']) : '';
        $additional_notes = isset($_POST['pesanan']) ? mysqli_real_escape_string($conn, $_POST['pesanan']) : '';

        $foto = upload_file(); 

        mysqli_stmt_bind_param($stmt, "sssssss", $nama, $harga, $quantity, $no_telp, $alamat, $additional_notes, $foto);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {
            die("Error: " . mysqli_stmt_error($stmt));
        }
    }

    
    $orderPlaced = true;
}

function upload_file()
{
    $namafile = $_FILES['payment_proof']['name'];
    $ukuranfile = $_FILES['payment_proof']['size'];
    $error = $_FILES['payment_proof']['error'];
    $tmpname = $_FILES['payment_proof']['tmp_name'];

    
    $extensifilevalid = ['jpg', 'jpeg', 'png'];
    $extensifile = pathinfo($namafile, PATHINFO_EXTENSION);
    $extensifile = strtolower($extensifile);

    if (!in_array($extensifile, $extensifilevalid)) {
        
        echo "<script>
                alert('Format file tidak valid');
                window.location.href='checkout.php';
            </script>";
        die();
    }

    
    if ($ukuranfile > 2048000) {
        
        echo "<script>
                alert('Ukuran file maksimal 2 MB');
                window.location.href='index.php';
            </script>";
        die();
    }

    
    $namafilebaru = uniqid() . '.' . $extensifile;

    
    move_uploaded_file($tmpname, 'foto/' . $namafilebaru);
    return $namafilebaru;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <title>Checkout</title>
</head>

<body>
    <header>
        <h1>Checkout</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>

    <section id="checkout-content">
        <h2>Order Details</h2>
        <?php if (!empty($_SESSION['keranjang']) && is_array($_SESSION['keranjang'])) : ?>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Menu</th>
                        <th>Harga</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($_SESSION['keranjang'] as $pesanan) :
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= htmlspecialchars($pesanan['nama']); ?></td>
                            <td><?= htmlspecialchars($pesanan['harga']); ?></td>
                            <td><?= htmlspecialchars($pesanan['quantity']); ?></td>
                        </tr>
                    <?php
                        $i++;
                    endforeach;
                    ?>
                </tbody>
            </table>

            <p>Total: <?= calculateTotal(); ?></p>

            <?php if ($orderPlaced) : ?>
                <p>Terima kasih telah berbelanja, pesanan sedang diproses!</p>
                <a href="index.php"><button>Back to Home</button></a>
            <?php else : ?>
                <form action="checkout.php" method="post" enctype="multipart/form-data">
                    <label for="no_telp">No. Telp:</label>
                    <input type="text" id="no_telp" name="no_telp" required>

                    <label for="alamat">Alamat:</label>
                    <textarea id="alamat" name="alamat" required></textarea>

                    <label for="pesanan">Additional Notes:</label>
                    <textarea id="pesanan" name="pesanan"></textarea>

                    <label for="payment_proof">Upload Proof of Payment:</label>
                    <input type="file" id="payment_proof" name="payment_proof" accept="image/*">

                    <input type="submit" name="submit_order" value="Submit Order">

                </form>
            <?php endif; ?>
        <?php else : ?>
            <p>Your order has been placed. Thank you for shopping with us!</p>
            <a href="index.php"><button>Back to Home</button></a>
        <?php endif; ?>
    </section>
</body>

</html>