<?php
session_start();
include "koneksi.php";



if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $pesanan = $_POST['pesanan'];
    $file = upload_file();

    $sql = "INSERT INTO `nasipadang`(`nama`, `no_telp`, `alamat`, `pesanan`, `file`) 
            VALUES ('$nama', '$no_telp', '$alamat', '$pesanan', '$file')";

    $result = mysqli_query($conn, $sql);

    if($result) {
        header("location: pesanmakan.php?msg=New record created successfully");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


function upload_file()
{
    $namafile = $_FILES['file']['name'];
    $ukuranfile = $_FILES['file']['size'];
    $error = $_FILES['file']['error'];
    $tmpname = $_FILES['file']['tmp_name'];

    
    $extensifilevalid = ['jpg', 'jpeg', 'png'];
    $extensifile = pathinfo($namafile, PATHINFO_EXTENSION);
    $extensifile = strtolower($extensifile);

    if (!in_array($extensifile, $extensifilevalid)) {
       
        echo "<script>
                alert('Format file tidak valid');
                window.location.href='pesanmakan.php';
            </script>";
        die();
    }

    
    if ($ukuranfile > 2048000) {
        // pesan gagal
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
    <link rel="stylesheet" href="style.css">
    <title>Table</title>
</head>

<body>
    <div class="add-form-container">
        <h1>Silahkan Masukkan Pesanan Anda</h1>
        <hr><br>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="textfield">
            <label for="no_telp">No.Telp</label>
            <input type="text" name="no_telp" class="textfield">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="textfield">
            <label for="pesanan">Pesanan</label>
            <input type="text" name="pesanan" class="textfield">
            <label for="file">Silahkan Upload Bukti Pembayaran</label>
            <input type="file" name="file" class="textfield">
            <input type="submit" name="tambah" value="Tambah Data" class="login-btn">
            <input type="button" name="tambah" value="Tambahkan ke Keranjang" onclick="tambahKeKeranjang()" class="login-btn">
        </form>
    </div>


    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Nomor Telpon</th>
                <th>Alamat</th>
                <th>Pesanan</th>
                <th>Bukti Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM nasipadang";
            $result = mysqli_query($conn, $sql);

            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo $row['no_telp']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['pesanan']; ?></td>
                <td><img src="foto/<?php echo $row['file']; ?>" alt="Foto" width="20" height="150"></td>
            </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>