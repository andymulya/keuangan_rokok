<?php

namespace App\Livewire\Forms;

use App\Models\Shift;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ShiftForm extends Form
{
    #[Locked]
    public $id;

    #[Validate]
    public $nama_shift;

    #[Validate]
    public $start;

    #[Validate]
    public $end;

    public function rules()
    {
        return [
            'nama_shift' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
        ];
    }

    public function load(int $id)
    {
        $shift = Shift::find($id);

        $this->id = $shift->id;
        $this->nama_shift = $shift->nama_shift;
        $this->start = $shift->start;
        $this->end = $shift->end;
    }

    public function clear()
    {
        $this->id = 0;
        $this->nama_shift = "";
        $this->start = null;
        $this->end = null;
    }

    public function post()
    {
        $this->validate();
        return Shift::updateOrCreate(['id' => $this->id], [
            "nama_shift" => $this->nama_shift,
            "start" => $this->start,
            "end" => $this->end
        ]);
    }
}
