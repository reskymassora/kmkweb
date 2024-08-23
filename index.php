<!-- <?php
  // Cek session terlebih dahulu
  session_start();
  if (!isset($_SESSION['nim'])) {
    header('Location: login.php');
    exit();
  }
  // Set waktu expired dalam detik (misalnya 30 menit)
  $session_timeout = 30 * 60; // 30 menit = 30 * 60 detik

  // Cek apakah session sudah expired
  if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_timeout)) {
    session_unset(); // Hapus semua data session
    session_destroy(); // Hapus session
    header('Location: ../login.php'); // Redirect ke halaman login
    exit();
  }
  $_SESSION['last_activity'] = time(); // Perbarui waktu aktivitas terakhir
  // Ambil info user yang login
  $nim = $_SESSION['nim'];
?> -->

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="author" content="templatemo">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet">

  <title>KMK Universitas Dipa</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="index/assets/css/fontawesome.css">
  <link rel="stylesheet" href="index/assets/css/templatemo-snapx-photography.css">
  <link rel="stylesheet" href="index/assets/css/owl.css">
  <link rel="stylesheet" href="index/assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <!--

TemplateMo 576 SnapX Photography

https://templatemo.com/tm-576-snapx-photography

-->
</head>

<body>


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo">
              <img src="index/assets/images/logo_kmk_nonbg.png" alt="logo KMK Undipa" style="width: 50px;">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="#">Categories</a></li>
              <li><a href="#">Users</a></li>
            </ul>
            <div class="border-button">
              <a href="login.php" class="sign-in-up"><i class="fa fa-user"></i> Log in</a>
            </div>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div id="modal" class="popupContainer" style="display:none;">
    <div class="popupHeader">
      <span class="header_title">Login</span>
      <span class="modal_close"><i class="fa fa-times"></i></span>
    </div>

    <section class="popupBody">
      <!-- Social Login -->
      <div class="social_login">
        <div class="">
          <a href="#" class="social_box fb">
            <span class="icon"><i class="fab fa-facebook"></i></span>
            <span class="icon_title">Connect with Facebook</span>

          </a>

          <a href="#" class="social_box google">
            <span class="icon"><i class="fab fa-google-plus"></i></span>
            <span class="icon_title">Connect with Google</span>
          </a>
        </div>

        <div class="centeredText">
          <span>Or use your Email address</span>
        </div>

        <div class="action_btns">
          <div class="one_half"><a href="#" id="login_form" class="btn">Login</a></div>
          <div class="one_half last"><a href="#" id="register_form" class="btn">Sign up</a></div>
        </div>
      </div>

      <!-- Username & Password Login form -->
      <div class="user_login">
        <form action="" method="post">
          <label>Email / Username</label>
          <input name="username" type="text" id="username" />
          <br />

          <label>Password</label>
          <input name="password" type="password" id="password" />
          <br />

          <div class="checkbox">
            <input id="remember" type="checkbox" />
            <label for="remember">Remember me on this computer</label>
          </div>

          <div class="action_btns">
            <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>
            <div class="one_half last"><button type="submit" class="btn btn_red">Login</button></div>
          </div>
        </form>

        <a href="#" class="forgot_password">Forgot password?</a>
      </div>

      <!-- Register Form -->
      <div class="user_register">
        <form action="" method="post">
          <label>Username</label>
          <input name="username" type="text" id="username" />
          <br />

          <label>Email Address</label>
          <input name="email" type="email" id="email" />
          <br />

          <label>Password</label>
          <input name="password" type="password" id="password" />
          <br />

          <div class="checkbox">
            <input id="send_updates" type="checkbox" />
            <label for="send_updates">Send me occasional email updates</label>
          </div>

          <div class="action_btns">
            <div class="one_half"><a href="#" class="btn back_btn"><i class="fa fa-angle-double-left"></i> Back</a>
            </div>
            <div class="one_half last"><button type="submit" class="btn btn_red">Register</button></div>
          </div>
        </form>
      </div>

    </section>
  </div>

  <!-- ***** Main Banner Area Start ***** -->
  <div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 offset-lg-1">
          <div class="header-text">
            <h2>Kerukunan Mahasiswa<em> Katolik</em> <br> Universitas <em>Dipa</em> Makassar</h2>
            <p>Website resmi, Kerukunan Mahasiswa Katolik Univesitas Dipa Makassar</p>
            <div class="buttons">
              <div class="big-border-button">
                <a href="contests.html">Facebook</a>
              </div>
              <div class="big-border-button">
                <a href="https://youtube.com/templatemo" target="_blank">Instagram</a>
              </div>
              <div class="big-border-button">
                <a href="https://youtube.com/templatemo" target="_blank">Youtube</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ***** Main Banner Area End ***** -->


  <section class="featured-items" id="featured-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-features owl-carousel" style="position: relative; z-index: 5;">
            <div class="thumb">
              <img src="assets/images/gallery/IMG_0800.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_7713.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_0822.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_1175.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_0800.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_0811.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_7680.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_7717.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_7716.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_7698.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_7680.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_7644.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_1396.JPG" alt="">
            </div>
            <div class="thumb">
              <img src="assets/images/gallery/IMG_1396.JPG" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <section class="closed-contests">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading text-center">
            <h4><em>ANNIVERSARY</em> 27 Tahun KMK </h4>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-features owl-carousel" style="position: relative; z-index: 5;">
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7704.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7721.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7732.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7733.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7741.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7742.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7754.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7757.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7769.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7772.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7778.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7782.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7785.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7790.JPG" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="closed-contests">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading text-center">
            <h4><em>Ret - Ret</em> 2023</h4>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-features owl-carousel" style="position: relative; z-index: 5;">
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7704.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7721.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7732.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7733.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7741.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7742.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7754.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7757.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7769.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7772.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7778.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7782.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7785.JPG" alt="">
                </div>
              </div>
            </div>
            <div class="item">
              <div class="closed-item">
                <div class="thumb">
                  <img src="index/assets/images/anniv/IMG_7790.JPG" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div>
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © Seprianus Resky Massora, template from <a href="#">SnapX</a></p>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="index/vendor/jquery/jquery.min.js"></script>
  <script src="index/vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="index/assets/js/isotope.min.js"></script>
  <script src="index/assets/js/owl-carousel.js"></script>

  <script src="index/assets/js/tabs.js"></script>
  <script src="index/assets/js/popup.js"></script>
  <script src="index/assets/js/custom.js"></script>

</body>

</html>