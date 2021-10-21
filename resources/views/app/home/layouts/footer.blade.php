  <!-- ======= Footer ======= -->
  <footer id="footer">

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Kontak</h2>
          <h3><span>Kontak Kami</span></h3>
          <p>Jika terdapat beberapa informasi yang dibutuhkan lebih lanjut, silahkan menghubungi kami dengan detail sebagai berikut</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Alamat</h3>
              <p>
                Jln. STPP Gowa, Romang Lompoa,
                Bontomarannu, Kabupaten Gowa, Sulawesi Selatan
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email</h3>
              <p>kelurahanromanglompoa20@gmail.com</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>No. Telepon</h3>
              <p>+62 821938344444</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15892.92299302068!2d119.5029334!3d-5.226405!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2bcd46fb693e4d36!2sRomanglompoa%20District%20Office!5e0!3m2!1sen!2sid!4v1634485813466!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6">
            <form action="{{route('aduans.store')}}" method="post" role="form" class="php-email-form">
              @csrf
              <div class="row">
                <div class="col form-group">
                  <input type="text" name="nama" class="form-control" id="name" placeholder="Nama Lengkap.." required>
                </div>
                <div class="col form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email.." required>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="handphone" id="subject" placeholder="Telepon.." required>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="aduan" rows="5" placeholder="Aduan.." required></textarea>
              </div>
              
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>

              <div class="text-center"><button type="submit">Kirim</button></div>
            </form>
          </div>

        </div>
      </div>
    </section><!-- End Contact Section -->

    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span>BizLand</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bizland-bootstrap-business-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->