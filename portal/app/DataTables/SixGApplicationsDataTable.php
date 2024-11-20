<?php

namespace App\DataTables;

use App\Models\{SixGUser,AssignedApplicationToExpert};
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
class SixGApplicationsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(Request $request, QueryBuilder $query): EloquentDataTable
    {
	$app_id = $request->app_id;
        if ($app_id) {
            $app_id = Crypt::decryptString($app_id);
        }

        $application_id_arr = array_column(AssignedApplicationToExpert::select('application_id')->get()->toArray(), 'application_id');

        return (new EloquentDataTable($query))
            ->setRowId('id')

	    ->editColumn('country', function ($row) {
                return $row->country_name->name ?? 'N/A';
            })


            ->editColumn('state', function ($row) {
                return $row->state_name->name ?? 'N/A';
            })

            ->editColumn('city', function ($row) {
                return $row->city_name->name ?? 'N/A';
            })

            ->editColumn('files', function ($row) {
                $files = '';

                if ($row->authorization_letter)
                $files .= 'Authorization Letter: ' . asset('storage/uploads/' . $row->authorization_letter) . ",";

                if ($row->bio_data_professional_credentials)
                $files .= 'Bio Data: ' . asset('storage/uploads/' . $row->bio_data_professional_credentials) . ",";

                if ($row->brief_product_solution_idea_description_attachment)
                $files .= 'Brief Product Solution: ' . asset('storage/uploads/' . $row->brief_product_solution_idea_description_attachment) . ",";

                if ($row->provide_the_specification_doc_relavant_to_product)
                $files .= 'Specific Doc Relevant to Product: ' . asset('storage/uploads/' . $row->provide_the_specification_doc_relavant_to_product) . ",";

                if ($row->provide_dev_plan_indicate_major_milestone_attachment)
                $files .= 'Dev Plan Indicate Major Milestone: ' . asset('storage/uploads/' . $row->provide_dev_plan_indicate_major_milestone_attachment) . ",";

                if ($row->infrastructure_support_requirements_attachment)
                $files .= 'Infrastructure Support Requirements: ' . asset('storage/uploads/' . $row->infrastructure_support_requirements_attachment) . ",";

                if ($row->details_of_existing_tools_testers_platform_attachment)
                $files .= 'Details of Existing Tools Testers Platform: ' . asset('storage/uploads/' . $row->details_of_existing_tools_testers_platform_attachment) . ",";

                if ($row->estimated_development_cost_attachment)
                $files .= 'Estimated Development Cost: ' . asset('storage/uploads/' . $row->estimated_development_cost_attachment) . ",";

                if ($row->details_of_funding_attachment)
                $files .= 'Details of Funding: ' . asset('storage/uploads/' . $row->details_of_funding_attachment) . ",";

                if ($row->details_self_funding_attachment)
                $files .= 'Self Funding Attachment: ' . asset('storage/uploads/' . $row->details_self_funding_attachment) . ",";

                return $files;

            })

	   ->editColumn('authorization_letter', function ($row) {
                $file = 'N/A';

                if ($row->authorization_letter)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->authorization_letter).'", "Link")';

                return $file;
            })

            ->editColumn('bio_data_professional_credentials', function ($row) {
                $file = 'N/A';

                if ($row->bio_data_professional_credentials)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->bio_data_professional_credentials).'", "Link")';

                return $file;
            })

            ->editColumn('brief_product_solution_idea_description_attachment', function ($row) {
                $file = 'N/A';

                if ($row->brief_product_solution_idea_description_attachment)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->brief_product_solution_idea_description_attachment).'", "Link")';

                return $file;
            })

            ->editColumn('provide_the_specification_doc_relavant_to_product', function ($row) {
                $file = 'N/A';

                if ($row->provide_the_specification_doc_relavant_to_product)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->provide_the_specification_doc_relavant_to_product).'", "Link")';

                return $file;
            })

            ->editColumn('provide_dev_plan_indicate_major_milestone_attachment', function ($row) {
                $file = 'N/A';

                if ($row->provide_dev_plan_indicate_major_milestone_attachment)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->provide_dev_plan_indicate_major_milestone_attachment).'", "Link")';

                return $file;
            })

            ->editColumn('infrastructure_support_requirements_attachment', function ($row) {
                $file = 'N/A';

                if ($row->infrastructure_support_requirements_attachment)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->infrastructure_support_requirements_attachment).'", "Link")';

                return $file;
            })

            ->editColumn('details_of_existing_tools_testers_platform_attachment', function ($row) {
                $file = 'N/A';

                if ($row->details_of_existing_tools_testers_platform_attachment)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->details_of_existing_tools_testers_platform_attachment).'", "Link")';

                return $file;
            })

            ->editColumn('estimated_development_cost_attachment', function ($row) {
                $file = 'N/A';

                if ($row->estimated_development_cost_attachment)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->estimated_development_cost_attachment).'", "Link")';

                return $file;
            })


            ->editColumn('details_of_funding_attachment', function ($row) {
                $file = 'N/A';

                if ($row->details_of_funding_attachment)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->details_of_funding_attachment).'", "Link")';

                return $file;
            })

            ->editColumn('details_self_funding_attachment', function ($row) {
                $file = 'N/A';

                if ($row->details_self_funding_attachment)
                $file = '=HYPERLINK("'.asset('storage/uploads/' . $row->details_self_funding_attachment).'", "Link")';

                return $file;
            })

	    ->editColumn('all', function ($row) use($application_id_arr, $app_id) {
              //$disabled = in_array($row->id, $application_id_arr) ? "disabled" : "";
              $assigned = in_array($row->id, $application_id_arr) ? "<p class=\"mt-2 text-center\"><span class=\"assigned_app badge btn-success\" data-enc-id=" . Crypt::encryptString($row->id) . ">Assigned</span></p>" : "";

              $selected = ($app_id == $row->id ? "checked" : "");
              return '<input type="radio" name="sixg_applications[]" id="checkbox_'.$row->id.'" class="form-control cbox" value="' . Crypt::encryptString($row->id) . '" ' . $selected . '  />' . $assigned;
            })

            ->editColumn('created_at', function ($row) {
                return date('D, j M Y H:i', strtotime($row->created_at));
            })
            ->addColumn('action', function ($row) {
		$col = '';
		
if (in_array('super_admin', get_roles())) {
    $col .= '<a href="' . route('six_g_user.show', Crypt::encryptString($row->id)) . '" class="btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
    
    //$edit_route = route('sixg.enable_edit', encrypt($row->id));
    //$col .= "<a href='".$edit_route."' onclick=\"return confirm('are you sure ?')\" class=\"btn-xs\">[Enable Edit]</a>";

    $enc_id = encrypt($row->id);

    $col .= "<a style=\"margin-left:10px;line-height:44px\" href=\"#\" onclick=\"get_evaluation('$enc_id')\" class=\"btn-xs btn-success\"><i class=\"fa fa-list\"></i></a>";

} else {
    
    if ($row->is_form_submit == 0)
    $col .= '<a href="' . route('six_g_user') . '" class="btn-xs btn-edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;';
     else
    $col .= '<a href="' . route('six_g_user.show', Crypt::encryptString($row->id)) . '" class="btn-xs btn-primary"><i class="fa fa-eye"></i></a>';
}

		return $col;
            })
            ->rawColumns(['action', 'all']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Request $request, SixGUser $model): QueryBuilder
    {
        if (in_array('super_admin', get_roles()) OR in_array('admin_view', get_roles())) {
            //return $model->where('is_form_submit', 1)->orderBy('id', 'DESC')->newQuery();

	    $action = $request->tab ?? 'submitted';

            if ("all" == $action) {
                return $model->orderBy('id', 'DESC')->newQuery();
            } elseif ("submitted" == $action) {
                return $model->where('is_form_submit', 1)->orderBy('id', 'DESC')->newQuery();
            } else {
                return $model->where('is_form_submit', 0)->orderBy('id', 'DESC')->newQuery();
            }

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
                    ->setTableId('sixgapplications-table')
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
	if (in_array('super_admin', get_roles())):
            $first_col = Column::make('all')->title('')->orderable(false)->searchable(false);
        else:
            $first_col = Column::make('sno')->title('#')->render('meta.row + meta.settings._iDisplayStart + 1')->orderable(false)->searchable(false);
        endif;

        return [
                    $first_col,
                    Column::make('organization_name')->orderable(false),
                    Column::make('nodal_contact_person')->orderable(false),
                    
                    Column::make('contact_no')->orderable(false),
                    Column::make('email_id')->orderable(false),

		    Column::make('country')->orderable(false)->visible(false),
                    Column::make('state')->orderable(false)->visible(false),
                    Column::make('city')->orderable(false)->visible(false),


                    Column::make('designation')->orderable(false)->visible(false),
                    Column::make('address')->orderable(false)->visible(false),
                    Column::make('pin_no')->orderable(false)->visible(false),
                    Column::make('applying_as')->orderable(false)->visible(false),


                    Column::make('proposed_project_title')->orderable(false)->visible(false),
                    Column::make('proposed_product_area_category')->orderable(false)->visible(false),
                    Column::make('technology_area')->orderable(false)->visible(false),
                    Column::make('stage_of_product_based_on_minimum_technology_readiness_level')->orderable(false)->visible(false),
                    Column::make('collaboration_customers_clients')->orderable(false)->visible(false),
                    Column::make('list_of_ipr_awards_paper_published')->orderable(false)->visible(false),
                    Column::make('relevant_standards_standard_body_membership')->orderable(false)->visible(false),
                    Column::make('brief_product_solution_idea_description')->orderable(false)->visible(false),
                    //Column::make('brief_product_solution_idea_description_attachment')->orderable(false)->visible(false),


                    Column::make('primary_objective_of_module_sub_system_product_solution_proposed')->orderable(false)->visible(false),
                    Column::make('key_deliverables')->orderable(false)->visible(false),
                    Column::make('type_of_solution_product')->orderable(false)->visible(false),
                    Column::make('details_prior_experience')->orderable(false)->visible(false),
                    Column::make('if_the_proposed_solution_product')->orderable(false)->visible(false),

                    Column::make('is_product_tech_related_to_present_activities')->orderable(false)->visible(false),
                    Column::make('is_it_new_concept_design_sol_product')->orderable(false)->visible(false),
                    Column::make('are_there_any_alternate_competive_tech_product')->orderable(false)->visible(false),
                    //Column::make('provide_the_specification_doc_relavant_to_product')->orderable(false)->visible(false),



                    Column::make('provide_dev_plan_indicate_major_milestone')->orderable(false)->visible(false),
                    //Column::make('provide_dev_plan_indicate_major_milestone_attachment')->orderable(false)->visible(false),
                    Column::make('manpower_support_requirements')->orderable(false)->visible(false),
                    Column::make('infrastructure_support_requirements')->orderable(false)->visible(false),
                    //Column::make('infrastructure_support_requirements_attachment')->orderable(false)->visible(false),
                    Column::make('details_of_existing_tools_testers_platform')->orderable(false)->visible(false),
                    //Column::make('details_of_existing_tools_testers_platform_attachment')->orderable(false)->visible(false),
                    Column::make('any_additional_dev_tools_software_requirements')->orderable(false)->visible(false),
                    Column::make('estimated_development_cost')->orderable(false)->visible(false),
                    Column::make('fund_expected')->orderable(false)->visible(false),
                    Column::make('details_of_funding')->orderable(false)->visible(false),
                    //Column::make('details_of_funding_attachment')->orderable(false)->visible(false),

                    Column::make('details_self_funding')->orderable(false)->visible(false),
                    //Column::make('details_self_funding_attachment')->orderable(false)->visible(false),
                    Column::make('any_regulatory_approval')->orderable(false)->visible(false),
                    Column::make('any_other_remarks')->orderable(false)->visible(false),


		    Column::make('authorization_letter')->orderable(false)->visible(false),
                    Column::make('bio_data_professional_credentials')->orderable(false)->visible(false),
                    Column::make('brief_product_solution_idea_description_attachment')->orderable(false)->visible(false),
                    Column::make('provide_the_specification_doc_relavant_to_product')->orderable(false)->visible(false),
                    Column::make('provide_dev_plan_indicate_major_milestone_attachment')->orderable(false)->visible(false),
                    Column::make('infrastructure_support_requirements_attachment')->orderable(false)->visible(false),
                    Column::make('details_of_existing_tools_testers_platform_attachment')->orderable(false)->visible(false),
                    Column::make('estimated_development_cost_attachment')->orderable(false)->visible(false),
                    Column::make('details_of_funding_attachment')->orderable(false)->visible(false),
                    Column::make('details_self_funding_attachment')->orderable(false)->visible(false),

                    //Column::make('files')->title('All Files')->orderable(false)->visible(false)->searchable(false),


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
        return 'SixGApplications_' . date('YmdHis');
    }
}
