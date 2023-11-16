<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_ke_keranjang'])) {
    // var_dump($_POST);

    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $quantity = $_POST['quantity'];


    $item = [
        'nama' => $nama,
        'harga' => $harga,
        'quantity' => $quantity,
    ];

    $_SESSION['keranjang'][] = $item;
}

function calculateTotal() {
    $total = 0;

    if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $pesanan) {
            $harga = $pesanan['harga'];
            $quantity = $pesanan['quantity'];
            $total += $harga * $quantity;
        }
    }

    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Shopping Cart</title>
</head>

<body>
    <header>
        <h1>Shopping Cart</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>

    <section id="menu">
    <?php
        $menuItems = [
            [
                'nama' => 'Nasi Ayam Goreng',
                'harga' => '25000',
                'foto' => 'foto/nasiayam.jpeg',
                'deskripsi' => 'Nasi Ayam Goreng Padang adalah hidangan khas Indonesia yang berasal dari Padang, Sumatra Barat. Hidangan ini terkenal karena perpaduan unik antara nasi yang harum dan lezat dengan ayam yang digoreng dengan bumbu khas Padang.',
            ],
            [
                'nama' => 'Nasi Rendang',
                'harga' => '25000',
                'foto' => 'foto/nasirendang.jpeg',
                'deskripsi' => 'Nasi Rendang Padang adalah hidangan khas Indonesia yang menggabungkan kelezatan nasi dengan daging sapi yang diolah dengan bumbu rendang khas Padang.',
            ],
            [
                'nama' => 'Nasi Telur Padang',
                'harga' => '20000',
                'foto' => 'foto/nasitelur.jpeg',
                'deskripsi' => 'Nasi Telur Padang adalah hidangan khas Indonesia yang sederhana namun lezat, menggabungkan kelezatan nasi dengan telur yang diolah dengan bumbu khas Padang.',
            ],
            [
                'nama' => 'Ayam Gulai',
                'harga' => '15000',
                'foto' => 'foto/ayamgulai.jpg',
                'deskripsi' => 'Ayam Gulai Padang adalah hidangan khas Indonesia yang memukau dengan kelezatan gulai berbumbu kaya khas Padang.',
            ],
            [
                'nama' => 'Nasi Ayam bakar',
                'harga' => '25000',
                'foto' => 'foto/ayam.jpg',
                'deskripsi' => 'Nasi Ayam Bakar Padang adalah hidangan lezat yang menyajikan perpaduan antara nasi yang harum, ayam yang dipanggang, dan bumbu khas Padang',
            ],
            [
                'nama' => 'Rendang',
                'harga' => '20000',
                'foto' => 'foto/nasirendang.jpeg',
                'deskripsi' => 'Rendang Padang adalah hidangan ikonik Indonesia yang memukau dengan kelezatan daging yang dimasak dalam santan dan rempah-rempah khas Padang',
            ],
            
        ];

        foreach ($menuItems as $menuItem) {
        ?>
            <div class="menu-item">
                <h2><?php echo $menuItem['nama']; ?></h2>
                <img src="<?php echo $menuItem['foto']; ?>" alt="gambar <?php echo $menuItem['nama']; ?>">
                <p><?php echo $menuItem['deskripsi']; ?></p>
                <p class="harga">Harga: Rp <?php echo $menuItem['harga']; ?></p>
                <form action="cart.php" method="post">
                    <input type="hidden" name="nama" value="<?php echo $menuItem['nama']; ?>">
                    <input type="hidden" name="harga" value="<?php echo $menuItem['harga']; ?>">
                    <label for="quantity">Jumlah:</label>
                    <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                    <button type="submit" name="tambah_ke_keranjang" class="add-to-cart-btn">Masukkan ke Keranjang</button>
                </form>
            </div>
        <?php
        }
        ?>
    </section>

    <section id="cart-content">
        <h2>Keranjang</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
                    $i = 1;
                    foreach ($_SESSION['keranjang'] as $pesanan) {
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $pesanan['nama']; ?></td>
                            <td><?php echo $pesanan['harga']; ?></td>
                            <td><?php echo $pesanan['quantity']; ?></td>
                            <td><a href="hapuskeranjang.php?id=<?php echo $i; ?>">Remove</a></td>
                        </tr>
                <?php
                        $i++;
                    }
                } else {
                    echo '<tr><td colspan="6">Your cart is empty</td></tr>';
                }
                ?>
            </tbody>
        </table>

        <p>Total: <?php echo calculateTotal(); ?></p>

        <a href="checkout.php">CHECKOUT</a>
    </section>

</body>

</html>
