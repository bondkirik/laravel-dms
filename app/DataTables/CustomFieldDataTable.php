<?php

declare(strict_types=1);

namespace App\DataTables;

use App\Models\CustomField;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class CustomFieldDataTable extends DataTable
{
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'custom_fields.datatables_actions')
            ->editColumn('model_type', function (CustomField $customField) {
                return config('settings_array.model_types_plural')[$customField->model_type];
            });
    }

    public function query(CustomField $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery();
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom' => 'Bfrtip',
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner'],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner'],
                ],
            ]);
    }

    protected function getColumns(): array
    {
        return [
            'id',
            'model_type',
            'name',
            'validation',
        ];
    }

    protected function filename(): string
    {
        return 'custom_fieldsdatatable_' . time();
    }
}
