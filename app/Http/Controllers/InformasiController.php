<?php

namespace App\Http\Controllers;
use DB;
use File;
use Illuminate\Support\Str;
use \App\Models\{
    JenisInformasi, JenisDokumen, JenisProfil,
    Informasi
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
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

        $jenis = JenisInformasi::whereUuid($uuid)->whereSlug($slug)->first();
        if($jenis){
            $datas = Informasi::whereJenisInformasiId($jenis->id)
                ->orderBy('is_headline', 'DESC')
                ->orderBy('tanggal_posting', 'ASC')
                ->orderBy('judul', 'ASC')
                ->with('penulis')
                ->get();
        }else{
            $datas = Informasi::whereJenisInformasiId(1)
                ->orderBy('is_headline', 'DESC')
                ->orderBy('tanggal_posting', 'ASC')
                ->orderBy('judul', 'ASC')
                ->with('penulis')
                ->get();
        }
        // dd($datas);

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Daftar Postingan '.ucfirst($jenis->nama),
            'urlNow' => route('postingans', ['slug' => $slug, 'uuid' => $uuid]),
            'isActive' => 'postingan',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
            'datas' => $datas,
        );
        return view('app.dashboard.informasi.index', $data);
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

        $jenis = JenisInformasi::whereUuid($uuid)->whereSlug($slug)->first();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Tambah Postingan '.ucfirst($jenis->nama),
            'urlNow' => route('postingans.create', ['slug' => $slug, 'uuid' => $uuid]),
            'isActive' => 'postingan',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
        );
        return view('app.dashboard.informasi.create', $data);
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
            'is_headline' => 'required|in:0,1',
        ],[ 
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 10 karakter',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi harus terisi',
            'tanggal_posting.required' => 'Tanggal posting harus terisi',
            'tangal_posting.date' => 'Tanggal posting tak sesuai format',
            'is_headline.required' => 'Status headline harus diisi',
            'is_headline.in' => 'Status headline tidak valid'
        ]);
        DB::beginTransaction();
        try{
            $data = new Informasi;
            $jenis = JenisInformasi::whereUuid($uuid)->whereSlug($slug)->first();

            $data->judul = $request->judul;
            $data->jenis_informasi_id = $jenis->id;
            $data->deskripsi = $request->deskripsi;
            $data->is_headline = $request->is_headline;
            $data->slug = Str::slug(strtolower($request->judul));
            $data->tanggal_posting = $request->tanggal_posting;  
            $data->created_by = auth()->user()->id;          

            if($request->file){
                $request->validate([
                    'file' => 'required|mimes:jpg,jpeg,png|max:2048'
                ],[
                    'file.required' => 'File harus diisi',
                    'file.mimes' => 'File yang diizinkan hanya JPG,JPEG dan PNG',
                    'file.max' => 'File maksimal yang dapat diterima sebeasr 2048kb'
                ]);
                
                $namaFile = 'postingan__'.Str::slug(strtolower($request->judul)).'__'.trim($request->file->getClientOriginalName());
                Storage::disk('google')->putFileAs("", $request->file, $namaFile);
                $data->cover = Storage::disk('google')->url($namaFile);
            }

            $data->save();
            DB::commit();
            return redirect()->route('postingans', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil ditambahkan');
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

        $jenis = JenisInformasi::whereUuid($uuid)->whereSlug($slug)->first();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Edit Postingan '.ucfirst($jenis->nama),
            'urlNow' => route('postingans.edit', ['slug' => $slug, 'uuid' => $uuid, 'uuid_item' => $uuid_item]),
            'isActive' => 'postingan',
            'isActiveSub' => $slug,
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'slug' => $slug,
            'uuid' => $uuid,
            'data' => Informasi::whereUuid($uuid_item)->first(),
        );
        return view('app.dashboard.informasi.edit', $data);
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
            'is_headline' => 'required|in:0,1',
        ],[ 
            'judul.required' => 'Judul harus diisi',
            'judul.min' => 'Judul minimal 10 karakter',
            'judul.max' => 'Judul maksimal 255 karakter',
            'deskripsi.required' => 'Deskripsi harus terisi',
            'tanggal_posting.required' => 'Tanggal posting harus terisi',
            'tangal_posting.date' => 'Tanggal posting tak sesuai format',
            'is_headline.required' => 'Status headline harus diisi',
            'is_headline.in' => 'Status headline tidak valid'
        ]);
        DB::beginTransaction();
        try{
            $data = Informasi::whereUuid($uuid_item)->first();

            $data->judul = $request->judul;
            $data->deskripsi = $request->deskripsi;
            $data->is_headline = $request->is_headline;
            $data->slug = Str::slug(strtolower($request->judul));
            $data->tanggal_posting = $request->tanggal_posting;  
            $data->created_by = auth()->user()->id;          

            if($request->file){
                $request->validate([
                    'file' => 'required|mimes:jpg,jpeg,png|max:2048'
                ],[
                    'file.required' => 'File harus diisi',
                    'file.mimes' => 'File yang diizinkan hanya JPG,JPEG dan PNG',
                    'file.max' => 'File maksimal yang dapat diterima sebeasr 2048kb'
                ]);

                //delete file with fileid then upload a new one if admin change the file
                $namaFile = 'postingan__'.Str::slug(strtolower($request->judul)).'__'.trim($request->file->getClientOriginalName());
                $fileid = trim($data->cover, "https://drive.google.com/uc?id=&export=media");
                Storage::disk('google')->delete($fileid);
                //upload file to gdrive
                Storage::disk('google')->putFileAs("", $request->file, $namaFile);
                //dd($request->file->store("","google"));
                $data->cover = Storage::disk('google')->url($namaFile);
            }

            $data->save();
            DB::commit();
            return redirect()->route('postingans', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil diubah');
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
        $data = Informasi::whereUuid($uuid_item)->first();
        DB::beginTransaction();
        try{
            if($data->cover){
                $fileid = trim($data->cover, "https://drive.google.com/uc?id=&export=media");
                Storage::disk('google')->delete($fileid);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('postingans', ['slug' => $slug, 'uuid' => $uuid])->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }        
    }
}
