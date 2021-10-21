@extends('app.home.layouts.app')

@section('content')

    <section id="services" class="services" style="background: #F1F6FE;">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Postingan</h2>
            <h3><span>Postingan</span> Terbaru</h3>
            <p>
                Berikut ini adalah postingan terbaru
            </p>
        </div>

        <div class="row mt-4">
            @forelse($postingans as $item)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-8 mt-md-0" data-aos="zoom-in" data-aos-delay="200" style="margin-top: 30px;">
                <div class="icon-box">
                    <div class="icon"><i class="bx bx-file"></i></div>
                    <h4>
                        <a href="{{route('home.dokumens.read', ['slug' => $item->slug, 'uuid' => $item->uuid])}}">
                            {{$item->judul}}
                        </a>
                    </h4>
                </div>
            </div>
            @empty
            @endforelse
        </div>

    </div>
    </section>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Dokumen</h2>
            <h3><span>Dokumen</span> Terbaru</h3>
            <p>
                Berikut ini adalah dokumen terbaru yang dapat diakses publik
            </p>
        </div>

        <div class="row mt-4">
        @forelse($dokumens as $dokumen)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-8 mt-md-0" data-aos="zoom-in" data-aos-delay="200" style="margin-top: 30px;">
            <div class="icon-box">
                <div class="icon"><i class="bx bx-file"></i></div>
                <h4>
                    <a href="{{route('home.dokumens.read', ['slug' => $dokumen->slug, 'uuid' => $dokumen->uuid])}}">
                        {{$dokumen->judul}}
                    </a>
                </h4>
            </div>
        </div>
        @empty
        @endforelse
        </div>
    </div>
    </section>
    <!-- End Services Section -->
@endsection