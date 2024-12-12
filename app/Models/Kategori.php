<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function menus()
    {
        return $this->hasMany(Menu::class, 'id_kategori');
    }
}
