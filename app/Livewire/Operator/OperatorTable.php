<?php

namespace App\Livewire\Operator;

use App\Livewire\Module\BaseTable;
use App\Livewire\Module\Trait\Notification;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use App\Models\HasilInputOperator;

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

    public function render()
    {
        return view('operator.operator-table', $this->getData());
    }

    #[Computed]
    public function rows()
    {
        return HasilInputOperator::search($this->search)
            ->orderBy($this->sort_by, $this->sort_direction)
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
}
