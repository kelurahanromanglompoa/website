<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kelurahan Romang Lompoa</title>
  <meta content="Website resmi Kelurahan Romanglompoa, Kecamatan Bontomarannu, Kabupaten Gowa, Sulawesi Selatan" name="description">
  <meta content="Website resmi Kelurahan Romanglompoa, Kecamatan Bontomarannu, Kabupaten Gowa, Sulawesi Selatan" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('homepage')}}/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{asset('homepage')}}/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('homepage')}}/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset('homepage')}}/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset('homepage')}}/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{asset('homepage')}}/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('homepage')}}/assets/css/style.css" rel="stylesheet">

  @stack('up_scripts')

</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:kelurahanromanglompoa20@gmail.com">kelurahanromanglompoa20@gmail.com</a></i>
        <i class="bi bi-phone d-flex align-items-center ms-4"><span>+62 821938344444</span></i>
      </div>
      {{-- <div class="social-links d-none d-md-flex align-items-center">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div> --}}
    </div>
  </section>

  @include('app.home.layouts.navbar')

  @if(Request::is('/'))
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
      <div class="container" data-aos="zoom-out" data-aos-delay="100">
        <h1>Selamat <span>Datang</span></h1>
        <h2>
          Ini adalah halaman resmi website Kelurahan Romang Lompoa
        </h2>
        {{-- <div class="d-flex">
          <a href="#about" class="btn-get-started scrollto">Get Started</a>
          <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
        </div> --}}
      </div>
    </section><!-- End Hero -->
  @endif

  <main id="main">
      @yield('content')
  </main><!-- End #main -->

  @include('app.home.layouts.footer')

  {{-- <div id="preloader"></div> --}}
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('homepage')}}/assets/vendor/aos/aos.js"></script>
  <script src="{{asset('homepage')}}/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('homepage')}}/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{asset('homepage')}}/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  {{-- <script src="{{asset('homepage')}}/assets/vendor/php-email-form/validate.js"></script> --}}
  <script src="{{asset('homepage')}}/assets/vendor/purecounter/purecounter.js"></script>
  <script src="{{asset('homepage')}}/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset('homepage')}}/assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('homepage')}}/assets/js/main.js"></script>

  @stack('scripts')

</body>

</html>