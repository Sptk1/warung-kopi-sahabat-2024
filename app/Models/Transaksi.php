<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['id_user', 'id_meja', 'total_transaksi', 'total_pembayaran', 'status'];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'id_meja');
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    // Transaksi.php (Model)
    public function scopeFilter($query, $filters)
    {
        if (isset($filters['year'])) {
            $query->whereYear('created_at', $filters['year']);
        }
        if (isset($filters['month'])) {
            $query->whereMonth('created_at', $filters['month']);
        }
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total_kembalian =  $model->total_pembayaran - $model->total_transaksi;
        });
    }
}
