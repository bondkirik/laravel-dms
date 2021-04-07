<?php

namespace App\DataTables;

use App\Models\Tag;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class TagDataTable extends DataTable
{
    public function dataTable($query): \Yajra\DataTables\DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        $dataTable = $dataTable->addColumn('action', 'tags.datatables_actions')
            ->addColumn('created_by', function (Tag $tag) {
                return $tag->createdBy->name;
            })
            ->editColumn('color', function (Tag $tag) {
                return '<span class="label" style="background-color: ' . $tag->color . '">' . $tag->color . '</span>';
            })
            ->rawColumns(['color'], true)
            ->filterColumn('created_by', function ($query, $keyword) {
                return $query->whereRaw("
                    select count(*)
                    from users
                    where lower(users.name)
                    like ?
                        and users.id=tags.created_by",
                    ["%$keyword%"]
                );
            });

        return $dataTable;
    }

    public function query(Tag $model): \Illuminate\Database\Eloquent\Builder
    {
        return $model->newQuery()->with(['createdBy']);
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addColumn(['data' => 'created_by'])
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
            'color',
        ];
    }

    protected function filename(): string
    {
        return 'tagsdatatable_' . time();
    }
}
