<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peran extends Model
{
    use HasFactory;
    protected $fillable = [
        'peran'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'id_peran');
    }
}
