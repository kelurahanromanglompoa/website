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
                <h3 class="card-label">
                    {{$currentTitle}}
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="javascript::void(0)" class="btn btn-primary font-weight-bolder">
                    <span class="flaticon2-add"> Tambah Data</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="col-12 table-responsive">
                <table class="table table-head-bg table-vertical-center table-bordered table-sm" id="table1">
                    <thead>
                        <tr>
                            <th>Avatar</th>
                            <th>Level</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Terakhir Login</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datas as $item)
                            <tr>
                                <td>
                                    @if($item->avatar)
                                        <img src="{{asset('/storage/avatar/'.$item->avatar)}}" style="max-height: 60px;">
                                    @endif
                                </td>
                                <td>
                                    {{$item->role->nama}}
                                </td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->nama_lengkap}}</td>
                                <td>
                                    {{date('d M Y', strtotime($item->last_login))}}
                                </td>
                                <td></td>
                            </tr>
                        @empty
                            <tr colspan="6">
                                <td>Data tidak ditemukan</td>
                            </tr>
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
