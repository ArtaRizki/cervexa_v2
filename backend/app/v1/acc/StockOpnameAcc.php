<?php

namespace App\v1\acc;

use App\MstProduk;
use Illuminate\Database\Eloquent\Model;

class StockOpnameAcc extends Model
{
    protected $table = 'trs_acc_so';
    protected $fillable = [
        'tanggal',
        'lokasi',
        'gudang',
        'area',
        'lantai',
        'idprod',
        'ball',
        'pcs',
        'kodeprod',
        'expdate',
        'user_id',
    ];
    public function produk()
    {
        return $this->hasOne(MstProduk::class, 'idprod', 'idprod');
    }
    public function save(array $options = array())
    {
        $this->user_id = auth()->user()->id;
        parent::save($options);
    }
}
