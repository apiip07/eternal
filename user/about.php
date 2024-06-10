<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: #F3B664;">
    <header class="head">
         <ul class="navmenu">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="projects.php">Project</a></li>
        </ul>

        <div class="nav-icon" onclick="redirWhatsapp()">
            <a href="#" class="btn">Contact</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>
<div class="content">
    <img src="assets/WhatsApp Image 2023-11-21 at 12.45.20_831d4610.jpg" alt="" class="img-foto1">
    <div class="intro">
        <p class="title">Hello, My name is Muhammad Rafif Abdillah Arsalan</p>
        <p class="description">saya lahir di surabaya pada tanggal 30 maret 2008. saya pindah ke sidoarjo saat saya berumur 4 tahun dan saya melanjutkan untuk bersekolah disini. hobi saya sejak kecil adalah bermain bola dan juga saya sering menghabiskan waktu dengan nongkrong bersama teman-teman saya.</p>
    </div>
</div>
<div class="parallax">
    <div class="tentang">
        <p class="title">saya adalah murid SMK TELKOM SIDOARJO</p>
        <p class="description">follow sosmed akuh dongs</p>
    </div>  
    <div class="content">
        <div class="card">
            <div class="card-item" onclick="redirInstagram()">
                <img src="assets/icon ig.jpg" alt="" class="icon">
                <p class="card-title">@rapipp30_</p>
            </div>
            <div class="card-item" onclick="redirTiktok()">
                <img src="assets/icon tiktok.png" alt="" class="icon">
                <p class="card-title">@apipipipip7</p>
            </div>
            <div class="card-item" onclick="redirTwitter()">
                <img src="assets/icon x.png" alt="" class="icon">
                <p class="card-title">@rapipp30</p>
            </div>
        </div>
    </div>
</div>
<footer>
    <p class="title">&copy; rapip website</p>
</footer>

<script>
    function redirInstagram() {
        window.location.href = "https://instagram.com/rapipp30_"
    }

    function redirTiktok() {
        window.location.href = "https://www.tiktok.com/@apipipipip7"
    }

    function redirTwitter() {
        window.location.href = "https://twitter.com/rapipp30"
    }

    function redirWhatsapp() {
        window.location.href = "https://wa.me/6281515892907"
    }

</script>

</body>
</html>