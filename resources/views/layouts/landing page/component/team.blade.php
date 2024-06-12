<!-- ======= Team Section ======= -->
<section id="team" class="team">
    <div class="container">

        <div class="row">
            <div class="col-lg-4">
                <div class="section-title" data-aos="fade-right">
                    <h2>Team</h2>
                    <p>Tim yang terlibat dalam pembuatan aplikasi CleanEarth.</p>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    @foreach ( team() as $teams )
                    <div class="col-lg-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <div class="pic"><img src="{{asset('storage/'.$teams->foto)}}" class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>{{$teams->nama}}</h4>
                                <span>{{$teams->jabatan}}</span>
                                <p>{{$teams->deskripsi}}</p>
                                <div class="social">
                                    <a href=""><i class="ri-twitter-fill"></i></a>
                                    <a href=""><i class="ri-facebook-fill"></i></a>
                                    <a href=""><i class="ri-instagram-fill"></i></a>
                                    <a href=""> <i class="ri-linkedin-box-fill"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>

    </div>
</section><!-- End Team Section -->
