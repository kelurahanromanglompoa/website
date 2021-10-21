<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($table) {
            $table->uuid = (string) \Str::uuid();
        });
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function informasis()
    {
        return $this->hasMany(Informasi::class, 'created_by', 'id');
    }

    public function dokumens()
    {
        return $this->hasMany(Dokumen::class, 'created_by', 'id');
    }

    public function forms()
    {
        return $this->hasMany(Form::class, 'created_by', 'id');
    }

    public function profils()
    {
        return $this->hasMany(Profil::class, 'created_by', 'id');
    }

}
