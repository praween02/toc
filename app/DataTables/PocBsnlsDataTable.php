<?php

namespace App\DataTables;

use App\Models\PocBsnl;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PocBsnlsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->editColumn('created_at', function ($row) {
                return date('D, j M Y H:i', strtotime($row->created_at));
            })

            ->addColumn('action', function ($row) {

                return '<a href="javascript:void(0)" onClick="application_summary(&quot;' . encrypt($row->id) . '&quot;)" class="btn-xs btn-primary application_summary"><i class="fa fa-eye"></i></a>';
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PocBsnl $model): QueryBuilder
    {
        if (in_array('super_admin', get_roles()) OR in_array('admin_view', get_roles())) {
            return $model->orderBy('id', 'DESC')->newQuery();
        } else {
            return $model->where('user_id', current_user_id())->orderBy('id', 'DESC')->newQuery();
        }   

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pocbsnls-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
            Column::make('company_name')->orderable(false),
            Column::make('cin_number')->orderable(false),
            Column::make('name')->orderable(false),
            Column::make('contact_no')->orderable(false),
            Column::make('email_id')->orderable(false),
            Column::make('created_at')->orderable(false),
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
        return 'PocBsnls_' . date('YmdHis');
    }
}
