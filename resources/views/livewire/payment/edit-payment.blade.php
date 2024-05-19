<div>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <x-wire-errors only="appointment" />

                <form wire:submit.prevent="update">
                    <div class="grid grid-cols-12 mb-3">
                        <div class="col-span-12">
                            <p class="font-semibold">Appointment Information</p>
                            <div class="mt-2">
                                <p class="py-1 text-gray-600">Patient: {{ $payment->appointment->patient->name }}</p>
                                <p class="py-1 text-gray-600">Clinic: {{ $payment->appointment->clinic->name }}</p>
                                <p class="py-1 text-gray-600">Schedule: {{ $payment->appointment->schedule }}</p>
                                <p class="py-1 text-gray-600">Complaint: {{ $payment->appointment->complaint }}</p>
                                <p class="py-1 text-gray-600">Status: {{ $payment->appointment->status }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-select label="Payment Method" wire:model="form.method"
                                placeholder="Select payment method" :options="$paymentMethods" option-label="name"
                                option-value="value" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-input label="Card Number" placeholder="Card Number" wire:model="form.card_number" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-input label="Amount" placeholder="Amount" wire:model="form.amount" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-input label="Note" placeholder="Note" wire:model="form.note" />
                        </div>

                    </div>

                    <div class="flex justify-end mt-4">
                        <x-wire-button icon="save" primary label="Save" type="submit" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
