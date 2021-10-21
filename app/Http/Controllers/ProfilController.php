<?php

namespace App\Http\Controllers;
use DB;
use File;
use Illuminate\Support\Str;
use \App\Models\{
    JenisInformasi, JenisDokumen, JenisProfil,
    Profil, Informasi
};
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug, $uuid)
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $jenis = JenisProfil::whereUuid($uuid)->whereSlug($slug)->first();
        if($jenis){
            $datas = Profil::whereJenisProfilId($jenis->id)
                ->orderBy('judul', 'ASC')
                ->with('penulis')
                ->get();
        }else{
            $datas = Informasi::whereJenisProfilId(1)
                ->orderBy('judul', 'ASC')
                ->with('penulis')
                ->get();
        }
        // dd($datas);

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Daftar Profil '.ucfirst($jenis->nama),
            'urlNow' => route('profils', ['slug' => $slug, 'uuid' => $uuid]),
            'isActive' => 'profil',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
            'datas' => $datas,
        );
        return view('app.dashboard.profil.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug, $uuid)
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $jenis = JenisProfil::whereUuid($uuid)->whereSlug($slug)->first();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Tambah Profil '.ucfirst($jenis->nama),
            'urlNow' => route('profils.create', ['slug' => $slug, 'uuid' => $uuid]),
            'isActive' => 'profil',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
        );
        return view('app.dashboard.profil.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug, $uuid)
    {
        $this->validate($request, [
            'judul' => 'required|min:10|max:255',
            'deskripsi' => 'required',
        ],[ 
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 10 karakter',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi harus terisi',
        ]);
        DB::beginTransaction();
        try{
            $data = new Profil;
            $jenis = JenisProfil::whereUuid($uuid)->whereSlug($slug)->first();
            $data->judul = $request->judul;
            $data->jenis_profil_id = $jenis->id;
            $data->deskripsi = $request->deskripsi;
            $data->slug = Str::slug(strtolower($request->judul));
            $data->created_by = auth()->user()->id;          

            if($request->file){
                $request->validate([
                    'file' => 'required|mimes:jpg,jpeg,png|max:2048'
                ],[
                    'file.required' => 'File harus diisi',
                    'file.mimes' => 'File yang diizinkan hanya JPG,JPEG dan PNG',
                    'file.max' => 'File maksimal yang dapat diterima sebeasr 2048kb'
                ]);
                $path = 'public/profil/';
                $namaFile = 'profil_'.Str::slug(strtolower($request->judul)).'__'.trim($request->file->getClientOriginalName());
                $data->cover = $namaFile;
                $request->file->storeAs($path, $namaFile);
            }

            $data->save();
            DB::commit();
            return redirect()->route('profils', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil ditambahkan');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $uuid, $uuid_item)
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $jenis = JenisProfil::whereUuid($uuid)->whereSlug($slug)->first();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Edit Profil '.ucfirst($jenis->nama),
            'urlNow' => route('profils.edit', ['slug' => $slug, 'uuid' => $uuid, 'uuid_item' => $uuid_item]),
            'isActive' => 'profil',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
            'data' => Profil::whereUuid($uuid_item)->first(),
        );
        return view('app.dashboard.profil.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, $uuid, $uuid_item)
    {
        $this->validate($request, [
            'judul' => 'required|min:10|max:255',
            'deskripsi' => 'required',
        ],[ 
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 10 karakter',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi harus terisi',
        ]);
        DB::beginTransaction();
        try{
            $data = Profil::whereUuid($uuid_item)->first();

            $data->judul = $request->judul;
            $data->deskripsi = $request->deskripsi;
            // $data->is_headline = $request->is_headline;
            $data->slug = Str::slug(strtolower($request->judul));
            $data->created_by = auth()->user()->id;          

            if($request->file){
                $request->validate([
                    'file' => 'required|mimes:jpg,jpeg,png|max:2048'
                ],[
                    'file.required' => 'File harus diisi',
                    'file.mimes' => 'File yang diizinkan hanya JPG,JPEG dan PNG',
                    'file.max' => 'File maksimal yang dapat diterima sebeasr 2048kb'
                ]);

                File::delete('storage/profil/'.$data->cover);

                $path = 'public/profil/';
                $namaFile = 'profil__'.Str::slug(strtolower($request->judul)).'__'.trim($request->file->getClientOriginalName());
                $data->cover = $namaFile;
                $request->file->storeAs($path, $namaFile);
            }

            $data->save();
            DB::commit();
            return redirect()->route('profils', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil diubah');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug, $uuid, $uuid_item)
    {
        $data = Profil::whereUuid($uuid_item)->first();
        DB::beginTransaction();
        try{
            if($data->nama_file){
                File::delete('storage/profil/'.$data->nama_file);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('profils', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }
}
