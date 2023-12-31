<?php

namespace App\Livewire\Components\Modals\Account;

use Filament\Notifications\Notification;
use LivewireUI\Modal\ModalComponent;

class RevokeApiKey extends ModalComponent
{

    public $apiKey;

    public function revokeApiKey()
    {
        auth()->user()->tokens()->where('id', $this->apiKey)->delete();

        Notification::make()
            ->title(__('pages/account/messages.notifications.api_key_revoked'))
            ->success()
            ->send();

        activity('system')
            ->performedOn(auth()->user())
            ->causedBy(auth()->user())
            ->withProperty('name', auth()->user()->username . ' (' . auth()->user()->email . ')')
            ->withProperty('ip', request()->ip())
            ->log('account.api_key_revoked');

        return redirect()->route('profile', ['tab' => 'api_keys']);
    }

    public function render()
    {
        return view('livewire.components.modals.account.revoke-api-key');
    }
}
