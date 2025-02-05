<?php

namespace App\Livewire;

use Exception;
use LivewireUI\Modal\ModalComponent;

class CFModalComponent extends ModalComponent
{
    public function log($message, $level = 'info')
    {
        if ($message instanceof Exception) {
            $message = $message->getMessage();
        }
        $this->dispatch('logger', ['type' => $level, 'message' => $message]);
    }
}
