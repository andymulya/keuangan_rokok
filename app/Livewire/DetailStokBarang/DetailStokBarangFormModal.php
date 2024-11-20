<?php

namespace App\Livewire\DetailStokBarang;

use App\Livewire\Forms\DetailStokBarangForm;
use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use App\Models\Permission;
use App\Models\DataPembelianBarang;
use Livewire\Attributes\Computed;

class DetailStokBarangFormModal extends BaseModal
{
    use Notification;

    public DetailStokBarangForm $form;

    /*
     * normal modal title
     * @var string
     */
    protected static $title = "Add New Detail Stok Barang";

    /*
     * load modal title
     * @var string
     */
    protected static $load_title = "Update Detail Stok Barang";

    /*
     * save or load permission
     * @var string|bool
     */
    protected $permission = [
        'load' => 'detail-stok edit',
        'save' => 'detail-stok create'
    ];

    public function mount()
    {
        $this->clear();
    }

    public function render()
    {
        return view('detail-stok-barang.detail-stok-barang-form-modal');
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
            $this->dispatch('detail-stok-barang-table:reload');
            return $this->toast(
                message: $this->form->id == 0 ? 'Detail Stok Barang Created' : 'Detail Stok Barang Updated',
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
