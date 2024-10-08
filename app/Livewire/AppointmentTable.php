<?php

namespace App\Livewire;

use App\Enum\AppointmentStatusEnum;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class AppointmentTable extends PowerGridComponent
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
        return Appointment::query()->with(['patient', 'clinic', 'payment'])->latest();
    }

    public function relationSearch(): array
    {
        return [
            'patient' => ['name'],
            'clinic' => ['name'],
        ];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('patient_id')
            ->add('patient.name')
            ->add('clinic_id')
            ->add('clinic.name')
            ->add('schedule_formatted', fn (Appointment $model) => Carbon::parse($model->schedule)->format('d/m/Y H:i:s'))
            ->add('complaint')
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Patient', 'patient.name', 'patient.name')
                ->searchable(),
            Column::make('Clinic', 'clinic.name', 'clinic.name')
                ->searchable(),

            Column::make('Schedule', 'schedule_formatted', 'schedule')
                ->sortable(),

            Column::make('Status', 'status')
                ->sortable()
                ->searchable(),

            Column::make('Complaint', 'complaint')
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
            Filter::multiSelectAsync('patient.name', 'patient_id')
                ->url(route('api.patient.index'))
                ->optionValue('id')
                ->optionLabel('name'),
            Filter::multiSelectAsync('clinic.name', 'clinic_id')
                ->url(route('api.clinic.index'))
                ->optionValue('id')
                ->optionLabel('name'),
            Filter::datetimepicker('schedule'),
            Filter::enumSelect('status')->dataSource(AppointmentStatusEnum::cases())->optionLabel('name')->optionValue('value'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->redirect("/appointment/{$rowId}/edit", true);
    }

    #[\Livewire\Attributes\On('payment')]
    public function payment($rowId): void
    {
        $this->redirect("/appointment/{$rowId}/payment", true);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $appointment = Appointment::with(['payment'])->find($rowId);

        if ($appointment->payment) {
            $appointment->payment->delete();
        }

        $appointment->delete();
    }

    public function actions(Appointment $row): array
    {
        return [
            Button::add('payment')
                ->slot('Payment')
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('payment', ['rowId' => $row->id]),

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

    public function actionRules($row): array
    {
        return [
            Rule::button('payment')
                ->when(fn ($row) => $row->status != AppointmentStatusEnum::Approved->value)
                ->hide(),
        ];
    }
}
