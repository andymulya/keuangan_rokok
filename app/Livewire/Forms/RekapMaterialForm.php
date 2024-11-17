<?php

namespace App\Livewire\Forms;

use App\Models\RekapMaterial;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RekapMaterialForm extends Form
{
    #[Locked]
    public $id;

    #[Validate]
    public $date;

    #[Validate]
    public $tipe_rekap;

    #[Validate]
    public $nama_material;

    #[Validate]
    public $persediaan;

    #[Validate]
    public $pemakaian;

    #[Validate]
    public $sisa;

    #[Validate]
    public $harga_satuan;

    #[Validate]
    public $total;

    public function rules()
    {
        return [
            'date' => ['required'],
            'tipe_rekap' => ['required'],
            'nama_material' => ['required'],
            'persediaan' => ['required'],
            'pemakaian' => ['required'],
            'sisa' => ['required'],
            'harga_satuan' => ['required'],
            'total' => ['required'],
        ];
    }

    public function load(int $id)
    {
        $rekap = RekapMaterial::find($id);

        $this->id = $rekap->id;
        $this->date = $rekap->date;
        $this->tipe_rekap = $rekap->tipe_rekap;
        $this->nama_material = $rekap->nama_material;
        $this->persediaan = $rekap->persediaan;
        $this->pemakaian = $rekap->pemakaian;
        $this->sisa = $rekap->sisa;
        $this->harga_satuan = $rekap->harga_satuan;
        $this->total = $rekap->total;
    }

    public function clear()
    {
        $this->id = 0;
        $this->date = null;
        $this->tipe_rekap = "";
        $this->nama_material = "";
        $this->persediaan = 0.00;
        $this->pemakaian = 0.00;
        $this->sisa = 0.00;
        $this->harga_satuan = 0;
        $this->total = 0;
    }

    public function post()
    {
        $this->validate();

        return RekapMaterial::updateOrCreate(['id' => $this->id], [
            "date" => $this->date,
            "tipe_rekap" => $this->tipe_rekap,
            "nama_material" => $this->nama_material,
            "persediaan" => $this->persediaan,
            "pemakaian" => $this->pemakaian,
            "sisa" => $this->persediaan - $this->pemakaian,
            "harga_satuan" => $this->harga_satuan,
            "total" => $this->pemakaian * $this->harga_satuan,
        ]);
    }
}
