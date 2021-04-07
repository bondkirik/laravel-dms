<?php

declare(strict_types=1);

namespace App\DataTables;

use App\Models\FileType;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class FileTypeDataTable extends DataTable
{
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', 'file_types.datatables_actions')
            ->editColumn('file_maxsize', '{{$file_maxsize}} MB');
    }

    public function query(FileType $model): \Illuminate\Database\Eloquent\Builder
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
            'no_of_files',
            'labels',
            'file_validations',
            'file_maxsize',
        ];
    }

    protected function filename(): string
    {
        return 'file_typesdatatable_' . time();
    }
}
