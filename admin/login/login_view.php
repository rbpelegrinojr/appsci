<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AppSci</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
        .back-button {
    position: fixed;
    bottom: 50px; /* Position above the back-to-top button */
    left: 100px;
    z-index: 999;
    border-radius: 50%;
    color: #fff; /* Bootstrap secondary color */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.back-button:hover {
    background-color: #6c757d;
    color: #fff;
}

.for-button {
    position: fixed;
    bottom: 50px; /* Position above the back-to-top button */
    right: 100px;
    z-index: 999;
    border-radius: 50%;
    color: #fff; /* Bootstrap secondary color */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.for-button:hover {
    background-color: #6c757d;
    color: #fff;
}

    </style>
</head>

<body>
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
            <!-- <h1 class="m-0 text-primary">AppSci</h1> -->
            <span class="navbar-brand-text text-primary fw-bold fs-5 text-center text-lg-start">AppSci</span>
            <!-- <h1 class="m-0 text-primary fs-4 text-wrap text-center text-lg-start">AppSci</h1> -->
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <?php if (isset($_SESSION['member_id'])): ?>
                    <!-- If user is logged in, show Logout -->
                    <a href="logout.php" class="nav-item nav-link">
                        Logout <i class="fa fa-sign-out ms-3"></i>
                    </a>
                <?php else: ?>
                <?php endif; ?>
            </div>

            <?php if (isset($_SESSION['member_id'])): ?>
                <!-- If user is logged in, show Logout -->
                <!-- <a href="logout.php" class="btn btn-danger rounded-0 py-4 px-lg-5 d-none d-lg-block">
                    Logout <i class="fa fa-sign-out ms-3"></i>
                </a> -->
            <?php else: ?>
                <!-- If user is NOT logged in, show Login -->
                <!-- <a href="login_view.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">
                    Login <i class="fa fa-arrow-right ms-3"></i>
                </a> -->
            <?php endif; ?>
        </div>
    </nav>
<style>
  .password-wrapper {
    position: relative;
  }

  .password-wrapper input[type="password"],
  .password-wrapper input[type="text"] {
    padding-right: 2.5rem; /* space for the eye icon */
  }

  .toggle-password {
    position: absolute;
    top: 50%;
    right: 0.75rem;
    transform: translateY(-50%);
    cursor: pointer;
    user-select: none;
    font-size: 1.25rem;
    color: #555;
  }
</style>
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Login as Administrator</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wow fadeInUp" data-wow-delay="0.5s">
                    <form action="../../controller/login.php" method="POST">
                        <div class="row g-3">
                            <!-- Username Field -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            
                            <!-- Password Field -->
                            
                            <div class="col-12">
                                <div class="form-floating password-wrapper">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                    <span class="toggle-password" onclick="togglePassword()" title="Show/Hide Password">
                                    👁️
                                    </span>
                                </div>
                                </div>


                            <!-- Login Button -->
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" name="btnAdminLogin" type="submit">Login</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  function togglePassword() {
    const pwInput = document.getElementById('password');
    const toggleIcon = document.querySelector('.toggle-password');

    if (pwInput.type === 'password') {
      pwInput.type = 'text';
      toggleIcon.textContent = '🙈';  // Change icon to closed eye
    } else {
      pwInput.type = 'password';
      toggleIcon.textContent = '👁️';  // Change icon to open eye
    }
  }
</script>
<!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <!-- <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Company</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Newsletter</h5>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">AppSci</a>, All Right Reserved. 
                            
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            <!-- Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> -->
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->




    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>