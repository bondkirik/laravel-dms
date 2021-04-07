<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'users.datatables_actions')
            ->editColumn('status', function (User $user) {
                if ($user->status == config('constants.STATUS.ACTIVE')) {
                    return '<span class="label label-success">' . $user->status . '</span>';
                }

                return '<span class="label label-danger">' . $user->status . '</span>';
            })->rawColumns(['action', 'status']);
    }

    public function query(User $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()->where('id', '!=', 1);
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
                    // ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner'],
                    // ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner'],
                    // ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner'],
                    // ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner'],
                ],
            ]);
    }

    protected function getColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'username',
            'address',
            'status',
        ];
    }

    protected function filename(): string
    {
        return 'usersdatatable_' . time();
    }
}
