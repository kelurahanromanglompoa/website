<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use \App\Models\{
    JenisDokumen, JenisInformasi, JenisProfil,
    Dokumen, Informasi, Profil
};

class HomepageController extends Controller
{
    private $dataNav = array();

    public function __construct()
    {
        $this->dataNav['jenisDokumen'] = JenisDokumen::orderBy('nama', 'ASC')->get();
        $this->dataNav['jenisPostingan'] = JenisInformasi::orderBy('nama', 'ASC')->get();
        $this->dataNav['jenisProfil'] = JenisProfil::orderBy('nama', 'ASC')->get();
    }

    public function index()
    {
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'home',
            'dokumens' => Dokumen::orderBy('tanggal_posting')->limit(6)->get(),
            'postingans' => Informasi::orderBy('tanggal_posting')->limit(6)->get(),
        );
        return view('app.home.index', $data);
    }

    public function postingans()
    {
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'postingan',
            'title' => 'Daftar Seluruh Postingan',
            'datas' => Informasi::orderBy('tanggal_posting')->paginate(4),
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.list', $data);
    }

    public function postingans_by_category($slug, $uuid)
    {
        $kategori = JenisInformasi::whereUuid($uuid)->whereSlug($slug)->first();

        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'postingan',
            'title' => 'Daftar Seluruh Postingan Kategori '.ucfirst($kategori->nama),
            'datas' => Informasi::whereJenisInformasiId($kategori->id)->orderBy('tanggal_posting')->paginate(4),
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.list', $data);
    }

    public function postingans_read($slug, $uuid)
    {
        $item = Informasi::whereSlug($slug)->whereUuid($uuid)->first(); 
        $item->viewers += 1;
        $item->save();
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'postingan',
            'data' => $item,
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.read_postingan', $data);
    }

    public function dokumens()
    {
        
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'dokumen',
            'title' => 'Seluruh Data Dokumen',
            'datas' => Dokumen::orderBy('tanggal_posting')->get(),
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.list_dokumen', $data);
    }

    public function dokumens_by_category($slug, $uuid)
    {
        $kategori = JenisDokumen::whereUuid($uuid)->whereSlug($slug)->first();
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'dokumen',
            'title' => 'Seluruh Data Dokumen Kategori '.ucfirst($kategori->nama),
            'datas' => Dokumen::whereJenisDokumenId($kategori->id)->orderBy('tanggal_posting')->get(),
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.list_dokumen', $data);
    }


    public function dokumens_read($slug, $uuid)
    {
        $item = Dokumen::whereSlug($slug)->whereUuid($uuid)->first(); 
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'dokumen',
            'data' => $item,
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.read_dokumen', $data);
    }

    public function profils_read($slug, $uuid)
    {
        $kategori = JenisProfil::whereSlug($slug)->whereUuid($uuid)->first();
        $item = Profil::whereJenisProfilId($kategori->id)->first();
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'profil',
            'data' => $item,
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.read_profil', $data);
    }

    public function search(Request $request)
    {
        $data = array(
            'dataNav' => $this->dataNav,
            'isActive' => 'postingan',
            'title' => 'Hasil Pencarian',
            'datas' => Informasi::where('judul', 'like', '%'.$request->keyword.'%')->orderBy('tanggal_posting', 'ASC')->get(),
            'topFive' => Informasi::limit(5)->get()->sortByDesc('viewers')
        );

        return view('app.home.list_postingan_without_paginate', $data);
    }

}
