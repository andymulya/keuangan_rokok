<?php

namespace App\Livewire\Forms;

use App\Models\DetailStokBarang;
use App\Models\DataPembelianBarang;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DetailStokBarangForm extends Form
{
    #[Locked]
    public $id;

    #[Validate]
    public $stok_name;

    #[Validate]
    public $data_pembelian_barang_id;

    #[Validate]
    public $jumlah;

    #[Validate]
    public $harga_satuan;

    #[Validate]
    public $harga_total;

    #[Validate]
    public $date;

    #[Validate]
    public $type = "reguler";

    public function rules()
    {
        return [
            'stok_name' => ['required'],
            'data_pembelian_barang_id' => ['required'],
            'jumlah' => ['required'],
            'harga_satuan' => ['required'],
            'harga_total' => ['required'],
        ];
    }

    public function load(int $id)
    {
        $stok = DetailStokBarang::find($id);

        $this->id = $stok->id;
        $this->stok_name = $stok->stok_name;
        $this->data_pembelian_barang_id = $stok->data_pembelian_barang_id;
        $this->jumlah = $stok->jumlah;
        $this->harga_satuan = $stok->harga_satuan;
        $this->harga_total = $stok->harga_total;
    }

    public function clear()
    {
        $this->id = 0;
        $this->stok_name = "";
        $this->data_pembelian_barang_id = 0;
        $this->jumlah = 0;
        $this->harga_satuan = 0;
        $this->harga_total = 0;
    }

    public function post()
    {
        $this->validate();
        $data = DataPembelianBarang::getDataPembelian($this->date, $this->type);

        return DetailStokBarang::updateOrCreate(['id' => $this->id], [
            "stok_name" => $this->stok_name,
            "data_pembelian_barang_id" => $data->id,
            "jumlah" => $this->jumlah,
            "harga_satuan" => $this->harga_satuan,
            "harga_total" => $this->jumlah * $this->harga_satuan,
        ]);
    }
}
