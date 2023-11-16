<?php
session_start();
include "koneksi.php";


$sql = "SELECT * FROM nasipadang";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>pesanmakan</title>
</head>

<body>

<!-- table shopping cart -->
<?php

    $query = "SELECT * FROM shopping_cart";
    $result = mysqli_query($conn, $query);


    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $allOrders = mysqli_fetch_all($result, MYSQLI_ASSOC);


    mysqli_free_result($result);
?>

<section id="all-orders-content">
    <h2>All Orders</h2>
    <?php if (!empty($allOrders)) : ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Additional Notes</th>
                    <th>bukti pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($allOrders as $order) :
                ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= htmlspecialchars($order['nama']); ?></td>
                        <td><?= htmlspecialchars($order['harga']); ?></td>
                        <td><?= htmlspecialchars($order['quantity']); ?></td>
                        <td><?= htmlspecialchars($order['no_telp']); ?></td>
                        <td><?= htmlspecialchars($order['alamat']); ?></td>
                        <td><?= htmlspecialchars($order['pesanan']); ?></td>
                        <td><img src="foto/<?php echo $order['foto']; ?>" alt="Foto" width="200" height="150"></td>
                    </tr>
                <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No orders found.</p>
    <?php endif; ?>
</section>



    <!-- table contact us -->
    <h2>Contact Us</h2>
    <?php
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

    $sqlGetData = "SELECT * FROM contact";
    $resultGetData = mysqli_query($conn, $sqlGetData);
    ?>

    <div id="dataDisplay">
        <h3>Data yang Tersimpan:</h3>
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1; 
                while ($row = mysqli_fetch_assoc($resultGetData)) {
                ?>
                    <tr>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['no_telp']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['pesan']; ?></td>
                        <td class="action">
                    <a href="deleteadmin.php?id=<?php echo $row["id"] ?>">
                        <button name="hapus" class="delete-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="white">
                                <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                            </svg>
                    </tr>
                <?php
                    $i++; 
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- table review -->
    <div class="review-container">
        <?php
        include "koneksi.php";

        $sqlSelectAll = "SELECT * FROM reviews ORDER BY id DESC";
        $resultSelectAll = mysqli_query($conn, $sqlSelectAll);

        if ($resultSelectAll) {
            echo "<h3>Semua Review:</h3>";

            echo "<table>";
            echo "<thead><tr><th>Nama</th><th>Ulasan</th><th>Rating</th></tr></thead>";
            echo "<tbody>";

            while ($row = mysqli_fetch_assoc($resultSelectAll)) {
                echo "<tr>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['ulasan'] . "</td>";
                echo "<td>" . $row['rating'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";

            mysqli_free_result($resultSelectAll);
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
        ?>
    </div>

    <div class="back-to-login">
        <a href="login.php">Back to Login</a>
    </div>
    <div id="successPopup" class="popup">
        <p id="successMessage"><?php echo $success_message; ?></p>
    </div>


    <script src="script.js"></script>
</body>
</html>
