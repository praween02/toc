<?php

namespace App\DataTables;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WorkShopDataTable extends DataTable
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
            ->editColumn('created_at', function ($row) {
                return date('D, j M\'y H:i', strtotime($row->created_at));
            })
            ->rawColumns([]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Workshop $model): QueryBuilder
    {
        return $model->orderBy('id', 'DESC')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('workshop-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
                    Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->searchable(false)->orderable(false),
                    Column::make('person_name')->orderable(false),
                    Column::make('organisation_name')->title('Organisation')->orderable(false),
                    Column::make('email_id')->title('Email')->orderable(false),
                    Column::make('contact_no')->orderable(false),
                    Column::make('expertise_in')->title('Expertise')->orderable(false),
                    Column::make('purpose_to_attend_workshop')->orderable(false),
                    Column::make('created_at')->orderable(false)
                ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Workshop_' . date('YmdHis');
    }
}
