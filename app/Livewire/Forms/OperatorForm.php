<?php

namespace App\Livewire\Forms;

use App\Models\HasilInputOperator;
use App\Models\Schedule;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class OperatorForm extends Form
{
    #[Locked]
    public $id;

    #[Validate]
    public $user_id;

    #[Validate]
    public $schedule_id;

    #[Validate]
    public $lb_black;

    #[Validate]
    public $bat;


    #[Validate]
    public $pem;


    public function rules()
    {
        return [
            'user_id' => ['required'],
            'schedule_id' => ['required'],
            'lb_black' => ['required'],
            'bat' => ['required'],
            'pem' => ['required'],
        ];
    }

    public function load(int $id)
    {
        $item = HasilInputOperator::find($id);

        $this->id = $item->id;
        $this->user_id = $item->user_id;
        $this->schedule_id = $item->schedule_id;
        $this->lb_black = $item->lb_black;
        $this->bat = $item->bat;
        $this->pem = $item->pem;
    }

    public function clear()
    {
        $this->id = 0;
        $this->user_id = 0;
        $this->schedule_id = 0;
        $this->lb_black = 0.00;
        $this->bat = 0.00;
        $this->pem = "";
    }

    public function post()
    {
        $this->validate();
        $item = HasilInputOperator::find($this->id);

        return HasilInputOperator::updateOrCreate(['id' => $this->id], [
            "user_id" => ($this->id != 0) ? $item->user_id : auth()->id() ,
            "schedule_id" => ($this->id != 0) ? $item->schedule_id : Schedule::getScheduleDateNowUser()->id,
            "lb_black" => $this->lb_black,
            "bat" => $this->bat,
            "pem" => $this->pem
        ]);
    }
}
