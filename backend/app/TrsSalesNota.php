<?php

namespace App;

use App\MstCustomer;
use App\VUser;
use Illuminate\Database\Eloquent\Model;
use Awobaz\Compoships\Compoships;

class TrsSalesNota extends Model
{
    use Compoships;
    protected $table = 'trs_sales_nota';

    protected $fillable = [
      'tanggal',
      'nokend',
      'idcust',
      'nonota',
      'jumlah',
      'diskon',
      'diskonlain',
      'retur',
      'netto',
      'poin',
      'jmlbayar',
      'sisahutang',
      'catatan',
      'opr',
      'sysdate',
      'lebihbayar',
      'recehan',
      'xat',
      'noxat',
      'ppn',
      'ppndisk',
      'tgl_create',
      'nofaktur',
      'iddaerah',
      'cabang',
      'tempxat',
      'tempppn',
      'idcustcab',
      'nofakturretur',
      'idcustold',
      'carabayar',
      'prsdisklain',
      'nobuktibayar',
      'banknorek',
      'bayar_tunai',
      'bayar_bank',
      'ppn_dpp',
      'ppn_bayar',
      'custbank',
      'jml_cetak',
      'bayar_trf',
      'lokasi',
      'noso',
      'waktu_awal',
      'waktu_akhir',
      'sales',
      'apk_versi',
      'notes_sales',
      'created_at',
      'updated_at',
      'print_at',
      'user_id',
      'trf_pending',
      'confirmbs_at',
      'confirm_at',
      'jmlbayar2',
      'carabayar2',
      'banknorek2',
      'bayar_bank2',
      'custbank2',
      'bayar_trf2',
      'nobuktibayar2',
      'bayar_tunai2',
      'driver_note',
      'idcust22',
      'print_sj_at',
      'lunas_at',
      'lunas_id',
    ];

    protected $guarded = [];
    public function rinci()
    {
        return $this->hasMany(TrsSalesRinci::class, 'nonota', 'nonota');
    }
    public function cust()
    {
        return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
    }
    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }
}
