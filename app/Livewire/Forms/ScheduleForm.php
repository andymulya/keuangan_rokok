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
    public $shift;

    #[Validate]
    public $date;

    #[Validate]
    public $absen;

    public function rules()
    {
        return [
            'user_id' => ['required'],
            'shift' => ['required'],
            'date' => ['required'],
            'absen' => ['required'],
        ];
    }

    public function load(int $id)
    {
        $item = Schedule::find($id);

        $this->id = $item->id;
        $this->user_id = $item->user_id;
        $this->shift = $item->schedule_id;
        $this->date = $item->lb_black;
        $this->absen = $item->bat;
    }

    public function clear()
    {
        $this->id = 0;
        $this->user_id = 0;
        $this->shift = "";
        $this->date = null;
        $this->absen = false;
    }

    public static function getScheduleDateNowUser()
    {
        foreach (Schedule::getScheduleDateNow() as $scheduleNow) {

            if($scheduleNow->user->id == auth()->id()) return $scheduleNow;
        }
    }

    public function post()
    {
        $this->validate();

        return Schedule::updateOrCreate(['id' => $this->id], [
            "user_id" => auth()->id(),
            "shift" => $this->shift,
            "date" => $this->date,
            "absen" => $this->absen
        ]);
    }
}
