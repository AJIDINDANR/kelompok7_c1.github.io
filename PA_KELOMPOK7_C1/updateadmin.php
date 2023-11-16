<?php
include "koneksi.php";


$id = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    
    $id = $_GET['id'];

    
    if (!ctype_digit($id)) {
        echo "Invalid ID";
        exit();
    }

    
    $sqlGetContact = "SELECT * FROM contact WHERE id = $id";
    $resultGetContact = mysqli_query($conn, $sqlGetContact);

    if ($resultGetContact) {
        $contact = mysqli_fetch_assoc($resultGetContact);

        
        if (!$contact) {
            echo "Contact not found";
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    
    if (!isset($_POST['id']) || !ctype_digit($_POST['id'])) {
        echo "Invalid ID";
        exit();
    }

    
    $id = $_POST['id'];

    
    $updatedNama = htmlspecialchars($_POST['na']);
    $updatedNoTelp = htmlspecialchars($_POST['no_telp']);
    $updatedEmail = htmlspecialchars($_POST['email']);
    $updatedPesan = htmlspecialchars($_POST['pesan']);

    $sqlUpdateContact = "UPDATE contact SET 
                        nama = '$updatedNama',
                        no_telp = '$updatedNoTelp',
                        email = '$updatedEmail',
                        pesan = '$updatedPesan'
                        WHERE id = $id";

    $resultUpdateContact = mysqli_query($conn, $sqlUpdateContact);

    if ($resultUpdateContact) {
        header("Location: admin.php"); 
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <title>Update Contact</title>
</head>

<body>

    <div id="updateForm">
        <h2>Update Contact</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <label for="na">Nama:</label>
            <input type="text" id="na" name="na" value="<?php echo $contact['nama']; ?>" required>

            <label for="no_telp">No. Telp:</label>
            <input type="tel" id="no_telp" name="no_telp" value="<?php echo $contact['no_telp']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $contact['email']; ?>" required>

            <label for="pesan">Pesan:</label>
            <textarea id="pesan" name="pesan" required><?php echo $contact['pesan']; ?></textarea>

            <button type="submit" name="update">Update</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>

</html>
