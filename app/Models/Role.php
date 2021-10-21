<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    const SUPER_ADMIN = 1;
    const ADMIN = 2;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($table) {
            $table->uuid = (string) \Str::uuid();
        });
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }
}
