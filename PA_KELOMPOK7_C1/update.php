<?php
include "koneksi.php";


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $conn->prepare("SELECT * FROM nasipadang WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {
        $nasipadang = $result->fetch_assoc();

        if ($nasipadang) {
            
            if (isset($_POST['update'])) {
                
                $nama = $_POST['nama'];
                $no_telp = $_POST['no_telp'];
                $alamat = $_POST['alamat'];
                $pesanan = $_POST['pesanan'];

                
                $update_stmt = $conn->prepare("UPDATE nasipadang SET nama=?, no_telp=?, alamat=?, pesanan=? WHERE id=?");
                $update_stmt->bind_param("ssssi", $nama, $no_telp, $alamat, $pesanan, $id);

                
                if ($update_stmt->execute()) {
                    
                    echo "
                    <script>
                        alert('Data berhasil Diubah!');
                        document.location.href = 'table.php';
                    </script>";
                } else {
                    
                    echo "
                    <script>
                        alert('Data Gagal Diubah!');
                        document.location.href = 'update.php?id={$id}';
                    </script>";
                }

                $update_stmt->close();
            }
        } else {
            
            echo "Data tidak ditemukan!";
        }
    } else {
        
        echo "Error: " . $conn->error;
    }

    $stmt->close();
} else {
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- formulir memperbarui data -->
    <div class="add-form-container">
        <h1>Update Data</h1>
        <hr><br>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $nasipadang['id']; ?>">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="textfield" value="<?php echo $nasipadang['nama']; ?>">
            <label for="no_telp">No.Telp</label>
            <input type="number" name="no_telp" class="textfield" value="<?php echo $nasipadang['no_telp']; ?>">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="textfield" value="<?php echo $nasipadang['alamat']; ?>">
            <label for="pesanan">Pesanan</label>
            <input type="text" name="pesanan" class="textfield" value="<?php echo $nasipadang['pesanan']; ?>">
            <label for="file">Silahkan Upload Ulang Bukti Pembayaran</label>
            <input type="file" name="file" class="textfield">
            <input type="submit" name="update" value="Update Data" class="login-btn">
        </form>
    </div>
</body>
</html>
