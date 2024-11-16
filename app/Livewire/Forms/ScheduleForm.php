<?php

namespace App\Livewire\Forms;

use App\Models\Schedule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ScheduleForm extends Form
{
    #[Locked]
    public $id;

    #[Validate]
    public $user_id;

    #[Validate]
    public $shift_id;

    #[Validate]
    public $date;

    public function rules()
    {
        return [
            'user_id' => ['required'],
            'shift_id' => ['required'],
            'date' => ['required'],
        ];
    }

    public function load(int $id)
    {
        $schedule = Schedule::find($id);

        $this->id = $schedule->id;
        $this->user_id = $schedule->user_id;
        $this->shift_id = $schedule->shift_id;
        $this->date = $schedule->date;
    }

    public function clear()
    {
        $this->id = 0;
        $this->user_id = 0;
        $this->shift_id = 0;
        $this->date = null;
    }

    public function post()
    {
        $this->validate();

        return Schedule::updateOrCreate(['id' => $this->id], [
            "user_id" => $this->user_id,
            "shift_id" => $this->shift_id,
            "date" => $this->date
        ]);
    }
}
