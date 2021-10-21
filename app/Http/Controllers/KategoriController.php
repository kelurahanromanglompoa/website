<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use File;
use Illuminate\Support\Str;
use \App\Models\{
    JenisInformasi, JenisDokumen, JenisProfil
};

class KategoriController extends Controller
{
    public function informasi()
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $datas = JenisInformasi::orderBy('nama', 'ASC')->get();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Datar Kategori Postingan',
            'urlNow' => route('postingans.kategori'),
            'isActive' => 'postingan',
            'isActiveSub' => 'kategori_postingan',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'datas' => $datas
        );
        return view('app.dashboard.kategori.informasi.index', $data);
    }

    public function store_informasi(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jenis_informasis,nama|min:3|max:50',
        ],[
            'nama.required' => 'Nama kategori harus diisi',
            'nama.unique' => 'Nama kategori harus bersifat unik',
            'nama.min' => 'Nama kategori minimal 6 karakter',
            'nama.max' => 'Nama kategori maksimal 6 karakter',
        ]);

        DB::beginTransaction();
        try{
            $data = new JenisInformasi;
            $data->nama = $request->nama;
            $data->slug = Str::slug(strtolower($request->nama));
            $data->save();
            DB::commit();
            return redirect()->route('postingans.kategori')->with('status', 'Data berhasil ditambahkan');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }

    public function destroy_informasi($uuid)
    {
        DB::beginTransaction();
        try{
            $data = JenisInformasi::firstWhere('uuid', $uuid);
            $data->delete();

            DB::commit();
            return redirect()->route('postingans.kategori')->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }

    public function dokumen()
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $datas = JenisDokumen::orderBy('nama', 'ASC')->get();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Datar Kategori Dokumen',
            'urlNow' => route('dokumens.kategori'),
            'isActive' => 'dokumen',
            'isActiveSub' => 'kategori_dokumen',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'datas' => $datas
        );
        return view('app.dashboard.kategori.dokumen.index', $data);
    }

    public function store_dokumen(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jenis_dokumens,nama|min:3|max:50',
        ],[
            'nama.required' => 'Nama kategori harus diisi',
            'nama.unique' => 'Nama kategori harus bersifat unik',
            'nama.min' => 'Nama kategori minimal 6 karakter',
            'nama.max' => 'Nama kategori maksimal 6 karakter',
        ]);

        DB::beginTransaction();
        try{
            $data = new JenisDokumen;
            $data->nama = $request->nama;
            $data->slug = Str::slug(strtolower($request->nama));
            $data->save();
            DB::commit();
            return redirect()->route('dokumens.kategori')->with('status', 'Data berhasil ditambahkan');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }

    public function destroy_dokumen($uuid)
    {
        DB::beginTransaction();
        try{
            $data = JenisDokumen::firstWhere('uuid', $uuid);
            $data->delete();

            DB::commit();
            return redirect()->route('dokumens.kategori')->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }

    public function profil()
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $datas = JenisProfil::orderBy('nama', 'ASC')->get();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Datar Kategori Profil',
            'urlNow' => route('profils.kategori'),
            'isActive' => 'profil',
            'isActiveSub' => 'kategori_profil',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'datas' => $datas
        );
        return view('app.dashboard.kategori.profil.index', $data);
    }

    public function store_profil(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:jenis_dokumens,nama|min:3|max:50',
        ],[
            'nama.required' => 'Nama kategori harus diisi',
            'nama.unique' => 'Nama kategori harus bersifat unik',
            'nama.min' => 'Nama kategori minimal 6 karakter',
            'nama.max' => 'Nama kategori maksimal 6 karakter',
        ]);

        DB::beginTransaction();
        try{
            $data = new JenisProfil;
            $data->nama = $request->nama;
            $data->slug = Str::slug(strtolower($request->nama));
            $data->save();
            DB::commit();
            return redirect()->route('profils.kategori')->with('status', 'Data berhasil ditambahkan');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }

    public function destroy_profil($uuid)
    {
        DB::beginTransaction();
        try{
            $data = JenisProfil::firstWhere('uuid', $uuid);
            $data->delete();

            DB::commit();
            return redirect()->route('profils.kategori')->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }
}
