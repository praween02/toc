<?php

namespace App\DataTables;

use App\Models\LabGrading;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class LabGradingDatatable extends DataTable
{
    public function dataTable(QueryBuilder $query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('institute', function ($grading) {
                return $grading->institute->name;
            })
            ->addColumn('innovation_project', function ($grading) {
                return $grading->innovation_project_check ? 
                    '<span class="badge badge-success">Yes</span>' : 
                    '<span class="badge badge-danger">No</span>';
            })
            ->addColumn('beyond_contribution', function ($grading) {
                return $grading->beyond_contribution ? 
                    '<span class="badge badge-success">Yes</span>' : 
                    '<span class="badge badge-danger">No</span>';
            })
            ->addColumn('poc_readiness', function ($grading) {
                return $grading->poc_readiness_check ? 
                    '<span class="badge badge-success">Yes</span>' : 
                    '<span class="badge badge-danger">No</span>';
            })
            ->addColumn('commercial_validation', function ($grading) {
                return $grading->commercial_product_validation ? 
                    '<span class="badge badge-success">Yes</span>' : 
                    '<span class="badge badge-danger">No</span>';
            })
            ->addColumn('action', function ($grading) {
                return view('pages.lab-grading.actions', compact('grading'))->render();
            })
            ->rawColumns(['innovation_project', 'beyond_contribution', 'poc_readiness', 'commercial_validation', 'action']);
    }

    public function query(LabGrading $model)
    {
        return $model->newQuery()->with('institute');
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('lab-gradings-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->title('ID'),
            Column::make('institute')->title('Institute'),
            Column::make('innovation_project')->title('Innovation Project'),
            Column::make('beyond_contribution')->title('Beyond Contribution'),
            Column::make('poc_readiness')->title('POC Readiness'),
            Column::make('commercial_validation')->title('Commercial Validation'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'LabGradings_' . date('YmdHis');
    }
} 