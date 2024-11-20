<?php

namespace App\Http\Controllers;

use App\Models\{Ticket,Equipment,TicketReply,UserInstitute};
use Illuminate\Http\Request;
use App\DataTables\TicketsDataTable;
use Illuminate\Validation\Rule;

use App\Enums\{TicketStatus};
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TicketsDataTable $dataTable)
    {
        //
        abort_if((count(array_intersect(['institute', 'vendor', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
        return $dataTable->render('pages.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        abort_if((count(array_intersect(['institute', 'vendor', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));
        $institutes = $this->vendorAssignedInstitutes(current_user_id());
        return view('pages.ticket.create', compact('institutes'));
    }


     /**
     * Return the vendor assigned institutes.
     */

    private function vendorAssignedInstitutes($current_user_id = "") {
        return DB::SELECT("SELECT `id`, `institute` FROM `" . DB::getTablePrefix() . "institutes` WHERE `id` IN (SELECT `institute_id` FROM `" . DB::getTablePrefix() . "vendor_zone_institutes` WHERE `vendor_zone_id` IN (SELECT `id` FROM `" . DB::getTablePrefix() . "vendor_zones` WHERE `vendor_id` = $current_user_id))");
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_if((count(array_intersect(['institute', 'vendor', 'super_admin'], get_roles())) ? 0 : 1), 403, __('app.permission_denied'));

        $arr =  [
                    'subject' => [Rule::enum(TicketStatus::class)],
                    'description' => 'required|max:1024'
                ];

        if (in_array('vendor', get_roles()))
        $arr['institute'] = 'required';

        $request->validate($arr);

        $current_user_id = current_user_id();

        $ticket_no = rand(111111111111, 999999999999);

        $post_arr = ['ticket_no' => $ticket_no, 'subject' => $request->subject, 'user_id' => $current_user_id, 'created_at' => date("Y-m-d H:i:s")];

        if (in_array('institute', get_roles()))
        $post_arr['institute_id'] = UserInstitute::select('institute_id')->where('user_id', $current_user_id)->first()->institute_id;
            else
        $post_arr['institute_id'] = $request->institute ?? null;

        DB::beginTransaction();

        try {
            $ticket_id = Ticket::create($post_arr)->id;
            TicketReply::create(['ticket_id' => $ticket_id, 'user_id' => $current_user_id, 'message' => $request->description]);
            DB::commit();
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';
            DB::rollback();

            echo $e->getMessage(); die;
        }
        return redirect()->route('tickets.index')->with($key ?? 'message', $msg ?? 'Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($ticket_no)
    {
        $ticket = Ticket::where('ticket_no', $ticket_no)->firstOrFail();
        $comments = $this->get_ticket_comments($ticket->id);
        return view('pages.ticket.show', compact('comments', 'ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($ticket_no)
    {
        //
        $ticket = Ticket::where('ticket_no', $ticket_no)->first();
        $institutes = $this->vendorAssignedInstitutes(current_user_id());
        $comments = $this->get_ticket_comments($ticket->id);
        return view('pages.ticket.edit', compact('ticket', 'institutes', 'comments'));
    }


    private function get_ticket_comments($ticket_id = '') {

        $comments = TicketReply::select(['ticket_replies.message', 'ticket_replies.created_at', 'users.name'])
                                ->leftJoin('users', 'ticket_replies.user_id', '=', 'users.id')
                                ->where('ticket_replies.ticket_id', $ticket_id)
                                ->orderBy('ticket_replies.id', 'DESC')
                                ->get();
        return $comments;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ticket_no)
    {
        //
        $current_user_id = current_user_id();
        $ticket = Ticket::where('ticket_no', $ticket_no)->firstOrFail();

        $arr =  [
                    //'subject' => [Rule::enum(TicketStatus::class)],
                    'description' => 'required|max:1024'
                ];

       // if (in_array('vendor', get_roles()) && ($request->subject == 'equipment_related'))
       // $arr['institute'] = 'required';

        $request->validate($arr);

        //$post_arr = ['subject' => $request->subject, 'description' => $request->description, 'status' => $request->status, 'updated_at' => date("Y-m-d H:i:s")];

        $post_arr = ['updated_at' => date("Y-m-d H:i:s")];

        //$post_arr['institute_id'] = null;

        //if ($request->subject == 'equipment_related')
        //$post_arr['institute_id'] = $request->institute;


        if(current_user_id() == $ticket->user_id)
             {
                $post_arr['status'] = $request->status;
                if ($request->status == 'closed'):
                    $post_arr['closed_date'] = date('Y-m-d H:i:s');
                    $post_arr['closed_by'] = $current_user_id;
                else:
                    $post_arr['closed_date'] = null;
                    $post_arr['closed_by'] = null;
                endif;
             }

        DB::beginTransaction();
        try {
            $ticket->update($post_arr);
            TicketReply::create(['ticket_id' => $ticket->id, 'user_id' => $current_user_id, 'message' => $request->description]);
            DB::commit();
        } catch (\Exception $e) {
            $key = 'error';
            $msg = 'Something Went Wrong';

            echo $e->getMessage(); die;
            DB::rollback();
        }
        return redirect()->route('tickets.index')->with($key ?? 'message', $msg ?? 'Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket_no)
    {
        //
    }

}
