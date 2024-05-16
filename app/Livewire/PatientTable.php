<?php

namespace App\Livewire;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
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

final class PatientTable extends PowerGridComponent
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
        return Patient::query()->latest();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('name')
            ->add('medical_record_id')
            ->add('nik')
            ->add('birth_place')
            ->add('birthday_formatted', fn (Patient $model) => Carbon::parse($model->birthday)->format('d/m/Y'))
            ->add('gender')
            ->add('address')
            ->add('religion')
            ->add('created_at')
            ->add('email')
            ->add('phone');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('Medical Record ID', 'medical_record_id')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('NIK', 'nik')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('Birth Place', 'birth_place')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('Birthday', 'birthday_formatted', 'birthday')
                ->visibleInExport(visible: true)
                ->sortable(),

            Column::make('Gender', 'gender')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('Address', 'address')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('Religion', 'religion')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('email', 'Email')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('phone', 'Phone')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->visibleInExport(visible: true)
                ->sortable()
                ->searchable(),

            Column::action('Action'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('birthday'),
            Filter::datetimepicker('created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->redirect("/patient/{$rowId}/edit", true);
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        Patient::find($rowId)->delete();
    }

    public function actions(Patient $row): array
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
