<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Payee') }}
        </h2>
    </x-slot>

<x-add-payee-card>

        <!-- Validation Errors -->
        <x-payee-validation-errors class="mb-4" :errors="$errors" />
        
        <!--success message -->
        <x-add-payee-success class="mb-4" :payee="$payee ?? '' " />

        <form method="POST" action="{{ route('add-payee') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Phone Number -->
            <div class="mt-4">
                <x-label for="phone" :value="__('Phone')" />

                <x-input id="phone" class="block mt-1 w-full"
                                type="text"
                                placeholder="254XXXXXXXXX"
                                name="phone" :value="old('phone')"
                                required autofocus />
            </div>
            <div class="flex items-center justify-center mt-4 mb-5">
                <x-button class="ml-3">
                    {{ __('Add') }}
                </x-button>
            </div>
        </form>
    </x-add-payee-card>
</x-app-layout>