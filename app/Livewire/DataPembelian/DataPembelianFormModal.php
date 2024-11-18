<?php

namespace App\Livewire\DataPembelian;

use App\Livewire\Forms\DataPembelianForm;
use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use App\Models\Permission;
use App\Models\DataPembelianBarang;
use Livewire\Attributes\Computed;

class DataPembelianFormModal extends BaseModal
{
    use Notification;

    public DataPembelianForm $form;

    /*
     * normal modal title
     * @var string
     */
    protected static $title = "Add New Data Pembelian Material";

    /*
     * load modal title
     * @var string
     */
    protected static $load_title = "Update Data Pembelian Material";

    /*
     * save or load permission
     * @var string|bool
     */
    protected $permission = [
        'load' => 'data-pembelian edit',
        'save' => 'data-pembelian create'
    ];

    public function mount()
    {
        $this->clear();
    }

    public function render()
    {
        return view('data-pembelian.data-pembelian-form-modal');
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
        $data = DataPembelianBarang::getDataPembelian($this->form->date, $this->form->tipe_pembelian);

        if(!$data){
            parent::save();
            if($this->form->post()) {
                $this->dispatch('close-modal', name: $this->modal_name);
                $this->dispatch('data-pembelian-table:reload');
                return $this->toast(
                    message: $this->form->id == 0 ? 'Data Pembelian Material Created' : 'Data Pembelian Material Updated',
                    type: 'success'
                );
            }
        }

        return $this->toast(
            message: "Maaf data yang anda masukkan telah tersedia",
            type: 'error'
        );
    }

    public function clear()
    {
        parent::clear();
        $this->form->clear();
    }
}
