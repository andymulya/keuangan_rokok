<?php

namespace App\Livewire\Operator;

use App\Livewire\Module\BaseTable;
use App\Livewire\Module\Trait\Notification;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use App\Models\HasilInputOperator;
use App\Exports\OperatorExport;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class OperatorTable extends BaseTable
{
    use Notification;

    #[Locked]
    public $title = "Operator Table";

    protected array $permissions = [
        'create' => 'operator create',
        'edit' => 'operator edit',
        'delete' => 'operator delete',
    ];

    protected array $modals = [
        'create' => 'operator-form-modal',
        'edit' => 'operator-form-modal',
    ];

    protected array $export = [
        'pdf' => 'exportPDF',
        'xlsx' => 'exportXLSX',
    ];

    public function render()
    {
        return view('operator.operator-table', $this->getData());
    }

    #[Computed]
    public function rows()
    {
        return HasilInputOperator::search($this->search)
            // ->orderBy($this->sort_by, $this->sort_direction)
            ->paginate($this->perPage);
    }

    public function cols()
    {
        return [
            [
                "label" => "LB Black",
                "query" => "lb_black",
                "sort" => true,
            ],
            [
                "label" => "BAT",
                "query" => "bat",
                "sort" => true,
            ],
            [
                "label" => "PEM",
                "query" => "pem",
                "sort" => true,
            ],
            [
                "label" => "Operator Name",
                "query" => "user.name",
                "sort" => true,
            ],
            [
                "label" => "Created At",
                "query" => "schedule.date",
                "sort" => true,
            ],

        ];
    }

    public function delete($id)
    {
        parent::delete($id);
        HasilInputOperator::destroy($id);
        $this->toast(
            message: "Role Removed",
        );
    }

    public function exportXLSX()
    {
        return FacadesExcel::download(
            new OperatorExport(),
            "download.xlsx",
            Excel::XLSX
        );
    }

    public function exportPDF()
    {
        return FacadesExcel::download(
            new OperatorExport(),
            "download.pdf",
            Excel::DOMPDF
        );
    }
}
