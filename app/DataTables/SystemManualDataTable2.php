<?php

namespace App\DataTables;

use App\Models\SystemManual;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;

class SystemManualDataTable2 extends DataTable
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
            ->addColumn('no_of_page', function ($row) {
                return $row->no_of_page; 
            })
            ->addColumn('document_title', function ($row) {
                return $row->document_title ?? 'N/A';
            })
            ->addColumn('date', function ($row) {
                return $row->date ?? 'N/A';
            })
            ->addColumn('institute_name', function ($row) {
                return $row->institute_name ?? 'N/A';
            })
            ->addColumn('type', function ($row) {
                return $row->type==1?'Upload Document':($row->type==2?'Implement Of Documents':($row->type==3?'Implement Of Documents':'UAT Signature'));
            })
            ->addColumn('document_file', function ($row) {
                if ($row->document_file) {
                    return '<a href="' . asset('storage/' . $row->document_file) . '" target="_blank">View File</a>';
                }
                return 'N/A';
            })
            ->addColumn('action', function ($row) {
                // $actions = '<a href="' . route('system_manual.index', [encrypt($row->id)]) . '" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>';
                // if (!permission('system_manual.update')) {
                    $actions = '<a href="' . route('system_manual.signature-edit', [$row->id]) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                // }
                return $actions;
            })
            ->rawColumns(['document_title', 'document_file', 'action','type','no_of_page','date','institute_name']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SystemManual $model): QueryBuilder
    {
        $roles = get_roles();
        if (in_array('institute', $roles)) {
            return $model->newQuery()
            ->leftjoin('users', 'users.id', '=', 'system_manual.created_by') // Join with the users table
            ->select([
                'system_manual.id',
                'system_manual.document_title',
                'system_manual.document_file',
                'system_manual.type',
                'system_manual.no_of_page',
                'system_manual.date',
                'users.name as institute_name', // Select the equipment name from the joined table
            ])->where('system_manual.type','4')->where('system_manual.display',0)->where('created_by',Auth::user()->id);
        }else{
            return $model->newQuery()
            ->leftjoin('users', 'users.id', '=', 'system_manual.created_by') // Join with the users table
            ->select([
                'system_manual.id',
                'system_manual.document_title',
                'system_manual.document_file',
                'system_manual.type',
                'system_manual.no_of_page',
                'system_manual.date',
                'users.name as institute_name', // Select the equipment name from the joined table
            ])->where('system_manual.type','4')->where('system_manual.display',0);
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('system-manual-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $roles = get_roles();
        if (in_array('institute', $roles)){
            return [
                Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
                Column::make('type')->title('Type'),
                Column::make('document_title')->title('Document Title'),
                Column::make('document_file')->title('Document File'),
                Column::make('no_of_page')->title('No Of Page'),
                Column::make('date')->title('Signature Date'),
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
                
            ];
        }else{
            return [
                Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
                Column::make('type')->title('Type'),
                Column::make('document_title')->title('Document Title'),
                Column::make('document_file')->title('Document File'),
                Column::make('no_of_page')->title('No Of Page'),
                Column::make('date')->title('Signature Date'),
                Column::make('institute_name')->title('Institute Name'),
                
            ];
        }
        
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SystemManuals_' . date('YmdHis');
    }
}