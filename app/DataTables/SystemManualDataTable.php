<?php

namespace App\DataTables;

use App\Models\SystemManual;
use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\Auth;

class SystemManualDataTable extends DataTable
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
            ->addColumn('vendor_name', function ($row) {
                return $row->vendor_name ?? 'N/A'; // Assuming the `Equipment` model has a `name` field
            })
            ->addColumn('equipment_name', function ($row) {
                return $row->equipment_name ?? 'N/A'; // Assuming the `Equipment` model has a `name` field
            })
            ->addColumn('no_of_page', function ($row) {
                return $row->no_of_page;
            })
            ->addColumn('document_title', function ($row) {
                return $row->document_title ?? 'N/A';
            })
            ->addColumn('type', function ($row) {
                return $row->type == 1 ? 'Upload Document' : ($row->type == 2 ? 'Lab Implemention Document' : ($row->type == 3 ? 'UAT Procedure Document' : ($row->type == 4 ? 'UAT Sign Document' : 'Receipt of goods Document')));
            })
            ->addColumn('date', function ($row) {
                return $row->date ?? 'N/A';
            })
            ->addColumn('document_file', function ($row) {
                if ($row->document_file) {
                    return '<a href="' . asset('storage/' . $row->document_file) . '" target="_blank">
                            <span class="badge bg-primary">Doc File</span>
                        </a><br>';
                }
                return 'N/A';
            })
            ->addColumn('action', function ($row) {
                // $actions = '<a href="' . route('system_manual.index', [encrypt($row->id)]) . '" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i></a>';
                // if (!permission('system_manual.update')) {
                if ($row->type == 4) {
                    $actions = '<a href="' . route('system_manual.signature-edit', [$row->id]) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                } elseif ($row->type == 5) {
                    $actions = '<a href="' . route('system_manual.receipt-goods-edit', [$row->id]) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                } else {
                    $actions = '<a href="' . route('system_manual.edit', [$row->id]) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>';
                }

                // }
                return $actions;
            })
            ->rawColumns(['equipment_name', 'document_title', 'document_file', 'action', 'type', 'no_of_page']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SystemManual $model): QueryBuilder
    {
        $roles = get_roles();
        $query = $model->newQuery()
            ->leftjoin('equipments', 'system_manual.equipment_id', '=', 'equipments.id')
            ->select([
                'system_manual.id',
                'system_manual.document_title',
                'system_manual.document_file',
                'system_manual.type',
                'system_manual.no_of_page',
                'system_manual.date',
                'equipments.equipment as equipment_name'
            ])->where('system_manual.display', 0);

        if (in_array('institute', $roles)) {
            $query->leftJoin('vendor_zones', 'vendor_zones.vendor_id', '=', 'system_manual.created_by')
                ->rightJoin('vendor_zone_institutes', 'vendor_zone_institutes.vendor_zone_id', '=', 'vendor_zones.zone_id')
                ->rightJoin('user_institutes', 'user_institutes.institute_id', '=', 'vendor_zone_institutes.institute_id')
                ->where('system_manual.type', '!=', '4')
                ->where('system_manual.type', '!=', '5')
                ->where('user_institutes.user_id', Auth::user()->id);
        } elseif (in_array('vendor', $roles)) {
            $query->where('system_manual.type', '!=', '5')
                ->where('system_manual.created_by', Auth::user()->id);
        } else {
            $query->leftJoin('users', 'system_manual.created_by', '=', 'users.id')
                ->addSelect(['users.name as vendor']);
        }

        // **Apply Custom Type Filter**
        if (request()->has('typeFilter') && request()->typeFilter != '0') {
            $query->where('system_manual.type', request()->typeFilter);
        }

        return $query->orderBy('system_manual.id', 'DESC');
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
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                // Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                // Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        $roles = get_roles();
        if (in_array('institute', $roles)) {
            return [

                Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
                Column::make('type')->title('Type'),
                Column::make('document_title')->name('system_manual.document_title')->title('Document Title'),
                Column::make('document_file')->name('system_manual.document_file')->title('Document File'),
                Column::make('no_of_page')->title('No Of Page'),



            ];
        } else  if (in_array('vendor', $roles)) {
            return [
                Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
                Column::make('type')->title('Type')->searchable(true), // Shorter title
                Column::make('equipment_name')->name('equipments.equipment')->title('equipments.equipment')->searchable(true), // Concise title
                Column::make('document_title')->name('system_manual.document_title')->title('Title')->searchable(true), // Simplified title
                Column::make('document_file')->title('File'), // Simplified title
                Column::make('no_of_page')->title('Pages'), // Simplified title
                Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        } else {
            if (request()->typeFilter != '1' && request()->typeFilter != '2' && request()->typeFilter != '3') {
                return [

                    Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
                    Column::make('vendor')->name('users.name')->title('Vendor/Institutes'),
                    Column::make('type')->name('system_manual.type')->title('Type')->searchable(true),
                    Column::make('equipment_name')->name('equipments.equipment')->title('Equipment Name')->searchable(true), // Change column title
                    Column::make('document_title')->name('system_manual.document_title')->title('Document Title')->searchable(true),
                    Column::make('document_file')->title('Document File'),
                    Column::make('no_of_page')->title('No Of Page'),
                    Column::make('date')->name('system_manual.date')->title('(Signature / Receipt Of Goods) Date'),
                    Column::computed('action')
                        ->exportable(false)
                        ->printable(false)
                        ->width(60)
                        ->addClass('text-center'),
                ];
            }else{
                return [

                    Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false),
                    Column::make('vendor')->name('users.name')->title('Vendor/Institutes'),
                    Column::make('type')->name('system_manual.type')->title('Type')->searchable(true),
                    Column::make('equipment_name')->name('equipments.equipment')->title('Equipment Name')->searchable(true), // Change column title
                    Column::make('document_title')->name('system_manual.document_title')->title('Document Title')->searchable(true),
                    Column::make('document_file')->title('Document File'),
                    Column::make('no_of_page')->title('No Of Page'),
                    // Column::make('date')->name('system_manual.date')->title('(Signature / Receipt Of Goods) Date'),
                    Column::computed('action')
                        ->exportable(false)
                        ->printable(false)
                        ->width(60)
                        ->addClass('text-center'),
                ];
            }
            
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
