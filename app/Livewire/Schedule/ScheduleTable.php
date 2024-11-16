<?php

namespace App\Livewire\Schedule;

use App\Livewire\Module\BaseTable;
use App\Livewire\Module\Trait\Notification;
use App\Models\Schedule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;

class ScheduleTable extends BaseTable
{
    use Notification;

    #[Locked]
    public $title = "Schedule Table";

    protected array $permissions = [
        'create' => 'schedule create',
        'edit' => 'schedule edit',
        'delete' => 'schedule delete',
    ];

    protected array $modals = [
        'create' => 'schedule-form-modal',
        'edit' => 'schedule-form-modal',
    ];

    public function render()
    {
        return view('schedule.schedule-table', $this->getData());
    }

    #[Computed]
    public function rows()
    {
        return Schedule::search($this->search)
            ->orderBy($this->sort_by, $this->sort_direction)
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
        ];
    }

    public function delete($id)
    {
        parent::delete($id);
        Schedule::destroy($id);
        $this->toast(
            message: "Schedule Removed",
        );
    }
}
