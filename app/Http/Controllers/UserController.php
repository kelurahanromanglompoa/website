<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Hash;
use File;
use \App\Models\{
    JenisInformasi, JenisDokumen, JenisProfil, User, Role
};

class UserController extends Controller
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

        $datas = User::orderBy('role_id', 'ASC')->orderBy('nama_lengkap', 'ASC')->get();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Daftar Admin',
            'urlNow' => route('users'),
            'isActive' => 'users',
            'isActiveSub' => '',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'datas' => $datas,
        );
        return view('app.dashboard.user.index', $data);
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

        $datas = Role::get();

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Form Tambah Admin',
            'urlNow' => route('users.create'),
            'isActive' => 'users',
            'isActiveSub' => '',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'datas' => $datas,
        );
        return view('app.dashboard.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username|min:6|max:30',
            'nama_lengkap' => 'required|min:3|max:40',
            'password' => 'required|min:6|max:12',
            'role_id' => 'required|in:1,2',
        ],[
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username harus bersifat unik',
            'username.min' => 'Username minimal 6 karakter',
            'username.max' => 'Username maksimal 6 karakter',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nama_lengkap.min' => 'Nama minimal 3 karakter',
            'nama_lengkap.max' => 'Nama maksimal 40 karakter',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.max' => 'Password maksimal 12 karakter',
            'role_id.required' => 'Status admin harus diisi',
            'role_id.in' => 'Status admin tidak valid'
        ]);

        DB::beginTransaction();
        try{
            $data = new User;
            if($request->file){
                $request->validate([
                    'file' => 'required|mimes:jpg,jpeg,png|max:512'
                ],[
                    'file.required' => 'File harus diisi',
                    'file.mimes' => 'File yang diizinkan hanya JPG,JPEG dan PNG',
                    'file.max' => 'File maksimal yang dapat diterima sebeasr 512kb'
                ]);
                $path = 'public/avatar/';
                $namaFile = 'avatar__'.$request->username.'__'.trim($request->file->getClientOriginalName());
                $data->avatar = $namaFile;
                $request->file->storeAs($path, $namaFile);

            }
            $data->role_id = $request->role_id;
            $data->username = $request->username;
            $data->password = bcrypt($request->password);
            $data->nama_lengkap = $request->nama_lengkap;
            $data->save();
            DB::commit();
            return redirect()->route('users')->with('status', 'Data berhasil ditambahkan');
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
    public function edit($uuid)
    {
        $listKategoriInformasi = JenisInformasi::orderBy('nama', 'ASC')->get();
        $listKategoriDokumen = JenisDokumen::orderBy('nama', 'ASC')->get();
        $listKategoriProfil = JenisProfil::orderBy('nama', 'ASC')->get();

        $datas = Role::get();
        $user = User::firstWhere('uuid', $uuid);

        $data = array(
            'defaultCurrentTitle' => 'Dashboard',
            'currentTitle' => 'Form Edit Admin',
            'urlNow' => route('users.edit', ['uuid' => $uuid]),
            'isActive' => 'users',
            'isActiveSub' => '',
            'listInformasi' => $listKategoriInformasi,
            'listDokumen' => $listKategoriDokumen,
            'listProfil' => $listKategoriProfil,
            'datas' => $datas,
            'data' => $user
        );
        return view('app.dashboard.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $data = User::firstWhere('uuid', $uuid);
        $request->validate([
            'username' => 'required|min:6|max:30|unique:users,username,'.$data->id,
            'nama_lengkap' => 'required|min:3|max:40',
            'role_id' => 'required|in:1,2',
        ],[
            'username.required' => 'Username harus diisi',
            'username.unique' => 'Username harus bersifat unik',
            'username.min' => 'Username minimal 6 karakter',
            'username.max' => 'Username maksimal 6 karakter',
            'nama_lengkap.required' => 'Nama lengkap harus diisi',
            'nama_lengkap.min' => 'Nama minimal 3 karakter',
            'nama_lengkap.max' => 'Nama maksimal 40 karakter',
            'role_id.required' => 'Status admin harus diisi',
            'role_id.in' => 'Status admin tidak valid'
        ]);

        DB::beginTransaction();
        try{
            if($request->password){
                $request->validate([
                    'password' => 'required|min:6|max:12',
                ],[
                    'password.required' => 'Password harus diisi',
                    'password.min' => 'Password minimal 6 karakter',
                    'password.max' => 'Password maksimal 12 karakter',
                ]);

                $data->password = bcrypt($request->password);
            }

            if($request->file){
                File::delete('storage/avatar/'.$data->avatar);
                $request->validate([
                    'file' => 'required|mimes:jpg,jpeg,png|max:512'
                ],[
                    'file.required' => 'File harus diisi',
                    'file.mimes' => 'File yang diizinkan hanya JPG,JPEG dan PNG',
                    'file.max' => 'File maksimal yang dapat diterima sebeasr 512kb'
                ]);
                $path = 'public/avatar/';
                $namaFile = 'avatar__'.$request->username.'__'.trim($request->file->getClientOriginalName());
                $request->file->storeAs($path, $namaFile);
                $data->avatar = $namaFile;
            }
            $data->role_id = $request->role_id;
            $data->nama_lengkap = $request->nama_lengkap;

            $data->save();
            DB::commit();
            return redirect()->route('users')->with('status', 'Data berhasil diubah');
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
    public function destroy($uuid)
    {
        $data = User::firstWhere('uuid', $uuid);
        DB::beginTransaction();
        try{
            if($data->avatar){
                File::delete('storage/avatar/'.$data->avatar);
            }
            $data->delete();
            DB::commit();
            return redirect()->route('users')->with('status', 'Data berhasil dihapus');
        }catch(Error $th){
            DB::rollback();
            dd($th);
        }        
    }
}
