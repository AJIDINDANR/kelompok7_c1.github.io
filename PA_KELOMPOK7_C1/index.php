<?php
    date_default_timezone_set('Asia/Jakarta');
    include 'koneksi.php';
    include 'session.php';

    if (isset($_SESSION['username'])) { 
        $username = $_SESSION['username'];
    } else { 
        $username = '';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- my css -->
    <link rel="stylesheet" href="style.css">
    <title>RUMAH MAKAN PADANG</title>
</head>
<body>
    <!-- navbar -->
    <div class="navbar">
        <div class="logo">Rumah Makan Padang</div>
        <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        <ul class="menu-navbar">
            <li><a href="#Home" onclick="scrollToSection('Home')">Home</a></li>
            <li><a href="#about" onclick="scrollToSection('about')">About Us</a></li>
            <li><a href="#menu" onclick="scrollToSection('menu')">Menu</a></li>
            <li><a href="#lokasi" onclick="scrollToSection('lokasi')">Lokasi</a></li>
            <li><a href="#pesanan" onclick="scrollToSection('pesanan')">Order Online</a></li>
            <li><a href="#kontak" onclick="scrollToSection('kontak')">Contact Us</a></li>
            <li><a href="#review" onclick="scrollToSection('review')">Customer Reviews</a></li>
            <?php
            if (isset($_SESSION['id_user'])) {
                echo '<a href="logout.php" id="logout">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </ul>
    </div>
    <!-- akhir navbar -->
    

    
    <!-- HOME -->
    <section id="Home">
        <div class="container">
            <div class="username">
                <?php
                    
                    if (isset($_SESSION['welcome_message'])) {
                        echo '<p>' . $_SESSION['welcome_message'] . '</p>';
                        unset($_SESSION['welcome_message']); 
                    }
                ?>
            </div>
            <h1>Hidangan Khas Padang untuk Manjakan Lidahmu!😊❤️</h1>
            <div class="content-slide">
                <div class="imgslide fade">
                    <div class="numberslide">1 /3</div>
                    <img src="foto/senin.jpeg" alt="">
                </div>

                <div class="imgslide fade">
                    <div class="numberslide">2 /3</div>
                    <img src="foto/selasa.jpeg" alt="">
                </div>

                <div class="imgslide fade">
                    <div class="numberslide">3 /3</div>
                    <img src="foto/rabu.jpeg" alt="">
                </div>

                <a class="prev" onClick="nextslide(-1)">&#10094;</a>
                <a class="next" onClick="nextslide(1)">&#10095;</a>
            </div>

            <div class="page">
                <span class="dot" onClick="dotslide(1)"></span>
                <span class="dot" onClick="dotslide(2)"></span>
                <span class="dot" onClick="dotslide(3)"></span>
            </div>
        </div>
    </section>


    <!-- about us -->
    <section id="about">
        <div class="box-container">
            <div class="about-box">
                <h2>About Us</h2>
                <p>Selamat datang di Rumah Makan Padang, tempat kami menyajikan masakan Padang yang lezat dan otentik.</p>
                <p>Koki kami berkomitmen untuk memberi Anda cita rasa tradisi kuliner Indonesia yang kaya.</p>
                <p>Jelajahi menu kami dan rasakan cita rasa Padang langsung di rumah anda.</p>
                <p> BUKA SETIAP HARI PUKUL 09.00-21.00 WITA</p>
            </div>
        </div>
    </section>

    <!-- menu -->
    <section id="menu">
        <div class="menu-item">
            <h2>Nasi Ayam Goreng</h2>
            <img src="foto/nasiayam.jpeg" alt="gambar nasi ayam goreng">
            <p>Nasi Ayam Goreng Padang adalah hidangan khas Indonesia yang berasal dari Padang, Sumatra Barat. Hidangan ini terkenal karena perpaduan unik antara nasi yang harum dan lezat dengan ayam yang digoreng dengan bumbu khas Padang.</p>
            <p class="harga">Harga: Rp 25.000</p>
        </div>

        <div class="menu-item">
            <h2>Nasi Rendang</h2>
            <img src="foto/nasirendang.jpeg" alt="gambar nasi rendang">
            <p>Nasi Rendang Padang adalah hidangan khas Indonesia yang menggabungkan kelezatan nasi dengan daging sapi yang diolah dengan bumbu rendang khas Padang.</p>
            <p class="harga">Harga: Rp 25.000</p>
        </div>

        <div class="menu-item">
            <h2>Nasi Telur Padang</h2>
            <img src="foto/nasitelur.jpeg" alt="gambar nasi telur">
            <p>Nasi Telur Padang adalah hidangan khas Indonesia yang sederhana namun lezat, menggabungkan kelezatan nasi dengan telur yang diolah dengan bumbu khas Padang.</p>
            <p class="harga">Harga: Rp 20.000</p>
        </div>

        <div class="menu-item">
            <h2>Ayam Gulai</h2>
            <img src="foto/ayamgulai.jpg" alt="gambar ayam gulai">
            <p>Ayam Gulai Padang adalah hidangan khas Indonesia yang memukau dengan kelezatan gulai berbumbu kaya khas Padang.</p>
            <p class="harga">Harga: Rp 15.000</p>
        </div>

        <div class="menu-item">
            <h2>Nasi Ayam Bakar</h2>
            <img src="foto/ayam.jpg" alt="gambar nasi ayam bakar">
            <p>Nasi Ayam Bakar Padang adalah hidangan lezat yang menyajikan perpaduan antara nasi yang harum, ayam yang dipanggang, dan bumbu khas Padang.</p>
            <p class="harga">Harga: Rp 25.000</p>
        </div>

        <div class="menu-item">
            <h2>Rendang</h2>
            <img src="foto/rendang.jpg" alt="gambar rendang">
            <p>Rendang Padang adalah hidangan ikonik Indonesia yang memukau dengan kelezatan daging yang dimasak dalam santan dan rempah-rempah khas Padang.</p>
            <p class="harga">Harga: Rp 20.000</p>
        </div>
    </section>

    
    <!-- lokasi -->
    <section id="lokasi">
        <h2>LOKASI</h2>
        <div id="map-container">
            <iframe
                frameborder="0"
                style="border:0; width:100%; height:300px;" 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1186.1405663969456!2d117.15697012481549!3d-0.4676880109789331!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67fd91915b52b%3A0xf03d404d8fc3016!2sFKTI%20Unmul!5e0!3m2!1sid!2sid!4v1699811679839!5m2!1sid!2sid"
                allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </section>



    <!-- table pesanan -->
    <section id="pesanan">
        <a href="<?php echo isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'cart.php' : 'login.php'; ?>" class="kurir-link">
            <img src="foto/kurir.png" alt="Gambar Kurir">
        </a>
        <h2>PESAN MAKANAN</h2>
    </section>



    <!-- table contact us -->
    <section id="kontak">
        <a href="contact.php" class="kurir-link">
            <img src="foto/contact.png" alt="Gambar contact">
        </a>
        <h2>Contact US</h2>
    </section>


    <!-- table review -->

    <div class="wrapper">
        <section id="review-section">
            <h2 class="ulasan">Ulasan Pengguna</h2>

            <!-- Bagian Menampilkan Komentar -->
            <div class="review-section">
                <?php if (isset($_SESSION['id_user'])) : ?>
                    <form id="reviewForm" action="save_review.php" method="post">
                        <label for="name">Nama:</label>
                        <input type="text" id="name" name="name" required><br>

                        <label for="comment">Ulasan:</label>
                        <textarea id="comment" name="comment" rows="4" required></textarea><br>

                        <label for="rating">Rating:</label>
                        <select id="rating" name="rating" required>
                            <option value="5">5 (Sangat Baik)</option>
                            <option value="4">4 (Baik)</option>
                            <option value="3">3 (Cukup)</option>
                            <option value="2">2 (Buruk)</option>
                            <option value="1">1 (Sangat Buruk)</option>
                        </select>

                        <input type="submit" value="Submit">
                    </form>
                <?php else : ?>
                    <div class="warning">HARUS LOGIN UNTUK REVIEW</div>
                    <br><br>
                <?php endif; ?>

                <?php
                $sql = "SELECT * FROM reviews";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) : ?>
                    <div class="reviews-wrapper">
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <div class="review-slide">
                                <div class="review-box">
                                    <h3><?= $row['nama']; ?></h3>
                                    <p><?= $row['ulasan']; ?></p>
                                    <p>Rating: <?= $row['rating']; ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <p>Belum ada ulasan saat ini.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>

    




    <!-- footer -->
    <div class="footer">
        <div class="footer-social">
            <a href="https://www.facebook.com/?locale=id_ID" class="social-icon" target="_blank">Facebook</a>
            <a href="https://twitter.com/your-twitter-account" class="social-icon" target="_blank">Twitter</a>
            <a href="https://www.instagram.com/" class="social-icon" target="_blank">Instagram</a>
        </div>        
        <div class="footer-bottom">
            &copy; 2023 Rumah Makan Padang. All rights reserved.
        </div>
    </div>

    <script>
        var slideIndex = 1;
        showSlide(slideIndex);

        function nextslide(n) {
            showSlide(slideIndex += n);
        }

        function dotslide(n) {
            showSlide(slideIndex = n);
        }

        function showSlide(n) {
            var i;
            var slides = document.getElementsByClassName("imgslide");
            var dot = document.getElementsByClassName("dot");

            if (n > slides.length) {
                slideIndex = 1;
            }
            if (n < 1) {
                slideIndex = slides.length;
            }

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
                dot[i].className = dot[i].className.replace(" active", "");
            }

            slides[slideIndex - 1].style.display = "block";
            dot[slideIndex - 1].className += " active";
        }

        var menu = document.querySelector('.menu');
        var menuToggle = document.querySelector('.menu-toggle');

        function toggleMenu() {
            const menu = document.querySelector('.menu-navbar');
            menu.classList.toggle('show');

            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('mobile-background', menu.classList.contains('show'));
        }

        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            window.scrollTo({
                top: section.offsetTop - 50,
                behavior: 'smooth'
            });
        }

        function submitReview() {
        var name = document.getElementById('name').value;
        var comment = document.getElementById('comment').value;

        var reviewBox = document.createElement('div');
        reviewBox.className = 'review-box';
        reviewBox.innerHTML = '<h3>' + name + '</h3><p>' + comment + '</p>';

        document.getElementById('reviewBoxContainer').appendChild(reviewBox);

        document.getElementById('name').value = '';
        document.getElementById('comment').value = '';
    }

    </script>
</body>
</html>