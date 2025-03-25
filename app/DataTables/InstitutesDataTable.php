<?php

namespace App\DataTables;

use App\Models\Institute;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use DB;
use Illuminate\Support\Facades\Log;

class InstitutesDataTable extends DataTable
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
            ->addColumn('institute', function ($row) {

                return '<a href="' . route('institute.summary', [encrypt($row->id)]) . '" class="">'.$row->institute.'</a>';
            })

            ->addColumn('action', function ($row) {

                $link = 'N/A';
                if( ! permission('institute.update')):
                $link = '<a href="' . route('institute.summary', [encrypt($row->id)]) . '" class="btn-xs btn-primary"><i class="fa fa-eye"></i></a>&nbsp;';
                $link .= '<a href="' . route('institutes.edit', [$row->id]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';
                endif;
                return $link;

            })
            ->rawColumns(['action', 'institute']);
    }

    /**
     * Get the query source of dataTable.
     */


     public function query(Institute $model): QueryBuilder
     {
         $search = request()->get('search')['value'] ?? null; 
         Log::info('Search Parameter:', ['search' => $search]);  
     
         if (in_array('vendor', get_roles())) {
             $query = Institute::select(['institutes.id', 'institutes.institute'])
                 ->rightJoin('vendor_zone_institutes', 'institutes.id', '=', 'vendor_zone_institutes.institute_id')
                 ->join('vendor_zones', 'vendor_zone_institutes.vendor_zone_id', '=', 'vendor_zones.id')
                 ->where('vendor_zones.vendor_id', \Auth::user()->id);
     
         } elseif (in_array('lsa', get_roles())) {
             $query = Institute::select(['institutes.id', 'institutes.institute'])
                 ->rightJoin('lsa_institute', 'institutes.id', '=', 'lsa_institute.institute_id')
                 ->where('lsa_institute.user_id', \Auth::user()->id)
                 ->orderBy('institutes.institute', 'ASC');
     
         } elseif (in_array('nodal', get_roles())) {
             $lsa_users = DB::table('nodal_lsas')
                 ->select('lsa_id')
                 ->where('nodal_user_id', current_user_id())
                 ->pluck('lsa_id')
                 ->toArray();
     
             $query = Institute::select(['institutes.id', 'institutes.institute'])
                 ->rightJoin('lsa_institute', 'institutes.id', '=', 'lsa_institute.institute_id')
                 ->whereIn('lsa_institute.user_id', $lsa_users)
                 ->orderBy('institutes.institute', 'ASC');
     
         } else {
             $query = $model->newQuery();
         }
     
         if (!empty($search)) {
             $query->where('institutes.institute', 'LIKE', "%{$search}%");
         }
     
         return $query;
     }
     
     
    

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('institutes-table')
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
            Column::make('institute'),
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
        return 'Institutes_' . date('YmdHis');
    }
}
