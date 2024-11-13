<?php

namespace App\Livewire\Operator;

use App\Livewire\Forms\OperatorForm;
use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use App\Models\Permission;
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
        return view('livewire.operator.operator-form-modal');
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
            $this->dispatch('operator-table:reload');
            $this->toast(
                message: $this->form->id == 0 ? 'Item Created' : 'Item Updated',
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
