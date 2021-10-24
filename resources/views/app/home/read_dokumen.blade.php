@extends('app.home.layouts.app')
@section('content')
<section id="blog" class="blog">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-8 entries">
            <article class="entry entry-single">
              @if($data)
                @if($data->cover)
                  <div class="entry-img">
                    <img src="{{$data->cover}}" alt="{{ $data->cover }}" class="img-fluid">
                  </div>
                @endif
              @endif
              <h2 class="entry-title">
                <a href="javascript:void(0);" style="pointer-events: none;cursor: default;">{{ $data->judul }}</a>
              </h2>
              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="javascript:void(0);" style="pointer-events: none;cursor: default;">{{ $data->penulis->nama_lengkap }}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-calendar"></i> <a href="javascript:void(0);" style="pointer-events: none;cursor: default;"><time>{{ date('d M Y', strtotime($data->tanggal_posting)) }}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-download"></i> <a href="{{$data->nama_file}}" target="_blank">Download</a></li>
                </ul>
              </div>
              <div class="entry-content">
                @if($data)
                  {!! $data->deskripsi !!}
                @endif

                <br/>
                <iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" src="{{$data->nama_file}}" frameborder="1" scrolling="auto" height="500" width="100%"></iframe>

              </div>

            </article><!-- End blog entry -->
          </div><!-- End blog entries list -->

          @include('app.home.layouts.sideinformation')

        </div>

      </div>
    </section>
@endsection