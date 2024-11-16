<?php

namespace App\Livewire\Operator;

use App\Livewire\Forms\OperatorForm;
use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use App\Models\Permission;
use App\Models\Schedule;
use App\Models\Role;
use Livewire\Attributes\Computed;

class OperatorFormModal extends BaseModal
{
    use Notification;

    public OperatorForm $form;

    /*
     * normal modal title
     * @var string
     */
    protected static $title = "Add New Item";

    /*
     * load modal title
     * @var string
     */
    protected static $load_title = "Update Item";

    /*
     * save or load permission
     * @var string|bool
     */
    protected $permission = [
        'load' => 'operator edit',
        'save' => 'operator create'
    ];

    public function mount()
    {
        $this->clear();
    }

    public function render()
    {
        return view('operator.operator-form-modal');
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
        if(auth()->user()->roles->first()->name == Role::ADMIN && $this->form->id != 0){
            parent::save();
            if($this->form->post()) {
                $this->dispatch('close-modal', name: $this->modal_name);
                $this->dispatch('operator-table:reload');
                return $this->toast(
                    message: $this->form->id == 0 ? 'Item Created' : 'Item Updated',
                    type: 'success'
                );
            }
        }

        if(Schedule::getScheduleDateNowUser() && auth()->user()->roles->first()->name == Role::OPERATOR){
            parent::save();
            if($this->form->post()) {
                $this->dispatch('close-modal', name: $this->modal_name);
                $this->dispatch('operator-table:reload');
                return $this->toast(
                    message: $this->form->id == 0 ? 'Item Created' : 'Item Updated',
                    type: 'success'
                );
            }
        }

        return $this->toast(
            message: "Shift anda belum saat ini",
            type: 'error'
        );
    }

    public function clear()
    {
        parent::clear();
        $this->form->clear();
    }
}
