<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\User;
use App\Models\VendorInstitute;
use App\Models\UserInstitute;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProposalController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $proposals = Proposal::where('user_id', $user->id)
            ->orWhereHas('teamMembers', function($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->latest()
            ->get();
        return view('pages.proposals.index', compact('proposals'));
    }

    public function create()
    {
        $user = Auth::user();
        $userInstitute = UserInstitute::where('user_id', $user->id)->first();
        
        if (!$userInstitute) {
            return redirect()->route('proposals.index')
                ->with('error', 'You must be associated with an institute to create proposals.');
        }

        $currentVendorZoneId = VendorInstitute::where('institute_id', $userInstitute->institute_id)
            ->value('vendor_zone_id');

        if (!$currentVendorZoneId) {
            return redirect()->route('proposals.index')
                ->with('error', 'Your institute is not associated with any vendor zone.');
        }

        // Get all institute IDs from the same zone
        $instituteIds = VendorInstitute::where('vendor_zone_id', $currentVendorZoneId)
            ->pluck('institute_id');

        // Get all users who have associations with institutes in the same zone
        $teamMembers = User::whereIn('id', function($query) use ($instituteIds) {
                $query->select('user_id')
                    ->from('user_institutes')
                    ->whereIn('institute_id', $instituteIds);
            })
            ->where('id', '!=', Auth::id())
            ->with(['userInstitutes.institute']) // Eager load relationships for the view
            ->get();

        return view('pages.proposals.create', compact('teamMembers'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userInstitute = UserInstitute::where('user_id', $user->id)
            ->first();
        
        if (!$userInstitute) {
            return redirect()->route('proposals.index')
                ->with('error', 'You must be associated with an approved institute to create proposals.');
        }

        $currentVendorZoneId = VendorInstitute::where('institute_id', $userInstitute->institute_id)
            ->value('vendor_zone_id');

        if (!$currentVendorZoneId) {
            return redirect()->route('proposals.index')
                ->with('error', 'Your institute is not associated with any vendor zone.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'socio_economic_vertical' => 'required|string|max:255',
            'description' => 'required|string',
            'proposal_brief' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'expected_completion_date' => 'required|date|after:today',
            'days_required' => 'required|integer|min:1',
            'expected_output' => 'required|string',
            'stack_holder' => 'required|string|max:50',
            'institute_id' => 'required|exists:institutes,id',
            'team_members' => 'required|array',
            'team_members.*' => [
                'exists:users,id',
                function ($attribute, $value, $fail) use ($currentVendorZoneId) {
                    $userInstitute = UserInstitute::where('user_id', $value)
                        ->first();
                    if ($userInstitute) {
                        $userVendorZoneId = VendorInstitute::where('institute_id', $userInstitute->institute_id)
                            ->value('vendor_zone_id');
                        
                        if ($userVendorZoneId !== $currentVendorZoneId) {
                            $fail('Team members must be from institutes in your zone.');
                        }
                    } else {
                        $fail('Selected team member must be associated with an institute.');
                    }
                }
            ]
        ]);

        // Validate that selected institute is in the same vendor zone
        $selectedInstituteVendorZoneId = VendorInstitute::where('institute_id', $request->institute_id)
            ->value('vendor_zone_id');
        
        if ($selectedInstituteVendorZoneId !== $currentVendorZoneId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selected institute must be from your vendor zone.');
        }

        $proposal = new Proposal($request->except('attachment', 'team_members'));
        $proposal->user_id = $user->id;
        
        // Use the selected institute_id from the form
        // $proposal->institute_id = $userInstitute->institute_id;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('proposals', 'public');
            $proposal->attachment = $path;
        }

        $proposal->save();

        // Add team members
        foreach ($request->team_members as $userId) {
            $proposal->teamMembers()->attach($userId, ['role' => 'team_member']);
        }

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal created successfully.');
    }

    public function show(Proposal $proposal)
    {
        return view('pages.proposals.show', compact('proposal'));
    }

    public function edit(Proposal $proposal)
    {
        
        $user = Auth::user();
        $userInstitute = UserInstitute::where('user_id', $user->id)
            ->first();
        
        if (!$userInstitute) {
            return redirect()->route('proposals.index')
                ->with('error', 'You must be associated with an approved institute to edit proposals.');
        }

        $currentVendorZoneId = VendorInstitute::where('institute_id', $userInstitute->institute_id)
            ->value('vendor_zone_id');

        if (!$currentVendorZoneId) {
            return redirect()->route('proposals.index')
                ->with('error', 'Your institute is not associated with any vendor zone.');
        }

        $instituteIds = VendorInstitute::where('vendor_zone_id', $currentVendorZoneId)
            ->pluck('institute_id');

        $teamMembers = User::whereHas('userInstitutes', function($query) use ($instituteIds) {
                $query->whereIn('institute_id', $instituteIds);
            })
            ->where('id', '!=', Auth::id())
            ->get();

        return view('pages.proposals.edit', compact('proposal', 'teamMembers'));
    }

    public function update(Request $request, Proposal $proposal)
    {
        
        $user = Auth::user();
        $userInstitute = UserInstitute::where('user_id', $user->id)
            ->first();
        
        if (!$userInstitute) {
            return redirect()->route('proposals.index')
                ->with('error', 'You must be associated with an approved institute to update proposals.');
        }

        $currentVendorZoneId = VendorInstitute::where('institute_id', $userInstitute->institute_id)
            ->value('vendor_zone_id');

        if (!$currentVendorZoneId) {
            return redirect()->route('proposals.index')
                ->with('error', 'Your institute is not associated with any vendor zone.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'socio_economic_vertical' => 'required|string|max:255',
            'description' => 'required|string',
            'proposal_brief' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'expected_completion_date' => 'required|date|after:today',
            'days_required' => 'required|integer|min:1',
            'expected_output' => 'required|string',
            'stack_holder' => 'required|string|max:255',
            'institute_id' => 'required|exists:institutes,id',
            'team_members' => 'required|array',
            'team_members.*' => [
                'exists:users,id',
                function ($attribute, $value, $fail) use ($currentVendorZoneId) {
                    $userInstitute = UserInstitute::where('user_id', $value)
                        ->first();
                    if ($userInstitute) {
                        $userVendorZoneId = VendorInstitute::where('institute_id', $userInstitute->institute_id)
                            ->value('vendor_zone_id');
                        
                        if ($userVendorZoneId !== $currentVendorZoneId) {
                            $fail('Team members must be from institutes in your zone.');
                        }
                    } else {
                        $fail('Selected team member must be associated with an institute.');
                    }
                }
            ]
        ]);

        // Validate that selected institute is in the same vendor zone
        $selectedInstituteVendorZoneId = VendorInstitute::where('institute_id', $request->institute_id)
            ->value('vendor_zone_id');
        
        if ($selectedInstituteVendorZoneId !== $currentVendorZoneId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Selected institute must be from your vendor zone.');
        }

        $proposal->fill($request->except('attachment', 'team_members'));

        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($proposal->attachment) {
                Storage::disk('public')->delete($proposal->attachment);
            }
            $path = $request->file('attachment')->store('proposals', 'public');
            $proposal->attachment = $path;
        }

        $proposal->save();

        // Update team members
        $proposal->teamMembers()->sync(
            collect($request->team_members)->mapWithKeys(function ($userId) {
                return [$userId => ['role' => 'team_member']];
            })->all()
        );

        return redirect()->route('proposals.index')
            ->with('success', 'Proposal updated successfully.');
    }

    public function destroy(Proposal $proposal)
    {
        
        if ($proposal->attachment) {
            Storage::disk('public')->delete($proposal->attachment);
        }
        
        $proposal->delete();
        
        return redirect()->route('proposals.index')
            ->with('success', 'Proposal deleted successfully.');
    }

    public function submit(Proposal $proposal)
    {
        
        $proposal->update(['status' => 'submitted']);
        
        return redirect()->route('proposals.index')
            ->with('success', 'Proposal submitted successfully.');
    }

    public function getTeamMembers(Request $request)
    {
        $request->validate([
            'institute_id' => 'required|exists:institutes,id',
        ]);

        $instituteId = $request->institute_id;
        
        // Get vendor zone ID for the selected institute
        $vendorZoneId = VendorInstitute::where('institute_id', $instituteId)
            ->value('vendor_zone_id');
            
        if (!$vendorZoneId) {
            return response()->json([]);
        }
        
        // Get all institute IDs in the same vendor zone
        // $instituteIds = VendorInstitute::where('vendor_zone_id', $vendorZoneId)
        //     ->pluck('institute_id');

        // Get users from the same vendor zone institutes, excluding current user
        $users = User::whereHas('userInstitutes', function($query) use ($instituteId) {
                $query->where('institute_id', $instituteId);
            })
            ->where('id', '!=', Auth::id())
            ->select('id', 'name', 'email')
            ->get()->toArray();

        return response()->json($users);
    }
} 