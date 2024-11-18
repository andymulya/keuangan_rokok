<?php

namespace App\Livewire\DataPembelian;

use App\Livewire\Module\BaseTable;
use App\Livewire\Module\Trait\Notification;
use App\Models\DataPembelianBarang;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

class DataPembelianTable extends BaseTable
{
    use Notification;

    #[Locked]
    public $title = "Data Pembelian Barang Table";

    public $tipe_data_selected = "reguler";
    public $data_date;

    protected array $permissions = [
        'create' => 'data-pembelian create',
        'edit' => 'data-pembelian edit',
        'delete' => 'data-pembelian delete',
    ];

    protected array $modals = [
        'create' => 'data-pembelian-form-modal',
        'edit' => 'data-pembelian-form-modal',
    ];

    public function render()
    {
        return view('data-pembelian.data-pembelian-table', $this->getData());
    }

    #[Computed]
    public function rows()
    {
        return DataPembelianBarang::search($this->search, $this->data_date, $this->tipe_data_selected)
            // ->orderBy($this->sort_by, $this->sort_direction)
            ->paginate($this->perPage);
    }

    public function cols()
    {
        return [
            [
                "label" => "Date",
                "query" => "date",
                "sort" => true,
            ],
            [
                "label" => "Tipe Pembelian",
                "query" => "tipe_pembelian",
                "sort" => true,
            ],
        ];
    }

    public function delete($id)
    {
        parent::delete($id);
        DataPembelianBarang::destroy($id);
        $this->toast(
            message: "Data Pembelian Barang Removed",
        );
    }
}
