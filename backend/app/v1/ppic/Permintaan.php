<?php

namespace App\v1\ppic;

use App\User;
use App\VUser;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{

    protected $table = 'trs_minta_brg';
    protected $primaryKey = 'id_permintaan';

    protected $fillable = [
        'tglminta',
        'tglbutuh',
        'jenisbrg',
        'nama',
        'qty',
        'satuan',
        'jenispr',
        'status',
        'id_karyawan',
        'spesifik',
        'keperluan',
        'id_barang',
        'no_pr',
        'seen',
        'no_minta',
        'ket',
        'id_tolak',
        'klasifikasi',
        'merk',

        'submited_at',
        'approved_at',
        'approved_user_id',
        'rejected_at',
        'rejected_note',
        'rejected_user_id',


        'user_id',
    ];
    protected $dates = [
        'tglminta',
        'created_at',
        'updated_at',
        'submited_at',
        'approved_at',
        'rejected_at',
    ];

    protected $appends = ['img', 'isRejected', 'isPending', 'isUrgent', 'tracking'];

    //Accessor
    public function getImgAttribute()
    {
        $res = array_map(function ($link) {
            return "http://app.irasa.co.id/storage/img/pembelian/permintaan/" . basename($link);
        }, glob("../../irs/storage/app/public/img/pembelian/permintaan/*" . strtolower("$this->id_permintaan") . "*"));
        return $res;
    }
    public function getIsRejectedAttribute()
    {
        $res = $this->rejected_at != null;
        return $res;
    }
    public function getIsPendingAttribute()
    {
        $spv = auth()->user()->jabatan_id == 2;
        $res = $spv && $this->submited_at && !$this->approved_at
            && !$this->rejected_at;
        return $res;
    }
    public function getIsUrgentAttribute()
    {
        $res = $this->jenispr == 'URGENT';
        return $res;
    }
    public function getTrackingAttribute()
    {
        $res = [];
        if ($this->created_at) {
            array_push($res, [
                'name'          => 'REQ_CREATED',
                'at'            => $this->created_at,
                'user'          => $this->user->pribadi->alias ?? '',
            ]);
        }
        if ($this->submited_at) {
            array_push($res, [
                'name'          => 'REQ_SUBMITED',
                'at'            => $this->submited_at,
                'user'          => $this->user->pribadi->alias ?? '',
            ]);
        }
        if ($this->approved_at) {
            array_push($res, [
                'name'          => 'REQ_APPROVED',
                'at'            => $this->approved_at,
                'user'          => $this->approved->pribadi->alias ?? '',
            ]);
        }
        if ($this->rejected_at) {
            array_push($res, [
                'name'          => 'REQ_REJECTED',
                'at'            => $this->rejected_at,
                'user'          => $this->rejected->pribadi->alias ?? '',
            ]);
        }

        //PR
        if ($this->prBarang) {
            if ($this->prBarang->created_at) {
                array_push($res, [
                    'name'          => 'PR_CREATED',
                    'at'            => $this->prBarang->created_at,
                    'user'          => $this->prBarang->user->pribadi->alias ?? '',
                ]);
            }
            if ($this->prBarang->approved_at) {
                array_push($res, [
                    'name'          => 'PR_APPROVED',
                    'at'            => $this->prBarang->approved_at,
                    'user'          => $this->prBarang->approved->pribadi->alias ?? '',
                ]);
            }
            if ($this->prBarang->rejected_at) {
                array_push($res, [
                    'name'          => 'PR_REJECTED',
                    'at'            => $this->prBarang->rejected_at,
                    'user'          => $this->prBarang->rejected->pribadi->alias ?? '',
                ]);
            }
            if ($this->prBarang->cancel_at) {
                array_push($res, [
                    'name'          => 'PR_CANCELED',
                    'at'            => $this->prBarang->cancel_at,
                    'user'          => $this->prBarang->user->pribadi->alias ?? '',
                ]);
            }
        }
        return array_reverse($res);
    }

    //SCOPE
    public function scopeSearch($query, $cari = null)
    {
        $res = $query->where(function ($q) use ($cari) {
            $q->where('nama', 'like', '%' . $cari . '%');
        });
        return $res;
    }
    public function scopeStatus($query, $status = null)
    {
        switch ($status) {
            case 'value':
                # code...
                break;

            default:
                $res = '';
                break;
        }
        return $res;
    }
    public function scopeUserId($query, $user_id = null)
    {
        if ($user_id && $user_id != '') {
            $res = $query->where('user_id', $user_id);
        } else {
            $res = $query->where('user_id', auth()->user()->id);
        }
        return $res;
    }
    public function scopeBagianId($query, $bagian_id = null)
    {

        if ($bagian_id && $bagian_id != '') {
            $res =
                $query->whereHas('user', function ($subq) use ($bagian_id) {
                    return $subq->where('bagian_id', $bagian_id);
                })
                ->whereNotNull('submited_at');
        } else {
            $res =
                $query->whereHas('user', function ($subq) {
                    return $subq->where('bagian_id', auth()->user()->bagian_id);
                });
        }

        return $res;
    }

    //RELASI
    public function prBarang()
    {
        return $this->hasOne(PRBarang::class, 'id_permintaan', 'id_permintaan');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function vuser()
    {
        return $this->hasOne(VUser::class, 'id', 'user_id');
    }
    public function approved()
    {
        return $this->hasOne(User::class, 'id', 'approved_user_id');
    }
    public function rejected()
    {
        return $this->hasOne(User::class, 'id', 'rejected_user_id');
    }
}
