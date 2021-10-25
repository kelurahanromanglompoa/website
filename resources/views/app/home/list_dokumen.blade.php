@extends('app.home.layouts.app')
@section('content')
<section id="blog" class="blog">
      <div class="container aos-init aos-animate" data-aos="fade-up">
        <div class="row">
          <h3>
            {{$title}}
          </h3>
          <div class="col-lg-8 entries">
            <article class="entry table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Judul Dokumen</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datas as $item)
                            <tr>
                                <td>{{$item->judul}}</td>
                                <td>
                                    {!! Str::limit($item->deskripsi, 300) !!}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('home.dokumens.read', ['slug' => $item->slug, 'uuid' => $item->uuid])}}"  class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <br/>
                                    <a href="{{$item->nama_file}}" target="blank" class="btn btn-sm btn-primary mt-2">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </article><!-- End blog entry -->

          </div><!-- End blog entries list -->

          @include('app.home.layouts.sideinformation')

        </div>

      </div>
    </section>
@endsection

