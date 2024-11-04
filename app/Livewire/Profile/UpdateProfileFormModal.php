<?php

namespace App\Livewire\Profile;

use App\Livewire\Module\BaseModal;
use App\Livewire\Module\Trait\Notification;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

class UpdateProfileFormModal extends BaseModal
{
    use Notification;

    #[Validate('required')]
    public $profile = [];

    /*
     * normal modal title
     * @var string
     */
    protected static $title = "Update Profile";

    /*
     * load modal title
     * @var string
     */
    protected static $load_title = "Update Profile";

    /*
     * save or load permission
     * @var string|bool
     */
    protected $permission = [
        'load' => true,
        'save' => true
    ];

    public function mount()
    {
        $this->clear();
    }

    public function render()
    {
        return view("livewire.profile.update-profile-form-modal");
    }

    #[Computed]
    public function information()
    {
        return auth()->user()->profile_information;
    }

    public function load($id)
    {
        parent::load($id);
        $this->profile = $this->information->pluck('value', 'id');
    }

    public function save()
    {
        parent::save();
        foreach($this->profile as $key => $val) {
            auth()->user()->profile()->detach($key);
            auth()->user()->profile()->attach($key, ['value' => $val]);
        }
        $this->dispatch('close-modal', name: $this->modal_name);
        $this->dispatch('profile:update');
        $this->toast(
            message: 'Profile Updated',
            type: 'success'
        );
    }

    public function clear()
    {
        parent::clear();
    }
}
