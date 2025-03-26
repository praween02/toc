<?php

namespace App\DataTables;

use App\Models\LabRegistration;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;
use DB;

class LabRegistrationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
{
    return (new EloquentDataTable($query))
        
        ->addColumn('applicant_category', function ($row) {
            return $row->applicant_category;
        })
        ->addColumn('subcategory', function ($row) {
            return $row->subcategory;
        })
        ->addColumn('person_name', function ($row) {
            return $row->person_name;
        })
        ->addColumn('qualification', function ($row) {
            return $row->qualification;
        })
        // ->addColumn('designation', function ($row) {
        //     return $row->designation;
        // })
        ->addColumn('institute', function ($row) {
            return $row->institute_company;
        })
        // ->addColumn('address', function ($row) {
        //     return $row->address;
        // })
        ->addColumn('mobile_no', function ($row) {
            return $row->mobile_no;
        })
        ->addColumn('email_id', function ($row) {
            return $row->email_id;
        })
        ->addColumn('reason', function ($row) {
            return $row->reason ?? 'N/A';
        })
        ->addColumn('status', function ($row) {
            return ($row->status == 'approved') 
                ? '<span class="badge btn-success">Approved</span>' 
                : (($row->status == 'rejected') 
                    ? '<span class="badge btn-danger">Rejected</span>'
                    : '<span class="badge btn-warning">Pending</span>');
        })
        // ->editColumn('created_at', function ($row) {
        //     return date('D, j M Y', strtotime($row->created_at));
        // })
        ->addColumn('action', function ($row) {
            $action = '<a href="' . route('lab-registration.show', [$row->id]) . '" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
            $action .= '&nbsp;<a href="' . route('lab-registration.edit', [$row->id]) . '" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>';
            $action .= '&nbsp;<button onclick="approve(' . $row->id . ')" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>';
            $action .= '&nbsp;<button onclick="rejectWithReason(' . $row->id . ')" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>';
            return $action;
        })
        ->setRowId('id')
        ->rawColumns(['status', 'action']);
}

    /**
     * Get the query source of dataTable.
     */
    public function query(LabRegistration $model): QueryBuilder
    {
        $current_user_id = current_user_id();
        return $model->newQuery()->where('institute_id', $current_user_id)->orderBy('id', 'DESC');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('lab-registration-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
        Column::make('applicant_category')->title('Applicant Category')->orderable(true),
        Column::make('subcategory')->title('Subcategory')->orderable(true),
        Column::make('person_name')->title('Person Name')->orderable(true),
        Column::make('qualification')->title('Qualification')->orderable(true),
        // Column::make('designation')->title('Designation')->orderable(true),
        Column::make('institute')->title('Institute')->orderable(true),
        // Column::make('address')->title('Address')->orderable(false),
        Column::make('mobile_no')->title('Mobile No')->orderable(false),
        Column::make('email_id')->title('Email ID')->orderable(false),
        Column::make('reason')->title('Reason')->orderable(false),
        Column::make('status')->title('Status')->orderable(false),
        // Column::make('created_at')->title('Registered On')->orderable(true),
        Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(100)
            ->addClass('text-center'),
    ];
}

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'LabRegistrations_' . date('YmdHis');
    }
}
