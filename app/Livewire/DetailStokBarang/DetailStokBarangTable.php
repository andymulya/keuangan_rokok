<?php

namespace App\Livewire\DetailStokBarang;

use App\Livewire\Module\BaseTable;
use App\Livewire\Module\Trait\Notification;
use App\Models\DetailStokBarang;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

class DetailStokBarangTable extends BaseTable
{
    use Notification;

    #[Locked]
    public $title = "Detail Stok Barang Table";

    protected array $permissions = [
        'create' => 'detail-stok create',
        'edit' => 'detail-stok edit',
        'delete' => 'detail-stok delete',
    ];

    protected array $modals = [
        'create' => 'detail-stok-barang-form-modal',
        'edit' => 'detail-stok-barang-form-modal',
    ];

    public function render()
    {
        return view('detail-stok-barang.detail-stok-barang-table', $this->getData());
    }

    #[Computed]
    public function rows()
    {
        return DetailStokBarang::search($this->search)
            ->orderBy($this->sort_by, $this->sort_direction)
            ->paginate($this->perPage);
    }

    public function cols()
    {
        return [
            [
                "label" => "Nama Stok",
                "query" => "stok_name",
                "sort" => true,
            ],
            [
                "label" => "Jumlah",
                "query" => "jumlah",
                "sort" => true,
            ],
            [
                "label" => "Harga Satuan",
                "query" => "harga_satuan",
                "sort" => true,
            ],
            [
                "label" => "Harga Total",
                "query" => "harga_total",
                "sort" => true,
            ],
        ];
    }

    public function delete($id)
    {
        parent::delete($id);
        DetailStokBarang::destroy($id);
        $this->toast(
            message: "Detail Stok Barang Removed",
        );
    }
}
