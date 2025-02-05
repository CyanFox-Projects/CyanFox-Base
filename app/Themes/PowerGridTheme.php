<?php

namespace App\Themes;

use PowerComponents\LivewirePowerGrid\Themes\Tailwind;

class PowerGridTheme extends Tailwind
{
    public string $name = 'tailwind';

    public function table(): array
    {
        return [
            'layout' => [
                'base' => 'p-3 align-middle inline-block min-w-full w-full sm:px-6 lg:px-8',
                'div' => 'rounded-t-lg relative border-x border-t border-neutral-300 dark:bg-neutral-900 dark:border-neutral-700',
                'table' => 'min-w-full dark:bg-neutral-800!',
                'container' => 'overflow-x-auto',
                'actions' => 'flex gap-2',
            ],

            'header' => [
                'thead' => 'shadow-xs rounded-t-lg bg-neutral-50 dark:bg-neutral-900',
                'tr' => '',
                'th' => 'font-extrabold px-3 py-3 text-left text-xs text-neutral-900 tracking-wider whitespace-nowrap dark:text-white',
                'thAction' => 'font-bold!',
            ],

            'body' => [
                'tbody' => 'text-neutral-900 dark:text-neutral-300',
                'tbodyEmpty' => '',
                'tr' => 'border-b border-neutral-300 dark:border-neutral-700 hover:bg-neutral-50 dark:bg-neutral-800 dark:hover:bg-neutral-700',
                'td' => 'px-3 py-2 whitespace-nowrap dark:text-neutral-200',
                'tdEmpty' => 'p-2 whitespace-nowrap dark:text-neutral-200',
                'tdSummarize' => 'p-2 whitespace-nowrap dark:text-neutral-200 text-sm text-neutral-600 text-right space-y-2',
                'trSummarize' => '',
                'tdFilters' => '',
                'trFilters' => '',
                'tdActionsContainer' => 'flex gap-1',
            ],
        ];
    }

    public function footer(): array
    {
        return [
            'view' => $this->root().'.footer',
            'select' => 'appearance-none bg-none! focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 rounded-md border-0 bg-transparent py-1.5 px-4 pr-7 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-auto',
            'footer' => 'border-x border-b rounded-b-lg border-b border-neutral-300 dark:bg-neutral-900 dark:border-neutral-700',
            'footer_with_pagination' => 'md:flex md:flex-row w-full items-center py-3 bg-white overflow-y-auto pl-2 pr-2 relative dark:bg-neutral-900',
        ];
    }

    public function cols(): array
    {
        return [
            'div' => 'select-none flex items-center gap-1',
        ];
    }

    public function editable(): array
    {
        return [
            'view' => $this->root().'.editable',
            'input' => 'focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 w-full rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-full',
        ];
    }

    public function toggleable(): array
    {
        return [
            'view' => $this->root().'.toggleable',
        ];
    }

    public function checkbox(): array
    {
        return [
            'th' => 'px-6 py-3 text-left text-xs font-medium text-neutral-900 tracking-wider',
            'base' => '',
            'label' => 'flex items-center space-x-3',
            'input' => 'form-checkbox dark:border-neutral-700 border-1 dark:bg-neutral-800 rounded-sm border-gray-300 bg-white transition duration-100 ease-in-out h-4 w-4 focus:ring-white dark:ring-offset-neutral-900',
        ];
    }

    public function radio(): array
    {
        return [
            'th' => 'px-6 py-3 text-left text-xs font-medium text-neutral-900 tracking-wider',
            'base' => '',
            'label' => 'flex items-center space-x-3',
            'input' => 'form-radio rounded-full transition ease-in-out duration-100',
        ];
    }

    public function filterBoolean(): array
    {
        return [
            'view' => $this->root().'.filters.boolean',
            'base' => 'min-w-[5rem]',
            'select' => 'appearance-none bg-none! focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 w-full rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-full',
        ];
    }

    public function filterDatePicker(): array
    {
        return [
            'base' => '',
            'view' => $this->root().'.filters.date-picker',
            'input' => 'flatpickr flatpickr-input focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 w-full rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-auto',
        ];
    }

    public function filterMultiSelect(): array
    {
        return [
            'view' => $this->root().'.filters.multi-select',
            'base' => 'inline-block relative w-full',
            'select' => 'mt-1',
        ];
    }

    public function filterNumber(): array
    {
        return [
            'view' => $this->root().'.filters.number',
            'input' => 'w-full min-w-[5rem] block focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 rounded-md border-0 bg-transparent py-1.5 pl-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6',
        ];
    }

    public function filterSelect(): array
    {
        return [
            'view' => $this->root().'.filters.select',
            'base' => '',
            'select' => 'appearance-none bg-none! focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-full',
        ];
    }

    public function filterInputText(): array
    {
        return [
            'view' => $this->root().'.filters.input-text',
            'base' => 'min-w-[9.5rem]',
            'select' => 'appearance-none bg-none! focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 w-full rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-full',
            'input' => 'focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 w-full rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-full',
        ];
    }

    public function searchBox(): array
    {
        return [
            'input' => 'focus:ring-white focus-within:focus:ring-white focus-within:ring-white dark:focus-within:ring-white flex items-center rounded-md ring-1 transition focus-within:ring-2 dark:ring-neutral-700 dark:text-neutral-300 text-gray-600 ring-gray-300 dark:bg-neutral-800 bg-white dark:placeholder-neutral-400 w-full rounded-md border-0 bg-transparent py-1.5 px-2 ring-0 placeholder:text-gray-400 focus:outline-hidden sm:text-sm sm:leading-6 w-full pl-8',
            'iconClose' => 'text-neutral-400 dark:text-neutral-200',
            'iconSearch' => 'text-neutral-300 mr-2 w-5 h-5 dark:text-neutral-200',
        ];
    }
}
