<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="masukan.css">
</head>
<body>
    <div class="comment-box">
        <h2>Berikan masukan anda</h2>
        <form action="masukan-form.php" method="post">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="email" placeholder="Email">
            <textarea name="message" placeholder="berikan masukan"></textarea>
            <button type="submit" name="submit">Submit masukan</button>
            <?php
            //check if form submitted, insert form data into users table.
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $message = $_POST['message'];
                //echo($judul);
                //include database connection file
                include_once("../koneksi.php");
                
                //insert comment data table
                $result = mysqli_query($mysqli,
                "INSERT INTO masukan(username,email,message) VALUES('$username','$email','$message')");

                //show message when comment added
                //echo "Data added successfully. <a href='index.php'>View data</a>
                header("location: artikel.php");
            }
            ?>
        </form>
    </div>
</body>
</html>