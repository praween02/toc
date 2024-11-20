<?php

namespace App\DataTables;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PaymentsDataTable extends DataTable
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
            ->addColumn('action', function ($row) {
                return '<a href="' . route('payments.edit', [$row->id]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
            })

            ->editColumn('institute', function($row)
             {
                 return $row->institute->institute ?? 'N/A';
             })

            ->editColumn('user_id', function($row)
             {
                 return $row->user->name ?? 'N/A';
             })

            ->editColumn('transaction_date', function($row)
             {
                return date('D, j M\'y', strtotime($row->transaction_date));
             })
            ->editColumn('amount', function($row)
             {
                return '₹ ' . $row->amount;
             })
            ->rawColumns(['action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Payment $model): QueryBuilder
    {
        if (in_array('institute', get_roles())) {
            return $model->select(['id', 'user_id', 'utr_no', 'transaction_date', 'amount'])->where('user_id', current_user_id())->orderBy('transaction_date', 'DESC');
        } 
        else {
            return $model->orderBy('transaction_date', 'DESC')->newQuery();
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('payments-table')
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
        $arr[] = Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false);

        if (in_array('super_admin', get_roles())) 
            {
               $arr[] = Column::make('user_id')->title('User')->orderable(false)->searchable(true);
               $arr[] = Column::make('institute')->title('Institute')->orderable(false)->searchable(false);
            }

        $arr[] = Column::make('utr_no')->orderable(false)->searchable(true);
        $arr[] = Column::make('transaction_date')->orderable(false)->searchable(true);
        $arr[] = Column::make('amount')->orderable(false)->searchable(true);
        $arr[] = Column::computed('action')
                                ->exportable(false)
                                ->printable(false)
                                ->width(60)
                                ->addClass('text-center');
        return $arr;
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Payments_' . date('YmdHis');
    }
}
