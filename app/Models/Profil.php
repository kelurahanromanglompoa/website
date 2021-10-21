<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($table) {
            $table->uuid = (string) \Str::uuid();
        });
    }

    public function jenis_profil()
    {
        return $this->belongsTo(JenisProfil::class, 'jenis_informasi_id', 'id');
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
