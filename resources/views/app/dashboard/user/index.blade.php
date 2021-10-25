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
                <a href="{{route('users.create')}}" class="btn btn-primary font-weight-bolder">
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
                                <td style="text-align: center;vertical-align:middle">
                                    @if($item->avatar)
                                        <img src="{{$item->avatar}}" style="max-height: 60px;">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{str_replace('_', ' ', $item->role->nama)}}</td>
                                <td>{{$item->username}}</td>
                                <td>{{$item->nama_lengkap}}</td>
                                <td>
                                    @if($item->last_login)
                                        {{date('d M Y', strtotime($item->last_login))}}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('users.edit', ['uuid' => $item->uuid])}}" class="badge badge-sm badge-primary">
                                        Edit
                                    </a>
                                    @if($item->id != auth()->user()->id)
                                        <a href="{{route('users.destroy', ['uuid' => $item->uuid])}}" class="badge badge-sm badge-danger" onclick="return confirm('Apakah Anda Yakin Menghapus Data User Dengan Nama {{$item->nama_lengkap}} ?')">
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
