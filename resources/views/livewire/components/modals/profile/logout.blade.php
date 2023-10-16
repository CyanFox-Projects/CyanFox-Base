<x-modal id="logout" class="modal-bottom sm:modal-middle">
    <div class="text-center">
        <h2 class="text-2xl font-bold mb-4">{{ __('pages/profile.modal.logout.title') }}</h2>
        <p class="mb-3">{{ __('pages/profile.modal.logout.description') }}</p>
    </div>
    <div class="flex justify-center modal-action">
        <form method="dialog">
            <button class="btn btn-neutral">{{ __('messages.cancel') }}</button>
            <a href="{{ route('logout') }}" role="button"
               class="btn btn-success">{{ __('pages/profile.modal.logout.logout') }}</a>
        </form>
    </div>
</x-modal>

