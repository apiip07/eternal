<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Register</h1><br>
        <form class="form" action="register.php" method="post">
            <input type="text" name="username" placeholder="username">
            <input type="text" name="email" placeholder="email">
            <input type="password" name="password" placeholder="password">
           <button class="button" name="submit">Register</button>
            <?php
            //check if form submitted, insert form data into users table.
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $level = "user";
                //echo($judul);
                //include database connection file
                include_once("koneksi.php");
                
                //insert user data table
                $result = mysqli_query($mysqli,
                "INSERT INTO user(username,email,password,level) VALUES('$username','$email','$password', '$level')");

                //show message when user added
                //echo "Data added successfully. <a href='index.php'>View data</a>
                header("location: index.php");
            }
            ?>
        </form>
    </div>
</body>
</html>