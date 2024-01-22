<?php

namespace App\Livewire\Components\Tables\Account;

use Laravel\Sanctum\PersonalAccessToken;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class APIKeysTable extends DataTableComponent
{
    protected $model = PersonalAccessToken::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setConfigurableAreas([
            'toolbar-left-start' => 'components.tables.account.create-api-key'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::make(__('messages.table.id'), "id")
                ->sortable()
                ->searchable(),
            Column::make(__('pages/account/profile.api_keys.table.name'), "name")
                ->sortable()
                ->searchable(),
            Column::make(__('pages/account/profile.api_keys.table.api_key'), 'token')
                ->searchable(),
            Column::make(__('pages/account/profile.api_keys.table.last_used_at'), 'last_used_at')
                ->sortable(),
            Column::make(__('messages.table.created_at'), 'created_at')
                ->sortable(),
            Column::make(__('messages.table.updated_at'), 'updated_at')
                ->sortable(),
            Column::make(__('messages.table.actions'))
                ->label(fn($row) => '<i wire:click="$dispatch(`openModal`, { component: `components.modals.account.a-p-i-keys.delete-a-p-i-key`,
                        arguments: { apiKeyId: `' . $row->id . '` } })" class="icon-trash font-semibold text-lg text-red-600 cursor-pointer"></i>'
                )
                ->html(),
        ];
    }
}
