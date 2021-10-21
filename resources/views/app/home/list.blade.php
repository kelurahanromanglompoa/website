@extends('app.home.layouts.app')
@section('content')
<section id="blog" class="blog">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="row">
          <h3>
            {{$title}}
          </h3>
          <div class="col-lg-8 entries">
            @foreach($datas as $item)
                <article class="entry">
                @if($item->cover)
                    <div class="entry-img">
                        <img src="{{asset('storage/postingan/'.$item->cover)}}" alt="" class="img-fluid">
                    </div>
                @endif
                <h2 class="entry-title">
                    <a href="javascript:void(0)">
                        {{$item->judul}}
                    </a>
                </h2>
                <div class="entry-meta">
                    <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="javascript:void(0)">{{$item->penulis->nama_lengkap}}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="javascript:void(0)"><time datetime="{{$item->tanggal_posting}}">{{date('d M Y', strtotime($item->tanggal_posting))}}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a href="javascript:void(0)">{{$item->viewers}}</a></li>
                </ul>
                </div>
                <div class="entry-content">
                    {!! Str::limit($item->deskripsi, 300) !!}
                    <div class="read-more" >
                        <a href="{{route('home.postingans.read', ['slug' => $item->slug, 'uuid' => $item->uuid])}}" style="background: #106EEA;">Selengkapnya</a>
                    </div>
                </div>
                </article><!-- End blog entry -->
            @endforeach
            <div class="blog-pagination">
              <ul class="justify-content-center">
                @if($datas)
                  {{$datas->links()}}
                @endif
              </ul>
            </div>
            

          </div><!-- End blog entries list -->

          @include('app.home.layouts.sideinformation')

        </div>

      </div>
    </section>
@endsection