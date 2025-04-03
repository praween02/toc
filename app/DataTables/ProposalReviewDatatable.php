<?php

namespace App\DataTables;

use App\Models\Proposal;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\UserInstitute;

class ProposalReviewDatatable extends DataTable
{
    public function dataTable(QueryBuilder $query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('title', function ($proposal) {
                return $proposal->title ?? 'N/A';
            })
            ->addColumn('submitted_by', function ($proposal) {
                return $proposal->user->name ?? 'Unknown User';
            })
            ->addColumn('institute', function ($proposal) {
                return $proposal->institute->institute ?? $proposal->institute->name ?? 'Unknown Institute';
            })
            ->addColumn('expected_completion', function ($proposal) {
                return $proposal->expected_completion_date ?? 'Not set';
            })
            ->addColumn('status', function ($proposal) {
                $statusColors = [
                    'draft' => 'secondary',
                    'submitted' => 'info',
                    'under_review' => 'warning',
                    'approved' => 'success',
                    'rejected' => 'danger'
                ];
                
                $status = $proposal->status ?? 'unknown';
                $color = $statusColors[$status] ?? 'secondary';
                return '<span class="badge badge-' . $color . '">' . ucfirst(str_replace('_', ' ', $status)) . '</span>';
            })
            ->addColumn('action', function ($proposal) {
                return view('pages.proposal-reviews.actions', compact('proposal'))->render();
            })
            ->rawColumns(['status', 'action']);
    }

    public function query(Proposal $model)
    {
        $user = Auth::user();
        
        // Get all institute IDs the user has access to
        $instituteIds = UserInstitute::where('user_id', $user->id)
            ->pluck('institute_id')
            ->toArray();
            
        if (empty($instituteIds)) {
            Log::warning('No institutes found for user ID: ' . $user->id);
            // Return empty query if user has no institutes
            return $model->newQuery()->where('id', 0);
        }
        
        Log::info('User ' . $user->id . ' has access to institutes: ' . implode(', ', $instituteIds));
        
        // Return all proposals for these institutes
        return $model->newQuery()
            ->whereIn('institute_id', $instituteIds)
            ->with(['user', 'institute']);
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('proposal-reviews-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
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
            Column::make('title')->title('Proposal'),
            Column::make('submitted_by')->title('Submitted By'),
            Column::make('institute')->title('Institute'),
            Column::make('expected_completion')->title('Expected Completion'),
            Column::make('status')->title('Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'ProposalReviews_' . date('YmdHis');
    }
}