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
            
            <div class="col-12 table-responsive">
                <table class="table table-head-bg table-vertical-center table-bordered table-sm" id="table1">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Aduan</th>
                            <th>E-mail</th>
                            <th>No. Telp</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $item)
                            <tr>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->aduan}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->handphone}}</td>
                                <td>
                                    @if($item->created_at)
                                        {{date('d M Y', strtotime($item->created_at))}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                        <a href="{{route('aduans.destroy',['uuid' => $item->uuid])}}" class="badge badge-sm badge-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Aduan yang Dibuat Oleh Nama {{$item->nama}} ?')">
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