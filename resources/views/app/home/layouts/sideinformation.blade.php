<div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Cari Postingan</h3>
              <div class="sidebar-item search-form">
                <form action="{{route('search')}}" method="POST">
                  @csrf
                  <input type="text" name="keyword" placeholder="Masukkan kata kunci judul.." required>
                  <button type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div><!-- End sidebar search formn-->

              <h3 class="sidebar-title">Postingan Terpopuler</h3>
              <div class="sidebar-item recent-posts">
                @foreach($topFive as $top)
                  <div class="post-item clearfix">
                    <img src="{{asset('storage/postingan/'.$top->cover)}}" alt="">
                    <h4><a href="{{route('home.postingans.read', ['slug' => $top->slug, 'uuid' => $top->uuid])}}">{{$top->judul}}</a></h4>
                    <time datetime="{{date('d M Y', strtotime($top->tanggal_posting))}}">{{date('d M Y', strtotime($top->tanggal_posting))}}</time>
                  </div>
                @endforeach
                

              </div><!-- End sidebar recent posts-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->