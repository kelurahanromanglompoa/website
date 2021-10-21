  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="{{route('home')}}">Kelurahan Romang Lompoa<span></span></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto {{$isActive == 'home' ? 'active' : ''}}" href="{{url('/')}}">Home</a></li>
          
          <li class="dropdown ">
            <a href="javascript:void(0)" class="{{$isActive == 'profil' ? 'active' : ''}}">
              <span>Profil</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              @foreach ($dataNav['jenisProfil'] as $profil)
              
                  <a href="{{route('home.profils', ['slug' => $profil->slug, 'uuid' => $profil->uuid])}}">{{$profil->nama}}</a>
                
              @endforeach
            </ul>
          </li>

          <li class="dropdown">
            <a href="javascript:void(0)" class="{{$isActive == 'postingan' ? 'active' : ''}}">
              <span>Postingan</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              <li><a href="{{route('home.postingans')}}">Semua Postingan</a></li>
              @foreach ($dataNav['jenisPostingan'] as $post)
                <li>
                  <a href="{{route('home.postingans.category', ['slug' => $post->slug, 'uuid' => $post->uuid])}}">{{$post->nama}}</a>
                </li>
              @endforeach
            </ul>
          </li>

          <li class="dropdown">
            <a href="javascript:void(0)" class="{{$isActive == 'dokumen' ? 'active' : ''}}">
              <span>Dokumen</span> <i class="bi bi-chevron-down"></i>
            </a>
            <ul>
              <li><a href="{{route('home.dokumens')}}">Semua Dokumen</a></li>
              @foreach ($dataNav['jenisDokumen'] as $doc)
                <li>
                  <a href="{{route('home.dokumens.category', ['slug' => $doc->slug, 'uuid' => $doc->uuid])}}">{{$doc->nama}}</a>
                </li>
              @endforeach
            </ul>
          </li>
          

          

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->