<?php

namespace App\Livewire\RekapMaterial;


use App\Livewire\Forms\RekapMaterialForm;
use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use App\Models\Permission;
use Livewire\Attributes\Computed;

class RekapMaterialFormModal extends BaseModal
{
    use Notification;

    public RekapMaterialForm $form;

    /*
     * normal modal title
     * @var string
     */
    protected static $title = "Add New Rekap Material";

    /*
     * load modal title
     * @var string
     */
    protected static $load_title = "Update Rekap Material";

    /*
     * save or load permission
     * @var string|bool
     */
    protected $permission = [
        'load' => 'rekap-material edit',
        'save' => 'rekap-material create'
    ];

    public function mount()
    {
        $this->clear();
    }

    public function render()
    {
        return view('rekap-material.rekap-material-form-modal');
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
            $this->dispatch('rekap-material-table:reload');
            $this->toast(
                message: $this->form->id == 0 ? 'Rekap Material Created' : 'Rekap Material Updated',
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
