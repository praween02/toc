<?php

namespace App\DataTables;

use App\Models\AskExpertDetail;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AskExpertDetailsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

	   ->editColumn('gender', function ($row) {
                    return ($row->gender);
                })

            ->editColumn('city', function ($row) {
                    return ($row->city_data->name ?? 'N/A');
                })

            ->editColumn('state', function ($row) {
                    return ($row->state_data->name ?? 'N/A');
                })

            ->editColumn('country', function ($row) {
                    return ($row->country_data->name ?? 'N/A');
                })

            ->editColumn('activity', function ($row) {
                    return ($row->activity_data->expertise ?? 'N/A');
                })

            ->editColumn('cv', function ($row) {
                $file = 'N/A';

                if ($row->cv)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->cv).'", "Link")';

                return $file;
            })

            ->editColumn('id_proof_document', function ($row) {
                $file = 'N/A';

                if ($row->id_proof_document)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->id_proof_document).'", "Link")';

                return $file;
            })

            ->editColumn('photograph', function ($row) {
                $file = 'N/A';

                if ($row->photograph)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->photograph).'", "Link")';

                return $file;
            })

            ->editColumn('web_page', function ($row) {
                $file = 'N/A';

                if ($row->web_page)
                $file = '=HYPERLINK("'. $row->web_page . '", "Link")';

                return $file;
            })

	   ->editColumn('approved', function ($row) {
                $approved =  ($row->approved === 0 ? ('<p class="text-center mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#ff0000" class="bi bi-circle-fill" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"></circle></svg></p>') : ('<p class="text-center mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="#08b833" class="bi bi-circle-fill" viewBox="0 0 16 16"><circle cx="8" cy="8" r="8"></circle></svg></p>'));

		if (in_array('super_admin', get_roles())) {
                  $route = route('experts.status', encrypt($row->id));
                  $approved .= "<a style='font-size:9px !important;text-align:center;display:block' href='" . $route . "'>[Change]</a>";
		}

                return $approved;
            })            

            ->editColumn('created_at', function ($row) {
                    return date('D, j M Y H:i', strtotime($row->created_at));
                })

            ->editColumn('created_at', function ($row) {
                    return date('D, j M Y H:i', strtotime($row->created_at));
                })

	   ->editColumn('nda', function ($row) {
                $file = 'N/A';

                if ($row->nda_agreement)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->nda_agreement).'", "Link")';

                return $file;
            })

            ->addColumn('action', function ($row) {

                return '<a href="javascript:void(0)" onClick="application_summary(&quot;' . encrypt($row->id) . '&quot;)" class="btn-xs btn-primary application_summary"><i class="fa fa-eye"></i></a>';
            })
            ->setRowId('id')
	    ->rawColumns(['approved', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(AskExpertDetail $model): QueryBuilder
    {
        if (in_array('super_admin', get_roles()) OR in_array('admin_view', get_roles())) {
            return $model->orderBy('id', 'DESC')->newQuery();
        } else {
            return $model->where('user_id', current_user_id())->orderBy('id', 'DESC')->newQuery();
        }   
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('askexpertdetails-table')
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
            Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->searchable(false)->orderable(false),
            Column::make('family_name')->orderable(false),
            Column::make('first_name')->orderable(false),
            Column::make('gender')->orderable(false)->visible(false),
            Column::make('position')->orderable(false),
            Column::make('current_organization')->orderable(false),
            Column::make('affiliations_certifications')->orderable(false),
            Column::make('graduation_date')->orderable(false)->visible(false),
	    Column::make('nda')->orderable(false)->visible(false)->searchable(false),


            Column::make('official_email')->orderable(false)->visible(false),
            Column::make('personal_email')->orderable(false)->visible(false),
            Column::make('address')->orderable(false)->visible(false),
            Column::make('city')->orderable(false)->visible(false),
            Column::make('state')->orderable(false)->visible(false),
            Column::make('country')->orderable(false)->visible(false),
            Column::make('post_code')->orderable(false)->visible(false),
            Column::make('whether_have_oci')->orderable(false)->visible(false),
            Column::make('tel_mobile')->orderable(false)->visible(false),
            Column::make('fax_prof')->orderable(false)->visible(false),


            Column::make('activity')->orderable(false)->visible(false),
            Column::make('level')->orderable(false)->visible(false),
            Column::make('cv')->orderable(false)->visible(false),
            Column::make('id_number')->orderable(false)->visible(false),
            Column::make('id_proof_document')->orderable(false)->visible(false),
            Column::make('photograph')->orderable(false)->visible(false),
            Column::make('web_page')->orderable(false)->visible(false),

	    Column::make('approved')->orderable(false)->exportable(false),

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
        return 'AskExpertDetails_' . date('YmdHis');
    }
}
