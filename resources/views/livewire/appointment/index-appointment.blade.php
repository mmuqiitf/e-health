<div>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Appointment') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-end">
                    <x-wire-button :href="route('appointment.create')" wire:navigate icon="plus-circle" primary label="Add" />
                </div>
                <livewire:appointment-table />
            </div>
        </div>
    </div>
</div>
