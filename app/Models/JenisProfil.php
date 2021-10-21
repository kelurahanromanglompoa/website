<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProfil extends Model
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

    public function profils()
    {
        return $this->hasMany(Profil::class, 'jenis_profil_id', 'id');
    }
}
