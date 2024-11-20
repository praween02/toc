<?php

namespace App\Http\Controllers;

use \App\Models\{EvaluationCommittee,EvaluationCommitteeExpert,AskExpertDetail};

use Illuminate\Http\Request;

use App\DataTables\TeamsDataTable;

use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Crypt;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TeamsDataTable $dataTable)
        {
            //
            //abort_if(permission('users.list'), 403, __('app.permission_denied'));

            return $dataTable->render('pages.team.index');
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            //
            //abort_if(permission('teams.create'), 403, __('app.permission_denied'));

            $experts = DB::SELECT("SELECT `user_id`, `first_name` FROM `" . DB::getTablePrefix() . "ask_expert_details` WHERE `user_id` NOT IN (SELECT `expert_id` FROM `" . DB::getTablePrefix() . "evaluation_committee_experts`) AND `approved` = 1");

            return view('pages.team.create', compact('experts'));

        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            //abort_if(permission('teams.create'), 403, __('app.permission_denied'));

            $request->validate([
                                    'committee' => 'required|unique:evaluation_committees,team|max:128',
                                    "experts"=> "required",
                              ]);
            try {
                    DB::beginTransaction();

                    $evaluation_committee_id = EvaluationCommittee::create(['team' => $request->committee, 'created_at' => date('Y-m-d H:i:s')])->id;

                    foreach ($request->experts as $expert_id) {
                            EvaluationCommitteeExpert::insert(['evaluation_committee_id' => $evaluation_committee_id, 'expert_id' => $expert_id, 'created_at' => date('Y-m-d H:i:s')]);
                    }
                
                    DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $key = 'error';
                $msg = $e->getMessage();
                echo $msg; die;
            }

            return redirect()->route('teams.index')->with($key ?? 'message', $msg ?? 'Added Successfully');
        }

    /**
     * Display the specified resource.
     */
    public function show(EvaluationCommittee $team)
        {
            //
        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, EvaluationCommittee $team)
        {
            //abort_if(permission('teams.update'), 403, __('app.permission_denied'));

            $experts = DB::SELECT("SELECT `user_id`, `first_name` FROM `" . DB::getTablePrefix() . "ask_expert_details` WHERE `user_id` NOT IN (SELECT `expert_id` FROM `" . DB::getTablePrefix() . "evaluation_committee_experts` WHERE `evaluation_committee_id` != " . $team->id . ") AND `approved` = 1");

            $sel_experts_res = EvaluationCommitteeExpert::select('expert_id')->where('evaluation_committee_id', $team->id)->get()->toArray();

            $sel_experts = array_column($sel_experts_res, 'expert_id');

            // AskExpertDetail::
            //             select(['ask_expert_details.first_name'])
            //                 ->leftJoin('evaluation_committee_experts', 'ask_expert_details.user_id', '=', 'evaluation_committee_experts.expert_id')
            //                 ->where('evaluation_committee_experts.evaluation_committee_id', '!=', $team->id)
            //                 ->orderBy('ask_expert_details.first_name', 'ASC')
            //                 ->get();

            // print_r($experts); die;

            return view('pages.team.edit', compact('team', 'experts', 'sel_experts'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EvaluationCommittee $team)
        {
            //abort_if(permission('teams.update'), 403, __('app.permission_denied'));

            $request->validate([
                                    'committee' => 'required|unique:evaluation_committees,team,' . $team->id . '|max:128',
                                    "experts"=> "required",
                              ]);
            try {
                    DB::beginTransaction();
                    
                    $team->update(['team' => $request->committee, 'updated_at' => date('Y-m-d H:i:s')]);

                    EvaluationCommitteeExpert::where('evaluation_committee_id', $team->id)->delete();

                    foreach ($request->experts as $expert_id) {
                            EvaluationCommitteeExpert::insert(['evaluation_committee_id' => $team->id, 'expert_id' => $expert_id, 'created_at' => date('Y-m-d H:i:s')]);
                    }
                    DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                $key = 'error';
                $msg = $e->getMessage();
            }
            return redirect()->route('teams.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
        }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(EvaluationCommittee $team)
        {
            abort_if(permission('teams.delete'), 403, __('app.permission_denied'));
        }

}
