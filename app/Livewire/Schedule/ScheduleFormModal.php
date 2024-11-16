<?php

namespace App\Livewire\Schedule;

use App\Livewire\Forms\ScheduleForm;
use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use App\Models\Permission;
use App\Models\Schedule;
use Livewire\Attributes\Computed;

class ScheduleFormModal extends BaseModal
{
    use Notification;

    public ScheduleForm $form;

    /*
     * normal modal title
     * @var string
     */
    protected static $title = "Add New Schedule";

    /*
     * load modal title
     * @var string
     */
    protected static $load_title = "Update Schedule";

    /*
     * save or load permission
     * @var string|bool
     */
    protected $permission = [
        'load' => 'schedule edit',
        'save' => 'schedule create'
    ];

    public function mount()
    {
        $this->clear();
    }
    public function render()
    {
        return view('schedule.schedule-form-modal');
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
            $this->dispatch('schedule-table:reload');
            $this->toast(
                message: "Success",
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
