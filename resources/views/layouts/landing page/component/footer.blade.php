<!-- ======= Footer ======= -->
<footer id="footer">

    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>{{onepige()->nama_aplikasi}}</h3>
                    <p>
                        {{onepige()->alamat}}<br>
                        <strong>Phone:</strong> {{onepige()->no_telp}}<br>
                        <strong>Email:</strong> {{onepige()->email}}<br>
                    </p>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
                        {{-- <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li> --}}
                        <li><i class="bx bx-chevron-right"></i> <a href="#team">Terms of service</a></li>
                        {{-- <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li> --}}
                    </ul>
                </div>

                <div class="col-lg-7 col-md-6 ">
                    <h4>Form Saran</h4>
                    <p>Apabila Memiliki Saran Silakan Isi Form Dibawah</p>
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('kirim.kotak-saran') }}" class="php-email-form mt-4"
                                enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label for="nama"> <span style="color: red;">*</span> Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="email"> <span style="color: red;">*</span> Email</label>
                                        <input type="text" name="email" id="email" class="form-control" required>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="Saran"> <span style="color: red;">*</span> Saran</label>
                                        <textarea name="saran" id="saran" class="form-control"></textarea>
                                    </div>
                                    <div class="col-12 mb-3 text-end">
                                        <button type="submit" class="btn btn-success">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
                &copy; Copyright <strong><span>CleanEarth</span></strong>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/ -->
                {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer><!-- End Footer -->
