<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RolesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')

            ->editColumn('name', function ($row) {
                return ucwords(str_replace('_', ' ', $row->name));
            })

            ->editColumn('slug', function ($row) {
                return $row->slug;
            })

            ->editColumn('total_users', function ($row) {
                $total_users = $row->total_users->count();
                return ('<div class="w-full text-center"><span class="badge badge-soft-primary bdg">' . $total_users . '</span></div>');
            })

            ->editColumn('created_at', function ($row) {
                return date('D, j M Y H:i', strtotime($row->created_at));
            })

            ->editColumn('status', function ($row) {
                return $row->status == 1 ? '<span class="badge bg-primary">Active</span>' : '<span class="badge bg-danger">Inactive</span>';
            })
            ->addColumn('action', function ($row) {

                return '<a href="' . route('roles.edit', [$row->id]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['status', 'action', 'total_users']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Role $model): QueryBuilder
    {
        return $model::with('total_users');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('roles-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('slug'),
            Column::make('total_users'),
            Column::make('created_at'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Roles_' . date('YmdHis');
    }
}
