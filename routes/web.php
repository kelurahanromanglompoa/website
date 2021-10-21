<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\{
    AduanController,
    AuthController, 
    DashboardController,
    UserController,
    ProfilController,
    InformasiController,
    DocumentController,
    KategoriController,
    TestController,
    HomepageController
};
use \App\Models\{
    Role
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//notif page
Route::get('/forbidden', function(){
    $data = array(
        'title' => '403 ! Forbidden',
        'statusCode' => '403',
        'message' => 'Anda tidak memiliki akses ke halaman ini, silahkan kembali.'
    );
    return view('forbidden', $data);
})->name('forbidden');


Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::post('/aduans/store', [AduanController::class, 'store'])->name('aduans.store');

Route::get('/profil/{slug}/{uuid}', [HomepageController::class, 'profils_read'])->name('home.profils');

Route::get('/postingan', [HomepageController::class, 'postingans'])->name('home.postingans');
Route::get('/postingan/kategori/{slug}/{uuid}', [HomepageController::class, 'postingans_by_category'])->name('home.postingans.category');
Route::get('/postingan/{slug}/{uuid}', [HomepageController::class, 'postingans_read'])->name('home.postingans.read');

Route::get('/dokumen', [HomepageController::class, 'dokumens'])->name('home.dokumens');
Route::get('/dokumen/kategori/{slug}/{uuid}', [HomepageController::class, 'dokumens_by_category'])->name('home.dokumens.category');
Route::get('/dokumen/{slug}/{uuid}', [HomepageController::class, 'dokumens_read'])->name('home.dokumens.read');

Route::post('search', [HomepageController::class, 'search'])->name('search');




Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('postlogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'checkRole:1,2'], 'prefix' => 'dashboard'], function(){
    //Bagian Rahmadani
    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //Menu Profil
    Route::group(['prefix' => 'profil'], function(){
        Route::get('/kategori_profil', [KategoriController::class, 'profil'])->name('profils.kategori');
        Route::post('/kategori_profil/store', [KategoriController::class, 'store_profil'])->name('profils.kategori.store');
        Route::get('/kategori_profil/destroy/{uuid}', [KategoriController::class, 'destroy_profil'])->name('profils.kategori.destroy');

        Route::get('{slug}/{uuid}', [ProfilController::class, 'index'])->name('profils');
        Route::get('{slug}/{uuid}/create', [ProfilController::class, 'create'])->name('profils.create');
        Route::post('{slug}/{uuid}/store', [ProfilController::class, 'store'])->name('profils.store');
        Route::get('{slug}/{uuid}/edit/{uuid_item}', [ProfilController::class, 'edit'])->name('profils.edit');
        Route::post('{slug}/{uuid}/update/{uuid_item}', [ProfilController::class, 'update'])->name('profils.update');
        Route::get('{slug}/{uuid}/destroy/{uuid_item}', [ProfilController::class, 'destroy'])->name('profils.destroy');
    });

    //Menu Postingan
    Route::group(['prefix' => 'postingan'], function(){
        Route::get('/kategori_postingan', [KategoriController::class, 'informasi'])->name('postingans.kategori');
        Route::post('/kategori_postingan/store', [KategoriController::class, 'store_informasi'])->name('postingans.kategori.store');
        Route::get('/kategori_postingan/destroy/{uuid}', [KategoriController::class, 'destroy_informasi'])->name('postingans.kategori.destroy');

        Route::get('{slug}/{uuid}/', [InformasiController::class, 'index'])->name('postingans');
        Route::get('{slug}/{uuid}/create', [InformasiController::class, 'create'])->name('postingans.create');
        Route::post('{slug}/{uuid}/store', [InformasiController::class, 'store'])->name('postingans.store');
        Route::get('{slug}/{uuid}/edit/{uuid_item}', [InformasiController::class, 'edit'])->name('postingans.edit');
        Route::post('{slug}/{uuid}/update/{uuid_item}', [InformasiController::class, 'update'])->name('postingans.update');
        Route::get('{slug}/{uuid}/destroy/{uuid_item}', [InformasiController::class, 'destroy'])->name('postingans.destroy');
    });

    //Menu Dokumen
    Route::group(['prefix' => 'dokumen'], function(){
        Route::get('/kategori_dokumen', [KategoriController::class, 'dokumen'])->name('dokumens.kategori');
        Route::post('/kategori_dokumen/store', [KategoriController::class, 'store_dokumen'])->name('dokumens.kategori.store');
        Route::get('/kategori_dokumen/destroy/{uuid}', [KategoriController::class, 'destroy_dokumen'])->name('dokumens.kategori.destroy');

        Route::get('{slug}/{uuid}', [DocumentController::class, 'index'])->name('dokumens');
        Route::get('{slug}/{uuid}/create', [DocumentController::class, 'create'])->name('dokumens.create');
        Route::post('{slug}/{uuid}/store', [DocumentController::class, 'store'])->name('dokumens.store');
        Route::get('{slug}/{uuid}/edit/{uuid_item}', [DocumentController::class, 'edit'])->name('dokumens.edit');
        Route::post('{slug}/{uuid}/update/{uuid_item}', [DocumentController::class,'update'])->name('dokumens.update');
        Route::get('{slug}/{uuid}/destroy/{uuid_item}', [DocumentController::class, 'destroy'])->name('dokumens.destroy');
    });

    //Menu Users
    Route::group(['prefix' => 'users', 'middleware' => ['checkRole:1']], function(){
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{uuid}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/update/{uuid}', [UserController::class, 'update'])->name('users.update');
        Route::get('/destroy/{uuid}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/reset_password/{uuid}', [UserController::class, 'reset'])->name('users.reset');
    });

    Route::group(['prefix' => 'tes_users'], function(){
        Route::get('/', [TestController::class, 'index'])->name('tesusers');
    });

    //End Bagian Rahmadani

    //Bagian Ryan Therry
    Route::group(['prefix' => 'aduans'], function(){
        Route::get('/', [AduanController::class, 'index'])->name('aduans');
        Route::get('/create', [AduanController::class,'create'])->name('aduans.create');
        Route::post('/store', [AduanController::class, 'store'])->name('aduans.store');
        Route::get('/edit', [AduanController::class, 'edit'])->name('aduans.edit');
        Route::get('/destroy/{uuid}', [AduanController::class, 'destroy'])->name('aduans.destroy');
    });

    //Menu Profil
    Route::group(['prefix' => 'profil'], function(){
        Route::get('/kategori_profil', [KategoriController::class, 'profil'])->name('profils.kategori');
        Route::post('/kategori_profil/store', [KategoriController::class, 'store_profil'])->name('profils.kategori.store');
        Route::get('/kategori_profil/destroy/{uuid}', [KategoriController::class, 'destroy_profil'])->name('profils.kategori.destroy');

        Route::get('{slug}/{uuid}/', [ProfilController::class, 'index'])->name('profils');
    });

    //End Bagian Ryan Therry

    
});
