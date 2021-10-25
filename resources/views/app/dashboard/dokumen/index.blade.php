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
                <!--begin::Button-->
                <a href="{{route('dokumens.create', ['slug' => $slug, 'uuid' => $uuid])}}" class="btn btn-primary font-weight-bolder">
                    <span class="flaticon2-add"> Tambah Data</span>
                </a>
                <!--end::Button-->
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
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Diterbitkan</th>
                            <th>Dibuat Oleh</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $item)
                            <tr>
                                <td>
                                    <a href="{{$item->nama_file}}" target="_blank">
                                        {{$item->judul}}
                                    </a>
                                </td>
                                <td>
                                    {!! Str::limit($item->deskripsi, 300) !!}
                                </td>
                                <td>
                                    {{date('d M Y', strtotime($item->tanggal_posting))}}
                                </td>
                                <td>
                                    {{$item->penulis->nama_lengkap}}
                                </td>
                                <td>
                                    <a href="{{route('dokumens.edit', ['slug' => $slug, 'uuid' => $uuid, 'uuid_item' => $item->uuid])}}" class="badge badge-sm badge-primary m-2">
                                        Edit
                                    </a>
                                    <a href="{{route('dokumens.destroy', ['slug' => $slug, 'uuid' => $uuid, 'uuid_item' => $item->uuid])}}" class="badge badge-sm badge-danger m-2" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini ?')">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        @empty
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

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
