<?php

namespace App\salesapp;

use App\MstCustomer;
use App\salesapp\MstPoin;
use App\salesapp\TrsPoin;
use App\VUser;
use App\v1\ppic\Minta;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TrsPoinPengajuan extends Model
{
    protected $table = 'trs_poin_pengajuan';
    protected $fillable = [
        'tanggal',
        'idcust',
        'id_giftpoin',
        'giftcustom',
        'qty',
        'created_id',
        'kunci_id',
        'kunci_at',
        'photo',
        // START | ADIT - 9/12/2024 - FPP/MLG/2411035 - untuk pilihan "tidak menukarkan hadiah"
        'rejected_at',
        'rejected_id',
        'rejected_note',
        // END | ADIT - 9/12/2024 - FPP/MLG/2411035 - untuk pilihan "tidak menukarkan hadiah"
    ];

    public function customer()
    {
        return $this->hasOne(MstCustomer::class, 'idcust', 'idcust');
    }

    public function hadiah()
    {
        return $this->hasOne(MstPoin::class, 'id', 'id_giftpoin');
    }

    public function user()
    {
        return $this->hasOne(VUser::class, 'id', 'created_id');
    }

    public function kunci()
    {
        return $this->hasOne(VUser::class, 'id', 'kunci_id');
    }

    public function subtitute()
    {
        return $this->hasOne(VUser::class, 'id', 'subtitute_id');
    }

    public function reject()
    {
        return $this->hasOne(VUser::class, 'id', 'rejected_id');
    }

    public function minta()
    {
        return $this->hasOne(Minta::class, 'id_permintaan', 'permintaan_id');
    }

    public function serah()
    {
        return $this->hasOne(TrsPoin::class, 'aju_id', 'id')->doesntHave('tolakNotDriver');
    }

    public function scopeKel($query, $kel)
    {
        return $query->whereHas('customer.daerahMax', function ($q) use ($kel) {
            $q->where('iddaerah', $kel);
        });
    }

    public function scopeTglIdcust($query, $tanggal, $idcust)
    {
        return $query->where([
            'tanggal'   => $tanggal,
            'idcust'    => $idcust,
        ]);
    }

    public function scopeTglIdcustProd($query, $tanggal, $idcust, $idgiftpoin, $giftcustom)
    {
        return $query->where([
            'tanggal'       => $tanggal,
            'idcust'        => $idcust,
            'id_giftpoin'   => $idgiftpoin,
            'giftcustom'    => $giftcustom,
        ]);
    }

    public function scopeNottglIdcust($query, $tanggal, $idcust)
    {
        return $query->where([
            ['tanggal', '!=', $tanggal],
            ['idcust', $idcust],
        ]);
    }

    public function scopeBetweenTgl($query, $awal, $akhir)
    {
        return $query->whereBetween('tanggal', [$awal, $akhir]);
    }

    public function scopeSiapKirim($query)
    {
        return $query->whereHas('serah', function ($query) {
            $query->has('kendaraan');
        });
    }

    public function scopeKirimToday($query, $idkend, $tanggal)
    {
        return $query->whereHas('serah', function ($query) use ($idkend, $tanggal) {
            $query->where('kend_id', $idkend);
            $query->whereDate('tanggal', $tanggal);
        });
    }

    public function getTrackingAttribute()
    {
        $res = [];
        array_push($res, [
            'id'        => 1,
            'status'    => 'Pengajuan Sales Ke Admin',
            'note'      => '',
            'user'      => $this->user->nama ?? '',
            'at'        => Carbon::parse($this->created_at)->toDateTimeString() ?? '',
        ]);

        if ($this->kunci_id != 0) {
            array_push($res, [
                'id'        => 2,
                'status'    => 'Dikunci Admin',
                'note'      => '',
                'user'      => $this->kunci->nama ?? '',
                'at'        => Carbon::parse($this->kunci_at)->toDateTimeString() ?? '',
            ]);
        }

        if ($this->subtitute_id != 0) {
            array_push($res, [
                'id'        => 3,
                'status'    => 'Disubtitusi Pembelian',
                'note'      => 'Diubah menjadi ' . trim($this->hadiah->nama) ?? '',
                'user'      => $this->subtitute->nama ?? '',
                'at'        => Carbon::parse($this->subtitute_at)->toDateTimeString() ?? '',
            ]);
        }

        if ($this->rejected_at != null && $this->rejected_id != 0) {
            array_push($res, [
                'id'        => 4,
                'status'    => 'Ditolak Pembelian',
                'note'      => 'Alasan: ' . trim($this->rejected_note) ?? '',
                'user'      => $this->reject->nama ?? '',
                'at'        => Carbon::parse($this->rejected_at)->toDateTimeString() ?? '',
            ]);
        }

        if ($this->permintaan_id != null) {
            array_push($res, [
                'id'        => 5,
                'status'    => 'Permintaan ke Pembelian',
                'note'      => '',
                'user'      => $this->minta->user->nama ?? '',
                'at'        => /*Carbon::parse($this->minta->created_at)->toDateTimeString() ??*/ '', //irin WIP uncomment
            ]);
        }

        if ($this->serah != null) {
            array_push($res, [
                'id'        => 6,
                'status'    => 'Penyerahan Pembelian ke Penjualan',
                'note'      => '',
                'user'      => $this->serah->user->nama ?? '',
                'at'        => Carbon::parse($this->serah->created_at)->toDateTimeString() ?? '',
            ]);

            if ($this->serah->print_id != null) {
                array_push($res, [
                    'id'        => 7,
                    'status'    => 'Dicetak Admin',
                    'note'      => 'No Cetak ' . trim($this->serah->noorder),
                    'user'      => $this->serah->cetak->nama ?? '',
                    'at'        => Carbon::parse($this->serah->print_at)->toDateTimeString() ?? '',
                ]);
            }

            if ($this->serah->kendaraan != null) {
                array_push($res, [
                    'id'        => 8,
                    'status'    => 'Dikirim Driver',
                    'note'      => 'Nokend ' . trim($this->serah->kendaraan->nokend),
                    'user'      => $this->serah->kirim->nama ?? '',
                    'at'        => Carbon::parse($this->serah->kirim_at)->toDateTimeString() ?? '',
                ]);
            }

            if ($this->serah->terima_id != null) {
                array_push($res, [
                    'id'        => 9,
                    'status'    => 'Diterima Pelanggan',
                    'note'      => '',
                    'user'      => $this->serah->terima->nama,
                    'at'        => Carbon::parse($this->serah->terima_at)->toDateTimeString(),
                ]);
            }

            if ($this->serah->tolakDriver != null) {
                array_push($res, [
                    'id'        => 10,
                    'status'    => 'Ditolak Pelanggan',
                    'note'      => 'Alasan: ' . trim($this->serah->cancel_note),
                    'user'      => $this->serah->tolakDriver->nama,
                    'at'        => Carbon::parse($this->serah->cancel_at)->toDateTimeString(),
                ]);
            }
        }
        return array_reverse($res);
    }
}
