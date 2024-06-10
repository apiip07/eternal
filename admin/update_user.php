<?php
include '../koneksi.php';

if(isset($_POST['update'])) {
    $ID = $_POST['ID'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Lakukan proses update data di database
    $query = "UPDATE user SET username='$username', password='$password', email='$email' WHERE ID=$ID";
    $result = mysqli_query($mysqli, $query);

    if($result) {
        echo "Data berhasil diperbarui.";
        header("Location: user.php"); // Redirect kembali ke halaman data user
        exit();
    } else {
        echo "Terjadi kesalahan: " . mysqli_error($mysqli);
    }
}

// Mendapatkan data user yang akan diupdate
if(isset($_GET['id'])) {
    $ID = $_GET['id'];
    $query = "SELECT * FROM user WHERE id=$ID";
    $result = mysqli_query($mysqli, $query);
    $data = mysqli_fetch_assoc($result);
} else {
    echo "ID user tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="styleuptade.css">
</head>
<body>
<div class="container">
        <header>
            <h1 class="title">Uptade User</h1>
        </header>
        <section class="form">
        <form method="POST" action="update_user.php">
        <input type="hidden" name="ID" value="<?php echo $data['ID']; ?>">

        <input type="text" ID="username" name="username" placeholder="Username" value="<?php echo $data['username']; ?>"><br>

        <input type="password" ID="password" name="password" placeholder="Password" value="<?php echo $data['password']; ?>"><br>

        <input type="email" ID="email" name="email" placeholder="Email" value="<?php echo $data['email']; ?>"><br><br>
        <input type="submit" name="update" value="Update" class="button">
    </form>
        </section>
    </div>
    
</body>
</html>