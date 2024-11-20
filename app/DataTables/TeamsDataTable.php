<?php

namespace App\DataTables;

use App\Models\EvaluationCommittee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class TeamsDataTable extends DataTable
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

            ->editColumn('experts', function ($row) {
                
                $experts = [];
                foreach (json_decode($row->experts) as $expert) {
                    $experts[] = '<span class=\'badge btn-success\'>' . $expert->first_name . '</span>';
                }
                return implode(' ', $experts);
            })

            ->editColumn('created_at', function ($row) {
                return date('D, j M Y H:i', strtotime($row->created_at));
            })

            ->editColumn('updated_at', function ($row) {
                return date('D, j M Y H:i', strtotime($row->updated_at));
            })

            ->addColumn('action', function ($row) {
		if(in_array('super_admin', get_roles()))
                return '<a href="' . route('teams.edit', [$row->id]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
		  else
		return 'N/A';
            })
            
            ->rawColumns(['action', 'experts']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(EvaluationCommittee $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('teams-table')
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
            Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
            Column::make('team')->title('Committee')->orderable(false),
            Column::make('experts')->orderable(false)->searchable(false),
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
        return 'Teams_' . date('YmdHis');
    }
}
