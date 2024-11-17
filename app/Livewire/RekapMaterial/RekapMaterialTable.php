<?php

namespace App\Livewire\RekapMaterial;

use App\Livewire\Module\BaseTable;
use App\Livewire\Module\Trait\Notification;
use App\Models\RekapMaterial;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

class RekapMaterialTable extends BaseTable
{
    use Notification;

    #[Locked]
    public $title = "Rekap Material Table";
    public $tipe_rekap_selected = "reguler";

    protected array $permissions = [
        'create' => 'rekap-material create',
        'edit' => 'rekap-material edit',
        'delete' => 'rekap-material delete',
    ];

    protected array $modals = [
        'create' => 'rekap-material-form-modal',
        'edit' => 'rekap-material-form-modal',
    ];

    public function render()
    {
        return view('rekap-material.rekap-material-table', $this->getData());
    }

    #[Computed]
    public function rows()
    {
        return RekapMaterial::search($this->search, $this->tipe_rekap_selected)
            // ->orderBy($this->sort_by, $this->sort_direction)
            ->paginate($this->perPage);
    }

    public function cols()
    {
        return [
            [
                "label" => "Tanggal",
                "query" => "date",
                "sort" => true,
            ],
            [
                "label" => "Nama Material",
                "query" => "nama_material",
                "sort" => true,
            ],
            [
                "label" => "Persediaan",
                "query" => "persediaan",
                "sort" => true,
            ],
            [
                "label" => "Pemakaian",
                "query" => "pemakaian",
                "sort" => true,
            ],
            [
                "label" => "Sisa",
                "query" => "sisa",
                "sort" => true,
            ],
            [
                "label" => "Harga Satuan",
                "query" => "harga_satuan",
                "sort" => true,
            ],
            [
                "label" => "Total",
                "query" => "total",
                "sort" => true,
            ],
            [
                "label" => "Tipe Rekap",
                "query" => "tipe_rekap",
                "sort" => true,
            ],
        ];
    }

    public function delete($id)
    {
        parent::delete($id);
        RekapMaterial::destroy($id);
        $this->toast(
            message: "Rekap Material Removed",
        );
    }
}
