<?php

namespace App\Livewire\Shift;

use App\Livewire\Module\BaseTable;
use App\Livewire\Module\Trait\Notification;
use App\Models\Shift;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

class ShiftTable extends BaseTable
{
    use Notification;

    #[Locked]
    public $title = "Shift Table";

    protected array $permissions = [
        'create' => 'shift create',
        'edit' => 'shift edit',
        'delete' => 'shift delete',
    ];

    protected array $modals = [
        'create' => 'shift-form-modal',
        'edit' => 'shift-form-modal',
    ];

    public function render()
    {
        return view('shift.shift-table', $this->getData());
    }

    #[Computed]
    public function rows()
    {
        return Shift::search($this->search)
            ->orderBy($this->sort_by, $this->sort_direction)
            ->paginate($this->perPage);
    }

    public function cols()
    {
        return [
            [
                "label" => "Nama Shift",
                "query" => "nama_shift",
                "sort" => true,
            ],
            [
                "label" => "Start",
                "query" => "start",
                "sort" => true,
            ],
            [
                "label" => "End",
                "query" => "end",
                "sort" => true,
            ],
        ];
    }

    public function delete($id)
    {
        parent::delete($id);
        Shift::destroy($id);
        $this->toast(
            message: "Shift Removed",
        );
    }
}
