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
            <div class="card-toolbar">
                @if(auth()->user()->role_id == \App\Models\Role::SUPER_ADMIN)
                    <!-- Button trigger modal-->
                    <button type="button" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#addModal">
                        <span class="flaticon2-add"> Tambah Data</span>
                    </button>
                    <!--end::Button-->
                @endif
            </div>
        </div>
        <div class="card-body">
            @if(session('status'))
            <div class="alert alert-custom alert-outline-primary fade show mb-5" role="alert">
                <div class="alert-icon">
                    <i class="flaticon2-checkmark"></i>
                </div>
                <div class="alert-text">
                    <strong>Berhasil !</strong> {{session('status')}}.
                </div>
            </div>
            @endif
            <div class="col-12 table-responsive">
                <table class="table table-head-bg table-vertical-center table-bordered table-sm" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Tanggal Dibuat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $item)
                            <tr>
                                <td style="text-align: center;vertical-align:middle">
                                    {{$loop->iteration}}
                                </td>
                                <td>{{$item->nama}}</td>
                                <td>
                                    {{date('d M Y', strtotime($item->created_at))}}
                                </td>
                                <td>
                                    @if(auth()->user()->role_id == \App\Models\Role::SUPER_ADMIN)
                                        <a href="{{route('profils.kategori.destroy', ['uuid' => $item->uuid])}}" class="badge badge-sm badge-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Data {{$item->nama}} ?')">
                                            Hapus
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL ADD-->
    <div class="modal fade" id="addModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form" action="{{route('profils.kategori.store')}}" method="POST">
                        @csrf
                        <div class="form-group col-12">
                            <label>Nama Kategori
                            <span class="text-danger">*</span></label>
                            <input type="text" name="nama" value="{{old('nama')}}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Kategori.." required>
                            @error('nama')
                                <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <span class="flaticon-reply"> Kembali</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="flaticon2-add-square"> Simpan</span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--END MODAL ADD-->

@endsection

@push('up_script')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

@endpush

@push('scripts')

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            "ordering": false,
        });
    } );
</script>

@endpush
