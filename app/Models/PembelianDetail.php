<?php

namespace App\Models;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'pembelian_details';
    protected $primaryKey = 'id';
    protected $guarded = [];


    /**
     * Get all of the produk for the PembelianDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function produk(): HasOne
    {
        return $this->hasOne(Produk::class,  'id', 'id_produk');
    }
}
