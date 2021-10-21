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
                <form class="form" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-12">
                        <label>Username
                        <span class="text-danger">*</span></label>
                        <input type="text" name="username" value="{{old('username')}}" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username.." required>
                        @error('username')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>Nama Lengkap
                        <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{old('nama_lengkap')}}" class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Masukkan Username.." required>
                        @error('nama_lengkap')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>Password
                        <span class="text-danger">*</span></label>
                        <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password.." required>
                        @error('password')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>Status Admin
                        <span class="text-danger">*</span></label>
                        <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                            <option value="">--Pilih Status Admin--</option>
                            @foreach($datas as $item)
                                <option value="{{$item->id}}" {{old('role_id') == $item->id ? 'selected' : ''}}>{{str_replace('_', ' ', $item->nama)}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12">
                        <label>Avatar</label>
                        <input class="form-control  @error('file') is-invalid @enderror" name="file" type="file" id="formFile" accept="image/*">
                        <span class="form-text text-muted">File harus bertipe JPG, JPEG, PNG dengan ukuran maksimal 500kb</span>
                        @error('file')
                            <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-12 float-left">
                        <button type="submit" class="btn btn-primary">
                            <span class="flaticon2-add-square"> Simpan</span>
                        </button>
                        <a class="btn btn-danger" href="{{route('users')}}">
                            <span class="flaticon-reply"> Kembali</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
