<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use \App\Models\{
    JenisInformasi, JenisDokumen, JenisProfil, User
};

class DashboardController extends Controller
{
    public function index()
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();
        
        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Dashboard Admin',
            'urlNow' => route('dashboard'),
            'isActive' => 'dashboard',
            'isActiveSub' => '',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
        );

        return view('app.dashboard.index',$data);
    }
}
