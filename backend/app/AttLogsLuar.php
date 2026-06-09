<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttLogsLuar extends Model
{
  protected $table = 'finger_att_logs_luar';

  protected $fillable = [
    'sn',
    'pin',
    'scan_date',
    'io_mode',
    'verify_mode',
    'shift_id',
    'work_code',
    // ADIT | START | 19/06/2025 | FPP/MLG/2406072 - monitoring absen sales
    'jenis',
    'is_valid',
    // ADIT |  END  | 19/06/2025 | FPP/MLG/2406072 - monitoring absen sales
  ];

  // ADIT | START | 19/06/2025 | FPP/MLG/2406072 - monitoring absen sales
  /**
   *
   */
  public function scopeInsertUpdate($query, $data)
  {
    return $query->updateOrCreate(
      [
        'sn'        => $data['sn'], // nokend
        'pin'       => $data['pin'], // nfp
        'shift_id'  => $data['shift_id'], // nonota
        'jenis'     => $data['jenis'], // jenis absen(IN/OUT)
      ],
      $data,
    );
  }

  /**
   * Untuk mengambil foto stok gudang customer saat check-OUT, saat sales
   * absen setelah transaksi nota
   */
  public function scopeFotoStokGudangCust($query, $nokend, $nonota)
  {
    $image = $query->where([
      'sn'        => $nokend,
      'shift_id'  => $nonota,
      'jenis'     => 'OUT',
    ])->pluck('work_code')->first();

    return $image ?? '';
  }
  // ADIT |  END  | 19/06/2025 | FPP/MLG/2406072 - monitoring absen sales
}
