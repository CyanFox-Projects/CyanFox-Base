@props([
    'label' => null,
    'hint' => null,
    'showRequired' => true,
    'showValidation' => true,
])

<div>
    <div class="flex w-full max-w-md flex-col gap-1 text-neutral-600 dark:text-neutral-300"
         x-data="{ uuid: Math.random().toString(20).substring(2, 20) }">
        @if($label)
            <label x-bind:for="uuid" class="w-fit pl-0.5 text-sm">
                {{ $label }}

                @if($attributes->get('required') && $showRequired)
                    <span class="text-red-600">*</span>
                @endif
            </label>
        @endif
        <textarea x-bind:id="uuid"
              {{ $attributes->twMerge('w-full rounded-md bg-neutral-50 px-2.5 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-neutral-900/50 dark:focus-visible:outline-white') }}>
        {{ $slot }}
    </textarea>
    </div>

    @if($hint)
        <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $hint }}</p>
    @endif

    @if($attributes->whereStartsWith('wire:model')->first() && $errors->has($attributes->whereStartsWith('wire:model')->first()) && $showValidation)
        <div
            class="text-red-600 text-sm">{{ $errors->first($attributes->whereStartsWith('wire:model')->first()) }}</div>
    @endif
</div>
