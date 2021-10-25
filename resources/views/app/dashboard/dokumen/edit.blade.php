@extends('app.layouts.app')
@section('content')
    <x-subheader :currentPage="$currentTitle" currentMenu="{{$defaultCurrentTitle}}" currentMenuUrl="{{ route('dashboard') }}"
        :currentPageUrl="$urlNow" />
    <div class="card card-custom m-3">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon-graphic-2 text-primary"></i>
                </span>
                <h3 class="card-label">{{ $currentTitle }}
                    {{-- <small>sub title</small> --}}
                </h3>
            </div>
        </div>
        <div class="card-body">
            <div class="col-12">
                <form class="form" action="{{route('dokumens.update', ['slug' => $slug, 'uuid' => $uuid, 'uuid_item' => $data->uuid])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-12">
                        <label>Judul
                        <span class="text-danger">*</span></label>
                        <input type="text" name="judul" value="{{$data->judul}}" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul.." required>
                        @error('judul')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form group col-12 mb-8">
                        <label>Deskripsi
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="deskripsi" id="editor" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan deskripsi" required>
                            {{$data->deskripsi}}
                        </textarea>
                        @error('deskripsi')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>Tanggal Posting
                        <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_posting" value="{{$data->tanggal_posting}}" class="form-control @error('tanggal_posting') is-invalid @enderror" required>
                        @error('tanggal_posting')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>
                            File Dokumen
                        </label>
                        <br/>
                            <a class="btn btn-success btn-sm mb-2" href="{{$data->nama_file}}" target="_blank">
                                <span class="fa fa-file"></span> dokumen 
                            </a>
                        <br/>
                        <input class="form-control  @error('file') is-invalid @enderror" name="file" type="file" id="formFile" accept="application/pdf">
                        <span class="form-text text-muted">
                            Jika ingin mengganti dokumen, silahkan upload dokumen baru
                            <br/>
                            File harus bertipe PDF dengan ukuran maksimal 20480kb
                        </span>
                        @error('file')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12 float-left">
                        <button type="submit" class="btn btn-primary">
                            <span class="flaticon2-add-square"> Simpan</span>
                        </button>
                        <a class="btn btn-danger" href="{{route('dokumens', ['slug' => $slug, 'uuid' => $uuid])}}">
                            <span class="flaticon-reply"> Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <!-- include summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote({
                placeholder: 'Ketik sesuatu disini..',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endpush
