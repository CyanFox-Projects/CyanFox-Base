<?php

namespace App\Livewire\Components\Modals;

use App\Livewire\CFModalComponent;
use Livewire\Attributes\Locked;
use Modules\Auth\Traits\WithPasswordConfirmation;

class Confirmation extends CFModalComponent
{
    use WithPasswordConfirmation;

    #[Locked]
    public $title;

    #[Locked]
    public $description;

    #[Locked]
    public $cancel;

    #[Locked]
    public $cancelColor;

    #[Locked]
    public $confirm;

    #[Locked]
    public $confirmColor;

    #[Locked]
    public $icon;

    #[Locked]
    public $iconColor;

    #[Locked]
    public $needsPasswordConfirmation;

    #[Locked]
    public $event;

    public function confirmAction()
    {
        if ($this->needsPasswordConfirmation && ! $this->hasPasswordConfirmedSession()) {
            return;
        }

        $this->dispatch('internal.confirmation.confirmed', $this->event);

        $this->dispatch('closeModal');
    }

    public function mount()
    {
        if ($this->needsPasswordConfirmation && ! $this->checkPasswordConfirmation()->passwordMethod('render')->checkPassword()) {
            return;
        }
    }

    public function render()
    {
        return view('livewire.components.modals.confirmation');
    }
}
