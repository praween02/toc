<?php

namespace App\Http\Controllers;

use App\DataTables\ProposalReviewDatatable;
use App\Helpers\Custom;
use App\Models\Proposal;
use App\Models\Institute;
use App\Models\ProposalReview;
use App\Models\UserInstitute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProposalReviewController extends Controller
{
    /**
     * Display a listing of the proposals pending review for the current institute user.
     *
     * @return \Illuminate\Http\Response
     */
    public function instituteIndex(Request $request, $institute_id = null)
    {
        $user = Auth::user();
        
        // Get the user's institute if no specific institute is provided
        if (!$institute_id) {
            $userInstitute = UserInstitute::where('user_id', $user->id)->first();
            $institute_id = $userInstitute ? $userInstitute->institute_id : null;
        }
        
        $institute = null;
        if ($institute_id) {
            $institute = Institute::find($institute_id);
        }
        
        // Get institute IDs the user has access to
        $userInstituteIds = UserInstitute::where('user_id', $user->id)
            ->pluck('institute_id')
            ->toArray();
        
        // Get proposals for these institutes with eager loading
        $proposals = Proposal::with(['user', 'institute'])
            ->whereIn('institute_id', $userInstituteIds)
            ->get();
            
        Log::info("Found " . $proposals->count() . " proposals for review");
        
        return view('pages.proposal-reviews.institute-index', compact('institute', 'proposals'));
    }

    /**
     * Display the review form for the specified proposal.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function review(Proposal $proposal)
    {
        // Check if user has permission to review this proposal
        $user = Auth::user();
        $userInstitutes = UserInstitute::where('user_id', $user->id)
            ->pluck('institute_id')
            ->toArray();
            
        if (!in_array($proposal->institute_id, $userInstitutes)) {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to review this proposal.');
        }
        
        // Get existing review or create a new one
        $review = ProposalReview::firstOrNew(['proposal_id' => $proposal->id]);
        
        return view('pages.proposal-reviews.review', compact('proposal', 'review'));
    }

    /**
     * Store or update a proposal review.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Proposal $proposal)
    {
        $validated = $request->validate([
            'comments' => 'nullable|string',
            'status' => 'required|in:under_review,approved,rejected',
        ]);
        
        // Update the proposal status
        $proposal->status = $validated['status'];
        $proposal->save();
        
        // Update or create the review
        ProposalReview::updateOrCreate(
            ['proposal_id' => $proposal->id],
            [
                'reviewer_id' => Auth::id(),
                'comments' => $validated['comments'],
                'status' => $validated['status'],
            ]
        );
        
        return redirect()->route('proposal-reviews.institutes')
            ->with('success', 'Proposal review has been submitted successfully.');
    }

    /**
     * Approve the specified proposal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve($id)
    {
        $proposal = Proposal::findOrFail($id);
        
        // Check if user has permission to review this proposal
        $user = Auth::user();
        $userInstitutes = UserInstitute::where('user_id', $user->id)
            ->pluck('institute_id')
            ->toArray();
            
        if (!in_array($proposal->institute_id, $userInstitutes)) {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to review this proposal.');
        }
        
        // Update the proposal status
        $proposal->status = 'approved';
        $proposal->save();
        
        
        return redirect()->route('proposal-reviews.institutes')
            ->with('success', 'Proposal has been approved successfully.');
    }

    /**
     * Reject the specified proposal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reject($id)
    {
        $proposal = Proposal::findOrFail($id);
        
        // Check if user has permission to review this proposal
        $user = Auth::user();
        $userInstitutes = UserInstitute::where('user_id', $user->id)
            ->pluck('institute_id')
            ->toArray();
            
        if (!in_array($proposal->institute_id, $userInstitutes)) {
            return redirect()->route('dashboard')
                ->with('error', 'You do not have permission to review this proposal.');
        }
        
        // Update the proposal status
        $proposal->status = 'rejected';
        $proposal->save();
        
        // Update or create the review
        ProposalReview::updateOrCreate(
            ['proposal_id' => $proposal->id],
            [
                'reviewer_id' => Auth::id(),
                'status' => 'rejected',
            ]
        );
        
        return redirect()->route('proposal-reviews.institutes')
            ->with('success', 'Proposal has been rejected successfully.');
    }

    /**
     * Display the specified proposal review.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = Proposal::with(['user', 'institute'])->findOrFail($id);
        $review = ProposalReview::where('proposal_id', $id)->first();
        
        return view('pages.proposal-reviews.show', compact('proposal', 'review'));
    }
}