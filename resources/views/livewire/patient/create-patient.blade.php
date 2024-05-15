<div>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Patient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <form wire:submit.prevent="store">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <x-input label="NIK" placeholder="NIK" wire:model="nik" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input label="Medical Record ID" placeholder="Medical Record ID"
                                wire:model="medical_record_id" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input label="Name" placeholder="Name" wire:model="name" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input label="Email" placeholder="Email" wire:model="email" />
                            <x-input-error for="email" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-inputs.phone label="Phone" mask="['(##) ####-####', '(##) #####-####']"
                                wire:model="phone" />
                            <x-input-error for="phone" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input label="Address" wire:model="address" />
                            <x-input-error for="address" class="mt-2" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-input label="Birth Place" wire:model="birth_place" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-datetime-picker :without-time="true" label="Birth Day" placeholder="Birth Day"
                                wire:model="birthday" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-native-select label="Religion" placeholder="Select one" :options="$religions"
                                wire:model="religion" />
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <x-native-select label="Gender" placeholder="Select one" :options="['Male', 'Female']"
                                wire:model="gender" />
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-button icon="save" primary label="Save" type="submit" />
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
