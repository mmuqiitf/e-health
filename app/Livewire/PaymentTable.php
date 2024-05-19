<?php

namespace App\Livewire;

use App\Enum\AppointmentStatusEnum;
use App\Enum\PaymentMethodEnum;
use App\Enum\PaymentStatusEnum;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class PaymentTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Payment::query()->with(['appointment' => ['clinic', 'patient']]);
    }

    public function relationSearch(): array
    {
        return [
            'appointment' => ['schedule', 'clinic' => ['name'], 'patient' => ['name']],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('appointment_id')
            ->add('appointment.clinic.name')
            ->add('appointment.patient.name')
            ->add('appointment.schedule')
            ->add('amount')
            ->add('status')
            ->add('method')
            ->add('card_number')
            ->add('note')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('Schedule', 'appointment.schedule', 'appointment.schedule')
                ->searchable(),

            Column::make('Patient', 'appointment.patient.name', 'appointment.patient.name')
                ->searchable(),

            Column::make('Clinic', 'appointment.clinic.name', 'appointment.clinic.name')
                ->searchable(),

            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Method', 'method')
                ->sortable()
                ->searchable(),

            Column::make('Card number', 'card_number')
                ->sortable()
                ->searchable(),

            Column::make('Note', 'note')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datetimepicker('appointment.schedule')->filterRelation('appointment', 'schedule'),
            Filter::enumSelect('status')->dataSource(PaymentStatusEnum::cases())->optionLabel('name')->optionValue('value'),
            Filter::enumSelect('method')->dataSource(PaymentMethodEnum::cases())->optionLabel('name')->optionValue('value'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->redirect("/payment/{$rowId}/edit", true);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $payment = Payment::with(['appointment'])->find($rowId);

        $payment->appointment->update([
            'status' => AppointmentStatusEnum::Approved->value,
        ]);

        $payment->delete();
    }

    public function actions(Payment $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('Delete')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('delete', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
