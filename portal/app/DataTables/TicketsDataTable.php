<?php

namespace App\DataTables;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;
use DB;

class TicketsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('institute_id', function ($row) {
                return $row->institute ?? 'N/A';
            })

            ->addColumn('subject', function ($row) {
                return ($row->subject == 'equipment_related' ? '<span class=\'badge btn-warning\'>Equipment Related</span>' : '<span class=\'badge btn-primary\'>Others</span>');
            })

            ->addColumn('user_id', function ($row) {
                return ucwords($row->user->name);
            })

            ->addColumn('status', function ($row) {
                return ($row->status == 'open' ? ('<span class=\'badge btn-info\'>Open</span>') : (($row->status == 'in-progress') ? '<span class=\'badge btn-secondary\'>In Progress</span>' : '<span class=\'badge btn-success\'>Closed</span>'));
            })

            ->editColumn('description', function ($row) {
                return Str::limit($row->description, 100, '...');
            })

            ->editColumn('created_at', function ($row) {
                return date('D, j M\'y', strtotime($row->created_at));
            })

            ->addColumn('action', function ($row) {

                $action =  '<a href="' . route('tickets.show', [$row->ticket_no]) . '" class="btn-xs btn-primary"><i class="fa fa-eye"></i></a>';

                if ($row->status != "closed")
                $action .=  '&nbsp;<a href="' . route('tickets.edit', [$row->ticket_no]) . '" class="btn-xs btn-primary"><i class="fa fa-edit"></i></a>';

                return $action;
            })

            ->setRowId('id')
            ->rawColumns(['description', 'subject', 'action', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Ticket $model): QueryBuilder
    {
        $current_user_id = current_user_id();

        $roles = get_roles();

        if (in_array('institute', $roles)) {
            $get_inst_vendor_id = DB::SELECT("SELECT `vendor_id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `id` IN (SELECT `vendor_zone_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `institute_id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "user_institutes` WHERE `user_id` = " . $current_user_id . "))")[0];
            return Ticket::select(['tickets.*'])->whereIn('user_id', [$get_inst_vendor_id->vendor_id ?? 0, $current_user_id])->orderBy('id', 'DESC');
        } else if (in_array('super_admin', $roles)) {
            return Ticket::select(['tickets.*'])->orderBy('id', 'DESC');
        } else if (in_array('vendor', $roles)) {
            $get_vendor_institute_users = DB::SELECT("SELECT `user_id` FROM `" . DB::getTablePrefix() . "user_institutes` WHERE `institute_id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `vendor_id` = " . $current_user_id . "))");
            $user_ids = array_column($get_vendor_institute_users, 'user_id');
            $user_ids[] = $current_user_id;
            return Ticket::select(['tickets.*'])->whereIn('user_id', $user_ids)->orderBy('id', 'DESC');
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('tickets-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
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
            Column::make('ticket_no')->orderable(false),
            Column::make('subject')->orderable(false),
            Column::make('user_id')->title('Requested By')->orderable(false),
            Column::make('created_at')->title('Requested On')->orderable(false),
            Column::make('status')->orderable(false),
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
        return 'Tickets_' . date('YmdHis');
    }
}
