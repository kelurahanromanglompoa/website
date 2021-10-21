<?php

namespace App\Http\Controllers;
use DB;
use File;
use Illuminate\Support\Str;
use \App\Models\{
    JenisInformasi, JenisDokumen, JenisProfil,
    Dokumen
};
use Illuminate\Http\Request;

class DocumentController extends Controller
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

        $jenis = JenisDokumen::whereUuid($uuid)->whereSlug($slug)->first();
        if($jenis){
            $datas = Dokumen::whereJenisDokumenId($jenis->id)
                ->orderBy('tanggal_posting', 'ASC')
                ->orderBy('judul', 'ASC')
                ->with('penulis')
                ->get();
        }else{
            $datas = Informasi::whereJenisDokumenId(1)
                ->orderBy('tanggal_posting', 'ASC')
                ->orderBy('judul', 'ASC')
                ->with('penulis')
                ->get();
        }
        // dd($datas);

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Daftar Dokumen '.ucfirst($jenis->nama),
            'urlNow' => route('dokumens', ['slug' => $slug, 'uuid' => $uuid]),
            'isActive' => 'dokumen',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
            'datas' => $datas,
        );
        return view('app.dashboard.dokumen.index', $data);
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

        $jenis = JenisDokumen::whereUuid($uuid)->whereSlug($slug)->first();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Tambah Dokumen '.ucfirst($jenis->nama),
            'urlNow' => route('dokumens.create', ['slug' => $slug, 'uuid' => $uuid]),
            'isActive' => 'dokumen',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
        );
        return view('app.dashboard.dokumen.create', $data);
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
            'tanggal_posting' => 'required|date',
            'file' => 'required|mimes:pdf|max:20480'
        ],[ 
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 10 karakter',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi harus terisi',
            'tanggal_posting.required' => 'Tanggal posting harus terisi',
            'tangal_posting.date' => 'Tanggal posting tak sesuai format',
            'file.required' => 'Dokumen harus diupload',
            'file.mimes' => 'Dokumen yang diizinkan hanya bertipe PDF',
            'file.max' => 'Dokumen yang diizinkan maksimal 20480kb'
        ]);

        DB::beginTransaction();
        try{
            $data = new Dokumen;
            $jenis = JenisDokumen::whereUuid($uuid)->whereSlug($slug)->first();

            $data->judul = $request->judul;
            $data->jenis_dokumen_id = $jenis->id;
            $data->deskripsi = $request->deskripsi;
            $data->slug = Str::slug(strtolower($request->judul));
            $data->tanggal_posting = $request->tanggal_posting;
            $data->created_by = auth()->user()->id;

            $path = 'public/dokumen/';
            $namaFile = 'dokumen__'.Str::slug(strtolower($request->judul)).'__'.trim($request->file->getClientOriginalName());
            $data->nama_file = $namaFile;
            $request->file->storeAs($path, $namaFile);

            $data->save();
            DB::commit();
            return redirect()->route('dokumens', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil ditambahkan');
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

        $jenis = JenisDokumen::whereUuid($uuid)->whereSlug($slug)->first();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Edit Dokumen '.ucfirst($jenis->nama),
            'urlNow' => route('dokumens.edit', ['slug' => $slug, 'uuid' => $uuid, 'uuid_item' => $uuid_item]),
            'isActive' => 'dokumen',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
            'data' => Dokumen::whereUuid($uuid_item)->first(),
        );
        return view('app.dashboard.dokumen.edit', $data);
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
            'tanggal_posting' => 'required|date',
        ],[ 
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 10 karakter',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi harus terisi',
            'tanggal_posting.required' => 'Tanggal posting harus terisi',
            'tangal_posting.date' => 'Tanggal posting tak sesuai format',
        ]);

        DB::beginTransaction();
        try{
            $data = Dokumen::whereUuid($uuid_item)->first();

            $data->judul = $request->judul;
            $data->deskripsi = $request->deskripsi;
            $data->slug = Str::slug(strtolower($request->judul));
            $data->tanggal_posting = $request->tanggal_posting;
            $data->created_by = auth()->user()->id;

            if($request->file){
                $request->validate([
                    'file' => 'required|mimes:pdf|max:20480'
                ],[
                    'file.required' => 'Dokumen harus diisi',
                    'file.mimes' => 'Dokumen yang diizinkan hanya PDF',
                    'file.max' => 'Dokumen maksimal yang dapat diterima sebeasr 20480kb'
                ]);

                File::delete('storage/dokumen/'.$data->nama_file);

                $path = 'public/dokumen/';
                $namaFile = 'dokumen__'.Str::slug(strtolower($request->judul)).'__'.trim($request->file->getClientOriginalName());
                $data->nama_file = $namaFile;
                $request->file->storeAs($path, $namaFile);
            }

            $data->save();
            DB::commit();
            return redirect()->route('dokumens', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil diperbaharui');
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
        $data = Dokumen::whereUuid($uuid_item)->first();
        DB::beginTransaction();
        try{
            if($data->nama_file){
                File::delete('storage/dokumen/'.$data->nama_file);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('dokumens', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }        
    }
}
