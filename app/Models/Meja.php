<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_meja');
    }
}
