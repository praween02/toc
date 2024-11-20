<?php

namespace App\DataTables;

use App\Models\{User,VendorZone};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorsDataTable extends DataTable
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

            ->addColumn('institutes', function($row) {
                return  "<button style=\"cursor:pointer\" class='cursor-pointer badge fnt13 cursor-pointer bg-secondary show-details' onClick='getVendorInstitute($row->id)' data-react_id= " . $row->id . ">" . __('app.assigned_institute') . "</button> ";
            })

            ->rawColumns(['status', 'action', 'institutes']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        //return $model->newQuery();
        // return User::rightJoin('vendors', 'vendors.vendor_id', '=', 'users.id')
        //                 ->select(['vendors.vendor_id AS id', 'users.name', 'users.email', 'users.created_at', 'users.updated_at']);

        return User::rightJoin('role_users', 'role_users.user_id', '=', 'users.id')->select(['users.id AS id', 'users.name', 'users.email', 'users.created_at', 'users.updated_at'])->where('role_users.role_id', 2);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendors-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
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
                    Column::make('name'),
                    Column::make('email'),
                    Column::make('institutes')
               ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Vendors_' . date('YmdHis');
    }
}
