<?php

namespace App\Traits;

use Livewire\Attributes\On;

trait WithConfirmation
{
    private $confirmationData = [];

    public function dialog(): static
    {
        $this->confirmationData = [];

        return $this;
    }

    public function question(string $title, string $description): static
    {
        $this->confirmationData['title'] = $title;
        $this->confirmationData['description'] = $description;

        return $this;
    }

    public function cancel($text, $color = 'primary')
    {
        $this->confirmationData['cancel'] = $text;
        $this->confirmationData['cancelColor'] = $color;

        return $this;
    }

    public function confirm($text, $color = 'success')
    {
        $this->confirmationData['confirm'] = $text;
        $this->confirmationData['confirmColor'] = $color;

        return $this;
    }

    public function icon($icon, $color = 'yellow-400')
    {
        $this->confirmationData['icon'] = $icon;
        $this->confirmationData['iconColor'] = $color;

        return $this;
    }

    public function needsPasswordConfirmation()
    {
        $this->confirmationData['needsPasswordConfirmation'] = true;

        return $this;
    }

    public function method(string $callable, ...$args): static
    {
        $this->confirmationData['event'] = $callable.'('.implode(', ', $args).')';

        return $this;
    }

    public function send(): void
    {
        $this->dispatch('openModal', 'components.modals.confirmation', [
            'title' => $this->confirmationData['title'],
            'description' => $this->confirmationData['description'],
            'cancel' => $this->confirmationData['cancel'] ?? __('messages.buttons.cancel'),
            'cancelColor' => $this->confirmationData['cancelColor'] ?? 'primary',
            'confirm' => $this->confirmationData['confirm'] ?? __('messages.buttons.confirm'),
            'confirmColor' => $this->confirmationData['confirmColor'] ?? 'success',
            'icon' => $this->confirmationData['icon'] ?? 'icon-info',
            'iconColor' => $this->confirmationData['iconColor'],
            'needsPasswordConfirmation' => $this->confirmationData['needsPasswordConfirmation'] ?? false,
            'event' => $this->confirmationData['event'],
        ]);
    }

    #[On('internal.confirmation.confirmed')]
    public function handleConfirmation($event): void
    {
        if (preg_match('/^(\w+)\((.*)\)$/', $event, $matches)) {
            $methodName = $matches[1];
            $arguments = array_map('trim', explode(',', $matches[2]));
            call_user_func_array([$this, $methodName], $arguments);
        }
    }
}
