<?php

namespace App\DataTables;

use App\Models\Setting;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class SettingDataTable extends DataTable
{
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'settings.datatables_actions');
    }

    public function query(Setting $model): \Illuminate\Database\Eloquent\Builder
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
            'name',
            'value',
        ];
    }

    protected function filename(): string
    {
        return 'settingsdatatable_' . time();
    }
}
