<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;

class UsersDataTable extends DataTable
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

            ->addColumn('role', function ($row) {

                    $role = $row->role->toArray();
                    return '<span class="badge bg-primary">' . ucwords(str_replace('_', ' ', $role['name'])) . '</span>';
            })

            ->addColumn('permission', function ($row) {

                $roles = $row->role->toArray();
                $enc_id = Crypt::encryptString($row->id);

                if ('super_admin' == $roles['slug']) {
                    return '<small class="sm">default permission can\'t be edited</small>';
                } else {

		    if(in_array('super_admin', get_roles()))
                    return '<a href="'.route('user.permission', $enc_id).'"><span class="badge bg-primary edit_permission" data-permission-id="'.$enc_id.'">Edit Permission</span></a>';
			else
		    return 'N/A';
                }
            })

            ->editColumn('created_at', function ($row) {
                return date('D, j M Y H:i', strtotime($row->created_at));
            })

            ->editColumn('updated_at', function ($row) {
                return date('D, j M Y H:i', strtotime($row->updated_at));
            })

            ->addColumn('action', function ($row) {
		  if(in_array('super_admin', get_roles()))
                  return '<a href="' . route('users.edit', [$row->id]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
			else
		  return 'N/A';
            })

            ->rawColumns(['action', 'role', 'permission']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        //return $model->newQuery();

        return $model->newQuery()->with('role:name,slug');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
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
            Column::make('email'),
            Column::make('role'),
            Column::make('permission'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Users_' . date('YmdHis');
    }
}
