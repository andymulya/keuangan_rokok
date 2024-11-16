<?php

namespace App\Livewire\Shift;

use App\Livewire\Forms\ShiftForm;
use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use App\Models\Permission;
use App\Models\Schedule;
use Livewire\Attributes\Computed;

class ShiftFormModal extends BaseModal
{
    use Notification;

    public ShiftForm $form;

    /*
     * normal modal title
     * @var string
     */
    protected static $title = "Add New Shift";

    /*
     * load modal title
     * @var string
     */
    protected static $load_title = "Update Shift";

    /*
     * save or load permission
     * @var string|bool
     */
    protected $permission = [
        'load' => 'shift edit',
        'save' => 'shift create'
    ];

    public function mount()
    {
        $this->clear();
    }

    public function render()
    {
        return view('shift.shift-form-modal');
    }

    #[Computed(persist: true)]
    public function permissions()
    {
        return Permission::all();
    }

    public function load($id)
    {
        parent::load($id);
        $this->form->load($id);
    }


    public function save()
    {
        parent::save();
        if($this->form->post()) {
            $this->dispatch('close-modal', name: $this->modal_name);
            $this->dispatch('shift-table:reload');
            $this->toast(
                message: $this->form->id == 0 ? 'Shift Created' : 'Shift Updated',
                type: 'success'
            );
        }
    }

    public function clear()
    {
        parent::clear();
        $this->form->clear();
    }
}
