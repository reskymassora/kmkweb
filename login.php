<?php
	require 'function/function.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login Pengurus</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
	<meta name="author" content="Xiaoying Riley at 3rd Wave Media">
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Sweatalert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- FontAwesome JS-->
	<script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

	<!-- App CSS -->
	<link id="theme-style" rel="stylesheet" href="assets/css/portal.css">

</head>

<body class="app app-login p-0">

<?php
    if (isset($_POST['submit'])) {
        $loginNIM = $_POST['nim'];
        $loginJABATAN = $_POST['jabatan'];
        $loginPASSWORD = $_POST['password'];

        $query = "SELECT * FROM pengurus WHERE 
                            nim = '$loginNIM' AND
                            password = '$loginPASSWORD' AND
                            jabatan = '$loginJABATAN'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>
                    Swal.fire({
                        title: 'Login Berhasil!',
                        text: 'Klik OK untuk melanjutkan ke dashboard.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '";
            if ($loginJABATAN == 'Ketua Umum') {
                echo "ketum/dashboard_ketua_umum.php";
            } else if ($loginJABATAN == 'Bendahara Umum') {
                echo "bendahara/dashboard_bendahara_umum.php";
            } else if ($loginJABATAN == 'Sekretaris Umum') {
                echo "sekretaris/dashboard_sekretaris_umum.php";
            } else {
                echo "dashboard_lain.php"; // Ganti sesuai kebutuhan
            }
            echo "';
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Login Gagal!',
                        text: 'NIM, Password, atau Jabatan salah.',
                        icon: 'error',
                        confirmButtonText: 'Coba Lagi'
                    });
                </script>";
        }
    }
    ?>




	<div class="row g-0 app-auth-wrapper">
		<div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
			<div class="d-flex flex-column align-content-end">
				<div class="app-auth-body mx-auto">
					<div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon me-2" src="assets/images/logo_kmk_nonbg.png" alt="logo"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in to Portal</h2>
					<div class="auth-form-container text-start">
						<form class="auth-form login-form" method="post">
							<div class="email mb-3">
								<label class="sr-only" for="nim">NIM</label>
								<input id="signin-email" name="nim" type="text" class="form-control signin-email" placeholder="NIM" required="required">
							</div><!--//form-group-->
							<div class="email mb-3">
								<label class="sr-only" for="jabatan">Jabatan</label>
								<select class="form-select" name="jabatan" required>
									<option value="">Pilih Jabatan</option>
									<option value="Ketua Umum">Ketua Umum</option>
									<option value="Sekretaris Umum">Sekretaris Umum</option>
									<option value="Bendahara Umum">Bendahara Umum</option>
									<option value="Bidang Rohani">Bidang Rohani</option>
									<option value="Bidang Kreasi">Bidang Kreasi</option>
									<option value="Bidang Humas">Bidang Humas</option>
									<option value="Bidang Dana">Bidang Dana</option>
								</select>
							</div>
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<input id="password" name="password" type="password" class="form-control signin-password" placeholder="Password" required="required">
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="ShowPassword">
											<label class="form-check-label" for="ShowPassword">
												Show Password
											</label>
										</div>
									</div><!--//col-6-->
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button type="submit" name="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
						</form>
						<div class="auth-option text-center pt-3">No Account? Sign up <a class="text-link" href="signup.html">here</a>.</div>
					</div><!--//auth-form-container-->
				</div><!--//auth-body-->
			</div><!--//flex-column-->
		</div><!--//auth-main-col-->
		<div class="col-12 col-md-5 col-lg-6 h-100 auth-background-col">
			<div class="auth-background-holder">
			</div>
			<div class="auth-background-mask"></div>
			<div class="auth-background-overlay p-3 p-lg-5">
				<div class="d-flex flex-column align-content-end h-100">
					<div class="h-100"></div>
				</div>
			</div><!--//auth-background-overlay-->
		</div><!--//auth-background-col-->
	</div><!--//row-->
</body>

</html>