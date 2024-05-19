<div>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <form wire:submit.prevent="update">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-select label="Patient" wire:model="patient_id" placeholder="Select patient"
                                :async-data="route('api.patient.index')" option-label="name" option-value="id" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-select label="Clinic" wire:model="clinic_id" placeholder="Select clinic"
                                :async-data="route('api.clinic.index')" option-label="name" option-value="id" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-datetime-picker label="Schedule" placeholder="Schedule" wire:model="schedule" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-input label="Complaint" placeholder="Complaint" wire:model="complaint" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-wire-select label="Status" wire:model="status" placeholder="Select status"
                                :options="$appointmentStatuses" option-label="name" option-value="value" />
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
