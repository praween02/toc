<?php

namespace App\DataTables;

use App\Models\TelecomProject;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
use DB;

class TelecomDataTable extends DataTable
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

            ->editColumn('department', function ($row) {
                return $row->telecom_department->department;
            })


            ->addColumn('action', function ($row) {
                return '<a href="' . route('telecom.edit', [$row->id]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
            })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Request $request, TelecomProject $model): QueryBuilder
    {
        $type = $request->type;
        $filter = $request->filter;

        $user_arr = DB::SELECT("SELECT `user_id` FROM `" . DB::getTablePrefix() . "user_telecom_departments` WHERE `department_id` = (SELECT `id` FROM `" . DB::getTablePrefix() . "telecom_departments` WHERE `department` = '" . $type . "')");

        if (in_array('project_manager', get_roles())) {
            if ($filter)
            return $model->where('user_id', current_user_id())->where('core_technology', $filter)->orderBy('id', 'DESC')->newQuery();
                else
            return $model->where('user_id', current_user_id())->orderBy('id', 'DESC')->newQuery();
        } else {
            if ($filter)
            return $model->where('core_technology', $filter)->orderBy('id', 'DESC')->newQuery();
                else
            return $model->orderBy('id', 'DESC')->newQuery();
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('projects-table')
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
            Column::make('project')->orderable(false),
            Column::make('implement_agency')->orderable(false),
            Column::make('core_technology')->orderable(false),
            Column::make('cost')->orderable(false),
            Column::make('department')->orderable(false)->searchable(false),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Projects_' . date('YmdHis');
    }
}
