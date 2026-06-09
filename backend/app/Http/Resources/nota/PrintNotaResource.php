<?php

namespace App\Http\Resources\nota;

use App\MstDiskon;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PrintNotaResource extends JsonResource
{
    public function toArray($request)
    {
        // ADIT | START | WIG Akumulasi Diskon | 20 Oktober 2025
        return [
            'id' => $this->id,
            'tanggal' => $this->tanggal,
            'nokend' => $this->nokend,
            'idcust' => $this->idcust,
            'nonota' => $this->nonota,
            'jumlah' => $this->jumlah,
            'diskon' => $this->diskon,
            'netto' => $this->netto,
            'poin' => $this->poin,
            'jmlbayar' => $this->jmlbayar,
            'sisahutang' => $this->sisahutang,
            'catatan' => trim($this->catatan),
            'opr' => trim($this->opr),
            'sysdate' => $this->sysdate,
            'lebihbayar' => $this->lebihbayar,
            'recehan' => $this->recehan,
            'xat' => trim($this->xat),
            'ppn' => $this->ppn,
            'ppndisk' => $this->ppndisk,
            'tgl_create' => $this->tgl_create,
            'nofaktur' => trim($this->nofaktur),
            'iddaerah' => trim($this->iddaerah),
            'cabang' => trim($this->cabang),
            'tempxat' => trim($this->tempxat),
            'tempppn' => $this->tempppn,
            'idcustcab' => trim($this->idcustcab),
            'nofakturretur' => trim($this->nofakturretur),
            'idcustold' => trim($this->idcustold),
            'carabayar' => trim($this->carabayar),
            'prsdisklain' => $this->getDiscount(),
            'nobuktibayar' => trim($this->nobuktibayar),
            'banknorek' => trim($this->banknorek),
            'bayar_tunai' => $this->bayar_tunai,
            'bayar_bank' => $this->bayar_bank,
            'ppn_dpp' => $this->ppn_dpp,
            'ppn_bayar' => $this->ppn_bayar,
            'custbank' => trim($this->custbank),
            'bayar_trf' => $this->bayar_trf,
            'noso' => $this->noso,
            'jml_cetak' => $this->jml_cetak,
            'waktu_awal' => $this->waktu_awal,
            'sales' => $this->sales,
            'lokasi' => $this->lokasi,
            'waktu_akhir' => $this->waktu_akhir,
            'apk_versi' => trim($this->apk_versi),
            'notes_sales' => trim($this->notes_sales),
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'trf_pending' => trim($this->trf_pending),
            'confirmbs_at' => $this->confirmbs_at,
            'confirm_at' => $this->confirm_at,
            'jmlbayar2' => $this->jmlbayar2,
            'carabayar2' => trim($this->carabayar2),
            'banknorek2' => trim($this->banknorek2),
            'bayar_bank2' => $this->bayar_bank2,
            'custbank2' => trim($this->custbank2),
            'bayar_trf2' => $this->bayar_trf2,
            'nobuktibayar2' => trim($this->nobuktibayar2),
            'bayar_tunai2' => $this->bayar_tunai2,
            'driver_note' => $this->driver_note,
            'idcust22' => trim($this->idcust22),
            'print_at' => $this->print_at,
            'print_sj_at' => $this->print_sj_at,
            'lunas_at' => $this->lunas_at,
            'lunas_id' => $this->lunas_id,
            'lebihbayar2' => $this->lebihbayar2,
            'sisahutang2' => $this->sisahutang2,
            'bayar_qris' => $this->bayar_qris,
            'bayar_qris2' => $this->bayar_qris2,
            'mode_ppn' => $this->mode_ppn,
            'rinci' => $this->rinci,
            'cust' => $this->cust,
            'user' => $this->user,
        ];
    }

    public function getDiscount()
    {
        $point = 0;
        foreach ($this->rinci as $item) {
            $point += $item['poin'];
        }

        $currentDate = Carbon::parse($this->tanggal);
        $parameters = [
            ['mulai', '<=', $currentDate],
            ['akhir', '>=', $currentDate],
            ['poin1', '<=', strval($point)],
            ['poin2', '>=', strval($point)],
        ];
        $newDiscountTemp = MstDiskon::where($parameters)->value('diskon') ?? 0;
        $result = (string) ($this->prsdisklain + (int) $newDiscountTemp);
        return $result;
    }
}
