<?php

namespace App\DataTables;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;

class EquipmentsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'equipments.action')
            ->setRowId('id')

            ->addColumn('specification', function ($row) {
                return $row->specification ?? 'N/A';
            })

            ->addColumn('image', function ($row) {
                return $row->image != '' ? "<img src='".url('storage/uploads/' . $row->image)."' width=\"70\">" : "N/A";
            })

            ->addColumn('action', function ($row) {

                if (in_array('vendor', get_roles())) {
                    return '<a href="' . route('equipment.update_specification', [Crypt::encryptString($row->id)]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                }

                elseif( ! permission('equipments.update'))
                    return '<a href="' . route('equipments.edit', [$row->id]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                else
                    return 'N/A';
            })

            ->rawColumns(['action', 'specification', 'image']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Equipment $model): QueryBuilder
    {
        if (in_array('vendor', get_roles())) 
            {
                return Equipment::
                            leftJoin('equipment_specifications', function ($join) {
                                $join->on('equipment_specifications.equipment_id', '=' , 'equipments.id') ;
                                $join->where('equipment_specifications.vendor_id', '=', current_user_id()) ;
                            })
                            ->select('equipments.id', 'equipments.equipment', 'equipments.model', 'equipment_specifications.specification', 'equipment_specifications.image');
            }
        else {
                return $model->newQuery();
             }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('equipments-table')
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
                    Column::make('id'),
                    Column::make('equipment'),
                    Column::make('specification')->title('Specification'),
                    Column::make('image')->title('Image'),
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
        return 'Equipments_' . date('YmdHis');
    }
}
