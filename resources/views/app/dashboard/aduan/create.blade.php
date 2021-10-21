@extends('app.layouts.app')
@section('content')
<x-subheader :currentPage="$currentTitle" currentMenu="{{$defaultCurrentTitle}}" currentMenuUrl="{{ route('dashboard') }}"
        :currentPageUrl="$urlNow" />
<div class="col-lg-8">
    <form class="form" action="{{route('aduans.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="inputNama" class="form-label">Nama</label>
          <input type="text" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" id="nama" name="nama" placeholder="Silahkan masukkan nama">
          @error('nama')
                <span class="form-text text-danger">{{$message}}</span>
          @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="email" placeholder="name@example.com" name="email">
            @error('email')
                <span class="form-text text-danger">{{$message}}</span>
            @enderror
        </div>
        <label for="nomor" class="form-label">Nomor Telepon</label>
        <div class="input-group mb-3">            
            <span class="input-group-text">+62</span>
            <input type="tel" class="form-control @error('handphone') is-invalid @enderror" value="{{old('handphone')}}" placeholder="1234567890" id="nomor" name="handphone">
            @error('handphone')
                <span class="form-text text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="inputAduan" class="form-label">Aduan</label>
            <textarea class="form-control @error('aduan') is-invalid @enderror" value="{{old('aduan')}}" id="aduan" rows="3" placeholder="Silahkan masukkan aduan anda" name="aduan"></textarea>
            @error('aduan')
                <span class="form-text text-danger">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit Aduan</button>
      </form>
</div>

@endsection