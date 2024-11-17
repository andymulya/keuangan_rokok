<?php

namespace App\Livewire\Forms;

use App\Models\DataPembelianBarang;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DataPembelianForm extends Form
{
    #[Locked]
    public $id;

    #[Validate]
    public $date;

    #[Validate]
    public $tipe_pembelian;

    public function rules()
    {
        return [
            'date' => ['required'],
            'tipe_pembelian' => ['required'],
        ];
    }

    public function load(int $id)
    {
        $barang = DataPembelianBarang::find($id);

        $this->id = $barang->id;
        $this->date = $barang->date;
        $this->tipe_pembelian = $barang->tipe_pembelian;
    }

    public function clear()
    {
        $this->id = 0;
        $this->date = null;
        $this->tipe_pembelian = "";
    }

    public function post()
    {
        $this->validate();

        return DataPembelianBarang::updateOrCreate(['id' => $this->id], [
            "date" => $this->date,
            "tipe_pembelian" => $this->tipe_pembelian,
        ]);
    }
}
