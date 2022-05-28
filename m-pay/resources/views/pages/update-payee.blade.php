<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Payee') }}
        </h2>
    </x-slot>

<x-add-payee-card>

        <!-- Validation Errors -->
        <x-payee-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('update-payee') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$payee->name" required autofocus />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full"
                                type="text"
                                placeholder="254XXXXXXXXX"
                                name="phone" :value="$payee->phone"
                                required autofocus />
            </div>
            <input type="hidden" name='id' value={{$payee->id}} />
            <div class="grid grid grid-cols-2">
                <div class="flex items-center justify-center mt-4 mb-5">
                    <x-button class="ml-3">
                        {{ __('Update') }}
                    </x-button>
                </div>
                <div class="flex items-center justify-center mt-4 mb-5">
                    <x-cancell-button class="ml-3" onclick="window.location='{{ route('payees') }}'">
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            <div>
        </form>
    </x-add-payee-card>
</x-app-layout>