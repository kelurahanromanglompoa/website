<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use \App\Models\{
    Aduan,
    JenisInformasi, JenisDokumen, JenisProfil
};


class AduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $datas = Aduan::orderBy('created_at', 'desc')->get();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Daftar Aduan',
            'urlNow' => route('aduans'),
            'isActive' => 'aduans',
            'isActiveSub' => '',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'datas' => $datas
        );
        return view('app.dashboard.aduan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();
        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Form Ajukan Aduan',
            'urlNow' => route('aduans.create'),
            'isActive' => 'aduans',
            'isActiveSub' => '',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
        );
        return view('app.dashboard.aduan.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nama' => 'required|min:4|max:30',
        //     'aduan' => 'required|min:10|max:750',
        //     'email' => 'required|email|min:6|max:50',
        //     'handphone' => 'required|min:10|max:12',
        // ],[
        //     'nama.min' => 'Nama yang dimasukkan terlalu pendek',
        //     'nama.max' => 'Nama yang dimasukkan terlalu panjang',
        //     'aduan.min' => 'Aduan yang dimasukkan minimal 10 karakter',
        //     'aduan.max' => 'Aduan yang boleh dimasukkan maksimal 750',
        //     'email.min' => 'Email yang anda masukkan terlalu pendek',
        //     'email.max' => 'Email yang anda masukkan terlalu panjang',
        //     'handphone.min' => 'Nomor yang anda masukkan terlalu pendek',
        //     'handphone.max' => 'Nomor yang anda masukkan terlalu panjang'
        // ]);
        
        DB::beginTransaction();
        try{
            $data = new Aduan;
            $data->nama = $request->nama;
            $data->aduan = $request->aduan;
            $data->email = $request->email;
            $data->handphone = $request->handphone;

            // dd($data);
            $data->save();
            DB::commit();
            return redirect()->route('home')->with('status', 'Data berhasil ditambahkan');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $data = Aduan::firstWhere('uuid', $uuid);
        DB::beginTransaction();
        try{
            $data->delete();
            DB::commit();
            return redirect()->route('aduans')->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }
    }
}
